<?php

$mensajeVacc = "";

if (isset($_POST['btnAccionVacc'])) {
  switch ($_POST['btnAccionVacc']) {
    case 'agregarVacc':
      if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
        $ID = openssl_decrypt($_POST['id'], COD, KEY);
        $mensajeVacc .= "OK ES CORRECTO ID " . $ID. "</br>";
      } else {
        $mensajeVacc .= "UPPSS...... ID INCORRECTO" . $ID . "</br>";
      }

      if (is_numeric(openssl_decrypt($_POST['med_vac_id'], COD, KEY))) {
        $MED_VAC_ID = openssl_decrypt($_POST['med_vac_id'], COD, KEY);
        $mensajeVacc .= "OK ES CORRECTO MED_VAC_ID " . $MED_VAC_ID. "</br>";
      } else {
        $mensajeVacc .= "UPPSS...... MED_VAC_ID INCORRECTO" . "</br>";
        break;
      }

      if (is_string(openssl_decrypt($_POST['med_vac_nom'], COD, KEY))) {
        $MED_VAC_NOM = openssl_decrypt($_POST['med_vac_nom'], COD, KEY);
        $mensajeVacc .= "OK ES CORRECTO MED_VAC_NOM " . $MED_VAC_NOM. "</br>";
      } else {
        $mensajeVacc .= "UPPSS...... MED_VAC_NOM INCORRECTO" . "</br>";
        break;
      }

      if (is_string(openssl_decrypt($_POST['med_vac_precio'], COD, KEY))) {
        $MED_VAC_PRECIO = openssl_decrypt($_POST['med_vac_precio'], COD, KEY);
        $mensajeVacc .= "OK ES CORRECTO MED_VAC_PRECIO " . $MED_VAC_PRECIO. "</br>";
      } else {
        $mensajeVacc .= "UPPSS...... MED_VAC_PRECIO INCORRECTO" . "</br>";
        break;
      }

      if (is_numeric(openssl_decrypt($_POST['cantidad'], COD, KEY))) {
        $CANTIDAD = openssl_decrypt($_POST['cantidad'], COD, KEY);
        $mensajeVacc .= "OK ES CORRECTO CANTIDAD " . $CANTIDAD. "</br>";
      } else {
        $mensajeVacc .= "UPPSS...... CANTIDAD INCORRECTO" . "</br>";
        break;
      }



      if (!isset($_SESSION['CARRITOVAC'])) {
        $producto = array(
          'ID' => $ID,
          'MED_VAC_ID' => $MED_VAC_ID,
          'MED_VAC_NOM' => $MED_VAC_NOM,
          'MED_VAC_PRECIO' => $MED_VAC_PRECIO,
          'CANTIDAD' => $CANTIDAD
        );
        $_SESSION['CARRITOVAC'][0] = $producto;
        $mensajeVacc = "Producto agregado al CARRITOVAC";
      } else {

        $idProductos = array_column($_SESSION['CARRITOVAC'], "ID");

        if (in_array($ID, $idProductos)) {
          //echo "<script> alertify.alert('VACUNAS', 'El producto ya a sido seleccionado..')</script>";
          echo "<script> alert('El producto ya a sido seleccionado..')</script>";
          $mensajeVacc = "";
        } else {
          $NumeroProductos = count($_SESSION['CARRITOVAC']);
          $producto = array(
            'ID' => $ID,
            'MED_VAC_ID' => $MED_VAC_ID,
            'MED_VAC_NOM' => $MED_VAC_NOM,
            'MED_VAC_PRECIO' => $MED_VAC_PRECIO,
            'CANTIDAD' => $CANTIDAD
          );
          $_SESSION['CARRITOVAC'][$NumeroProductos] = $producto;
          $mensajeVacc = "Producto agregado al CARRITOVAC";
        }
      }

      //$mensajeVacc= print_r($_SESSION,true);
      break;

    case "eliminarVacc";
      if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
        $ID = openssl_decrypt($_POST['id'], COD, KEY);

        foreach ($_SESSION['CARRITOVAC'] as $indice => $producto) {
          if ($producto['ID'] == $ID) {
            unset($_SESSION['CARRITOVAC'][$indice]);
          }
        }
      } else {
        $mensajeVacc .= "UPPSS...... ID INCORRECTO";
      }
      break;
  }
}
