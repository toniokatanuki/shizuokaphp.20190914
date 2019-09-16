#!/usr/bin/php
<?php
print "start.\n"; # 前処理

$fp = fopen("php://stdin", "r"); # fopenの引数を読み込みストリームにするだけ.step1のち外はここのみ


while ($line = trim(fgets($fp)) ) # ファイルの1行1行を読んで$line変数に格納. fgetsの引数をSTDINにしても書けるけどね
{
	print "input:". $line."\n"; # やりたい処理をする
}

print "end.\n"; # 後処理


