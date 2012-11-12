<?php

// 接続するデータベース名
$database = 'test';

// 接続するテーブル名
$table = 'guruguru_test_tbl';

// インサートするデータの定義
$table_define = array(
// INT ===================================================
	// 100 から始まって2ずつ増えるカラム
	'id' => array(
		'attr' => COLUMN_ATTRIBUTE_INT,
		'type' => DATA_TYPE_NUMBER,
		'start_num' => 100,
		'inc_num' => 2,
	),
	// 1000～2000の間のランダムな値を取るカラム
	'target_id' => array(
		'attr' => COLUMN_ATTRIBUTE_INT,
		'type' => DATA_TYPE_RANGE,
		'min' => 1000,
		'max' => 2000,
	),
	// 1 or 10 or 20 を値に取るカラム
	'status' => array(
		'attr' => COLUMN_ATTRIBUTE_INT,
		'type' => DATA_TYPE_LIST,
		'list' => array(1, 10, 20),
	),
// STRING =================================================
	// 200から始まり5ずつ増えプリフィックスtest_user_を持つ文字列
	// ex: test_user_200, test_user_205, test_user_210 ....
 	'name' => array(
 		'attr' => COLUMN_ATTRIBUTE_STRING,
 		'type' => DATA_TYPE_NUMBER,
 		'prefix' => 'test_user_',
 		'start_num' => 200,
 		'inc_num' => 5,
 	),
// DATETIME ===============================================
	// 1986年9月28日から始まり10秒ずつ増えるdatetime
	'birth' => array(
		'attr' => COLUMN_ATTRIBUTE_DATETIME,
		'type' => DATA_TYPE_NUMBER,
		'start_num' => strtotime('1986-09-28 00:00:00'),
		'inc_num' => 10,
	),
	// 2005年1月1日から2020年1月1日までの間のランダムなdatetime
	'marriage' => array(
		'attr' => COLUMN_ATTRIBUTE_DATETIME,
		'type' => DATA_TYPE_RANGE,
		'min' => strtotime('2005-01-01 00:00:00'),
		'max' => strtotime('2020-01-01 00:00:00'),
	),
);

