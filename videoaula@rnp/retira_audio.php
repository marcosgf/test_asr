<?php
$arqvs = scandir('videos/',1);
for($i=0 ; $i<sizeof($arqvs); $i++){
	$nome = explode(".",$arqvs[$i])[0];
	exec("ffmpeg -i videos/$arqvs[$i] -vn -ac 1 -ab 256k -ar 8000 audios/$nome.wav");
}
