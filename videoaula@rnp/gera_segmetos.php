<?php
/**
 * Created by PhpStorm.
 * User: marcos
 * Date: 24/01/17
 * Time: 13:41
 */
error_reporting(E_ERROR | E_PARSE);
$arqvs = scandir("audios/",1);
for($j=0;$j<sizeof($arqvs);$j++){
    exec("python time-example.py 1 audios/$arqvs[$j] > segmentos");
    $json = "";
    $arquivo = file('segmentos');
    $flag = 0;
    $inicio = 0;
    for($i = 0 ; $i < sizeof($arquivo); $i++){
        preg_match_all('/[0-9.]+/',$arquivo[$i],$out,PREG_PATTERN_ORDER);
        if($flag!=1){
            $inicio = $out[0][0];
            $fim = ((float)$out[0][1] - (float)$out[0][0]);
        }
        else {
            $fim = ((float)$out[0][1] - (float)$inicio);
        }
        if($fim >= 10.0){
            $nome = explode(".",$arqvs[$j])[0];
            $segmento = explode(".",$inicio)[0];
            exec("sudo sox audios/$arqvs[$j] chunks/$nome-$segmento.wav trim $inicio $fim");
            //exec("sudo ffmpeg -i $arqvs[$j] -ss $inicio -t $fim chunks/seg-$inicio-$fim.wav");
            //$json = $json . shell_exec('curl -T seg.wav "http://138.121.71.38:8080/client/dynamic/recognize" ');
            //unlink('seg.wav');
            $flag = 0;
        }
        else{
            $flag = 1;
        }
    }
    echo $json;
    unlink('segmentos');
}

