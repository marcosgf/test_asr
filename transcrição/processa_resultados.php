<?php
    /*
     *
     * /media/dados/rnp/videos/rnp/Video_94/chunks/chunk-664.wav	{'alternative': [{'confidence': 0.88060993, 'transcript': 'e aqui também estamos usando também que coisa a combinação cumprimentaram ou se fica'}, {'confidence': 0.90195906, 'transcript': 'e aqui também estamos usando também que coisa a combinação cumprimentaram ou sínica'}, {'confidence': 0.90195906, 'transcript': 'e aqui também estamos usando também que coisa a combinação cumprimentaram ou cínica'}, {'confidence': 0.85903114, 'transcript': 'aqui também estamos usando também que coisa a combinação cumprimentaram ou se fica'}, {'confidence': 0.90195906, 'transcript': 'e aqui também estamos usando também que coisa a combinação cumprimentaram ou fica'}], 'final': True}
    /media/dados/rnp/videos/rnp/Video_94/chunks/chunk-11.wav	{'alternative': [{'confidence': 0.67965347, 'transcript': 'músicas regionais'}, {'confidence': 0.35319778, 'transcript': 'músicas de Sérgio Reis'}, {'confidence': 0.38095239, 'transcript': 'música sincera demais'}, {'confidence': 0.49605495, 'transcript': 'músicas de ninar mais'}, {'confidence': 0.38095239, 'transcript': 'música sincero demais'}], 'final': True}
    /media/dados/rnp/videos/rnp/Video_94/chunks/chunk-442.wav	{'alternative': [{'confidence': 0.41100642, 'transcript': 'menina junto com estrogênio no comprimento'}, {'confidence': 0.18119766, 'transcript': 'é muito como estão hoje ela me complementa'}, {'confidence': 0.3508943, 'transcript': 'menina junto com estrogênio mesmo comprimento'}, {'confidence': 0.17039685, 'transcript': 'é muito quando estão geleia de pimenta'}, {'confidence': 0.16261224, 'transcript': 'é muito quando estão longe ela me complementa'}], 'final': True}
     */
    error_reporting(E_ERROR | E_PARSE);
    $file = file('rnp-videos-0.06.tra');
    for($k=0; $k<sizeof($file); $k++){
        $linha = explode("\t",$file[$k]);
        //descobrir arquivo principal
        $nome = explode('/',$linha[0])[6];
        file_put_contents("videos/$nome",$file[$k], FILE_APPEND);
    }
    $arqs = scandir('videos/',1);
    for($i=0; $i<sizeof($arqs);$i++){
        $file = file("videos/$arqs[$i]");
        for($j = 0 ; $j < sizeof($file) ; $j++){
            $array[(int)explode('-',explode('.',explode('/',explode("\t",$file[$j])[0])[8])[0])[1]] = $file[$j];
        }
        ksort($array);
        //print_r($array);
        foreach($array as $linha){
            /*$chunk = explode('], \'final\': True}',explode('{\'alternative\': [',explode("\t",$linha)[1])[1])[0];
            $chunk = str_replace('}, {','},|{',$chunk);
            $transcript = explode(",|",$chunk);
            $json = str_replace('\'','"',$transcript[0]);
            $obj = json_decode($json);
            $maior_confidence =  $obj->{'confidence'}."\n";
            $trascpt = $obj->{'transcript'}."\n";
            for($m=1;$m<sizeof($transcript);$m++){
                $json = str_replace('\'','"',$transcript[$m]);
                $obj = json_decode($json);
                if((float)$obj->{'confidence'} > (float)$maior_confidence){
                    $maior_confidence =  $obj->{'confidence'}."\n";
                    $trascpt = $obj->{'transcript'}."\n";
                }
            }
            //echo "Maior confidence: $maior_confidence - transcrição: $trascpt \n";
            //echo $chunk."\n";
            $nome = explode("\t",$linha)[0];
            $confidence = explode("\n",$maior_confidence)[0];
            file_put_contents("result","$nome\t$confidence\t$trascpt", FILE_APPEND);
            */
            file_put_contents("result",$linha, FILE_APPEND);
        }

        unset($array);
        unlink("videos/$arqs[$i]");
    }
    /*for($j = 0 ; $j < sizeof($file) ; $j++){
        $array[(int)explode('-',explode('.',explode('/',explode("\t",$file[$j])[0])[8])[0])[1]] = $file[$j];
    }
    ksort($array);
    //print_r($array);
    for($i = 0;$i < sizeof($file);$i++){
        $linha = explode("\t",$file[$i]);
        //descobrir arquivo principal
        $nome = explode('/',$linha[0])[6];

    }*/