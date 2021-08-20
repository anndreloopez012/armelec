<?php

$mensajeMed = "";


if (isset($_POST['btnAccionMed'])) {
  switch ($_POST['btnAccionMed']) {
    case 'agregarMed':
      if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
        $ID = openssl_decrypt($_POST['id'], COD, KEY);
        $mensajeMed .= "OK ES CORRECTO ID " . $ID. "</br>";
      } else {
        $mensajeMed .= "UPPSS...... ID INCORRECTO" . $ID . "</br>";
      }

      if (is_string(openssl_decrypt($_POST['ctg_fap_nomcom'], COD, KEY))) {
        $CTG_FAP_NOMCOM = openssl_decrypt($_POST['ctg_fap_nomcom'], COD, KEY);
        $mensajeMed .= "OK ES CORRECTO CTG_FAP_NOMCOM " . $CTG_FAP_NOMCOM. "</br>";
      } else {
        $mensajeMed .= "UPPSS...... CTG_FAP_NOMCOM INCORRECTO" . "</br>";
        break;
      }

      if (is_string(openssl_decrypt($_POST['ctg_far_nomcom'], COD, KEY))) {
        $CTG_FAR_NOMCOM = openssl_decrypt($_POST['ctg_far_nomcom'], COD, KEY);
        $mensajeMed .= "OK ES CORRECTO CTG_FAR_NOMCOM " . $CTG_FAR_NOMCOM. "</br>";
      } else {
        $mensajeMed .= "UPPSS...... CTG_FAR_NOMCOM INCORRECTO" . "</br>";
        break;
      }

      if (is_string(openssl_decrypt($_POST['ctg_fap_contrato'], COD, KEY))) {
        $CTG_FAP_CONTRATO = openssl_decrypt($_POST['ctg_fap_contrato'], COD, KEY);
        $mensajeMed .= "OK ES CORRECTO CTG_FAP_CONTRATO " . $CTG_FAP_CONTRATO. "</br>";
      } else {
        $mensajeMed .= "UPPSS...... CTG_FAP_CONTRATO INCORRECTO" . "</br>";
        break;
      }

      if (is_string(openssl_decrypt($_POST['ctg_far_code'], COD, KEY))) {
        $CTG_FAR_CODE = openssl_decrypt($_POST['ctg_far_code'], COD, KEY);
        $mensajeMed .= "OK ES CORRECTO CTG_FAR_CODE " . $CTG_FAR_CODE. "</br>";
      } else {
        $mensajeMed .= "UPPSS...... CTG_FAR_CODE INCORRECTO" . "</br>";
        break;
      }

      if (is_string(openssl_decrypt($_POST['ctg_fap_pre'], COD, KEY))) {
        $CTG_FAP_PRE = openssl_decrypt($_POST['ctg_fap_pre'], COD, KEY);
        $mensajeMed .= "OK ES CORRECTO CTG_FAP_PRE " . $CTG_FAP_PRE. "</br>";
      } else {
        $mensajeMed .= "UPPSS...... CTG_FAP_PRE INCORRECTO" . "</br>";
        break;
      }

      if (is_string(openssl_decrypt($_POST['ctg_fap_pro'], COD, KEY))) {
        $CTG_FAP_PRO = openssl_decrypt($_POST['ctg_fap_pro'], COD, KEY);
        $mensajeMed .= "OK ES CORRECTO CTG_FAP_PRO " . $CTG_FAP_PRO. "</br>";
      } else {
        $mensajeMed .= "UPPSS...... CTG_FAP_PRO INCORRECTO" . "</br>";
        break;
      }

      if (is_numeric(openssl_decrypt($_POST['cantidad'], COD, KEY))) {
        $CANTIDAD = openssl_decrypt($_POST['cantidad'], COD, KEY);
        $mensajeMed .= "OK ES CORRECTO CANTIDAD " . $CANTIDAD. "</br>";
      } else {
        $mensajeMed .= "UPPSS...... CANTIDAD INCORRECTO" . "</br>";
        break;
      }



      if (!isset($_SESSION['CARRITOMED'])) {
        $producto = array(
          'ID' => $ID,
          'CTG_FAP_NOMCOM' => $CTG_FAP_NOMCOM,
          'CTG_FAR_NOMCOM' => $CTG_FAR_NOMCOM,
          'CTG_FAP_CONTRATO' => $CTG_FAP_CONTRATO,
          'CTG_FAR_CODE' => $CTG_FAR_CODE,
          'CTG_FAP_PRE' => $CTG_FAP_PRE,
          'CTG_FAP_PRO' => $CTG_FAP_PRO,
          'CANTIDAD' => $CANTIDAD
        );
        $_SESSION['CARRITOMED'][0] = $producto;
        $mensajeMed = "Producto agregado al CARRITOMED";
      } else {

        $idProductos = array_column($_SESSION['CARRITOMED'], "ID");

        if (in_array($ID, $idProductos)) {
          echo "<script> alert('El producto ya a sido seleccionado..')</script>";
          $mensajeMed = "";
        } else {
          $NumeroProductos = count($_SESSION['CARRITOMED']);
          $producto = array(
            'ID' => $ID,
            'CTG_FAP_NOMCOM' => $CTG_FAP_NOMCOM,
            'CTG_FAR_NOMCOM' => $CTG_FAR_NOMCOM,
            'CTG_FAP_CONTRATO' => $CTG_FAP_CONTRATO,
            'CTG_FAR_CODE' => $CTG_FAR_CODE,
            'CTG_FAP_PRE' => $CTG_FAP_PRE,
            'CTG_FAP_PRO' => $CTG_FAP_PRO,
            'CANTIDAD' => $CANTIDAD
          );
          $_SESSION['CARRITOMED'][$NumeroProductos] = $producto;
          $mensajeMed = "Producto agregado al CARRITOMED";
        }
      }

      //$mensajeMed= print_r($_SESSION,true);
      break;

    case "eliminarMed";
      if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
        $ID = openssl_decrypt($_POST['id'], COD, KEY);

        foreach ($_SESSION['CARRITOMED'] as $indice => $producto) {
          if ($producto['ID'] == $ID) {
            unset($_SESSION['CARRITOMED'][$indice]);
          }
        }
      } else {
        $mensajeMed .= "UPPSS...... ID INCORRECTO";
      }
      break;
  }
}
