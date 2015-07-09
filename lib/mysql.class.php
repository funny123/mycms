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
			Common::errormsg('数据库连接失败');
		}
		if(!mysql_select_db($this->db_name,$this->conn)){
			$this->errormsg('指定数据库失败');
		}
// 		return $conn;
		
	}
	//
	public function errormsg($msg){
		echo $msg;
		exit;
	}
	//
	public function insert($table,$arr){
		$keys=join(',',array_keys($arr));
		$vals="'".join("','",array_values($arr))."'";
		$sql="insert into {$table}($keys)values({$vals})";
		$this->query($sql);
		return mysql_insert_id();
	}
	//
	function update($table,$array,$where=null){
		foreach($array as $key=>$val){
			if($str==null){
				$sep="";
			}else{
				$sep=",";
			}
			$str.=$sep.$key."='".$val."'";
		}
		$sql="update {$table} set {$str} ".($where==null?null:" where ".$where);
		$result=mysql_query($sql);
		//var_dump($result);
		//var_dump(mysql_affected_rows());exit;
		if($result){
			return mysql_affected_rows();
		}else{
			return false;
		}
	}
	//
	public function delete($table,$where=null){
		$where=$where==null?null:" where ".$where;
		$sql="delete from {$table} {$where}";
		$this->query($sql);
		return mysql_affected_rows();
	}
	//
	public function fetchOne($sql,$result_type=MYSQL_ASSOC){
		$res=$this->query($sql);
		$row=mysql_fetch_array($res,$result_type);
		return $row;
	}
	//
	public function fetchAll($sql,$result_type=MYSQ_ASSOC){
		$res=$this->query($sql);
		$rows=array();
		while($row=mysql_fetch_array($res,$result_type)){
			$rows[]=$row;
		}
		return $rows;
	}
	//
	public function getResultNum($sql){
		$res=$this->query($sql);
		return mysql_num_rows($res);
	}
	//
	public function getInsertId($sql){
		return mysql_insert_id();
	}
}
