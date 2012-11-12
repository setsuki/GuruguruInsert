<?php
/**
 * GuruguruInsert用汎用定義ファイル
 *
 * @package		guruguruInsert
 * @author		setsuki (yukicon)
 * @copyright	Susugi Ningyokan
 * @license		BSD
 **/

// ========================================================
// 定数定義
// ========================================================
define('COMMON_DATE_FORMAT', 'Y-m-d H:i:s');

// データ種別
define('COLUMN_ATTRIBUTE_INT', 1);
define('COLUMN_ATTRIBUTE_STRING', 2);
define('COLUMN_ATTRIBUTE_DATETIME', 3);

// 挿入するデータのタイプ(詳細はsetting_sampleディレクトリを参照)
define('DATA_TYPE_RANGE', 1);		// 1～100までの範囲内の値
define('DATA_TYPE_LIST', 2);		// array(1, 10, 20)のいずれかの値
define('DATA_TYPE_NUMBER', 3);		// 1000から1ずつカウントアップして順に使う

// ========================================================
// 関数
// ========================================================

/**
 * SQLを実行する
 * @param	PDO			$db				PDOインスタンス
 * @param	string		$sql_str		SQL文字列
 * @param	array		$sql_param		SQLパラメータ
 */
function execSQL($db, $sql_str, $sql_param)
{
	// SQLを実行
	$stmt = $db->prepare($sql_str);
	$stmt->execute($sql_param);
}

/**
 * 挿入用のデータを生成する
 * @param	array		$table_define		テーブル定義配列
 */
function generateRowData($table_define)
{
	static $number_arr = array();
	
	$row_data = array();
	foreach ($table_define as $key => $val) {
		$data = null;
		switch ($val['attr']) {
			case COLUMN_ATTRIBUTE_INT:
				switch ($val['type'])  {
				case DATA_TYPE_RANGE:
					$data = mt_rand($val['min'], $val['max']);
					break;
				case DATA_TYPE_LIST:
					$rand_key = array_rand($val['list']);
					$data = $val['list'][$rand_key];
					break;
				case DATA_TYPE_NUMBER:
					if (!isset($number_arr[$key])) {
						$number_arr[$key] = $val['start_num'];
					} else {
						if (isset($val['inc_num'])) {
							$number_arr[$key] += $val['inc_num'];
						} else {
							$number_arr[$key]++;
						}
					}
					$data = $number_arr[$key];
					break;
				default:
					$data = 0;
					break;
				}
				break;
			case COLUMN_ATTRIBUTE_STRING:
				switch ($val['type'])  {
				case DATA_TYPE_NUMBER:
					if (!isset($number_arr[$key])) {
						$number_arr[$key] = $val['start_num'];
					} else {
						if (isset($val['inc_num'])) {
							$number_arr[$key] += $val['inc_num'];
						} else {
							$number_arr[$key]++;
						}
					}
					if (isset($val['prefix'])) {
						$data = $val['prefix'] . $number_arr[$key];
					} else {
						$data = '' . $number_arr[$key];
					}
					break;
				default:
					$data = '';
					break;
				}
				break;
			case COLUMN_ATTRIBUTE_DATETIME:
				switch ($val['type'])  {
				case DATA_TYPE_RANGE:
					$diff = mt_rand($val['min'], $val['max']);
					$data = date(COMMON_DATE_FORMAT, time() - $diff);
					break;
				case DATA_TYPE_NUMBER:
					if (!isset($number_arr[$key])) {
						$number_arr[$key] = $val['start_num'];
					} else {
						if (isset($val['inc_num'])) {
							$number_arr[$key] += $val['inc_num'];
						} else {
							$number_arr[$key]++;
						}
					}
					$data = date(COMMON_DATE_FORMAT, $number_arr[$key]);
					break;
				default:
					$data = date(COMMON_DATE_FORMAT, time());
					break;
				}
				break;
			}
		$row_data[] = $data;
	}
	
	return $row_data;
}




