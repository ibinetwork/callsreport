<?php /* $Id$ */

date_default_timezone_set('America/Sao_Paulo');
date_default_timezone_set("UTC");

$conf = parse_ini_file(__DIR__ . "/../conf/config.ini",true);


$vars = array(
	'action'			=> null,
	'confirm_email'		=> '',
	'confirm_password'	=> '',
	'display'			=> '',
	'extdisplay'		=> null,
	'email_address'		=> '',
	'fw_popover' 		=> '',
	'fw_popover_process' => '',
	'logout'			=> false,
	'password'			=> '',
	'quietmode'			=> '',
	'restrictmods'		=> false,
	'skip'				=> 0,
	'skip_astman'		=> false,
	'type'				=> '',
	'username'			=> '',
	'unlock'			=> false,
);

foreach ($vars as $k => $v) {
	$config_vars[$k] = $$k = isset($_REQUEST[$k]) ? $_REQUEST[$k] : $v;

	//special handeling
	switch ($k) {
	case 'extdisplay':
		$extdisplay = (isset($extdisplay) && $extdisplay !== false)
			? htmlspecialchars($extdisplay, ENT_QUOTES)
			: false;
		$_REQUEST['extdisplay'] = $extdisplay;
		break;

	case 'restrictmods':
		$restrict_mods = $restrictmods
			? array_flip(explode('/', $restrictmods))
			: false;
		break;

	case 'skip_astman':
		$bootstrap_settings['skip_astman']	= $skip_astman;
		break;
	}
}


header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
header('Expires: Sat, 01 Jan 2000 00:00:00 GMT');
header('Cache-Control: post-check=0, pre-check=0',false);
header('Pragma: no-cache');
header('Content-Type: text/html; charset=utf-8');

// This needs to be included BEFORE the session_start or we fail so
// we can't do it in bootstrap and thus we have to depend on the
// __FILE__ path here.

require_once(dirname(__FILE__) . '/../../../../admin/libraries/ampuser.class.php');

session_set_cookie_params(60 * 60 * 24 * 30);//(re)set session cookie to 30 days
ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 30);//(re)set session to 30 days
if (!isset($_SESSION)) {
	//start a session if we need one
	$ss = @session_start();
	if(!$ss){
		session_regenerate_id(true); // replace the Session ID
		session_start();
	}
}

//unset the ampuser if the user logged out
if ($logout == 'true') {
	unset($_SESSION['AMP_user']);
	exit();
}

//session_cache_limiter('public, no-store');
if (isset($_REQUEST['handler'])) {
	if ($restrict_mods === false) {
		$restrict_mods = true;
	}
	// I think reload is the only handler that requires astman, so skip it
	//for others
	switch ($_REQUEST['handler']) {
	case 'api':
		break;
		case 'reload';
		break;
	default:
		// If we didn't provide skip_astman in the $_REQUEST[] array it will be boolean false and for handlers, this should default
		// to true, if we did provide it, it will NOT be a boolean (it could be 0) so we will honor the setting
		//
		$bootstrap_settings['skip_astman'] = $bootstrap_settings['skip_astman'] === false ? true : $bootstrap_settings['skip_astman'];
		break;
	}
}

// call bootstrap.php through freepbx.conf
if (!@include_once(getenv('FREEPBX_CONF') ? getenv('FREEPBX_CONF') : '/etc/freepbx.conf')) {
	include_once('/etc/asterisk/freepbx.conf');
}

//check to make sure zend files aren't breaking the SPL autoloader.
//if they are then tell the user to run said command below
//which disables any zend module that breaks the autoloader
if(function_exists('SPLAutoloadBroken') && SPLAutoloadBroken()) {
	die_freepbx(_("The autoloader is damaged. Please run: ".$amp_conf['AMPBIN']."/fwconsole --fix_zend"));
}

// At this point, we have a session, and BMO was created in bootstrap, so we can check to
// see if someone's trying to programatically log in.
if ($unlock) {
	if ($bmo->Unlock($unlock)) {
		unset($no_auth);
		$display = 'index';
	}
}

//redirect back to the modules page for upgrade
if(isset($_SESSION['modulesRedirect'])) {
	$display = 'modules';
	unset($_SESSION['modulesRedirect']);
}

// determine if the user has a session time out set in advanced settings. If the timeout is 0 or not set, we don't force logout
$sessionTimeOut = \FreePBX::Config()->get('SESSION_TIMEOUT');
if ($sessionTimeOut) {
	// Make sure it's not set to something crazy short.
	if ($sessionTimeOut < 60) {
		\FreePBX::Config()->update('SESSION_TIMEOUT', 60);
		$sessionTimeOut = 60;
	}
	if (!empty($_SESSION['AMP_user']) && is_object($_SESSION['AMP_user'])) {
		//if we don't have last activity set it now
		if (empty($_SESSION['AMP_user']->_lastactivity)) {
			$_SESSION['AMP_user']->_lastactivity = time();
		} else {
			//check to see if we should be logged out or reset the last activity time
			if (($_SESSION['AMP_user']->_lastactivity + $sessionTimeOut) < time()) {
				unset($_SESSION['AMP_user']);
			} else {
				$_SESSION['AMP_user']->_lastactivity = time();
			}
		}
	}
}

/* If there is an action request then some sort of update is usually being done.
   This may protect from cross site request forgeries unless disabled.
 */
if (!isset($no_auth) && $action != '' && $amp_conf['CHECKREFERER']) {
	if (isset($_SERVER['HTTP_REFERER'])) {
		$referer = parse_url($_SERVER['HTTP_REFERER']);
		// Check if the 'SERVER_NAME' variable is an IPv6 address. If it is, we want
		// to add [ and ] around it. This is because IPv6 raw addresses are connected
		// to like this:
		//   http://[2001:f00d:dead:beef::1]/admin/config.php
		// But, SERVER_NAME is (legitmately) reported as just '2001:f00d:dead:beef::1'.
		// We need to add the braces around it to compare it.
		if (filter_var($_SERVER['SERVER_NAME'], \FILTER_VALIDATE_IP, \FILTER_FLAG_IPV6)) {
			$server = "[".$_SERVER['SERVER_NAME']."]";
		} else {
			$server = trim($_SERVER['SERVER_NAME']);
		}
		// This used to have 'trim's around them. I don't think we want that any more,
		// if someone's stuck whitespace or \n's in there, it's broken already.
		$refererok = ($referer['host'] == $server);
	} else {
		$refererok = false;
	}
	if (!$refererok) {
		$display = 'badrefer';
	}
}
if (isset($no_auth) && empty($display)) {
	$display = 'noauth';
}
// handle special requests
if (!in_array($display, array('noauth', 'badrefer'))
	&& isset($_REQUEST['handler'])
) {
	$module = isset($_REQUEST['module'])	? $_REQUEST['module']	: '';
	$file 	= isset($_REQUEST['file'])		? $_REQUEST['file']		: '';
	fileRequestHandler($_REQUEST['handler'], $module, $file);
	exit();
}


if (!$quietmode) {
	$modulef = module_functions::create();
	$modulef->run_notification_checks();
	$nt = notifications::create();
	if ( !isset($_SERVER['HTACCESS']) && preg_match("/apache/i", $_SERVER['SERVER_SOFTWARE']) ) {
		// No .htaccess support
		if(!$nt->exists('framework', 'htaccess')) {
			$nt->add_security('framework', 'htaccess', _('.htaccess files are disable on this webserver. Please enable them'),
				sprintf(_("To protect the integrity of your server, you must allow overrides in your webserver's configuration file for the User Control Panel. For more information see: %s"), '<a href="http://wiki.freepbx.org/display/F2/Webserver+Overrides">http://wiki.freepbx.org/display/F2/Webserver+Overrides</a>'),"http://wiki.freepbx.org/display/F2/Webserver+Overrides");
		}
	} elseif(!preg_match("/apache/i", $_SERVER['SERVER_SOFTWARE'])) {
		$sql = "SELECT value FROM admin WHERE variable = 'htaccess'";
		$sth = FreePBX::Database()->prepare($sql);
		$sth->execute();
		$o = $sth->fetch();

		if(empty($o)) {
			if($nt->exists('framework', 'htaccess')) {
				$nt->delete('framework', 'htaccess');
			}
			$nt->add_warning('framework', 'htaccess', _('.htaccess files are not supported on this webserver.'),
				sprintf(_("htaccess files help protect the integrity of your server. Please make sure file paths and directories are locked down properly. For more information see: %s"), '<a href="http://wiki.freepbx.org/display/F2/Webserver+Overrides">http://wiki.freepbx.org/display/F2/Webserver+Overrides</a>'),"http://wiki.freepbx.org/display/F2/Webserver+Overrides",true,true);
			$sql = "REPLACE INTO admin (`value`, `variable`) VALUES (1, 'htaccess')";
			$sth = FreePBX::Database()->prepare($sql);
			$sth->execute();
		}
	} else {
		if($nt->exists('framework', 'htaccess')) {
			$nt->delete('framework', 'htaccess');
		}
	}
}

//draw up freepbx menu
$fpbx_menu = array();

// pointer to current item in $fpbx_menu, if applicable
$cur_menuitem = null;

// add module sections to $fpbx_menu
if(is_array($active_modules)){
	foreach($active_modules as $key => $module) {

		//create an array of module sections to display
		// stored as [items][$type][$category][$name] = $displayvalue
		if (isset($module['items']) && is_array($module['items'])) {
			// loop through the types
			foreach($module['items'] as $itemKey => $item) {

				// check access, unless module.xml defines all have access
				// BMO TODO: Per-module auth should be managed by BMO.
				//module is restricted to admin with excplicit permission
				$needs_perms = !isset($item['access'])
					|| strtolower($item['access']) != 'all'
					? true : false;

				//check if were logged in
				$admin_auth = isset($_SESSION["AMP_user"])
					&& is_object($_SESSION["AMP_user"]);

				//per admin access rules
				$has_perms = $admin_auth
					&& $_SESSION["AMP_user"]->checkSection($itemKey);

				//requies authentication
				$needs_auth = isset($item['requires_auth'])
					&& strtolower($item['requires_auth']) == 'false'
					? false
					: true;

				//skip this module if we dont have proper access
				//test: if we require authentication for this module
				//			and either the user isnt authenticated
				//			or the user is authenticated and dose require
				//				section specifc permissions but doesnt have them
				if ($needs_auth
					&& (!$admin_auth || ($needs_perms && !$has_perms))
				) {
					//clear display if they were trying to gain unautherized
					//access to $itemKey. If there logged in, but dont have
					//permissions to view this specicc page - show them a message
					//otherwise, show them the login page
					if($display == $itemKey){
						if ($admin_auth) {
							$display = 'noaccess';
						} else {
							$display = 'noauth';
						}
					}
					continue;
				}

				if (!isset($item['display'])) {
					$item['display'] = $itemKey;
				}

				// reference to the actual module
				$item['module'] =& $active_modules[$key];

				// item is an assoc array, with at least
				//array(module=> name=>, category=>, type=>, display=>)
				$fpbx_menu[$itemKey] = $item;

				// allow a module to replace our main index page
				if (($item['display'] == 'index') && ($display == '')) {
					$display = 'index';
				}

				// check current item
				if ($display == $item['display']) {
					// found current menuitem, make a reference to it
					$cur_menuitem =& $fpbx_menu[$itemKey];
				}
			}
		}
	}
}

//if display is modules then show the login page dont show does not exist as its confusing
if ($cur_menuitem === null && !in_array($display, array('noauth', 'badrefer','noaccess',''))) {
	if($display == 'modules') {
		$display = 'noauth';
		$_SESSION['modulesRedirect'] = 1;
	} else {
		$display = 'noaccess';
	}
}

// extensions vs device/users ... this is a bad design, but hey, it works
if (!$quietmode && isset($fpbx_menu["extensions"])) {
	if (isset($amp_conf["AMPEXTENSIONS"])
		&& ($amp_conf["AMPEXTENSIONS"] == "deviceanduser")) {
			unset($fpbx_menu["extensions"]);
		} else {
			unset($fpbx_menu["devices"]);
			unset($fpbx_menu["users"]);
		}
}

// If it's index, do we have an override?
if ($display === "index") {
	$override = $bmo->Config()->get('DASHBOARD_OVERRIDE');

	// Does this user have permission to use this?
	if (is_array($active_modules) && isset($active_modules[$override])) {
		// Yes.
		$display = $override;
		$cur_menuitem = $fpbx_menu[$display];
	}
}

ob_start();
// Run all the pre-processing for the page that's been requested.
if (!empty($display) && $display != 'badrefer') {
	// $CC is used by guielemets as a Global.
		$CC = $currentcomponent = new component($display);

		// BMO: Process ConfigPageInit functions
		$bmo->Performance->Start("inits-$display");
		$bmo->GuiHooks->doConfigPageInits($display, $currentcomponent);
		$bmo->Performance->Stop("inits-$display");

		// now run each 'process' function and 'gui' function
		$bmo->Performance->Start("processconfigpage-$display");
		$currentcomponent->processconfigpage();
		$bmo->Performance->Stop("processconfigpage-$display");
		$bmo->Performance->Start("buildconfigpage-$display");
		$currentcomponent->buildconfigpage();
		$bmo->Performance->Stop("buildconfigpage-$display");
}
$module_name = "";
$module_page = "";
$module_file = "";

if ($display == 'index' && ($cur_menuitem['module']['rawname'] == 'builtin')) {
	$display = '';
}

$dbcdr = callreport_db();
$reports = callsreport_today_scheduling();


if(count($reports) > 0) {
	foreach($reports as $id => $report) {

		if($report['periodicity'] == 0) {
			
			$dt_final = new DateTime();
			$dt_final->setTime($report['hour'],0,0);

			$dt_interval = new DateInterval('P1M');

			$dt_inicial = new DateTime();
			$dt_inicial->setTime($report['hour'],0,0);
			$dt_inicial->sub($dt_interval);

			$data[$id]['data_inicio'] = $dt_inicial->format('d-m-Y');
			$data[$id]['hora_inicio'] = $dt_inicial->format('H:i');
			$data[$id]['data_fim'] = $dt_final->format('d-m-Y');
			$data[$id]['hora_fim'] = $dt_final->format('H:i');
			$data[$id]['b_ramais'] = explode(',',$report['extens']);
			$data[$id]['b_atendentes'] = explode(',',$report['extens']);
			$data[$id]['type'] = $report['type'];
			$data[$id]['description'] = $report['description'];
			$data[$id]['email'] = $report['email'];

		}
		else if($report['periodicity'] == 1) {

			$dt_final = new DateTime();
			$dt_final->setTime($report['hour'],0,0);

			$dt_interval = new DateInterval('P1W');

			$dt_inicial = new DateTime();
			$dt_inicial->setTime($report['hour'],0,0);
			$dt_inicial->sub($dt_interval);

			$data[$id]['data_inicio'] = $dt_inicial->format('d-m-Y');
			$data[$id]['hora_inicio'] = $dt_inicial->format('H:i');
			$data[$id]['data_fim'] = $dt_final->format('d-m-Y');
			$data[$id]['hora_fim'] = $dt_final->format('H:i');
			$data[$id]['b_ramais'] = explode(',',$report['extens']);
			$data[$id]['b_atendentes'] = explode(',',$report['extens']);
			$data[$id]['type'] = $report['type'];
			$data[$id]['description'] = $report['description'];
			$data[$id]['email'] = $report['email'];

		}
		else if($report['periodicity'] == 2) {

			$dt_final = new DateTime();
			$dt_final->setTime($report['hour'],0,0);

			$dt_inicial = new DateTime();
			$dt_inicial->setTime(0,0,0);

			$data[$id]['data_inicio'] = $dt_inicial->format('d-m-Y');
			$data[$id]['hora_inicio'] = $dt_inicial->format('H:i');
			$data[$id]['data_fim'] = $dt_final->format('d-m-Y');
			$data[$id]['hora_fim'] = $dt_final->format('H:i');
			$data[$id]['b_ramais'] = explode(',',$report['extens']);
			$data[$id]['b_atendentes'] = explode(',',$report['extens']);
			$data[$id]['type'] = $report['type'];
			$data[$id]['description'] = $report['description'];
			$data[$id]['email'] = $report['email'];
			
		}
		else if($report['periodicity'] == 3) {

			// consulta ultimo envio na tabela 
			$last_sent = callsreport_get_last_send($report['id']);

			// houve ultimo envio;

			if($last_sent) {
				// verifica se entre o ultimo envio e agora existem "hour" de intervalo
				$now_last = new \DateTime($last_sent['date']);

				$last_limit = new \DateTime();
				$last_limit->setTime($report['limit_final'],0,0);
				
				$now = new \DateTime();
				$now->setTime($now->format('H'),0,0);
			
				$diferenca = $now->diff($now_last);

				// quando a diferenca entre as last e a data atual é igual ao intervalo do relatorio
				if($diferenca->h == $report['hour'] || $diferenca->i > 50 ) {
					if($now <= $last_limit) {
						// gera relatorio de limit_initial ate agora
						$data[$id]['data_inicio'] = $now_last->format('d-m-Y');
						$data[$id]['hora_inicio'] = $now_last->format('H:i');
						$data[$id]['data_fim'] = $now->format('d-m-Y');
						$data[$id]['hora_fim'] = $now->format('H:i');
						$data[$id]['b_ramais'] = explode(',',$report['extens']);
						$data[$id]['b_atendentes'] = explode(',',$report['extens']);
						$data[$id]['type'] = $report['type'];
						$data[$id]['description'] = $report['description'];
						$data[$id]['email'] = $report['email'];

						callsreport_add_send($report['id']);
					}
				}
			}
			// não houve ultimo envio;
			else{

				// verifica se existe "hour" de intervalo entre limit_initial e agora
				$now_init = new \DateTime();
				$now_init->setTime($report['limit_initial'],0,0);

				$last_limit = new \DateTime();
				$last_limit->setTime($report['limit_final'],0,0);

				$now = new \DateTime();
				$now->setTime($now->format('H'),0,0);
				//$diferenca = $now->diff($now_init);

				// quando a diferenca entre as limit_initial  e a data atual é igual ao intervalo do relatorio

				if( $now_init <= $now ) {
					if($now <= $last_limit) {
						// gera relatorio de limit_initial ate agora
						$data[$id]['data_inicio'] = $now_init->format('d-m-Y');
						$data[$id]['hora_inicio'] = $now_init->format('H:i');
						$data[$id]['data_fim'] = $now->format('d-m-Y');
						$data[$id]['hora_fim'] = $now->format('H:i');
						$data[$id]['b_ramais'] = explode(',',$report['extens']);
						$data[$id]['b_atendentes'] = explode(',',$report['extens']);
						$data[$id]['type'] = $report['type'];
						$data[$id]['description'] = $report['description'];
						$data[$id]['email'] = $report['email'];
						callsreport_add_send($report['id']);						
					}
				}
			}		
		}
	}
}


require_once(dirname(__FILE__) . '/../lib/PHPMailer/PHPMailerAutoload.php');

if(count($data) > 0) {
	foreach($data as $id => $relatorio) {
		// calls report
		if($relatorio['type'] == '0') {
			$results = callsreport_get_callsreport($dbcdr, $relatorio, 0, false, false, true);
			$file = callsreport_export_pdf($results, 'calls', $relatorio, true);
			$emails = explode(',', $relatorio['email']);

			if($conf['smtp']['sender'] == '1') {

				$subject = $relatorio['description'];
				$subject = '=?UTF-8?B?'.base64_encode($subject).'?='; ;
				$mail = new PHPMailer();
				$mail->IsSMTP();
				$mail->SMTPDebug = 1;
				$mail->SMTPAuth = true;
				$mail->SMTPSecure = 'tls';
				$mail->Host = $conf['smtp']['host'];
				$mail->Port = $conf['smtp']['port'];
				$mail->Username = $conf['smtp']['username'];
				$mail->Password = $conf['smtp']['password'];
				$mail->SetFrom($conf['smtp']['username'], "Relatorio");
				$mail->Subject = $subject;
				$mail->addAttachment($file);
				$mail->Body = "Olá,\n\nEm anexo o relatório: <br /> {$relatorio['description']} <br />";
				$eemail = array_shift($emails);
				$mail->AddAddress( $eemail );
				foreach($emails as $eeemail) {
					$mail->AddCC($eeemail);
				}

				if(!$mail->Send()) {
					echo $error = 'Mail error: '.$mail->ErrorInfo; 
				} else {
					echo $error = 'Mensagem enviada!';
				}
			}
			else{
				foreach($emails as $email) {
					$cmd = "echo 'Seu relatório' |  /bin/mail -s {$relatorio['description']} -a $file $email ";
					exec($cmd);
				}		
			}
		}

		// agents report
		if($relatorio['type'] == '1') {

			$results = callsreport_get_agentsreport($dbcdr, $relatorio, 0, false, false, true);

			$file = callsreport_export_pdf($results, 'agents', $relatorio, true);
			$emails = explode(',', $relatorio['email']);

			if($conf['smtp']['sender'] == '1') {

				$subject = $relatorio['description'];
				$subject = '=?UTF-8?B?'.base64_encode($subject).'?='; ;

				$mail = new PHPMailer();
				$mail->IsSMTP();		// Ativar SMTP
				$mail->SMTPDebug = 1;		// Debugar: 1 = erros e mensagens, 2 = mensagens apenas
				$mail->SMTPAuth = true;		// Autenticação ativada
				$mail->SMTPSecure = 'tls';	// SSL REQUERIDO pelo GMail
				$mail->Host = $conf['smtp']['host'];
				$mail->Port = $conf['smtp']['port'];
				$mail->Username = $conf['smtp']['username'];
				$mail->Password = $conf['smtp']['password'];
				$mail->SetFrom($conf['smtp']['username'], "Relatorio:");
				$mail->Subject = $subject;
				$mail->addAttachment($file);
				$mail->Body = "Olá,\n\nEm anexo o relatório: <br /> {$relatorio['description']} <br />";
                                $eemail = array_shift($emails);
                                $mail->AddAddress( $eemail );
                                foreach($emails as $eeemail) {
                                        $mail->AddCC($eeemail);
                                }

				if(!$mail->Send()) {
					echo $error = 'Mail error: '.$mail->ErrorInfo; 
				} else {
					echo $error = 'Mensagem enviada!';
				}

			}else{
				foreach($emails as $email) {
					$cmd = "echo 'Seu relatório' |  /bin/mail -s {$relatorio['description']} -a $file $email ";
					exec($cmd);
				}
			}

		}

	}

}


