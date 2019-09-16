#!/usr/bin/php
<?php
require 'vendor/autoload.php'; #いつものやつ


$parse_result = parseComandLine();
$fp = choiceInputDataSourceAndFopen($parse_result);

if ($parse_result->options["date"])
{
	print `date`; #バッククォートで外部コマンドを呼び出せる
}

print "start.\n"; # 前処理
while ($line = trim(fgets($fp)) ) # ファイルの1行1行を読んで$line変数に格納.
{

	if ($parse_result->options["pre"]) 
	{ //preオプションがあったときの処理
		$pre = $parse_result->options["pre"];
		print $pre .":". $line."\n";
	}
	else
	{ //デフォルトの処理
		print "input:". $line."\n";
	}

}

print "end.\n"; # 後処理


///////////////以下、関数//////////


function parseComandLine()
{
	
	// オプションパースオブジェクト生成. 引数に入れる配列は、ヘルプ表示時に必要な値.
	$parser = new Console_CommandLine(array(
	    'description' => 'for shizuoka.php',
	    'version'     => '1.0.0'
	));

	// 行頭の文字を変えるためのオプション追加
	$parser->addOption('pre', array(
	    'short_name'  => '-p',
	    'long_name'   => '--prefix',
	    'action'      => 'StoreString',  #引数の形を指定.他にはStoreTrue、StoreIntなどがある.デフォルトはStoreString
	    'description' => 'change prefix .'  #ヘルプ表示用
	));

	// 先頭行にdateコマンドの結果を実行のためのオプション追加
	$parser->addOption('date', array(
	    'short_name'  => '-d',
	    'long_name'   => '--date',
	    'action'      => 'StoreTrue', # オプションがあるかどうかだけで挙動を決めるので、actionはStoreTrue
	    'description' => 'exec date'  #ヘルプ表示用
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
	}
	catch(Exception $e)
	{
		var_dump($e->getMessage());exit;
	}
	return $parse_result;
}


function choiceInputDataSourceAndFopen($parse_result)
{
$fopen_path = $parse_result->args["target_file"] ?? "php://stdin";
	
	$fp = fopen($fopen_path ,"r");

	return $fp;
}