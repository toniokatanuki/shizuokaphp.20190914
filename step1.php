#!/usr/bin/php
<?php
print "start.\n"; # 前処理

$fp = fopen($argv[1], "r"); # 第一引数に書かれたパス（相対パスでOK）のファイルを開く


while ($line = trim(fgets($fp)) ) # ファイルの1行1行を読んで$line変数に格納
{
	print "input:". $line."\n"; # やりたい処理をする
}

print "end.\n"; # 後処理


