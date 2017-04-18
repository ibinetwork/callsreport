<?php
if (!defined('FREEPBX_IS_AUTH')) { die('No direct script access allowed'); }

$dbcdr = callreport_db();

isset($_REQUEST['action']) ? $action = $_REQUEST['action'] : $action = '';

if($action == 'agents') {

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

	$report = 'agents';
	$view = 'agents.tpl';

}
else if($action == 'scheduling') {

	isset($_REQUEST['method']) ? $method = $_REQUEST['method'] : $method = 'scheduling';

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
else{

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

    $report = 'calls';
	$view = 'calls.tpl';

}


if($action == 'agents') {
	
	$pdf = ($_REQUEST['pdf'] == '1' ? $pdf = true : $pdf = false);

	if($_REQUEST['num']) {
		if($_REQUEST['num'] != $_SESSION['modulo_callsreport']['num']) {
			$_SESSION['callsreport']['num'] = $_REQUEST['num'];
		}
	}
	if(!isset($_SESSION['modulo_callsreport']['num'])) {

	}
	$itens = (isset($_SESSION['callsreport']['num']) ? $_SESSION['callsreport']['num'] : 10 );
	$page = (isset($_REQUEST['page']) ? $_REQUEST['page'] : 1);

	$results = callsreport_get_agentsreport($dbcdr, $_SESSION['callsreport'][$report], 0);

	if($pdf) {
		callsreport_export_pdf($results, 'agents', $_SESSION['callsreport'][$report]);
	}

}
else if($action == 'scheduling') {

	
}
else{

	$pdf = ($_REQUEST['pdf'] == '1' ? $pdf = true : $pdf = false);
	
	if($_REQUEST['num']) {
		if($_REQUEST['num'] != $_SESSION['modulo_callsreport']['num']) {
			$_SESSION['callsreport']['num'] = $_REQUEST['num'];
		}
	}
	if(!isset($_SESSION['modulo_callsreport']['num'])) {

	}
	$itens = (isset($_SESSION['callsreport']['num']) ? $_SESSION['callsreport']['num'] : 10 );
	$page = (isset($_REQUEST['page']) ? $_REQUEST['page'] : 1);

	$total = callsreport_get_callsreport($dbcdr, $_SESSION['callsreport'][$report], 1);
	if(isset($total[0])) {
		$total = $total[0];
	}else{
		$total = 0;
	}
	$pagination = callsreport_get_pagination($total, $itens, $page);
	$results = callsreport_get_callsreport($dbcdr, $_SESSION['callsreport'][$report], 0, $pagination['limit'], $pagination['offset'], $pdf);

	if($pdf) {
		callsreport_export_pdf($results, 'calls', $_SESSION['callsreport'][$report]);
	}
}

$variables = array(
	'total' => $total,
	'results' => $results,
	'data_inicio' => $_SESSION['callsreport'][$report]['data_inicio'],
	'hora_inicio' => $_SESSION['callsreport'][$report]['hora_inicio'],
	'data_fim' => $_SESSION['callsreport'][$report]['data_fim'],
	'hora_fim' => $_SESSION['callsreport'][$report]['hora_fim'],
	'scheduling' => ( isset($scheduling) ? $scheduling : false ),
	'ramais' => callsreport_get_extens(),
	'estados' => array(),
	'sel_disposition' => ( is_array($_SESSION['callsreport'][$report]['disposition']) ? $_SESSION['callsreport'][$report]['disposition'] : array()),
	'sel_ramais' => ( is_array($_SESSION['callsreport'][$report]['b_ramais']) ? $_SESSION['callsreport'][$report]['b_ramais'] : array()),
	'sel_atendentes' => ( is_array($_SESSION['callsreport'][$report]['b_atendentes']) ? $_SESSION['callsreport'][$report]['b_atendentes'] : array()),
    'destino' => ( isset($_SESSION['callsreport'][$report]['destino']) ? $_SESSION['callsreport'][$report]['destino'] : '' ),
    'origem' => ( isset($_SESSION['callsreport'][$report]['origem']) ? $_SESSION['callsreport'][$report]['origem'] : '' ),
    'numero' => ( isset($_SESSION['callsreport'][$report]['numero']) ? $_SESSION['callsreport'][$report]['numero'] : '' ),
	'num' => $itens,
	'pagination' => $pagination	
);

$html = load_view(dirname(__FILE__).'/views/'.$view, $variables);
echo $html;
