#!/usr/bin/php
<?php
print "start.\n"; # 前処理

//NULL合体演算子.php7からサポート.参考:https://qiita.com/youhey/items/b2d9702650420d0d6536
$fopen_path = $argv[1] ?? "php://stdin";
 
/* // 以下の書き方と同じ挙動.昔ながらの書き方.php5だとこっち
if (array_key_exists(1, $argv))
{
	$fopen_path = $argv[1];
}
else
{
	$fopen_path = "php://stdin";
}
*/

$fp = fopen($fopen_path, "r");


while ($line = trim(fgets($fp)) ) # ファイルの1行1行を読んで$line変数に格納.
{
	print "input:". $line."\n"; # やりたい処理をする
}

print "end.\n"; # 後処理


