◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆
　　　　　ぐるぐるインサート
◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆

■----------------------------■
　　　　　概要
■----------------------------■
指定のテーブルに適当なデータをたくさんインサートするスクリプトです。
テスト用にデータがいっぱい詰まったテーブルが欲しい！という時などにどうぞ。

※あまり良いつくりではないので実行速度は遅いです。




■----------------------------■
　　　　　使い方
■----------------------------■
PDOを使っています。
必ず事前にインストールを済ませてください。

-- マニュアルの表示
$ php guruguru_insert.php -m

-- 設定ファイルmy_setting.phpを元に1000行ずつ100回(なので10万行)インサート
$ php guruguru_insert.php -f my_setting.php -b 1000 -l 100

-- ユーザ名とパスワードを指定
$ php guruguru_insert.php -f my_setting.php -b 1000 -l 100 -u my_user -p my_pass

-- ホストとポートを指定
$ php guruguru_insert.php -f my_setting.php -b 1000 -l 100 -u my_user -p my_pass -h my_host -P 3306

設定ファイルの作り方についてはsetting_sampleディレクトリを参照してください。
guruguru_test_tbl.sql を流すとsetting_sample/setting.phpがそのまま使えるテーブルが
データベースtestに作成されますので、お試しの際はどうぞ。

また、以下のコマンドで指定されたテーブルから設定ファイルのサンプルを生成できます。

-- データベース test の test_tbl の設定ファイルを生成する
$ php guruguru_setting_generate.php test test_tbl > my_setting.php




■----------------------------■
　　　　　作者
■----------------------------■
setsuki とか yukicon とか Yuki Susugi とか名乗ってますが同じ人です。
https://github.com/setsuki
https://twitter.com/yukiconEx



■----------------------------■
　　　　　ライセンス
■----------------------------■
修正BSDライセンスです。
著作権表示さえしてくれれば好きに扱ってくれて構いません。
ただし無保証です。

