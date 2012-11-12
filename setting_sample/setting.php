<?php

// �ڑ�����f�[�^�x�[�X��
$database = 'test';

// �ڑ�����e�[�u����
$table = 'guruguru_test_tbl';

// �C���T�[�g����f�[�^�̒�`
$table_define = array(
// INT ===================================================
	// 100 ����n�܂���2��������J����
	'id' => array(
		'attr' => COLUMN_ATTRIBUTE_INT,
		'type' => DATA_TYPE_NUMBER,
		'start_num' => 100,
		'inc_num' => 2,
	),
	// 1000�`2000�̊Ԃ̃����_���Ȓl�����J����
	'target_id' => array(
		'attr' => COLUMN_ATTRIBUTE_INT,
		'type' => DATA_TYPE_RANGE,
		'min' => 1000,
		'max' => 2000,
	),
	// 1 or 10 or 20 ��l�Ɏ��J����
	'status' => array(
		'attr' => COLUMN_ATTRIBUTE_INT,
		'type' => DATA_TYPE_LIST,
		'list' => array(1, 10, 20),
	),
// STRING =================================================
	// 200����n�܂�5�������v���t�B�b�N�Xtest_user_����������
	// ex: test_user_200, test_user_205, test_user_210 ....
 	'name' => array(
 		'attr' => COLUMN_ATTRIBUTE_STRING,
 		'type' => DATA_TYPE_NUMBER,
 		'prefix' => 'test_user_',
 		'start_num' => 200,
 		'inc_num' => 5,
 	),
// DATETIME ===============================================
	// 1986�N9��28������n�܂�10�b��������datetime
	'birth' => array(
		'attr' => COLUMN_ATTRIBUTE_DATETIME,
		'type' => DATA_TYPE_NUMBER,
		'start_num' => strtotime('1986-09-28 00:00:00'),
		'inc_num' => 10,
	),
	// 2005�N1��1������2020�N1��1���܂ł̊Ԃ̃����_����datetime
	'marriage' => array(
		'attr' => COLUMN_ATTRIBUTE_DATETIME,
		'type' => DATA_TYPE_RANGE,
		'min' => strtotime('2005-01-01 00:00:00'),
		'max' => strtotime('2020-01-01 00:00:00'),
	),
);

