<?php
define('ROOT',dirname(__FILE__));
require_once ROOT.'/lib/mysql.class.php';
require_once ROOT.'/lib/common.class.php';
$db=new Mysql('localhost','root','root');