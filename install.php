<?php
/* FreePBX installer file
 * Calls Report by Gnovit.com
 */


$sql = "DROP TABLE IF EXISTS `calls_report_scheduling`;
CREATE TABLE `calls_report_scheduling` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(200) DEFAULT NULL,
  `extens` varchar(500) DEFAULT NULL,
  `ivr` varchar(50) DEFAULT NULL,
  `queue` varchar(50) DEFAULT NULL,
  `type` int(1) DEFAULT NULL,
  `direction` int(1) DEFAULT NULL,
  `periodicity` char(1) DEFAULT NULL,
  `day` int(2) DEFAULT NULL,
  `week_day` int(1) DEFAULT NULL,
  `limit_initial` varchar(2),
  `limit_final` varchar(2),
  `hour` int(2) DEFAULT NULL,
  `email` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$sql .= "DROP TABLE IF EXISTS `calls_report_send_log`;
CREATE TABLE `calls_report_send_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scheduling_id` int(11) NOT NULL,
  `date` DATETIME NOT NULL, 
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";

$check = sql($sql);
if (DB::IsError($check)) {
        die_freepbx( "Can not create `cdr` table: " . $check->getMessage() .  "\n");
}


global $amp_conf;

$db_name = 'asteriskcdrdb';
$db_hash = array('mysql' => 'mysql', 'postgres' => 'pgsql');
$db_type = 'mysql';
$db_host = 'localhost'; //$amp_conf["CDRDBHOST"];
$db_port = empty($amp_conf["CDRDBPORT"]) ? '' :  ':' . $amp_conf["CDRDBPORT"];
$db_user = empty($amp_conf["CDRDBUSER"]) ? $amp_conf["AMPDBUSER"] : $amp_conf["CDRDBUSER"];
$db_pass = empty($amp_conf["CDRDBPASS"]) ? $amp_conf["AMPDBPASS"] : $amp_conf["CDRDBPASS"];
$datasource = $db_type . '://' . $db_user . ':' . $db_pass . '@' . $db_host . $db_port . '/' . $db_name;

$dbcdr = DB::connect($datasource); // attempt connection

// ON asteriskcdrdb
$sqlcdr .= "DROP TABLE IF EXISTS `queue_log`;
CREATE TABLE `queue_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `time` char(26) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `callid` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `queuename` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `agent` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `event` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `data1` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `data2` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `data3` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `data4` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `data5` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
";

$dbcdr->sql($sqlcdr);



