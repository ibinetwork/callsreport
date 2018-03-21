<?php

date_default_timezone_set("UTC"); 

function generate_menus($r) {

    $menu_html = '<ul class="nav nav-tabs" role="tablist">';
    $top_html = '<div class="btn-group" style="margin-bottom: 10px;">';

    if($r['action'] == 'scheduling') {
        $top_html .= '<a class="btn btn-default" href="/admin/config.php?display=callsreport&action=report">';
        $top_html .=   _('Reports');
        $top_html .= '</a>';
        $top_html .= '<a class="btn btn-default active" href="/admin/config.php?display=callsreport&action=scheduling">';
        $top_html .=   _('Scheduling');
        $top_html .= '</a>';
        // $menu_html .= '<li role="presentation" class="active">';
        // $menu_html .= '<a href="/admin/config.php?display=callsreport&action=scheduling" role="tab">'. _('Scheduling') .'</a>';
        // $menu_html .= '</li>';        
    }
    else {
        $top_html .= '<a class="btn btn-default active" href="/admin/config.php?display=callsreport&action=report">';
        $top_html .=   _('Reports');
        $top_html .= '</a>';
        $top_html .= '<a class="btn btn-default" href="/admin/config.php?display=callsreport&action=scheduling">';
        $top_html .=   _('Scheduling');
        $top_html .= '</a>';

        if($r['report'] == 'calls') {
            $menu_html .= '<li role="presentation" class="active">';
            $menu_html .= '<a href="/admin/config.php?display=callsreport&action=report&report=calls" role="tab">'. _('Calls Report') .'</a>';
            $menu_html .= '</li>';
            $menu_html .= '<li role="presentation">';
            $menu_html .= '<a href="/admin/config.php?display=callsreport&action=report&report=agents" role="tab">'. _('Agents Report') .'</a>';
            $menu_html .= '</li>';
            $menu_html .= '<li role="presentation">';
            $menu_html .= '<a href="/admin/config.php?display=callsreport&action=reports&report=queues" role="tab">'. _('Queues Report') .'</a>';
            $menu_html .= '</li>';
            $menu_html .= '<li role="presentation">';
            $menu_html .= '<a href="/admin/config.php?display=callsreport&action=reports&report=attended" role="tab">'. _('Attended Report') .'</a>';
            $menu_html .= '</li>';
            $menu_html .= '<li role="presentation">';
            $menu_html .= '<a href="/admin/config.php?display=callsreport&action=reports&report=returned" role="tab">'. _('Returned Report') .'</a>';
            $menu_html .= '</li>';
            $menu_html .= '<li role="presentation">';
            $menu_html .= '<a href="/admin/config.php?display=callsreport&action=reports&report=ura" role="tab">'. _('IVR Report') .'</a>';
            $menu_html .= '</li>';
        }
        else if ($r['report'] == 'agents') {
            $menu_html .= '<li role="presentation">';
            $menu_html .= '<a href="/admin/config.php?display=callsreport&action=report&report=calls" role="tab">'. _('Calls Report') .'</a>';
            $menu_html .= '</li>';
            $menu_html .= '<li role="presentation" class="active">';
            $menu_html .= '<a href="/admin/config.php?display=callsreport&action=reports&report=agents" role="tab">'. _('Agents Report') .'</a>';
            $menu_html .= '</li>';
            $menu_html .= '<li role="presentation">';
            $menu_html .= '<a href="/admin/config.php?display=callsreport&action=reports&report=queues" role="tab">'. _('Queues Report') .'</a>';
            $menu_html .= '</li>';         
            $menu_html .= '<li role="presentation">';
            $menu_html .= '<a href="/admin/config.php?display=callsreport&action=reports&report=attended" role="tab">'. _('Attended Report') .'</a>';
            $menu_html .= '</li>';
            $menu_html .= '<li role="presentation">';
            $menu_html .= '<a href="/admin/config.php?display=callsreport&action=reports&report=returned" role="tab">'. _('Returned Report') .'</a>';
            $menu_html .= '</li>';
            $menu_html .= '<li role="presentation">';
            $menu_html .= '<a href="/admin/config.php?display=callsreport&action=reports&report=ura" role="tab">'. _('IVR Report') .'</a>';
            $menu_html .= '</li>';
        }
        else if($r['report'] == 'queues') {
            $menu_html .= '<li role="presentation">';
            $menu_html .= '<a href="/admin/config.php?display=callsreport&action=report&report=calls" role="tab">'. _('Calls Report') .'</a>';
            $menu_html .= '</li>';
            $menu_html .= '<li role="presentation">';
            $menu_html .= '<a href="/admin/config.php?display=callsreport&action=reports&report=agents" role="tab">'. _('Agents Report') .'</a>';
            $menu_html .= '</li>';
            $menu_html .= '<li role="presentation" class="active">';
            $menu_html .= '<a href="/admin/config.php?display=callsreport&action=reports&report=queues" role="tab">'. _('Queues Report') .'</a>';
            $menu_html .= '</li>';
            $menu_html .= '<li role="presentation">';
            $menu_html .= '<a href="/admin/config.php?display=callsreport&action=reports&report=attended" role="tab">'. _('Attended Report') .'</a>';
            $menu_html .= '</li>';
            $menu_html .= '<li role="presentation">';
            $menu_html .= '<a href="/admin/config.php?display=callsreport&action=reports&report=returned" role="tab">'. _('Returned Report') .'</a>';
            $menu_html .= '</li>';
            $menu_html .= '<li role="presentation">';
            $menu_html .= '<a href="/admin/config.php?display=callsreport&action=reports&report=ura" role="tab">'. _('IVR Report') .'</a>';
            $menu_html .= '</li>';
        }
        else if($r['report'] == 'attended') {
            $menu_html .= '<li role="presentation">';
            $menu_html .= '<a href="/admin/config.php?display=callsreport&action=report&report=calls" role="tab">'. _('Calls Report') .'</a>';
            $menu_html .= '</li>';
            $menu_html .= '<li role="presentation">';
            $menu_html .= '<a href="/admin/config.php?display=callsreport&action=reports&report=agents" role="tab">'. _('Agents Report') .'</a>';
            $menu_html .= '</li>';
            $menu_html .= '<li role="presentation">';
            $menu_html .= '<a href="/admin/config.php?display=callsreport&action=reports&report=queues" role="tab">'. _('Queues Report') .'</a>';
            $menu_html .= '</li>';
            $menu_html .= '<li role="presentation" class="active">';
            $menu_html .= '<a href="/admin/config.php?display=callsreport&action=reports&report=attended" role="tab">'. _('Attended Report') .'</a>';
            $menu_html .= '</li>';
            $menu_html .= '<li role="presentation">';
            $menu_html .= '<a href="/admin/config.php?display=callsreport&action=reports&report=returned" role="tab">'. _('Returned Report') .'</a>';
            $menu_html .= '</li>';
            $menu_html .= '<li role="presentation">';
            $menu_html .= '<a href="/admin/config.php?display=callsreport&action=reports&report=ura" role="tab">'. _('IVR Report') .'</a>';
            $menu_html .= '</li>';
        }
        else if($r['report'] == 'returned') {
            $menu_html .= '<li role="presentation">';
            $menu_html .= '<a href="/admin/config.php?display=callsreport&action=report&report=calls" role="tab">'. _('Calls Report') .'</a>';
            $menu_html .= '</li>';
            $menu_html .= '<li role="presentation">';
            $menu_html .= '<a href="/admin/config.php?display=callsreport&action=reports&report=agents" role="tab">'. _('Agents Report') .'</a>';
            $menu_html .= '</li>';
            $menu_html .= '<li role="presentation">';
            $menu_html .= '<a href="/admin/config.php?display=callsreport&action=reports&report=queues" role="tab">'. _('Queues Report') .'</a>';
            $menu_html .= '</li>';
            $menu_html .= '<li role="presentation">';
            $menu_html .= '<a href="/admin/config.php?display=callsreport&action=reports&report=attended" role="tab">'. _('Attended Report') .'</a>';
            $menu_html .= '</li>';
            $menu_html .= '<li role="presentation" class="active">';
            $menu_html .= '<a href="/admin/config.php?display=callsreport&action=reports&report=returned" role="tab">'. _('Returned Report') .'</a>';
            $menu_html .= '</li>';
            $menu_html .= '<li role="presentation">';
            $menu_html .= '<a href="/admin/config.php?display=callsreport&action=reports&report=ura" role="tab">'. _('IVR Report') .'</a>';
            $menu_html .= '</li>';
        }
        else if($r['report'] == 'ura') {
            $menu_html .= '<li role="presentation">';
            $menu_html .= '<a href="/admin/config.php?display=callsreport&action=report&report=calls" role="tab">'. _('Calls Report') .'</a>';
            $menu_html .= '</li>';
            $menu_html .= '<li role="presentation">';
            $menu_html .= '<a href="/admin/config.php?display=callsreport&action=reports&report=agents" role="tab">'. _('Agents Report') .'</a>';
            $menu_html .= '</li>';
            $menu_html .= '<li role="presentation">';
            $menu_html .= '<a href="/admin/config.php?display=callsreport&action=reports&report=queues" role="tab">'. _('Queues Report') .'</a>';
            $menu_html .= '</li>';
            $menu_html .= '<li role="presentation">';
            $menu_html .= '<a href="/admin/config.php?display=callsreport&action=reports&report=attended" role="tab">'. _('Attended Report') .'</a>';
            $menu_html .= '</li>';
            $menu_html .= '<li role="presentation">';
            $menu_html .= '<a href="/admin/config.php?display=callsreport&action=reports&report=returned" role="tab">'. _('Returned Report') .'</a>';
            $menu_html .= '</li>';            
            $menu_html .= '<li role="presentation" class="active">';
            $menu_html .= '<a href="/admin/config.php?display=callsreport&action=reports&report=ura" role="tab">'. _('IVR Report') .'</a>';
            $menu_html .= '</li>';            


        }
    }
    $top_html .= '</div>';
    $menu_html .='</ul>';
    return array('top'=>$top_html, 'menu'=>$menu_html);
}

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

function callsreport_get_returned($db, $callsreport, $count, $limit = 30, $offset = false, $pdf = false) {
    $dt_ini = implode("-", array_reverse(explode("/", $callsreport['data_inicio'])));
    $dt_fim = implode("-", array_reverse(explode("/", $callsreport['data_fim'])));

    $dt_ini = "$dt_ini {$callsreport['hora_inicio']}:00";
    $dt_fim = "$dt_fim {$callsreport['hora_fim']}:59";

    $data_inicio = new \DateTime($dt_ini);
    $data_fim = new \DateTime($dt_fim);
    $where = '';
    $where .= " AND r.calldate BETWEEN '". date_format($data_inicio, 'Y-m-d H:i:s') ."'";
    $where .= " AND '". date_format($data_fim, 'Y-m-d H:i:s')  ."'";


    $ramais = array_keys(callsreport_get_extens());
    $_ramais = implode(',',$ramais);
    $ramais_where = " AND ( r.src NOT IN(".$_ramais.") AND r.dst IN(".$_ramais.")  AND r.disposition = 'ANSWERED' AND r.src != '')  ";
 
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
                 $ramais_where
                 ORDER BY r.calldate
                 DESC 
                 $limit_offset";

        $results = $db->getRow($sql, DB_FETCHMODE_DEFAULT);
        return $results;
    }else{

        $sql = " SELECT *
                 FROM cdr as r
                 WHERE r.calldate > 0 
                 $where
                 $ramais_where
                 ORDER BY r.calldate
                 DESC
                 $limit_offset";
        $results = $db->getAll($sql, DB_FETCHMODE_ASSOC);        

    }

    $stat = array('returned'=>0, 'avg_return_time'=>0);
    $stat_general = $stat;
    $stat_att = array();
    $stat_returns = array();

    foreach($results as $res) {
        $sql = "SELECT * FROM cdr WHERE dst = {$res['src']} AND calldate > '{$res['calldate']}' ";
        $_res = $db->getRow($sql, DB_FETCHMODE_ASSOC);
        if($_res) {

            if(! isset($stat_att[$_res['src']])) {
                $stat_att[$_res['src']] = $stat;
            }
            $f_call = new \DateTime($res['calldate']);
            $f_call = $f_call->getTimeStamp();

            $s_call = new \DateTime($_res['calldate']);
            $s_call = $s_call->getTimeStamp();

            $return_time = ($s_call - $f_call);
            $stat_att[$_res['src']]['returned'] = $stat_att[$_res['src']]['returned']+1;
            $stat_att[$_res['src']]['avg_return_time'] = $stat_att[$_res['src']]['avg_return_time']+$return_time;
            $stat_general['returned'] = $stat_general['returned']+1;
            $stat_general['avg_return_time'] = $stat_general['avg_return_time']+$return_time;
            $stat_returns[] = $_res;
        }

    }

    $stat_general['avg_return_time'] = $stat_general['avg_return_time'] / $stat_general['returned'];
    foreach($stat_att as $sid => $satt) {
        $stat_att[$sid]['avg_return_time'] = $satt['avg_return_time'] / $satt['returned'];
    }

    return array('general'=>$stat_general, 'attendant'=>$stat_att, 'analytic' =>$stat_returns);

}

function callsreport_get_attended($db, $callsreport, $count, $limit = 30, $offset = false, $pdf = false) {

    $dt_ini = implode("-", array_reverse(explode("/", $callsreport['data_inicio'])));
    $dt_fim = implode("-", array_reverse(explode("/", $callsreport['data_fim'])));

    $dt_ini = "$dt_ini {$callsreport['hora_inicio']}:00";
    $dt_fim = "$dt_fim {$callsreport['hora_fim']}:59";

    $data_inicio = new \DateTime($dt_ini);
    $data_fim = new \DateTime($dt_fim);
    $where = '';
    $where .= " AND r.calldate BETWEEN '". date_format($data_inicio, 'Y-m-d H:i:s') ."'";
    $where .= " AND '". date_format($data_fim, 'Y-m-d H:i:s')  ."'";


    $ramais = array_keys(callsreport_get_extens());
    $ramais = implode(',',$ramais);
    $ramais_where = " AND ( r.src NOT IN(".$ramais.") AND r.dst IN(".$ramais.")  AND r.disposition = 'ANSWERED')  ";
 
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
                 WHERE ( r.calldate > 0 AND r.src != '' )
                 $where
                 $ramais_where
                 ORDER BY r.calldate
                 DESC 
                 $limit_offset";

        $results = $db->getRow($sql, DB_FETCHMODE_DEFAULT);
        return $results;
    }else{

        $sql = " SELECT r.calldate, r.dst, r.src, r.disposition, r.duration, r.billsec
                 FROM cdr as r
                 WHERE r.calldate > 0 
                 $where
                 $ramais_where
                 ORDER BY r.calldate
                 DESC";
        $results = $db->getAll($sql, DB_FETCHMODE_ASSOC);        

        $limit_sql = " SELECT *
                 FROM cdr as r
                 WHERE r.calldate > 0 
                 $where
                 $ramais_where
                 ORDER BY r.calldate
                 DESC
                 $limit_offset";
        $limit_results = $db->getAll($limit_sql, DB_FETCHMODE_ASSOC);        

    }

    $info =  array('total'=>0, 'answered'=>0, 'noanswer'=>0, 'abandon' =>0, 'duration'=>0, 'billsec'=>0, 'holdtime'=>0);
    $general = $info;
    $attendant = array();
    foreach($results as $r) {

        if(! isset($attendant[$r['dst']])) {
            $attendant[$r['dst']] = $info;
        }        
        $attendant[$r['dst']]['total'] = $attendant[$r['dst']]['total']+1;
        $general['total'] = $general['total']+1;

        if($r['disposition'] == 'ANSWERED') {
            $attendant[$r['dst']]['answered'] = $attendant[$r['dst']]['answered']+1;
            $general['answered'] = $general['answered']+1;
        }
        else if($r['disposition'] == 'NO ANSWER') {
            $attendant[$r['dst']]['noanswered'] = $attendant[$r['dst']]['noanswered']+1;
            $general['noanswered'] = $general['noanswered']+1;
        }
        else if($r['disposition'] == 'NO ANSWER') {
            $attendant[$r['dst']]['abandon'] = $attendant[$r['dst']]['abandon']+1;
            $general['abandon'] = $general['abandon']+1;            
        }
        $attendant[$r['dst']]['duration'] = $attendant[$r['dst']]['duration']+$r['duration'];
        $attendant[$r['dst']]['billsec'] = $attendant[$r['dst']]['duration']+$r['billsec'];
        
        $holdtime = (int)( (int)$r['duration'] - (int)$r['billsec']);
        $attendant[$r['dst']]['holdtime'] = $attendant[$r['dst']]['holdtime']+$holdtime;

        $general['duration'] = $general['duration']+$r['duration'];
        $general['billsec'] = $general['billsec']+$r['billsec'];
        $general['holdtime'] = $general['holdtime']+$holdtime;
        //$general['abandon'] = $general['abandon']+1;
    }

    foreach($attendant as $at => $atv) {
        $attendant[$at]['avg_answered'] = $atv['duration'] / $atv['answered'];
        $attendant[$at]['avg_holdtime'] = $atv['holdtime'] / $atv['answered'];
    }
    $general['avg_answered'] = $general['duration'] / $general['answered'];
    $general['avg_holdtime'] = $general['holdtime'] / $general['answered'];

    $data = array('general' => $general, 'attendant' => $attendant, 'analitic' => $limit_results);

    if(DB::IsError($results)) {
        die_freepbx($results->getMessage()."<br><br>Error selectingivr");
    }
    return $data;

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
        die_freepbx($results->getMessage()."<br><br>Error selecting from database");
    }
    return $results;
}

function callsreport_get_ivr_entries() {
    global $db;    
    $sql = " SELECT e.*, d.name, d.extension FROM ivr_entries AS e, ivr_details AS d WHERE e.ivr_id = d.id ";
    $_entries = array();
    $entries = $db->getAll($sql, DB_FETCHMODE_ASSOC);
    foreach($entries as $entrie) {
        $entries['total'] = 0;
        $_entries[$entrie['extension']][$entrie['selection']] = $entrie;
    }
    return $_entries;
}

function callreport_get_uras_options($ura) {
    global $db;
    $sql = " SELECT selection,description FROM ivr_entries WHERE ivr_id = '$ura' ORDER BY selection";
    $result = $db->getAll($sql, DB_FETCHMODE_ASSOC);
    $_result = array();
    if(count($result) > 0) {
        foreach($result as $_r) {
            $_result[$_r['selection']]['name'] = "{$_r['description']}";
        }
    }
    return $_result;

}

function callsreport_get_ivrreport($db, $callsreport, $count = 0, $limit = 30, $offset = false, $pdf = false) {

    global $db;
    $dt_ini = implode("-", array_reverse(explode("/", $callsreport['data_inicio'])));
    $dt_fim = implode("-", array_reverse(explode("/", $callsreport['data_fim'])));

    $dt_ini = "$dt_ini {$callsreport['hora_inicio']}:00";
    $dt_fim = "$dt_fim {$callsreport['hora_fim']}:59";

    $data_inicio = new \DateTime($dt_ini);
    $data_fim = new \DateTime($dt_fim);
    $where = '';
    $where .= " AND i.date BETWEEN '". date_format($data_inicio, 'Y-m-d H:i:s') ."'";
    $where .= " AND '". date_format($data_fim, 'Y-m-d H:i:s')  ."'";

    $entries = callsreport_get_ivr_entries();

    $sql = " SELECT *
             FROM ivr_log AS i
             WHERE i.id > 0 
             $where
             ORDER BY i.ivr 
             ";
    $results = $db->getAll($sql, DB_FETCHMODE_ASSOC);

    $totais = array();
    $total_agentes = array();
    $ivr_opt = callreport_get_uras_options($callsreport['ura']);
    $colors = array('#d11141','#00b159','#00aedb','#f37735','#ffc425','#2175d9','#00308f','#e30074','#b8d000','#ff9900','#210203','#9A9CBF','#5EBA4A');

    $_ivr_opt = array();
    foreach($ivr_opt as $ivr_id => $ivr) {
        $_color = array_shift($colors);
        $_ivr_opt[$ivr_id] = array('total'=>0, 'item'=>$ivr_id, 'descricao' => $ivr['name'], 'cor'=>$_color);
    }

    $result = array();
    foreach($results as $res) {
        $_ivr_opt[$res['item']]['total'] = $_ivr_opt[$res['item']]['total']+1;
    }

    $response = array('result'=> $_ivr_opt);
    if(DB::IsError($results)) {
        die_freepbx($results->getMessage()."<br><br>Error selecting from database");
    }
    return $response;

}

function callsreport_get_queuesreport($db, $callsreport, $count = 0, $limit = 30, $offset = false, $pdf = false) {

    $dt_ini = implode("-", array_reverse(explode("/", $callsreport['data_inicio'])));
    $dt_fim = implode("-", array_reverse(explode("/", $callsreport['data_fim'])));

    $dt_ini = "$dt_ini {$callsreport['hora_inicio']}:00";
    $dt_fim = "$dt_fim {$callsreport['hora_fim']}:59";

    $data_inicio = new \DateTime($dt_ini);
    $data_fim = new \DateTime($dt_fim);
    $where = '';
    $where .= " AND q.time BETWEEN '". date_format($data_inicio, 'Y-m-d H:i:s') ."'";
    $where .= " AND '". date_format($data_fim, 'Y-m-d H:i:s')  ."'";

    $event_where = " AND (q.event IN ('ABANDON', 'COMPLETEAGENT','COMPLETECALLER','CONNECT','ENTERQUEUE','EXITEMPTY','EXITWITHKEY','EXITWITHTIMEOUT','RINGNOANSWER', '') )";


    $limit_offset = '';
    if($limit && $offset !== false && !$pdf) {
        if($offset != 0) {
            $limit_offset = "  LIMIT $limit OFFSET $offset ";    
        }else{
            $limit_offset = "  LIMIT $limit ";
        }        
    }

    if($count == 1) {
        $sql = " SELECT count(id) FROM queue_log AS q
                 WHERE q.id != ''
                 $where
                 $event_where
                 ORDER BY q.queuename, q.callid
                 $limit_offset";

        $results = $db->getRow($sql, DB_FETCHMODE_DEFAULT);

    }else{

        $sql = " SELECT *
                 FROM queue_log AS q
                 WHERE q.id > 0 
                 $where
                 $event_where
                 ORDER BY q.queuename, q.callid
                 $limit_offset";


        $results = $db->getAll($sql, DB_FETCHMODE_ASSOC);        

        $calls = array();
        $start = false;
        $attended = false;
        $finish = false;

        $stat = array('entrantes' => 0, 'atendidas' =>0, 'abandonadas'=>0,'tempolimite'=>0, 
                      'naoatendidas'=>0, 'calltime' => 0, 'holdtime'=>0);
        $queue_stat = array();

        foreach($results as $r) {

            if(!isset($queue_stat[$r['queuename']])) {
                $queue_stat[$r['queuename']] = $stat;
            }

            switch($r['event']) {
                // Entrada na fila
                case 'ENTERQUEUE':
                    $stat['entrantes'] = $stat['entrantes']+1;
                    $queue_stat[$r['queuename']]['entrantes'] = $queue_stat[$r['queuename']]['entrantes']+1;
                break;
                // Atendimento
                // case 'CONNECT':
                //     $stat['atendidas'] = $stat['atendidas']+1;
                break;
                // Finalização
                case 'COMPLETEAGENT';
                    $stat['atendidas'] = $stat['atendidas']+1;
                    $stat['calltime'] = $stat['calltime'] + $r['data1'];
                    $stat['holdtime'] = $stat['holdtime'] + $r['data2'];
                    $queue_stat[$r['queuename']]['atendidas'] = $queue_stat[$r['queuename']]['atendidas']+1;
                    $queue_stat[$r['queuename']]['calltime'] = $queue_stat[$r['queuename']]['calltime']+$r['data1'];
                    $queue_stat[$r['queuename']]['holdtime'] = $queue_stat[$r['queuename']]['holdtime']+$r['data2'];
                break;
                // Finalização
                case 'COMPLETECALLER';
                    $stat['atendidas'] = $stat['atendidas']+1;
                    $stat['calltime'] = $stat['calltime'] + $r['data1'];
                    $stat['holdtime'] = $stat['holdtime'] + $r['data2'];                    
                    $queue_stat[$r['queuename']]['atendidas'] = $queue_stat[$r['queuename']]['atendidas']+1;
                    $queue_stat[$r['queuename']]['calltime'] = $queue_stat[$r['queuename']]['calltime']+$r['data1'];
                    $queue_stat[$r['queuename']]['holdtime'] = $queue_stat[$r['queuename']]['holdtime']+$r['data2'];                    
                break;
                // Erros
                case 'EXITEMPTY':
                    $stat['naoatendidas'] = $stat['naoatendidas']+1;
                    $queue_stat[$r['queuename']]['naoatendidas'] = $queue_stat[$r['queuename']]['naoatendidas']+1;
                break;
                case 'EXITWITHTIMEOUT':
                    $stat['tempolimite'] = $stat['tempolimite']+1;
                    $queue_stat[$r['queuename']]['tempolimite'] = $queue_stat[$r['queuename']]['tempolimite']+1;
                break;
                case 'ABANDON':
                     $stat['abandonadas'] = $stat['abandonadas']+1;
                     $queue_stat[$r['queuename']]['abandonadas'] = $queue_stat[$r['queuename']]['abandonadas']+1;
                 break;
            }

        }

        $stat['calltime_avg'] = number_format($stat['calltime'] / $stat['atendidas'], 2);
        $stat['holdtime_avg'] = number_format($stat['holdtime'] / $stat['entrantes'], 2);
        foreach($queue_stat as $queue => $q) {
            $queue_stat[$queue]['calltime_avg'] = number_format($q['calltime'] / $q['atendidas'], 2);
            $queue_stat[$queue]['holdtime_avg'] = number_format($q['holdtime'] / $q['entrantes'], 2);
        }

    }

    $response = array('general'=> $stat, 'queue_stat'=>$queue_stat);
    if(DB::IsError($results)) {
        die_freepbx($results->getMessage()."<br><br>Error selecting from database");
    }
    return $response;
}

function callsreport_get_ivr() {
    global $db;
    $sql = "SELECT id,name,extension,description FROM ivr_details";
    $ivrs = array();
    if($_ivrs = $db->getAll($sql, DB_FETCHMODE_ASSOC)) {
        foreach($_ivrs as $_ivr) {
            $ivrs[$_ivr['id']] = $_ivr['extension'] .' - '. $_ivr['name'];
        }
    }    
    return $ivrs;    
}

function callsreport_get_queues() {
    global $db;
    $sql = "SELECT extension FROM queues_config";
    $queues = array();
    if($_queues = $db->getAll($sql, DB_FETCHMODE_ASSOC)) {
        foreach($_queues as $_queue) {
            $queues[$_queue['extension']] = $_queue['extension'];
        }
    }    
    return $queues;    
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
    if($report == 'ura') {

        $ivrs = callsreport_get_ivr();
        foreach($ivrs as $key => $val) {
            $ivr_key = $key;
            continue;
        }
        $_SESSION['callsreport'][$report]['ura'] = $ivr_key;
    }
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

    ob_clean();
    require_once(__DIR__ .'/vendor/mpdf60/mpdf.php');

    $mpdf = new mPDF();
    $html = ob_get_contents();
    $file_name = __DIR__ . '/cache/relatorio_chamadas_.pdf';

    $report_type = $type;

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

    if($type == 'queues') {


        $html .=  '<table style="font-size:10px;width:100%;">';
        $html .=  '    <tbody style="background-color: #696969;">';
        $html .=  '          <tr>';
        $html .=  '              <td><h2>'._('Queues Report'). '</h2></td>';
        $html .=  '          </tr>';
        $html .=  '          <tr>';
        $html .=  '              <td><b>'._('Period'). ': </b>'.$period['data_inicio'].' '.$period['hora_inicio'].' - '.$period['data_fim'].' '.$period['hora_fim'].'</td>';
        $html .=  '          </tr>';        
        $html .=  '    </tbody>';
        $html .=  '</table>';

        $html .=  '<h4>'._('General Statistics').'</h4>';
        $html .=  '<table style="font-size:10px;width:100%;" callpadding="0">';
        $html .=  '    <thead style="background-color: #696969;">';
        $html .=  '          <tr style="background-color: #d2d2d2;">';
        $html .=  '              <td><b>'._('Total Calls'). '</b></td>';
        $html .=  '              <td><b>'._('Answered'). '</b></td>';
        $html .=  '              <td><b>'._('Abandon'). '</b></td>';
        $html .=  '              <td><b>'._('Time Limit'). '</b></td>';
        $html .=  '              <td><b>'._('Not Answered'). '</b></td>';
        $html .=  '          </tr>';
        $html .=  '    </thead>';
        $html .=  '    <tbody>';
        if(count($results['general']) > 0) {
            $html .=  '                  <tr style="'.($c == 1 ? 'background-color:#f1f1f1;' : 'background-color:#fff;').'">';                    
            $html .=  '                      <td>'. $results['general']['entrantes'] .'</td>';
            $html .=  '                      <td>'. $results['general']['atendidas'] .'</td>';
            $html .=  '                      <td>'. $results['general']['abandonadas'] .'</td>';
            $html .=  '                      <td>'. $results['general']['tempolimite'] .'</td>';
            $html .=  '                      <td>'. $results['general']['naoatendidas'] .'</td>';
            $html .=  '                  </tr>';
            $c = ($c == 1 ? $c = 0 : $c = 1);
        }
        $html .=  '        </tbody>';
        $html .=  '      </table>';        

        $html .=  '<table style="font-size:10px;width:100%;" callpadding="0">';
        $html .=  '    <thead style="background-color: #696969;">';
        $html .=  '          <tr style="background-color: #d2d2d2;">';
        $html .=  '              <td><b>'._('Total Call Time'). '</b></td>';
        $html .=  '              <td><b>'. _('Total Hold Time'). '</b></td>';
        $html .=  '              <td><b>'. _('Average Call Time'). '</b></td>';
        $html .=  '              <td><b>'. _('Average Hold Time'). '</b></td>';
        $html .=  '          </tr>';
        $html .=  '    </thead>';
        $html .=  '    <tbody>';
        if(count($results['general']) > 0) {
            $html .=  '                  <tr style="'.($c == 1 ? 'background-color:#f1f1f1;' : 'background-color:#fff;').'">';                    
            $html .=  '                      <td>'. gmdate('H:i:s', $results['general']['calltime']) .'</td>';
            $html .=  '                      <td>'. gmdate('H:i:s', $results['general']['holdtime']) .'</td>';
            $html .=  '                      <td>'. gmdate('H:i:s', $results['general']['calltime_avg']) .'</td>';
            $html .=  '                      <td>'. gmdate('H:i:s', $results['general']['holdtime_avg']) .'</td>';
            $html .=  '                  </tr>';
            $c = ($c == 1 ? $c = 0 : $c = 1);
        }
        $html .=  '        </tbody>';
        $html .=  '      </table>';        


        foreach($results['queue_stat'] as $queue => $val) {
            $html .=  '<h4>'._('Queue Statistics') .' '. $queue .'</h4>';

            $html .=  '<table style="font-size:10px;width:100%;" callpadding="0">';
            $html .=  '    <thead style="background-color: #696969;">';
            $html .=  '          <tr style="background-color: #d2d2d2;">';
            $html .=  '              <td><b>'. _('Total Calls'). '</b></td>';
            $html .=  '              <td><b>'. _('Answered'). '</b></td>';
            $html .=  '              <td><b>'. _('Abandon'). '</b></td>';
            $html .=  '              <td><b>'. _('Time Limit'). '</b></td>';
            $html .=  '              <td><b>'. _('Not Answered'). '</b></td>';
            $html .=  '          </tr>';
            $html .=  '    </thead>';
            $html .=  '    <tbody>';
            if(count($results['general']) > 0) {
                $html .=  '                  <tr style="'.($c == 1 ? 'background-color:#f1f1f1;' : 'background-color:#fff;').'">';                    
                $html .=  '                      <td>'. $val['entrantes'] .'</td>';
                $html .=  '                      <td>'. $val['atendidas'] .'</td>';
                $html .=  '                      <td>'. $val['abandonadas'] .'</td>';
                $html .=  '                      <td>'. $val['tempolimite'] .'</td>';
                $html .=  '                      <td>'. $val['naoatendidas'] .'</td>';
                $html .=  '                  </tr>';
                $c = ($c == 1 ? $c = 0 : $c = 1);
            }
            $html .=  '        </tbody>';
            $html .=  '      </table>';        

            $html .=  '<table style="font-size:10px;width:100%;" callpadding="0">';
            $html .=  '    <thead style="background-color: #696969;">';
            $html .=  '          <tr style="background-color: #d2d2d2;">';
            $html .=  '              <td><b>'. _('Total Call Time'). '</b></td>';
            $html .=  '              <td><b>'. _('Total Hold Time'). '</b></td>';
            $html .=  '              <td><b>'. _('Average Call Time'). '</b></td>';
            $html .=  '              <td><b>'. _('Average Hold Time'). '</b></td>';
            $html .=  '          </tr>';
            $html .=  '    </thead>';
            $html .=  '    <tbody>';
            $html .=  '                  <tr style="'.($c == 1 ? 'background-color:#f1f1f1;' : 'background-color:#fff;').'">';                    
            $html .=  '                      <td>'. gmdate('H:i:s', $val['calltime']) .'</td>';
            $html .=  '                      <td>'. gmdate('H:i:s', $val['holdtime']) .'</td>';
            $html .=  '                      <td>'. gmdate('H:i:s', $val['calltime_avg']) .'</td>';
            $html .=  '                      <td>'. gmdate('H:i:s', $val['holdtime_avg']) .'</td>';
            $html .=  '                  </tr>';
            $html .=  '        </tbody>';
            $html .=  '      </table>';  
        }        

        $mpdf->WriteHTML($html);
        $content = $mpdf->Output($file_name, $output);
        if($output) {
            return $file_name;    
        }        
    }    


    if($type == 'ura') {

        $html .=  '<table style="font-size:10px;width:100%;">';
        $html .=  '    <tbody style="background-color: #696969;">';
        $html .=  '          <tr>';
        $html .=  '              <td><h2>'. _('Ivr Report') .'</h2></td>';
        $html .=  '          </tr>';
        $html .=  '          <tr>';
        $html .=  '              <td><b>'._('Period') .': </b>'.$period['data_inicio'].' '.$period['hora_inicio'].' - '.$period['data_fim'].' '.$period['hora_fim'].'</td>';
        $html .=  '          </tr>';        

        $html .=  '          <tr>';
        $html .=  '              <td><b>'. _('Ivr') .': </b>'.$results['ura'].'</td>';
        $html .=  '          </tr>';
        $html .=  '    </tbody>';
        $html .=  '</table>';


        $html .=   '<img src="'. callsreport_generate_image('pie', $results['result']) .'" />';

        $html .=  '<table style="font-size:10px;width:100%;" callpadding="0">';
        $html .=  '    <thead style="background-color: #696969;">';
        $html .=  '          <tr style="background-color: #d2d2d2;">';
        $html .=  '              <td style="width:10px;"> </td>';
        $html .=  '              <td><b>'. _('Choice') .'</b></td>';
        $html .=  '              <td><b>'. _('Description') .'</b></td>';
        $html .=  '              <td><b>'. _('Total') .'</b></td>';
        $html .=  '          </tr>';
        $html .=  '    </thead>';
        $html .=  '    <tbody>';
        if(count($results['result']) > 0) {
            foreach($results['result'] as $res) {
                $html .=  '                  <tr style="'.($c == 1 ? 'background-color:#f1f1f1;' : 'background-color:#fff;').'">';        
                $html .=  '                      <td> <div style="background-color:'.$res['cor'].';color:'.$res['cor'].';width:10px;heigth:10px;padding:3px;"> - </div> </td>';            
                $html .=  '                      <td>'. $res['item'] .'</td>';
                $html .=  '                      <td>'. $res['descricao'] .'</td>';
                $html .=  '                      <td>'. $res['total'] .'</td>';
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


    if($type == 'attended') {

        $html .=  '<table style="font-size:10px;width:100%;">';
        $html .=  '    <tbody style="background-color: #696969;">';
        $html .=  '          <tr>';
        $html .=  '              <td><h2>'. _('Attended Report') .'</h2></td>';
        $html .=  '          </tr>';
        $html .=  '          <tr>';
        $html .=  '              <td><b>Período: </b>'.$period['data_inicio'].' '.$period['hora_inicio'].' - '.$period['data_fim'].' '.$period['hora_fim'].'</td>';
        $html .=  '          </tr>';        
        $html .=  '    </tbody>';
        $html .=  '</table>';


        $html .=  '<table style="font-size:10px;width:100%;" callpadding="0">';
        $html .=  '    <thead style="background-color: #696969;">';
        $html .=  '          <tr style="background-color: #d2d2d2;">';
        $html .=  '              <td><b>'. _('Attended'). '</b></td>';
        $html .=  '              <td><b>'. _('Total Time'). '</b></td>';
        $html .=  '              <td><b>'. _('Total Hold Time'). '</b></td>';
        $html .=  '              <td><b>'. _('Average Call Time'). '</b></td>';
        $html .=  '              <td><b>'. _('Average Hold Time'). '</b></td>';
        $html .=  '          </tr>';
        $html .=  '    </thead>';
        $html .=  '    <tbody>';
        $html .=  '          <tr style="'.($c == 1 ? 'background-color:#f1f1f1;' : 'background-color:#fff;').'">';        
        $html .=  '              <td>'. $results['general']['answered'] .'</td>';
        $html .=  '              <td>'. gmdate('H:i:s', $results['general']['duration']) .'</td>';
        $html .=  '              <td>'. gmdate('H:i:s', $results['general']['holdtime']) .'</td>';
        $html .=  '              <td>'. gmdate('H:i:s', $results['general']['avg_answered']) .'</td>';
        $html .=  '              <td>'. gmdate('H:i:s', $results['general']['avg_holdtime']) .'</td>';
        $html .=  '          </tr>';
        $html .=  '        </tbody>';
        $html .=  '      </table>';        


      
        if(count($results['attendant']) > 0) {
            foreach($results['attendant'] as $att => $res) {
                $html .=  '<h4>'._('Attendent Statistics') .' '. $att .'</h4>';
                $html .=  '<table style="font-size:10px;width:100%;" callpadding="0">';
                $html .=  '    <thead style="background-color: #696969;">';
                $html .=  '          <tr style="background-color: #d2d2d2;">';
                $html .=  '              <td><b>'. _('Attended'). '</b></td>';
                $html .=  '              <td><b>'. _('Total Time'). '</b></td>';
                $html .=  '              <td><b>'. _('Total Hold Time'). '</b></td>';
                $html .=  '              <td><b>'. _('Average Call Time'). '</b></td>';
                $html .=  '              <td><b>'. _('Average Hold Time'). '</b></td>';
                $html .=  '          </tr>';
                $html .=  '    </thead>';
                $html .=  '    <tbody>';

                $html .=  '          <tr style="'.($c == 1 ? 'background-color:#f1f1f1;' : 'background-color:#fff;').'">';        
                $html .=  '              <td>'. $res['answered'] .'</td>';
                $html .=  '              <td>'. gmdate('H:i:s', $res['duration']) .'</td>';
                $html .=  '              <td>'. gmdate('H:i:s', $res['holdtime']) .'</td>';
                $html .=  '              <td>'. gmdate('H:i:s', $res['avg_answered']) .'</td>';
                $html .=  '              <td>'. gmdate('H:i:s', $res['avg_holdtime']) .'</td>';
                $html .=  '          </tr>';
                $c = ($c == 1 ? $c = 0 : $c = 1);                
                $html .=  '        </tbody>';
                $html .=  '      </table>';                        
            }
        }

        $mpdf->WriteHTML($html);
        $content = $mpdf->Output($file_name, $output);
        if($output) {
            return $file_name;    
        }                
    }

    if($type == 'returned') {

        $html .=  '<table style="font-size:10px;width:100%;">';
        $html .=  '    <tbody style="background-color: #696969;">';
        $html .=  '          <tr>';
        $html .=  '              <td><h2>'. _('Returned Report') .'</h2></td>';
        $html .=  '          </tr>';
        $html .=  '          <tr>';
        $html .=  '              <td><b>Período: </b>'.$period['data_inicio'].' '.$period['hora_inicio'].' - '.$period['data_fim'].' '.$period['hora_fim'].'</td>';
        $html .=  '          </tr>';        
        $html .=  '    </tbody>';
        $html .=  '</table>';


        $html .=  '<table style="font-size:10px;width:100%;" callpadding="0">';
        $html .=  '    <thead style="background-color: #696969;">';
        $html .=  '          <tr style="background-color: #d2d2d2;">';
        $html .=  '              <td><b>'. _('Returned'). '</b></td>';
        $html .=  '              <td><b>'. _('Average Return Time'). '</b></td>';
        $html .=  '          </tr>';
        $html .=  '    </thead>';
        $html .=  '    <tbody>';
        $html .=  '          <tr style="'.($c == 1 ? 'background-color:#f1f1f1;' : 'background-color:#fff;').'">';        
        $html .=  '              <td>'. $results['general']['returned'] .'</td>';
        $html .=  '              <td>'. gmdate('H:i:s', $results['general']['avg_return_time']) .'</td>';
        $html .=  '          </tr>';
        $html .=  '        </tbody>';
        $html .=  '      </table>';        

      
        if(count($results['attendant']) > 0) {
            foreach($results['attendant'] as $att => $res) {
                $html .=  '<h4>'._('Attendent Statistics') .' '. $att .'</h4>';
                $html .=  '<table style="font-size:10px;width:100%;" callpadding="0">';
                $html .=  '    <thead style="background-color: #696969;">';
                $html .=  '          <tr style="background-color: #d2d2d2;">';
                $html .=  '              <td><b>'. _('Returned'). '</b></td>';
                $html .=  '              <td><b>'. _('Average Return Time'). '</b></td>';
                $html .=  '          </tr>';
                $html .=  '    </thead>';
                $html .=  '    <tbody>';

                $html .=  '          <tr style="'.($c == 1 ? 'background-color:#f1f1f1;' : 'background-color:#fff;').'">';        
                $html .=  '              <td>'. $res['returned'] .'</td>';
                $html .=  '              <td>'. gmdate('H:i:s', $res['avg_return_time']) .'</td>';
                $html .=  '          </tr>';
                $c = ($c == 1 ? $c = 0 : $c = 1);                
                $html .=  '        </tbody>';
                $html .=  '      </table>';                        
            }
        }

        $mpdf->WriteHTML($html);
        $content = $mpdf->Output($file_name, $output);
        if($output) {
            return $file_name;    
        }                
    }

}

function callsreport_generate_image($type, $data) {


    require_once __DIR__ . '/lib/jpgraph-4.0.2/src/jpgraph.php';
    require_once __DIR__ . '/lib/jpgraph-4.0.2/src/jpgraph_pie.php';
    $dir = __DIR__ . '/cache/';

    $file = new \DateTime();
    $file = $file->getTimeStamp().'_'.rand().'_.png';
    $file = $dir . $file;


    $_cor = array();
    $_info = array();
    $_label = array();
    foreach($data as $d) {
        $_info[] = $d['total'];
        $_label[] = "{$d['descricao']}";
        $_cor[] = "{$d['cor']}";
    }


    if($type == 'pie') {

        $data = $_info;
        $graph = new PieGraph(850,350);
        $theme_class="DefaultTheme";
        $graph->SetBox(true);

        $p1 = new PiePlot($data);
        $graph->Add($p1);

        $p1->ShowBorder();
        $p1->SetColor('black');
        $p1->SetSliceColors($_cor);
        $p1->SetLabelType(PIE_VALUE_PER);

        $labels = $_label;
        $p1->SetLegends($labels);

        $graph->Stroke($file);
        return $file;
        exit;
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

    if($data['ivr'] != '') {
        $ivr = $data['ivr'];
    }else{
        $ivr = '';
    }

    if($data['queue'] != '') {
        $queue = $data['queue'];
    }else{
        $queue = '';
    }
    
    if(count($data['b_ramais']) > 0) {
        $extens = implode(',', $data['b_ramais']);    
    }else{
        $extens = '';
    }
    $sql = "INSERT INTO calls_report_scheduling (description,extens,ivr,queue,type,direction,periodicity,day,week_day,hour,email, limit_initial, limit_final)
            VALUES ('{$data['description']}','$extens','$ivr','$queue','{$data['type']}','{$data['direction']}','{$data['periodicity']}',
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

    if($data['ivr'] != '') {
        $ivr = $data['ivr'];
    }else{
        $ivr = '';
    }

    if($data['queue'] != '') {
        $queue = $data['queue'];
    }else{
        $queue = '';
    }

    $sql = "UPDATE  calls_report_scheduling 
            SET description = '{$data['description']}',
                extens =  '$extens', 
                ivr = '$ivr',
                queue = '$queue',
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

function callsreport_get_pagination($total, $itenspp, $page, $report) {

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

    $url = '/admin/config.php?display=callsreport&action=report&report='.$report.'&page=';

    $html = '<ul class="pagination pagination-md" style="margin-right:4px;">';
    if($first == $page) {
        $html .= '<li class="disabled">';
        $html .=    "<a href=\"#\">";
        $html .=        _('First');
        $html .=    '</a>';
        $html .= '</li>';
    }else{
        $html .= '<li>';
        $html .=    "<a href=\"$url$first\">";
        $html .=        _('Last');
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
        $html .=        _('Last');
        $html .=    '</a>';
        $html .= '</li>';
    }else{
        $html .= '<li>';
        $html .=    "<a href=\"$url$last\">";
        $html .=        _('Last');
        $html .=    '</a>';
        $html .= '</li>';
    }

    $html .= '</ul>';
    return array('html'=>$html,'limit'=>$limit,'offset'=>$offset);
}
