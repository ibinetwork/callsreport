<?php
if (!defined('FREEPBX_IS_AUTH')) { die('No direct script access allowed'); }

$dbcdr = callreport_db();

isset($_REQUEST['action']) ? $action = $_REQUEST['action'] : $_REQUEST['action'] = $action = 'report';
isset($_REQUEST['report']) ? $report = $_REQUEST['report'] : $_REQUEST['report'] = $report = 'calls';

$menus = generate_menus($_REQUEST);

if($report == 'agents') {

	if($_REQUEST['agents']['limpar'] == '1') {
		callsreport_clear_filter('agents');
		callsreport_generate_date('agents');
		header('Location: /admin/config.php?display=callsreport&action=agents');
	}
	if(isset($_REQUEST['agents'])) {
		if($_SESSION['callsreport']['agents'] != $_REQUEST['agents']) {
			$_SESSION['callsreport']['agents'] = $_REQUEST['agents'];
		}
	}
	if( ! isset($_SESSION['callsreport']['agents']['data_inicio']) || ! isset($_SESSION['callsreport']['agents']['data_fim'])) {
		callsreport_generate_date('agents');
	}

	$extens = callsreport_get_extens();
	$report = 'agents';
	$view = 'agents.tpl';
}
else if($report == 'calls') {

	if($_REQUEST['calls']['limpar'] == '1') {
		callsreport_clear_filter('calls');
		callsreport_generate_date('calls');
		unset($_REQUEST);
		header('Location: /admin/config.php?display=callsreport');
	}
	if(isset($_REQUEST['calls'])) {
		if($_SESSION['callsreport']['calls'] != $_REQUEST['calls']) {
			$_SESSION['callsreport']['calls'] = $_REQUEST['calls'];
		}
	}
	if( ! isset($_SESSION['callsreport']['calls']['data_inicio']) || ! isset($_SESSION['callsreport']['calls']['data_fim'] )) {
		callsreport_generate_date('calls');
	}

	$extens = callsreport_get_extens();
    $report = 'calls';
	$view = 'calls.tpl';
}
else if($report == 'queues') {

	if($_REQUEST['queues']['limpar'] == '1') {
		callsreport_clear_filter('queues');
		callsreport_generate_date('queues');
		unset($_REQUEST);
		header('Location: /admin/config.php?display=callsreport&action=reports&report=queues');
	}
	if(isset($_REQUEST['queues'])) {
		if($_SESSION['callsreport']['queues'] != $_REQUEST['queues']) {
			$_SESSION['callsreport']['queues'] = $_REQUEST['queues'];
		}
	}
	if( ! isset($_SESSION['callsreport']['queues']['data_inicio']) || ! isset($_SESSION['callsreport']['queues']['data_fim'] )) {
		callsreport_generate_date('queues');
	}

	$queues = callsreport_get_queues();
	$report = 'queues';
	$view = 'queues.tpl';
}
else if($report == 'attended') {

	if($_REQUEST['attended']['limpar'] == '1') {
		callsreport_clear_filter('attended');
		callsreport_generate_date('attended');
		unset($_REQUEST);
		header('Location: /admin/config.php?display=callsreport');
	}
	if(isset($_REQUEST['attended'])) {
		if($_SESSION['callsreport']['attended'] != $_REQUEST['attended']) {
			$_SESSION['callsreport']['attended'] = $_REQUEST['attended'];
		}
	}
	if( ! isset($_SESSION['callsreport']['attended']['data_inicio']) || ! isset($_SESSION['callsreport']['attended']['data_fim'] )) {
		callsreport_generate_date('attended');
	}

	//$queues = callsreport_get_queues();
	$report = 'attended';
	$view = 'attended.tpl';
}
else if($report == 'returned') {

	if($_REQUEST['returned']['limpar'] == '1') {
		callsreport_clear_filter('returned');
		callsreport_generate_date('returned');
		unset($_REQUEST);
		header('Location: /admin/config.php?display=callsreport');
	}
	if(isset($_REQUEST['returned'])) {
		if($_SESSION['callsreport']['returned'] != $_REQUEST['returned']) {
			$_SESSION['callsreport']['returned'] = $_REQUEST['returned'];
		}
	}
	if( ! isset($_SESSION['callsreport']['returned']['data_inicio']) || ! isset($_SESSION['callsreport']['returned']['data_fim'] )) {
		callsreport_generate_date('returned');
	}

	//$queues = callsreport_get_queues();
	$report = 'returned';
	$view = 'returned.tpl';
}
else if($report == 'ura') {

	//$ivrs = callsreport_get_ivr();

	if($_REQUEST['ura']['limpar'] == '1') {
		callsreport_clear_filter('ura');
		callsreport_generate_date('ura');
		unset($_REQUEST);
		header('Location: /admin/config.php?display=callsreport&action=report&report=ura');
	}
	if(isset($_REQUEST['ura'])) {
		if($_SESSION['callsreport']['ura'] != $_REQUEST['ura']) {
			$_SESSION['callsreport']['ura'] = $_REQUEST['ura'];
		}
	}
	if( ! isset($_SESSION['callsreport']['ura']['data_inicio']) || ! isset($_SESSION['callsreport']['ura']['data_fim'] )) {
		callsreport_generate_date('ura');
	}

	$report = 'ura';
	$view = 'ura.tpl';
}

if($action == 'scheduling') {

	isset($_REQUEST['method']) ? $method = $_REQUEST['method'] : $method = 'scheduling';

	$queues = callsreport_get_queues();
	$ivrs = callsreport_get_ivr();

	if($method == 'add') {
		if($_REQUEST['scheduling']) {

			callsreport_add_scheduling($_REQUEST['scheduling']);
			header('Location: /admin/config.php?display=callsreport&action=scheduling');
		}
		$view = 'scheduling_add.tpl';	
	}
	else if($method == 'edit') {

		if($_REQUEST['confirm_update'] == '1') {
			callsreport_update_scheduling($_REQUEST['scheduling']);
			header('Location: /admin/config.php?display=callsreport&action=scheduling');
		}

		$scheduling = callsreport_get_scheduling($_REQUEST['id']);
		$view = 'scheduling_edit.tpl';	
	}
	else if($method == 'remove') {

		if($_REQUEST['confirm_remove'] == '1') {
			callsreport_remove_scheduling($_REQUEST['id']);
			header('Location: /admin/config.php?display=callsreport&action=scheduling');
		}

		$scheduling = callsreport_get_scheduling($_REQUEST['id']);
		$view = 'scheduling_remove.tpl';			
	}else{
		$scheduling = callsreport_getall_scheduling();
		$view = 'scheduling.tpl';	
	}	
}

if($report == 'agents') {
	
	$pdf = ($_REQUEST['pdf'] == '1' ? $pdf = true : $pdf = false);

	if($_REQUEST['num']) {
		if($_REQUEST['num'] != $_SESSION['modulo_callsreport']['num']) {
			$_SESSION['callsreport']['num'] = $_REQUEST['num'];
		}
	}
	if(!isset($_SESSION['modulo_callsreport']['num'])) {

	}
	$itens = (isset($_SESSION['callsreport']['num']) ? $_SESSION['callsreport']['num'] : 20 );
	$page = (isset($_REQUEST['page']) ? $_REQUEST['page'] : 1);

	$results = callsreport_get_agentsreport($dbcdr, $_SESSION['callsreport'][$report], 0);

	if($pdf) {
		callsreport_export_pdf($results, 'agents', $_SESSION['callsreport'][$report]);
	}

}
if($report == 'calls') {

	$pdf = ($_REQUEST['pdf'] == '1' ? $pdf = true : $pdf = false);
	
	if($_REQUEST['num']) {
		if($_REQUEST['num'] != $_SESSION['modulo_callsreport']['num']) {
			$_SESSION['callsreport']['num'] = $_REQUEST['num'];
		}
	}
	if(!isset($_SESSION['modulo_callsreport']['num'])) {

	}
	$itens = (isset($_SESSION['callsreport']['num']) ? $_SESSION['callsreport']['num'] : 20 );
	$page = (isset($_REQUEST['page']) ? $_REQUEST['page'] : 1);

	$total = callsreport_get_callsreport($dbcdr, $_SESSION['callsreport'][$report], 1);
	if(isset($total[0])) {
		$total = $total[0];
	}else{
		$total = 0;
	}
	$pagination = callsreport_get_pagination($total, $itens, $page, $report);
	$results = callsreport_get_callsreport($dbcdr, $_SESSION['callsreport'][$report], 0, $pagination['limit'], $pagination['offset'], $pdf);

	if($pdf) {
		callsreport_export_pdf($results, 'calls', $_SESSION['callsreport'][$report]);
	}
}


if($report == 'queues') {

	$pdf = ($_REQUEST['pdf'] == '1' ? $pdf = true : $pdf = false);
	
	if($_REQUEST['num']) {
		if($_REQUEST['num'] != $_SESSION['modulo_callsreport']['num']) {
			$_SESSION['callsreport']['num'] = $_REQUEST['num'];
		}
	}
	if(!isset($_SESSION['modulo_callsreport']['num'])) {

	}

	$itens = (isset($_SESSION['callsreport']['num']) ? $_SESSION['callsreport']['num'] : 20 );
	$page = (isset($_REQUEST['page']) ? $_REQUEST['page'] : 1);
	$results = callsreport_get_queuesreport($dbcdr, $_SESSION['callsreport'][$report], 0, $pagination['limit'], $pagination['offset'], $pdf);

	if($pdf) {
		callsreport_export_pdf($results, 'queues', $_SESSION['callsreport'][$report]);
	}
}
if($report == 'attended') {

	$pdf = ($_REQUEST['pdf'] == '1' ? $pdf = true : $pdf = false);
	
	if($_REQUEST['num']) {
		if($_REQUEST['num'] != $_SESSION['modulo_callsreport']['num']) {
			$_SESSION['callsreport']['num'] = $_REQUEST['num'];
		}
	}
	if(!isset($_SESSION['modulo_callsreport']['num'])) {

	}

	$itens = (isset($_SESSION['callsreport']['num']) ? $_SESSION['callsreport']['num'] : 20 );
	$page = (isset($_REQUEST['page']) ? $_REQUEST['page'] : 1);

	$total = callsreport_get_attended($dbcdr, $_SESSION['callsreport'][$report], 1);

	if(isset($total[0])) {
		$total = $total[0];
	}else{
		$total = 0;
	}
	$pagination = callsreport_get_pagination($total, $itens, $page, $report);
	$results = callsreport_get_attended($dbcdr, $_SESSION['callsreport'][$report], 0, $pagination['limit'], $pagination['offset'], $pdf);

	if($pdf) {
		callsreport_export_pdf($results, 'attended', $_SESSION['callsreport'][$report]);
	}
}
if($report == 'returned') {

	$pdf = ($_REQUEST['pdf'] == '1' ? $pdf = true : $pdf = false);
	
	if($_REQUEST['num']) {
		if($_REQUEST['num'] != $_SESSION['modulo_callsreport']['num']) {
			$_SESSION['callsreport']['num'] = $_REQUEST['num'];
		}
	}
	if(!isset($_SESSION['modulo_callsreport']['num'])) {

	}

	$itens = (isset($_SESSION['callsreport']['num']) ? $_SESSION['callsreport']['num'] : 20 );
	$page = (isset($_REQUEST['page']) ? $_REQUEST['page'] : 1);

	$total = callsreport_get_returned($dbcdr, $_SESSION['callsreport'][$report], 1);

	if(isset($total[0])) {
		$total = $total[0];
	}else{
		$total = 0;
	}
	$pagination = callsreport_get_pagination($total, $itens, $page, $report);
	$results = callsreport_get_returned($dbcdr, $_SESSION['callsreport'][$report], 0, $pagination['limit'], $pagination['offset'], $pdf);

	if($pdf) {
		callsreport_export_pdf($results, 'returned', $_SESSION['callsreport'][$report]);
	}
}
if($report == 'ura') {

	$pdf = ($_REQUEST['pdf'] == '1' ? $pdf = true : $pdf = false);
	$ivrs = callsreport_get_ivr();
	
	if($_REQUEST['num']) {
		if($_REQUEST['num'] != $_SESSION['modulo_callsreport']['num']) {
			$_SESSION['callsreport']['num'] = $_REQUEST['num'];
		}
	}
	if(!isset($_SESSION['modulo_callsreport']['num'])) {

	}

	$itens = (isset($_SESSION['callsreport']['num']) ? $_SESSION['callsreport']['num'] : 20 );
	$page = (isset($_REQUEST['page']) ? $_REQUEST['page'] : 1);

	$pagination = callsreport_get_pagination($total, $itens, $page, $report);
	$results = callsreport_get_ivrreport($dbcdr, $_SESSION['callsreport'][$report], 0, $pagination['limit'], $pagination['offset'], $pdf);
	$results['ura'] = $ivrs[$_SESSION['callsreport'][$report]['ura']];

	if($pdf) {
		callsreport_export_pdf($results, 'ura', $_SESSION['callsreport'][$report]);
	}
	
}

$variables = array(
	'total' => $total,
	'menus' => $menus,
	'results' => $results,
	'data_inicio' => $_SESSION['callsreport'][$report]['data_inicio'],
	'hora_inicio' => $_SESSION['callsreport'][$report]['hora_inicio'],
	'data_fim' => $_SESSION['callsreport'][$report]['data_fim'],
	'hora_fim' => $_SESSION['callsreport'][$report]['hora_fim'],
	'scheduling' => ( isset($scheduling) ? $scheduling : false ),
	'extens' => ( isset($extens) ? $extens : false),
	'queues' => ( isset($queues) ? $queues : false),
	'ivrs' => ( isset($ivrs) ? $ivrs : false),
	'estados' => array(),
	'sel_disposition' => ( is_array($_SESSION['callsreport'][$report]['disposition']) ? $_SESSION['callsreport'][$report]['disposition'] : array()),
	'sel_ramais' => ( is_array($_SESSION['callsreport'][$report]['b_ramais']) ? $_SESSION['callsreport'][$report]['b_ramais'] : array()),
	'sel_atendentes' => ( is_array($_SESSION['callsreport'][$report]['b_atendentes']) ? $_SESSION['callsreport'][$report]['b_atendentes'] : array()),
	'sel_queues' => array('ALL'),
	'sel_ivr' => array('ALL'),
    'destino' => ( isset($_SESSION['callsreport'][$report]['destino']) ? $_SESSION['callsreport'][$report]['destino'] : '' ),
    'origem' => ( isset($_SESSION['callsreport'][$report]['origem']) ? $_SESSION['callsreport'][$report]['origem'] : '' ),
    'numero' => ( isset($_SESSION['callsreport'][$report]['numero']) ? $_SESSION['callsreport'][$report]['numero'] : '' ),
	'num' => $itens,
	'pagination' => $pagination	
);

$html = load_view(dirname(__FILE__).'/views/'.$view, $variables);
echo $html;
