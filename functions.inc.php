<?php

date_default_timezone_set("UTC"); 

function callreport_db() {
    global $db, $amp_conf;

    $db_name = 'asteriskcdrdb';
    $db_hash = array('mysql' => 'mysql', 'postgres' => 'pgsql');
    $db_type = 'mysql';
    $db_host = 'localhost'; //$amp_conf["CDRDBHOST"];
    $db_port = empty($amp_conf["CDRDBPORT"]) ? '' :  ':' . $amp_conf["CDRDBPORT"];
    $db_user = empty($amp_conf["CDRDBUSER"]) ? $amp_conf["AMPDBUSER"] : $amp_conf["CDRDBUSER"];
    $db_pass = empty($amp_conf["CDRDBPASS"]) ? $amp_conf["AMPDBPASS"] : $amp_conf["CDRDBPASS"];
    $datasource = $db_type . '://' . $db_user . ':' . $db_pass . '@' . $db_host . $db_port . '/' . $db_name;
    
    $dbcdr = DB::connect($datasource); // attempt connection
    

    return $dbcdr;

    // echo '<pre>';
    // print_r($amp_conf['CDRDBHOST']);
    // print_r($amp_conf['CDRDBTYPE']);
    // echo '</pre>';
    // exit;

    // if (!empty($amp_conf["CDRDBHOST"]) && !empty($amp_conf["CDRDBTYPE"])) {

    //     $db_name = 'asteriskcdrdb';
    //     $db_hash = array('mysql' => 'mysql', 'postgres' => 'pgsql');
    //     $db_type = 'mysql';
    //     $db_host = $amp_conf["CDRDBHOST"];
    //     $db_port = empty($amp_conf["CDRDBPORT"]) ? '' :  ':' . $amp_conf["CDRDBPORT"];
    //     $db_user = empty($amp_conf["CDRDBUSER"]) ? $amp_conf["AMPDBUSER"] : $amp_conf["CDRDBUSER"];
    //     $db_pass = empty($amp_conf["CDRDBPASS"]) ? $amp_conf["AMPDBPASS"] : $amp_conf["CDRDBPASS"];
    //     $datasource = $db_type . '://' . $db_user . ':' . $db_pass . '@' . $db_host . $db_port . '/' . $db_name;
    //     $dbcdr = DB::connect($datasource); // attempt connection
    //     if(DB::isError($dbcdr)) {
    //         die_freepbx($dbcdr->getDebugInfo());
    //     }
    // } else {
    //     $dbcdr = $db;
    // }
    // return $dbcdr;
}

function callsreport_get_agentsreport($db, $callsreport, $count = 0, $limit = 30, $offset = false, $pdf = false) {

    $dt_ini = implode("-", array_reverse(explode("/", $callsreport['data_inicio'])));
    $dt_fim = implode("-", array_reverse(explode("/", $callsreport['data_fim'])));

    $dt_ini = "$dt_ini {$callsreport['hora_inicio']}:00";
    $dt_fim = "$dt_fim {$callsreport['hora_fim']}:59";

    $data_inicio = new \DateTime($dt_ini);
    $data_fim = new \DateTime($dt_fim);
    $where = '';
    $where .= " AND r.calldate BETWEEN '". date_format($data_inicio, 'Y-m-d H:i:s') ."'";
    $where .= " AND '". date_format($data_fim, 'Y-m-d H:i:s')  ."'";

    $ramais_where = '';
    if( isset($callsreport['b_atendentes']) && $callsreport['b_atendentes'] != NULL) {
        $ramais = array();
        if(in_array('ALL', $callsreport['b_atendentes'])) {
            $ramais_where = '';
        }else{
            foreach($callsreport['b_atendentes'] as $_ramais) {
                $ramais[$_ramais] = "'$_ramais'";    
            }
            $ramais_where = " AND ( r.src IN(".implode(',', $ramais).") OR r.dst IN(".implode(',', $ramais).") ) ";
        }
    }  


    if($count == 1) {
        $sql = " SELECT count(r.calldate) as total
                 FROM cdr as r
                 WHERE r.calldate > 0
                 $where
                 $estados_where
                 $destino_where
                 $origem_where
                 $numero_where                 
                 $ramais_where
                 $disposition_where
                 ORDER BY r.calldate
                 DESC ";

        $results = $db->getRow($sql, DB_FETCHMODE_DEFAULT);

    }else{

        $sql = " SELECT *
                 FROM cdr as r
                 WHERE r.calldate > 0 
                 $where
                 $estados_where
                 $destino_where
                 $origem_where
                 $numero_where
                 $ramais_where
                 $disposition_where
                 ORDER BY r.calldate
                 DESC ";
        $results = $db->getAll($sql, DB_FETCHMODE_ASSOC);        

    }

    $report = array();
    $totals = array();

    if( ! isset($callsreport['b_atendentes'])) {
        $callsreport['b_atendentes'] = array();
    }

    foreach($results as $res) {

        if( in_array($res['src'], $callsreport['b_atendentes']) ) {
            if(! isset($report[$res['src']]['outbound'])) {
                $report[$res['src']]['outbound']['answered'] =  0; 
                $report[$res['src']]['outbound']['noanswered'] =  0;        
                $report[$res['src']]['outbound']['total'] =  0;

                $report[$res['src']]['inbound']['answered'] =  0; 
                $report[$res['src']]['inbound']['noanswered'] =  0;
            }
            if($res['disposition'] == 'ANSWERED') {
                $report[$res['src']]['outbound']['answered'] = $report[$res['src']]['outbound']['answered']+1;
                $report[$res['src']]['outbound']['total'] = $report[$res['src']]['outbound']['total']+1;
            }
            else if($res['disposition'] == 'NO ANSWER') {
                $report[$res['src']]['outbound']['noanswered'] = $report[$res['src']]['outbound']['noanswered']+1;
                $report[$res['src']]['outbound']['total'] = $report[$res['src']]['outbound']['total']+1;
            }
        }

        if( in_array($res['dst'], $callsreport['b_atendentes']) ) {
            if(! isset($report[$res['dst']]['inbound'])) {
                $report[$res['dst']]['inbound']['answered'] =  0; 
                $report[$res['dst']]['inbound']['noanswered'] =  0; 
                $report[$res['dst']]['inbound']['total'] =  0;
            }
            if($res['disposition'] == 'ANSWERED') {
                $report[$res['dst']]['inbound']['answered'] = $report[$res['dst']]['inbound']['answered']+1;
                $report[$res['dst']]['inbound']['total'] = $report[$res['dst']]['inbound']['total']+1;
            }
            else if($res['disposition'] == 'NO ANSWER') {
                $report[$res['dst']]['inbound']['noanswered'] = $report[$res['dst']]['inbound']['noanswered']+1;
                $report[$res['dst']]['inbound']['total'] = $report[$res['dst']]['inbound']['total']+1;
            }
        }
    }


    foreach($report as $exten => $rep) {
        
        $out_answered = (isset($report[$exten]['outbound']['answered']) ? $report[$exten]['outbound']['answered'] : 0);
        $out_noanswered = (isset($report[$exten]['outbound']['noanswered']) ? $report[$exten]['outbound']['noanswered'] : 0);
        $in_answered = (isset($report[$exten]['inbound']['answered']) ? $report[$exten]['inbound']['answered'] : 0);
        $in_noanswered = (isset($report[$exten]['inbound']['noanswered']) ? $report[$exten]['inbound']['noanswered'] : 0);

        $report[$exten]['totals']['answered'] = $out_answered + $in_answered;
        $report[$exten]['totals']['noanswered'] = $out_noanswered + $in_noanswered;
        $report[$exten]['totals']['total'] = $out_answered + $in_answered + $out_noanswered + $in_noanswered;

        $totals['outbound']['answered'] = $totals['outbound']['answered'] + $out_answered;
        $totals['outbound']['noanswered'] = $totals['outbound']['noanswered'] + $out_noanswered;

        $totals['inbound']['answered'] = $totals['inbound']['answered'] + $in_answered;
        $totals['inbound']['noanswered'] = $totals['inbound']['noanswered'] + $in_noanswered;

        $totals['totals']['answered'] = $totals['totals']['answered'] + ($out_answered + $in_answered);
        $totals['totals']['noanswered'] = $totals['totals']['noanswered'] + ($out_noanswered + $in_noanswered);

    }

    return array('report'=>$report,'totals'=>$totals);
}

function callsreport_get_callsreport($db, $callsreport, $count = 0, $limit = 30, $offset = false, $pdf = false) {

    $dt_ini = implode("-", array_reverse(explode("/", $callsreport['data_inicio'])));
    $dt_fim = implode("-", array_reverse(explode("/", $callsreport['data_fim'])));

    $dt_ini = "$dt_ini {$callsreport['hora_inicio']}:00";
    $dt_fim = "$dt_fim {$callsreport['hora_fim']}:59";

    $data_inicio = new \DateTime($dt_ini);
    $data_fim = new \DateTime($dt_fim);
    $where = '';
    $where .= " AND r.calldate BETWEEN '". date_format($data_inicio, 'Y-m-d H:i:s') ."'";
    $where .= " AND '". date_format($data_fim, 'Y-m-d H:i:s')  ."'";

    $disposition_where = '';
    if( isset($callsreport['disposition']) && $callsreport['disposition'] != NULL) {
        $disposition = array();
        if(in_array('multiselect-all', $callsreport['disposition'])) {
            $disposition_where = '';
        }else{
            foreach($callsreport['disposition'] as $_disposition) {
                if($_disposition != 'multiselect-all') {
                    $disposition[$_disposition] = "'$_disposition'";    
                }                
            }
            $disposition_where = " AND r.disposition IN(". implode(',', $disposition) .") ";
        }
    }


    $ramais_where = '';
    if( isset($callsreport['b_ramais']) && $callsreport['b_ramais'] != NULL) {
        $ramais = array();
        if(in_array('ALL', $callsreport['b_ramais'])) {
            $ramais_where = '';
        }else{
            foreach($callsreport['b_ramais'] as $_ramais) {
                $ramais[$_ramais] = "'$_ramais'";    
            }
            $ramais_where = " AND ( r.src IN(".implode(',', $ramais).") OR r.dst IN(".implode(',', $ramais).") ) ";
        }
    }    

    $destino_where = '';
    if($callsreport['destino'] != '') {
        $destino_where = " AND r.dst LIKE '%{$callsreport['destino']}%' ";
    }

    $origem_where = '';
    if($callsreport['origem']) {
        $origem_where = " AND r.src LIKE '%{$callsreport['origem']}%' ";
    }

    $numero_where = '';
    if($callsreport['numero'] != '') {
        $numero_where = " AND (r.src LIKE '%{$callsreport['numero']}%' OR r.dst LIKE '%{$callsreport['numero']}%' )";
    }


    $limit_offset = '';
    if($limit && $offset !== false && !$pdf) {
        if($offset != 0) {
            $limit_offset = "  LIMIT $limit OFFSET $offset ";    
        }else{
            $limit_offset = "  LIMIT $limit ";
        }        
    }

    if($count == 1) {
        $sql = " SELECT count(r.calldate) as total
                 FROM cdr as r
                 WHERE r.calldate > 0
                 $where
                 $estados_where
                 $destino_where
                 $origem_where
                 $numero_where                 
                 $ramais_where
                 $disposition_where
                 ORDER BY r.calldate
                 DESC 
                 $limit_offset";

        $results = $db->getRow($sql, DB_FETCHMODE_DEFAULT);

    }else{

        $sql = " SELECT *
                 FROM cdr as r
                 WHERE r.calldate > 0 
                 $where
                 $estados_where
                 $destino_where
                 $origem_where
                 $numero_where
                 $ramais_where
                 $disposition_where
                 ORDER BY r.calldate
                 DESC
                 $limit_offset";
        $results = $db->getAll($sql, DB_FETCHMODE_ASSOC);        

    }

    if(DB::IsError($results)) {
        die_freepbx($results->getMessage()."<br><br>Error selecting from custom_extensions");
    }
    return $results;
}

function callsreport_generate_date($report) {
    $_data_inicio = new \DateTime('NOW');
    $_data_inicio->setTime('00','00','00');
    $_SESSION['callsreport'][$report]['data_inicio'] = $data_inicio = $_data_inicio->format('d/m/Y');
    $_SESSION['callsreport'][$report]['hora_inicio'] = $hora_inicio = $_data_inicio->format('H:i');

    $_data_fim = new \DateTime('NOW');
    $_data_fim->setTime('23','59','59');
    $_SESSION['callsreport'][$report]['data_fim'] = $data_fim = $_data_fim->format('d/m/Y');
    $_SESSION['callsreport'][$report]['hora_fim'] = $hora_fim = $_data_fim->format('H:i');

}

function callsreport_clear_filter($report) {
    $_SESSION['callsreport'][$report] = false;
}

function callsreport_get_extens() {
    global $db;
    $sql = "SELECT extension,name FROM users";
    $extens = array();
    if($_extens = $db->getAll($sql, DB_FETCHMODE_ASSOC)) {
        foreach($_extens as $_exten) {
            $extens[$_exten['extension']] = $_exten['name'];
        }
    }    
    return $extens;
}

function callsreport_export_pdf($results, $type, $period, $output = false) {

    require_once(__DIR__ .'/vendor/mpdf60/mpdf.php');

    $mpdf = new mPDF();
    $html = ob_get_contents();
    $file_name = __DIR__ . '/cache/relatorio_chamadas_.pdf';

    $report_type = ( $type == 'calls' ? 'chamadas' : 'agentes' );

    if(!$output) {
        $output = 'D';
        $file_name = 'relatorio_'.$report_type.'_.pdf';
    }else{
        $output = 'F';        
        $file_name = __DIR__ . '/cache/relatorio_'.$report_type.'_.pdf';
    }

    ob_end_clean();

    if($type == 'calls') {

        $html .=  '<table style="font-size:10px;width:100%;">';
        $html .=  '    <tbody style="background-color: #696969;">';
        $html .=  '          <tr>';
        $html .=  '              <td><h2>Relatório de Chamadas</h2></td>';
        $html .=  '          </tr>';
        $html .=  '          <tr>';
        $html .=  '              <td><b>Período: </b>'.$period['data_inicio'].' '.$period['hora_inicio'].' - '.$period['data_fim'].' '.$period['hora_fim'].'</td>';
        $html .=  '          </tr>';        
        $html .=  '    </tbody>';
        $html .=  '</table>';


        $html .=  '<table style="font-size:10px;width:100%;" callpadding="0">';
        $html .=  '    <thead style="background-color: #696969;">';
        $html .=  '          <tr style="background-color: #d2d2d2;">';
        $html .=  '              <td><b>Data</b></td>';
        $html .=  '              <td><b>Hora</b></td>';
        $html .=  '              <td><b>CallerID</b></td>';
        $html .=  '              <td><b>Origem</b></td>';
        $html .=  '              <td><b>Destino</b></td>';
        $html .=  '              <td><b>Estado</b></td>';
        $html .=  '              <td><b>Duração</b></td>';
        $html .=  '              <td><b>Ring Time</b></td>';
        $html .=  '              <td><b>Talking Time</b></td>';
        $html .=  '          </tr>';
        $html .=  '    </thead>';
        $html .=  '    <tbody>';
        if(count($results) > 0) {
            foreach($results as $evento) {
                $data_ini = new \DateTime( $evento['calldate'] );
                $html .=  '                  <tr style="'.($c == 1 ? 'background-color:#f1f1f1;' : 'background-color:#fff;').'">';                    
                $html .=  '                      <td>'. $data_ini->format('d/m/Y') .'</td>';
                $html .=  '                      <td>'. $data_ini->format('H:i:s') .'</td>';
                $html .=  '                      <td>'. $evento['clid'] .'</td>';
                $html .=  '                      <td>'. $evento['src'] .'</td>';
                $html .=  '                      <td>'. $evento['dst'] .'</td>';
                $html .=  '                      <td>'. $evento['disposition'] .'</td>';
                $html .=  '                      <td>'. gmdate('i:s', $evento['duration']) .'</td>';
                $html .=  '                      <td>'. gmdate('i:s', $evento['billsec']) .'</td>';
                $html .=  '                      <td>'. gmdate('i:s', $evento['duration']-$evento['billsec']) .'</td>';
                $html .=  '                  </tr>';
                $c = ($c == 1 ? $c = 0 : $c = 1);
            }
        }
        $html .=  '        </tbody>';
        $html .=  '      </table>';        
        $mpdf->WriteHTML($html);
        $content = $mpdf->Output($file_name, $output);
        if($output) {
            return $file_name;    
        }        
    }
 
    if($type == 'agents') {

        $extens = callsreport_get_extens();

        $html .=  '<table style="font-size:10px;width:100%;">';
        $html .=  '    <tbody style="background-color: #696969;">';
        $html .=  '          <tr>';
        $html .=  '              <td><h2>Relatório de Agentes</h2></td>';
        $html .=  '          </tr>';
        $html .=  '          <tr>';
        $html .=  '              <td><b>Período: </b>'.$period['data_inicio'].' '.$period['hora_inicio'].' - '.$period['data_fim'].' '.$period['hora_fim'].'</td>';
        $html .=  '          </tr>';        
        $html .=  '    </tbody>';
        $html .=  '</table>';

        $html .=  '<table class="table table-striped table-hover table-responsive" style="width:800px;">';
        $html .=  '  <thead style="text-align:center;background-color:#f1f1f1;border:1px solid #d2d2d2;">';
        $html .=  '        <tr>';
        $html .=  '            <td rowspan="2" style="font-size:12px;"><br /><b>Agente</td>';
        $html .=  '            <td colspan="3" style="border-left:1px solid #d2d2d2;font-size:12px;"><b>Entrante</b></td>';
        $html .=  '            <td colspan="3" style="border-left:1px solid #d2d2d2;font-size:12px;"><b>Sainte</b></td>';
        $html .=  '            <td colspan="3" style="border-left:1px solid #d2d2d2;font-size:12px;"><b>Total</b></td>';
        $html .=  '        </tr>';
        $html .=  '        <tr>';
        $html .=  '            <td style="border-left:1px solid #d2d2d2;font-size:12px;"><b>Atendidas</b></td>';
        $html .=  '            <td style="font-size:12px;"><b>Não Atendidas</b></td>';
        $html .=  '            <td style="font-size:12px;"><b>Total</b></td>';
        $html .=  '            <td style="border-left:1px solid #d2d2d2;font-size:12px;"><b>Atendidas</b></td>';
        $html .=  '            <td style="font-size:12px;"><b>Não Atendidas</td>';
        $html .=  '            <td style="font-size:12px;"><b>Total</b></td>';        
        $html .=  '            <td style="border-left:1px solid #d2d2d2;font-size:12px;"><b>Atendidas</b></td>';
        $html .=  '            <td style="font-size:12px;"><b>Não Atendidas</b></td>';
        $html .=  '            <td style="font-size:12px;"><b>Total</b></td>';
        $html .=  '        </tr>';
        $html .=  '  </thead>';

        if(count($results) > 0) {
            foreach($results['report'] as $agent => $evento) {
                $html .= '<tr style="text-align:center;background-color:'.($c == 1 ? '#f1f1f1;' : '#fff;' ).'">';
                $html .= '  <td style="width:100px;">'. $agent .'<br />'. $extens[$agent] .'</td>';
                $html .= '  <td style="border-left:1px solid #d2d2d2;text-align:center;">';
                $html .=        $evento['inbound']['answered'];
                $html .= '  </td>';
                $html .= '  <td style="text-align:center;">';
                $html .=        $evento['inbound']['noanswered'];
                $html .= '  </td>';
                $html .= '  <td style="text-align:center;">';
                $html .=        (isset($evento['inbound']['total']) ? $evento['inbound']['total'] : 0);
                $html .= '  </td>';                
                $html .= '  <td style="border-left:1px solid #d2d2d2;text-align:center;">';
                $html .=        $evento['outbound']['answered'];
                $html .= '  </td>';
                $html .= '  <td style="text-align:center;">';
                $html .=        $evento['outbound']['noanswered'];
                $html .= '  </td>';
                $html .= '  <td style="text-align:center;">';
                $html .=        (isset($evento['outbound']['total']) ? $evento['outbound']['total'] : 0);
                $html .= '  </td>';                
                $html .= '  <td style="border-left:1px solid #d2d2d2;text-align:center;">';
                $html .=        $evento['totals']['answered'];
                $html .= '  </td>';
                $html .= '  <td style="text-align:center;">';
                $html .=        $evento['totals']['noanswered'];
                $html .= '  </td>';
                $html .= '  <td style="text-align:center;">';
                $html .=        $evento['totals']['total'];
                $html .= '  </td>';                
                $html .= '</tr>';
                $c = ($c == 1 ? $c = 0 : $c = 1);
            }
            $html .= '<tr style="text-align:center;background-color: #d2d2d2 !important; border:1px solid #696969 !important;">';
            $html .= '  <td style="border-left:1px solid #d2d2d2;background-color:#f1f1f1;"><b>Totais</b></td>';
            $html .= '  <td style="background-color:#f1f1f1;text-align:center;"><b>';
            $html .=      ($results['totals']['inbound']['answered'] ? $results['totals']['inbound']['answered'] : 0);
            $html .= '  </b></td>';
            $html .= '  <td style="border-left:1px solid #d2d2d2;background-color:#f1f1f1;text-align:center;"><b>';
            $html .=      ($results['totals']['inbound']['noanswered'] ? $results['totals']['inbound']['noanswered'] : 0);
            $html .= '  </b></td>';

	    $in_noanswered = ($results['totals']['inbound']['noanswered'] ? $results['totals']['inbound']['noanswered'] : 0);
            $in_answered =  ($results['totals']['inbound']['answered'] ? $results['totals']['inbound']['answered'] : 0);

            $html .= '  <td style="border-left:1px solid #d2d2d2;background-color:#f1f1f1;text-align:center;"><b>';
            $html .=      $in_noanswered + $in_answered;
            $html .= '  </b></td>';            
            $html .= '  <td style="background-color:#f1f1f1;text-align:center;"><b>';
            $html .=      ($results['totals']['outbound']['answered'] ? $results['totals']['outbound']['answered'] : 0);
            $html .= '  </b></td>';
            $html .= '  <td style="border-left:1px solid #d2d2d2;background-color:#f1f1f1;text-align:center;"><b>';
            $html .=      ($results['totals']['outbound']['noanswered'] ? $results['totals']['outbound']['noanswered'] : 0);
            $html .= '  </b></td>';

            $out_noanswered = ($results['totals']['outbound']['noanswered'] ? $results['totals']['outbound']['noanswered'] : 0);
            $out_answered =  ($results['totals']['outbound']['answered'] ? $results['totals']['outbound']['answered'] : 0);


            $html .= '  <td style="border-left:1px solid #d2d2d2;background-color:#f1f1f1;text-align:center;"><b>';
            $html .=      $out_noanswered + $out_answered;
            $html .= '  </b></td>';            
            $html .= '  <td style="background-color:#f1f1f1;text-align:center;"><b>';
            $html .=     ($results['totals']['totals']['answered'] ? $results['totals']['totals']['answered'] : 0);
            $html .= '  </b></td>            ';
            $html .= '  <td style="background-color:#f1f1f1;text-align:center;"><b>';
            $html .=     ($results['totals']['totals']['noanswered'] ? $results['totals']['totals']['noanswered'] : 0);
            $html .= '  </b></td>';
            $html .= '  <td style="background-color:#f1f1f1;text-align:center;"><b>';
            $html .=     $in_noanswered + $in_answered + $out_noanswered + $out_answered;
            $html .= '  </b></td>';            
            $html .= '</tr>';
        }
        $html .=  '        </tbody>';
        $html .=  '      </table>';        
        $mpdf->WriteHTML($html);
        $content = $mpdf->Output($file_name, $output);
    
        if($output) {
            return $file_name;    
        }
    }

}

function callsreport_today_scheduling() {

    global $db;
    $now = new DateTime();
    $hour = (int)$now->format('H');
    $week_day = $now->format('w');
    $day = $now->format('j');

    $sql = 'SELECT * FROM calls_report_scheduling WHERE id > 0 ';

    // diario
    // hour
    $sql .= " AND ( (periodicity = '2' AND hour = '$hour') ";

    // semanal
    // week_day and hour
    $sql .= " OR (periodicity = '1' AND week_day = '$week_day' AND hour = '$hour') ";

    // quando a periodicidade for 3,  hour passa a ser a frequencia de envio em horas.
    $sql .= " OR (periodicity = '3')";

    // Mensal
    // day and hour
    $sql .= " OR (periodicity = '0' AND day = '$day' AND hour = '$hour') )";
    $scheduling = $db->getAll($sql, DB_FETCHMODE_ASSOC);

    return $scheduling;
}

function callsreport_get_last_send($scheduling_id) {
    global $db;
    $sql = "SELECT * FROM calls_report_send_log WHERE scheduling_id = '$scheduling_id' ORDER BY date DESC LIMIT 1 ";
    $scheduling = $db->getRow($sql, DB_FETCHMODE_ASSOC);
    return $scheduling;
}
function callsreport_add_send($scheduling_id) {
    global $db;
    
    $now = new \DateTime();
    $now = $now->format('Y-m-d H:i:s');
    $sql = "INSERT INTO calls_report_send_log (scheduling_id,`date`) VALUES ('$scheduling_id', '$now') ";    
    $res = sql($sql);
}

function callsreport_getall_scheduling() {
    global $db;
    $sql = "SELECT * FROM calls_report_scheduling";
    $scheduling = $db->getAll($sql, DB_FETCHMODE_ASSOC);
    return $scheduling;
}

function callsreport_add_scheduling($data) {
    global $db;

    if($data['periodicity'] == 0) {
        $hour = $data['month_hour'];
    }
    if($data['periodicity'] == 1) {
        $hour = $data['week_hour'];
    }
    if($data['periodicity'] == 2) {
        $hour = $data['day_hour'];
    }
    if($data['periodicity'] == 3) {
        $hour = $data['hour'];
    }

    
    if(count($data['b_ramais']) > 0) {
        $extens = implode(',', $data['b_ramais']);    
    }else{
        $extens = '';
    }
    $sql = "INSERT INTO calls_report_scheduling (description,extens,type,direction,periodicity,day,week_day,hour,email, limit_initial, limit_final)
            VALUES ('{$data['description']}','$extens','{$data['type']}','{$data['direction']}','{$data['periodicity']}',
                    '{$data['day']}','{$data['week_day']}','$hour','{$data['email']}','{$data['limit_initial']}','{$data['limit_final']}') ";
    $res = sql($sql);
    return $res;
}

function callsreport_remove_scheduling($id) {
    global $db;
    $sql = "DELETE FROM calls_report_scheduling WHERE id = '$id' ";
    $res = sql($sql);


    $sql = "DELETE FROM calls_report_send_log WHERE scheduling_id =  '$id' ";
    $res = sql($sql);

    return $res;
}

function callsreport_get_scheduling($data) {
    global $db;
    $sql = "SELECT * FROM calls_report_scheduling WHERE id = '$data' ";
    $scheduling = $db->getRow($sql, DB_FETCHMODE_ASSOC);
    $scheduling['extens'] = explode(',',$scheduling['extens']);

    return $scheduling;
}

function callsreport_update_scheduling($data) {
    global $db;

    $extens = implode(',', $data['b_ramais']);

    if($data['periodicity'] == 0) {
        $hour = $data['month_hour'];
    }
    if($data['periodicity'] == 1) {
        $hour = $data['week_hour'];
    }
    if($data['periodicity'] == 2) {
        $hour = $data['day_hour'];
    }
    if($data['periodicity'] == 3) {
        $hour = $data['hour'];
    }    

    $sql = "UPDATE  calls_report_scheduling 
            SET description = '{$data['description']}',
                extens =  '$extens', 
                type = '{$data['type']}',
                direction = '{$data['direction']}',
                periodicity = '{$data['periodicity']}',
                day = '{$data['day']}',
                week_day = '{$data['week_day']}',
                hour = $hour,
                email = '{$data['email']}',
                limit_initial = '{$data['limit_initial']}',
                limit_final = '{$data['limit_final']}'
            WHERE id = '{$data['id']}'";
    $res = sql($sql);
    return $res;
}

function callsreport_get_pagination($total, $itenspp, $page) {

    // limit 
    $limit = $itenspp;

    // offset
    if($page > 1) {
        $offset = $itenspp * ($page -1);    
    }else{
        $offset = 0;
    }    

    // html
    $first = 1;
    $last = ceil( $total / $itenspp);

    $raio = array();
    for($i = $page; $i < $page+5; $i++) {
        if($i <= $last) {
            $raio[$i] = $i;
        }
    }   

    for($i = $page; $i > $page-5; $i--) {
        if($i >= $first && $i < $last) {
            $raio[$i] = $i;
        }
    }   

    ksort($raio);
    if(count($raio) == 0) {
        return array('html'=>'','limit'=>0,'offset'=>0);
    }

    $url = '/admin/config.php?display=callsreport&page=';

    $html = '<ul class="pagination pagination-md" style="margin-right:4px;">';
    if($first == $page) {
        $html .= '<li class="disabled">';
        $html .=    "<a href=\"#\">";
        $html .=        _('Primeira');
        $html .=    '</a>';
        $html .= '</li>';
    }else{
        $html .= '<li>';
        $html .=    "<a href=\"$url$first\">";
        $html .=        _('Primeira');
        $html .=    '</a>';
        $html .= '</li>';
    }
    $html .= '</ul>';

    $_page = (int)$page-1;
    $html .= '<ul class="pagination pagination-md">';
    
    if($_page >= $first) {
        $html .= '<li>';
        $html .=    "<a href=\"$url$_page\">";
        $html .=        '&laquo;';
        $html .=    '</a>';        
        $html .= '</li>';
    }else{
        $html .= '<li class="disabled">';
        $html .=    "<a href=\"#\">";
        $html .=        '&laquo;';
        $html .=    '</a>';
        $html .= '</li>';
    }
    

    foreach($raio as $_raio) {
        if($_raio == $page ) {
            $html .= '<li class="active">';
            $html .=    '<a href="#">';
            $html .=        "$page";
            $html .=    '</a>';
            $html .= '</li>';
        }else{
            $html .= '<li>';
            $html .=    "<a href=\"$url$_raio\">";
            $html .=        $_raio;
            $html .=    '</a>';
            $html .= '</li>';
        }
    }

    $_page = (int)$page+1;
    
    if($_page <= $last) {
        $html .= '<li>';
        $html .=    "<a href=\"$url$_page\">";
        $html .=        '&raquo;';
        $html .=    '</a>';        
        $html .= '</li>';
    }else{
        $html .= '<li class="disabled">';
        $html .=    "<a href=\"#\">";
        $html .=        '&raquo;';
        $html .=    '</a>';
        $html .= '</li>';
    }
    
    $html .= '</ul>';
    $html .= '<ul class="pagination pagination-md" style="margin-left:4px;">';


    if($page == $last) {
        $html .= '<li class="disabled">';
        $html .=    "<a href=\"#\">";
        $html .=        _('Última');
        $html .=    '</a>';
        $html .= '</li>';
    }else{
        $html .= '<li>';
        $html .=    "<a href=\"$url$last\">";
        $html .=        _('Última');
        $html .=    '</a>';
        $html .= '</li>';
    }

    $html .= '</ul>';
    return array('html'=>$html,'limit'=>$limit,'offset'=>$offset);
}
