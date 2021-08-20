<?php

//textos app

//$mod = 1;
$arrTableVaccineBuy = array();
$var_consulta = "SELECT *
                FROM adm_lenguaje
                WHERE lan = '$lan'
                AND mod = '$mod'";
$sql = pg_query($rmfAdm, $var_consulta);
//print_r( $var_consulta);

while ($rTMP = pg_fetch_assoc($sql)) {

    $arrTableVaccineBuy[$rTMP["id"]]["id"]               = $rTMP["id"];
    $arrTableVaccineBuy[$rTMP["id"]]["codigo"]           = $rTMP["codigo"];
    $arrTableVaccineBuy[$rTMP["id"]]["texto_esp"]            = $rTMP["texto_esp"];
    $arrTableVaccineBuy[$rTMP["id"]]["texto_eng"]            = $rTMP["texto_eng"];
    $arrTableVaccineBuy[$rTMP["id"]]["descrip"]          = $rTMP["descrip"];
    $arrTableVaccineBuy[$rTMP["id"]]["lang"]          = $rTMP["lang"];
}
pg_free_result($sql);

$lan_ = "lan_";
if (is_array($arrTableVaccineBuy) && (count($arrTableVaccineBuy) > 0)) {
    $intContador = 1;
    reset($arrTableVaccineBuy);
    foreach ($arrTableVaccineBuy as $rTMP['key'] => $rTMP['value']) {
        $codigo = $rTMP["value"]['codigo'];

        //$lan_.$intContador =  $rTMP["value"]['texto']; 

        if($rTMP["value"]['lang'] == 1){
            $_SESSION['M_' . $codigo] =  $rTMP["value"]['texto_esp'];
        }else if($rTMP["value"]['lang'] == 2){
            $_SESSION['M_' . $codigo] =  $rTMP["value"]['texto_eng'];
        }

        $_SESSION['logged'] = true;
       
        //print_r($lan_.$intContador);
        //print_r($lan_."1");

        //print_r('<pre>');
        //print_r($_SESSION);
        //print_r('</pre> <br>');

        $intContador++;
    }
}

