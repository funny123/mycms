<?php
class Mysql{
	public $db_host;
	public $db_user;
	public $db_pass;
	public $db_name;
	public $db_charset;
	public $conn;
	public function __construct($db_host,$db_user,$db_pass,$db_name,$db_charset){
		$this->db_host=$db_host;
		$this->db_user=$db_user;
		$this->db_pass=$db_pass;
		$this->db_name=$db_name;
		$this->db_charset=$db_charset;
		$this->conn=mysql_connect($this->db_host,$this->db_user,$this->db_pass);
		if(!$this->conn){
			$this->errormsg('数据库连接失败');
		}
		if(!mysql_select_db($this->db_name,$this->conn)){
			$this->errormsg('指定数据库失败');
		}
		
	}
	//
	function errormsg($msg){
		echo $msg;
		exit;
	}
}