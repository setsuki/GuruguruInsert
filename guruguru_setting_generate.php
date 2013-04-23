#!/usr/bin/php -q
<?php
/**
 * GuruguruInsert設定ファイル生成
 * 指定されたテーブルの設定ファイル生成するスクリプト
 *
 * @package		guruguruInsert
 * @author		setsuki (yukicon)
 * @copyright	Susugi Ningyoukan
 * @license		BSD
 **/

// 汎用定義ファイルの読み込み
require('guruguru_insert_common.php');


$options = getopt('h:P:u:p:b:l:mf:');

$host = 'localhost';
$port = 3306;
$user = 'root';
$pass = 'root';

if (isset($options['m'])) {
	print "require option table name ex:./guruguru_setting_generate.php database table\n";
	print "-h host          [optional]mysql host [default:{$host}]\n";
	print "-P port          [optional]mysql port [default:{$port}]\n";
	print "-u user          [optional]mysql user [default:{$user}]\n";
	print "-p pass          [optional]mysql pass [default:{$pass}]\n";
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

// 引数からテーブル名を取得
$next_ignore_flg = true;
$target_arr = null;
foreach ($argv as $key => $val) {
	if ($next_ignore_flg) {
		// フラグが有効ならフラグを落として次へ
		$next_ignore_flg = false;
		continue;
	}
	if (0 === strpos($val, '-')) {
		// -から始まるものはオプションとして次のものを含めて無視するようにする
		$next_ignore_flg = true;
		continue;
	}
	$target_arr[] = $val;
}

if (2 > ($target_arr)) {
	// テーブルが設定されなかった場合はエラー終了
	print "[ERROR] empty set table name\n";
	print "Manual for (-m)\n";
	exit;
}

$database = $target_arr[0];
$table = $target_arr[1];

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

$table_info_arr = fetchAll($db, "DESC {$table}", array());

print "<?php\n\n\$database = '{$database}';\n\n";
print "\$table = '{$table}';\n\n";
print "\$table_define = array(\n";

// 1行ずつ処理
foreach ($table_info_arr as $col_info) {
	outputSampleColumnData($col_info);
}

print ");\n\n";
