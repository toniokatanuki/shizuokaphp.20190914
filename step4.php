#!/usr/bin/php
<?php
require 'vendor/autoload.php'; #いつものやつ

# 順序立てて説明するために、クラスや関数等にはまとめずに書きます


// オプションパースオブジェクト生成. 引数に入れる配列は、ヘルプ表示時に必要な値.
$parser = new Console_CommandLine(array(
    'description' => 'for shizuoka.php',
    'version'     => '1.0.0'
));

// 行頭に日付を入れるためのオプション追加
$parser->addOption('pre', array(
    'short_name'  => '-p',
    'long_name'   => '--prefix',
    'action'      => 'StoreString',  #引数の形を指定.他にはStoreTrue、StoreIntなどがある.デフォルトはStoreString
    'description' => 'add prefix .'  #ヘルプ表示用
));

# 引数を使う旨を定義
$parser->addArgument(
    'target_file',
    array(
        'multiple'    => false, //引数のファイルを複数指定したいときはこの要素をtrueにする。デフォはfalse
        'description' => 'argument file!!!!', #ヘルプ表示時の説明文
		'optional'    => true   //falseにすると引数必須になる.標準入力で受けることができなくなるので今回はtrueに.
    )
);


try
{
	$parse_result = $parser->parse(); #パース実行
	var_dump($parse_result->options); #コマンド中のオプションはこっちに入る
	var_dump($parse_result->args);    #コマンド中の引数はこっちに入る
	
}
catch(Exception $e)
{
	var_dump($e->getMessage());
}
exit;

# step3と違って、Console_Commandlineから取得する必要がある
$fopen_path = $argv[1] ?? "php://stdin";
 
/* 以下の書き方と同じ挙動
if (array_key_exists(1, $argv))
{
	$fopen_path = $argv[1];
}
else
{
	$fopen_path = "php://stdin";
}
*/

$fp = fopen($fopen_path, "r"); # fopenの引数を読み込みストリームにするだけ


while ($line = trim(fgets($fp)) ) # ファイルの1行1行を読んで$line変数に格納.
{
	print "input:". $line."\n"; # やりたい処理をする
}



print "end.\n"; # 後処理


