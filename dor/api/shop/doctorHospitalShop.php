<?php

$mensajeHosp = "";

if (isset($_POST['btnAccionHosp'])) {
  switch ($_POST['btnAccionHosp']) {
    case 'agregarHosp':
      if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
        $ID = openssl_decrypt($_POST['id'], COD, KEY);
        $mensajeHosp .= "OK ES CORRECTO ID " . $ID. "</br>";
      } else {
        $mensajeHosp .= "UPPSS...... ID INCORRECTO" . $ID . "</br>";
      }

      if (is_string(openssl_decrypt($_POST['ctg_hpp_descrip'], COD, KEY))) {
        $CTG_HPP_DESCRIP = openssl_decrypt($_POST['ctg_hpp_descrip'], COD, KEY);
        $mensajeHosp .= "OK ES CORRECTO CTG_HPP_DESCRIP " . $CTG_HPP_DESCRIP. "</br>";
      } else {
        $mensajeHosp .= "UPPSS...... CTG_HPP_DESCRIP INCORRECTO" . "</br>";
        break;
      }

      if (is_string(openssl_decrypt($_POST['ctg_hos_nomcom'], COD, KEY))) {
        $CTG_HOS_NOMCOM = openssl_decrypt($_POST['ctg_hos_nomcom'], COD, KEY);
        $mensajeHosp .= "OK ES CORRECTO CTG_HOS_NOMCOM " . $CTG_HOS_NOMCOM. "</br>";
      } else {
        $mensajeHosp .= "UPPSS...... CTG_HOS_NOMCOM INCORRECTO" . "</br>";
        break;
      }

      if (is_string(openssl_decrypt($_POST['ctg_hos_contrato'], COD, KEY))) {
        $CTG_HOS_CONTRATO = openssl_decrypt($_POST['ctg_hos_contrato'], COD, KEY);
        $mensajeHosp .= "OK ES CORRECTO CTG_HOS_CONTRATO " . $CTG_HOS_CONTRATO. "</br>";
      } else {
        $mensajeHosp .= "UPPSS...... CTG_HOS_CONTRATO INCORRECTO" . "</br>";
        break;
      }

      if (is_string(openssl_decrypt($_POST['ctg_hos_code'], COD, KEY))) {
        $CTG_HOS_CODE = openssl_decrypt($_POST['ctg_hos_code'], COD, KEY);
        $mensajeHosp .= "OK ES CORRECTO CTG_HOS_CODE " . $CTG_HOS_CODE. "</br>";
      } else {
        $mensajeHosp .= "UPPSS...... CTG_HOS_CODE INCORRECTO" . "</br>";
        break;
      }

      if (is_string(openssl_decrypt($_POST['ctg_hpp_code'], COD, KEY))) {
        $CTG_HPP_CODE = openssl_decrypt($_POST['ctg_hpp_code'], COD, KEY);
        $mensajeHosp .= "OK ES CORRECTO CTG_HPP_CODE " . $CTG_HPP_CODE. "</br>";
      } else {
        $mensajeHosp .= "UPPSS...... CTG_HPP_CODE INCORRECTO" . "</br>";
        break;
      }

      if (is_string(openssl_decrypt($_POST['ctg_hpp_contrato'], COD, KEY))) {
        $CTG_HPP_CONTRATO = openssl_decrypt($_POST['ctg_hpp_contrato'], COD, KEY);
        $mensajeHosp .= "OK ES CORRECTO CTG_HPP_CONTRATO " . $CTG_HPP_CONTRATO. "</br>";
      } else {
        $mensajeHosp .= "UPPSS...... CTG_HPP_CONTRATO INCORRECTO" . "</br>";
        break;
      }

      if (is_string(openssl_decrypt($_POST['ctg_hpp_pre'], COD, KEY))) {
        $CTG_HPP_PRE = openssl_decrypt($_POST['ctg_hpp_pre'], COD, KEY);
        $mensajeHosp .= "OK ES CORRECTO CTG_HPP_PRE " . $CTG_HPP_PRE. "</br>";
      } else {
        $mensajeHosp .= "UPPSS...... CTG_HPP_PRE INCORRECTO" . "</br>";
        break;
      }

      if (is_numeric(openssl_decrypt($_POST['cantidad'], COD, KEY))) {
        $CANTIDAD = openssl_decrypt($_POST['cantidad'], COD, KEY);
        $mensajeHosp .= "OK ES CORRECTO CANTIDAD " . $CANTIDAD. "</br>";
      } else {
        $mensajeHosp .= "UPPSS...... CANTIDAD INCORRECTO" . "</br>";
        break;
      }



      if (!isset($_SESSION['CARRITOHOSP'])) {
        $producto = array(
          'ID' => $ID,
          'CTG_HPP_DESCRIP' => $CTG_HPP_DESCRIP,
          'CTG_HOS_NOMCOM' => $CTG_HOS_NOMCOM,
          'CTG_HOS_CONTRATO' => $CTG_HOS_CONTRATO,
          'CTG_HPP_CONTRATO' => $CTG_HPP_CONTRATO,
          'CTG_HPP_CODE' => $CTG_HPP_CODE,
          'CTG_HOS_CODE' => $CTG_HOS_CODE,
          'CTG_HPP_PRE' => $CTG_HPP_PRE,
          'CANTIDAD' => $CANTIDAD
        );
        $_SESSION['CARRITOHOSP'][0] = $producto;
        $mensajeHosp = "Producto agregado al CARRITOHOSP";
      } else {

        $idProductos = array_column($_SESSION['CARRITOHOSP'], "ID");

        if (in_array($ID, $idProductos)) {
          echo "<script> alert('El producto ya a sido seleccionado..')</script>";
          $mensajeHosp = "";
        } else {
          $NumeroProductos = count($_SESSION['CARRITOHOSP']);
          $producto = array(
            'ID' => $ID,
            'CTG_HPP_DESCRIP' => $CTG_HPP_DESCRIP,
            'CTG_HOS_NOMCOM' => $CTG_HOS_NOMCOM,
            'CTG_HOS_CONTRATO' => $CTG_HOS_CONTRATO,
            'CTG_HPP_CONTRATO' => $CTG_HPP_CONTRATO,
            'CTG_HPP_CODE' => $CTG_HPP_CODE,
            'CTG_HOS_CODE' => $CTG_HOS_CODE,
            'CTG_HPP_PRE' => $CTG_HPP_PRE,
            'CANTIDAD' => $CANTIDAD
          );
          $_SESSION['CARRITOHOSP'][$NumeroProductos] = $producto;
          $mensajeHosp = "Producto agregado al CARRITOHOSP";
        }
      }

      //$mensajeHosp= print_r($_SESSION,true);
      break;

    case "eliminarHosp";
      if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
        $ID = openssl_decrypt($_POST['id'], COD, KEY);

        foreach ($_SESSION['CARRITOHOSP'] as $indice => $producto) {
          if ($producto['ID'] == $ID) {
            unset($_SESSION['CARRITOHOSP'][$indice]);
          }
        }
      } else {
        $mensajeHosp .= "UPPSS...... ID INCORRECTO";
      }
      break;
  }
}
