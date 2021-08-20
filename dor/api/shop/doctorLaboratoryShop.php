<?php

$mensaje = "";

if (isset($_POST['btnAccionLab'])) {
  switch ($_POST['btnAccionLab']) {
    case 'agregarLab':
      if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
        $ID = openssl_decrypt($_POST['id'], COD, KEY);
        $mensaje .= "OK ES CORRECTO ID " . $ID. "</br>";
      } else {
        $mensaje .= "UPPSS...... ID INCORRECTO" . $ID . "</br>";
      }

      if (is_string(openssl_decrypt($_POST['ctg_lce_descrip'], COD, KEY))) {
        $CTG_LCE_DESCRIP = openssl_decrypt($_POST['ctg_lce_descrip'], COD, KEY);
        $mensaje .= "OK ES CORRECTO OK ES CORRECTO CTG_LCE_DESCRIP " . $CTG_LCE_DESCRIP. "</br>";
      } else {
        $mensaje .= "UPPSS...... CTG_LCE_DESCRIP INCORRECTO" . "</br>";
        break;
      }

      if (is_string(openssl_decrypt($_POST['ctg_lab_nomcom'], COD, KEY))) {
        $CTG_LAB_NOMCOM = openssl_decrypt($_POST['ctg_lab_nomcom'], COD, KEY);
        $mensaje .= "OK ES CORRECTO CTG_LAB_NOMCOM " . $CTG_LAB_NOMCOM. "</br>";
      } else {
        $mensaje .= "UPPSS...... CTG_LAB_NOMCOM INCORRECTO" . "</br>";
        break;
      }

      if (is_numeric(openssl_decrypt($_POST['ctg_lce_code'], COD, KEY))) {
        $CTG_LCE_CODE = openssl_decrypt($_POST['ctg_lce_code'], COD, KEY);
        $mensaje .= "OK ES CORRECTO CTG_LCE_CODE " . $CTG_LCE_CODE. "</br>";
      } else {
        $mensaje .= "UPPSS...... CTG_LCE_CODE INCORRECTO" . "</br>";
        break;
      }

      if (is_numeric(openssl_decrypt($_POST['ctg_lab_code'], COD, KEY))) {
        $CTG_LAB_CODE = openssl_decrypt($_POST['ctg_lab_code'], COD, KEY);
        $mensaje .= "OK ES CORRECTO CTG_LAB_CODE " . $CTG_LCE_CODE. "</br>";
      } else {
        $mensaje .= "UPPSS...... CTG_LAB_CODE INCORRECTO" . "</br>";
        break;
      }

      if (is_string(openssl_decrypt($_POST['ctg_lce_contrato'], COD, KEY))) {
        $CTG_LCE_CONTRATO = openssl_decrypt($_POST['ctg_lce_contrato'], COD, KEY);
        $mensaje .= "OK ES CORRECTO CTG_LCE_CONTRATO " . $CTG_LCE_CONTRATO. "</br>";
      } else {
        $mensaje .= "UPPSS...... CTG_LCE_CONTRATO INCORRECTO" . "</br>";
        break;
      }

      if (is_string(openssl_decrypt($_POST['ctg_lab_contrato'], COD, KEY))) {
        $CTG_LAB_CONTRATO = openssl_decrypt($_POST['ctg_lab_contrato'], COD, KEY);
        $mensaje .= "OK ES CORRECTO CTG_LAB_CONTRATO " . $CTG_LAB_CONTRATO. "</br>";
      } else {
        $mensaje .= "UPPSS...... CTG_LAB_CONTRATO INCORRECTO" . "</br>";
        break;
      }

      if (is_string(openssl_decrypt($_POST['ctg_lce_pre'], COD, KEY))) {
        $CTG_LCE_PRE = openssl_decrypt($_POST['ctg_lce_pre'], COD, KEY);
        $mensaje .= "OK ES CORRECTO CTG_LCE_PRE " . $CTG_LCE_PRE. "</br>";
      } else {
        $mensaje .= "UPPSS...... CTG_LCE_PRE INCORRECTO" . "</br>";
        break;
      }

      if (is_numeric(openssl_decrypt($_POST['cantidad'], COD, KEY))) {
        $CANTIDAD = openssl_decrypt($_POST['cantidad'], COD, KEY);
        $mensaje .= "OK ES CORRECTO CANTIDAD " . $CANTIDAD. "</br>";
      } else {
        $mensaje .= "UPPSS...... CANTIDAD INCORRECTO" . "</br>";
        break;
      }



      if (!isset($_SESSION['CARRITOLAB'])) {
        $producto = array(
          'ID' => $ID,
          'CTG_LCE_DESCRIP' => $CTG_LCE_DESCRIP,
          'CTG_LAB_NOMCOM' => $CTG_LAB_NOMCOM,
          'CTG_LCE_CODE' => $CTG_LCE_CODE,
          'CTG_LAB_CODE' => $CTG_LAB_CODE,
          'CTG_LCE_CONTRATO' => $CTG_LCE_CONTRATO,
          'CTG_LAB_CONTRATO' => $CTG_LAB_CONTRATO,
          'CTG_LCE_PRE' => $CTG_LCE_PRE,
          'CANTIDAD' => $CANTIDAD
        );
        $_SESSION['CARRITOLAB'][0] = $producto;
        $mensaje = "Producto agregado al CARRITOLAB";
      } else {

        $idProductos = array_column($_SESSION['CARRITOLAB'], "ID");

        if (in_array($ID, $idProductos)) {
          echo "<script> alertify.alert('LABORATORIOS', 'El producto ya a sido seleccionado..')</script>";
          $mensaje = "";
        } else {
          $NumeroProductos = count($_SESSION['CARRITOLAB']);
          $producto = array(
            'ID' => $ID,
            'CTG_LCE_DESCRIP' => $CTG_LCE_DESCRIP,
            'CTG_LAB_NOMCOM' => $CTG_LAB_NOMCOM,
            'CTG_LCE_CODE' => $CTG_LCE_CODE,
            'CTG_LAB_CODE' => $CTG_LAB_CODE,
            'CTG_LCE_CONTRATO' => $CTG_LCE_CONTRATO,
            'CTG_LAB_CONTRATO' => $CTG_LAB_CONTRATO,
            'CTG_LCE_PRE' => $CTG_LCE_PRE,
            'CANTIDAD' => $CANTIDAD
          );
          $_SESSION['CARRITOLAB'][$NumeroProductos] = $producto;
          $mensaje = "Producto agregado al CARRITOLAB";
        }
      }

      //$mensaje= print_r($_SESSION,true);



      break;

    case "eliminarLab";
      if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
        $ID = openssl_decrypt($_POST['id'], COD, KEY);

        foreach ($_SESSION['CARRITOLAB'] as $indice => $producto) {
          if ($producto['ID'] == $ID) {
            unset($_SESSION['CARRITOLAB'][$indice]);
          }
        }
      } else {
        $mensaje .= "UPPSS...... ID INCORRECTO";
      }
      break;
  }
}
