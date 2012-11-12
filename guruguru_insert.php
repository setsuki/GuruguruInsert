#!/usr/bin/php -q
<?php
/**
 * GuruguruInsert実行ファイル
 * 設定ファイルを元にテストデータをインサートするスクリプト
 *
 * @package		guruguruInsert
 * @author		setsuki (yukicon)
 * @copyright	Susugi Ningyokan
 * @license		BSD
 **/

// 汎用定義ファイルの読み込み
require('guruguru_insert_common.php');


$exec_start_time = microtime(true);

$options = getopt('h:P:u:p:b:l:mf:');

$host = 'localhost';
$port = 3306;
$user = 'root';
$pass = 'root';
$once_ins_cnt = 1000;
$loop_cnt = 10;
$setting_file = 'setting.php';

if (isset($options['m'])) {
	print "-h host          [optional]mysql host [default:{$host}]\n";
	print "-P port          [optional]mysql port [default:{$port}]\n";
	print "-u user          [optional]mysql user [default:{$user}]\n";
	print "-p pass          [optional]mysql pass [default:{$pass}]\n";
	print "-b base_count    [optional]base insert count [default{$once_ins_cnt}]\n";
	print "-l loop_count    [optional]loop count [default{$loop_cnt}]\n";
	print "-f file          [optional]setting file [{$setting_file}]\n";
	exit;
}

if (isset($options['h'])) {
	$host = $options['h'];
}
if (isset($options['P'])) {
	$port = $options['p'];
}
if (isset($options['u'])) {
	$user = $options['u'];
}
if (isset($options['p'])) {
	$pass = $options['p'];
}
if (isset($options['b'])) {
	$once_ins_cnt = $options['b'];
}
if (isset($options['l'])) {
	$loop_cnt = $options['l'];
}
if (isset($options['f'])) {
	$setting_file = $options['f'];
}

// 設定の読み込み
if (!is_file($setting_file)) {
	// 設定ファイルが存在しないなら終了
	echo "file not exist {$setting_file}\n";
	exit;
}
require($setting_file);

$attribute = array(
	PDO::ATTR_PERSISTENT => false,
	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . 'utf8',
	PDO::ATTR_EMULATE_PREPARES => true,	
	PDO::ATTR_TIMEOUT => 30
);

// DBに接続する
$db_dsn = sprintf('%s:host=%s;port=%s;dbname=%s', 'mysql', $host, $port, $database);
$db = new PDO($db_dsn, $user, $pass, $attribute);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	// エラー時はExceptionを投げる

$ins_cnt = 0;
$start_time = time();
for ($i = 0; $i < $loop_cnt; $i++) {
	$col_names = array_keys($table_define);
	$sql_str = 'INSERT INTO ' . $table . ' ( ' . implode(',', $col_names) . ' ) VALUES ';
	
	$tmp_param_arr = array();
	foreach ($table_define as $key => $val) {
		$tmp_param_arr[] = '?';
	}
	$base_param_str = ' ( ' . implode(',', $tmp_param_arr) . ' ) ';
	
	$value_str_arr = array();
	$sql_param = array();
	for ($j = 0; $j < $once_ins_cnt; $j++) {
		$row_data = generateRowData($table_define);
		$sql_param = array_merge($sql_param, $row_data);
		$value_str_arr[] = $base_param_str;
		$ins_cnt++;
	}
	$sql_str .= implode(',', $value_str_arr);
	execSQL($db, $sql_str, $sql_param);
	echo "loop:{$i} ins_cnt:{$ins_cnt}\n";
}


$exec_end_time = microtime(true);
$exec_time = $exec_end_time - $exec_start_time;
echo "exec time {$exec_time}\n";

