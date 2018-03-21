<?php
if (!defined('FREEPBX_IS_AUTH')) { die('No direct script access allowed'); }
sql('DROP TABLE IF EXISTS calls_report_scheduling');
sql('DROP TABLE IF EXISTS calls_report_send_log');
sql('DROP TABLE IF EXISTS queue_log');
