<?php
/* FreePBX installer file
 * Calls Report by Gnovit.com
 */


$sql = "DROP TABLE IF EXISTS `calls_report_scheduling`;
CREATE TABLE `calls_report_scheduling` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(200) DEFAULT NULL,
  `extens` varchar(500) DEFAULT NULL,
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
