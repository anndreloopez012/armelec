<?php

$mensaje="";

if(isset($_POST['btnAccion'])){
    switch($_POST['btnAccion']){
        case 'agregar':
            if(is_numeric(openssl_decrypt( $_POST['ctg_far_nomcom'],COD,KEY))){
                $ctg_far_nomcom=openssl_decrypt( $_POST['ctg_far_nomcom'],COD,KEY);
                $mensaje.="ctg_far_nomcom ".$ctg_far_nomcom;
              }else{
                  $mensaje.="UPPSS...... ctg_far_nomcom INCORRECTO".$ID."</br>";
                }

            if(is_string(openssl_decrypt( $_POST['ctg_fap_nomcom'],COD,KEY))){
              $ctg_fap_nomcom=openssl_decrypt( $_POST['ctg_fap_nomcom'],COD,KEY);
              $mensaje.="ctg_fap_nomcom ".$ctg_fap_nomcom;
              }else{
                  $mensaje.="UPPSS...... ctg_fap_nomcom INCORRECTO"."</br>"; break;}

            if(is_numeric(openssl_decrypt( $_POST['ctg_far_dir'],COD,KEY))){
              $ctg_far_dir=openssl_decrypt( $_POST['ctg_far_dir'],COD,KEY);
              $mensaje.="ctg_far_dir ".$ctg_far_dir;
              }else{
                  $mensaje.="UPPSS...... ctg_far_dir INCORRECTO"."</br>"; break;}

            if(is_string(openssl_decrypt( $_POST['ctg_far_zona'],COD,KEY))){
              $ctg_far_zona=openssl_decrypt( $_POST['ctg_far_zona'],COD,KEY);
              $mensaje.="ctg_far_zona ".$ctg_far_zona;
              }else{
                  $mensaje.="UPPSS...... ctg_far_zona INCORRECTO"."</br>"; break;}
                  
            if(is_string(openssl_decrypt( $_POST['ctg_fap_pre'],COD,KEY))){
              $ctg_fap_pre=openssl_decrypt( $_POST['ctg_fap_pre'],COD,KEY);
              $mensaje.="ctg_fap_pre ".$ctg_fap_pre;
              }else{
                  $mensaje.="UPPSS...... ctg_fap_pre INCORRECTO"."</br>"; break;}

            if(is_numeric(openssl_decrypt( $_POST['cantidad'],COD,KEY))){
              $cantidad=openssl_decrypt( $_POST['cantidad'],COD,KEY);
              $mensaje.="cantidad ".$CANTIDAD;
              }else{
                  $mensaje.="UPPSS...... cantidad INCORRECTO"."</br>"; break;}

              if(!isset($_SESSION['CARRITO'])){
                $producto=array(
                  'ctg_far_nomcom'=>$ctg_far_nomcom,
                  'ctg_fap_nomcom'=>$ctg_fap_nomcom,
                  'ctg_far_dir'=>$ctg_far_dir,
                  'ctg_far_zona'=>$ctg_far_zona,
                  'ctg_fap_pre'=>$ctg_fap_pre,
                  'cantidad'=>$cantidad
                );
                $_SESSION['CARRITO'][0]=$producto;
                $mensaje= "Producto agregado al carrito";

              }else{

                $idProductos=array_column($_SESSION['CARRITO'],"ID");

                if(in_array($ID,$idProductos)){
                  echo "<script> alert('El producto ya a sido seleccionado..')</script>";
                  $mensaje= "";
                }else{
                $NumeroProductos=count($_SESSION['CARRITO']);
                $producto=array(
                  'ctg_far_nomcom'=>$ctg_far_nomcom,
                  'ctg_fap_nomcom'=>$ctg_fap_nomcom,
                  'ctg_far_dir'=>$ctg_far_dir,
                  'ctg_far_zona'=>$ctg_far_zona,
                  'ctg_fap_pre'=>$ctg_fap_pre,
                  'cantidad'=>$cantidad
                );
                $_SESSION['CARRITO'][$NumeroProductos]=$producto;
                $mensaje= "Producto agregado al carrito";
                }
              }

              //$mensaje= print_r($_SESSION,true);
              
              
              
        break;

        case "eliminar";
            if(is_numeric(openssl_decrypt( $_POST['id'],COD,KEY))){
                $ID=openssl_decrypt( $_POST['id'],COD,KEY);

                foreach($_SESSION['CARRITO'] as $indice=>$producto){
                  if($producto['ctg_far_nomcom']==$ctg_far_nomcom){
                      unset($_SESSION['CARRITO'][$indice]);
                  }

                }

            }else{
                $mensaje.="UPPSS...... ctg_far_nomcom INCORRECTO";
              }
        break;
    }
}

?>