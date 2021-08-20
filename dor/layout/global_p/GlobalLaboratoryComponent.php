<section class="content col-md-12">
  <p>
    <p>
      <p>
        <p>
        <a class="btn btn-raised btn-info" href="../../app/patient/index.php" role="button" aria-expanded="false" href="index.php">Menu</a>
          <a class="btn btn-raised btn-info btn-center" onclick="fntLaboratory()"><i class="fad fa-2x fa-microscope" style="color: black;"></i> Orden de Laboratorios <b><span style="color:black"> (<?php echo (empty($_SESSION['CARRITOLAB'])) ? 0 : count($_SESSION['CARRITOLAB']); ?>) </span></b></a>
        </p>
        <div>
          <?php
          //HOSPITALES
          //print $mensajeHosp;
          //print_r($_POST);

          //MEDICAMENTOS
          //print $mensajeMed;
          //print_r($_POST);

          //VACUNAS
          //print $mensajeVacc;
          //print_r($_POST);

          //LABORATORIOS
          //print $mensaje;
          //print_r($_POST);
          ?>
        </div>

        <!--------------------------------- TABLAS DE PRIMER NIVEL-------------------------------------------------------------------------------->
        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-12 col-md-12 ">
              <div class=" collapse show" id="exa">
                <div class="card-body">
                  <div class="card-primary collapsed-card">
                    <div class="card-body " style="display: block;">
                      <div class="div1">

                        <div class="row">
                          <h4 class="modal-title w-100" id="myModalLabel">EXAMENES</h4>
                          <a class="btn btn-raised btn-info btn-center" onclick="fntLaboratorySession()"><i class="fad fa-2x fa-shopping-cart"></i></a>
                          <div class="col-sm-6">
                            <input class="form-control" name="SearchExa" id="SearchExa" type="text" style="text-transform:uppercase;" placeholder="Escriba el dato a buscar">
                          </div>
                          <div>
                            <a type="button" class="btn btn-info" onclick="fntDibujoTablaLabExa() "><i class="fad fa-2x fa-search"></i></a>
                          </div>
                        </div>

                        <?php
                        if ($mensaje) {
                        ?>
                          <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong> <?php echo $mensaje; ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        <?php
                        }
                        ?>

                        <input type="hidden" class="form-control" id="filterExa" name="filterExa">
                        <div id="tableLabExa" name="tableLabExa">
                          <!-- DIBUJO DE TABLA -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-md-1 "></div>
          </div>
        </div>
        <!--------------------------------- TABLAS DE SEGUNDO NIVEL-------------------------------------------------------------------------------->

        <div class="modal fade" id="modalLab" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">


                <div class="row">
                  <h4 class="modal-title w-100" id="myModalLabel">LABORATORIOS</h4>
                  <div class="col-sm-10">
                    <input class="form-control" name="SearchLab" id="SearchLab" type="text" style="text-transform:uppercase;" placeholder="Escriba el dato a buscar">
                  </div>
                  <div>
                    <a type="button" class="btn btn-info" onclick="fntDibujoTablaLab() "><i class="fad fa-2x fa-search"></i></a>
                  </div>
                </div>

                <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="card-body">
                  <div class="card-primary collapsed-card">
                    <div class="card-body " style="display: block;">
                      <div class="div1">
                        <div id="tableLab" name="tableLab">
                          <!-- DIBUJO DE TABLA -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CERRAR</button>
              </div>
            </div>
          </div>
        </div>

        <!--------------------------------- TABLAS DE SESSION-------------------------------------------------------------------------------->

        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-12 col-md-12 ">
              <div class=" collapse show" id="sessionLaboratory">
                <div class="card-body">
                  <div class="card-primary collapsed-card">
                    <div class="card-body " style="display: block;">
                      <div class="div1">
                        <div id="tableLabExaSession" name="tableLabExaSession">
                          <h4>ORDENES DE LABORATORIO</h4>
                          <a class="btn btn-raised btn-info btn-center" onclick="fntLaboratorySessionClose()"><i class="fad fa-2x fa-reply"></i></a>
                          <!-- DIBUJO DE TABLA -->
                          <?php if (!empty($_SESSION['CARRITOLAB'])) { ?>
                            <table class="table table-bordered table-striped table-hover table-sm">
                              <tbody>
                                <thead>
                                  <tr>
                                    <th width="30%">Servicio</th>
                                    <th width="30%">Laboratorio</th>
                                    <th width="15%" class="text-center">Cantidad</th>
                                    <th width="10%" class="text-center">Precio</th>
                                    <th width="10%" class="text-center">Total</th>
                                    <th width="5%"></th>
                                  </tr>
                                </thead>
                                <?php $total = 0; ?>
                                <?php foreach ($_SESSION['CARRITOLAB'] as $indice => $producto) { ?>
                                  <tr>
                                    <td width="30%"><?php echo $producto['CTG_LCE_DESCRIP'] ?></td>
                                    <td width="30%"><?php echo $producto['CTG_LAB_NOMCOM'] ?></td>
                                    <td width="15%" class="text-center"><?php echo $producto['CANTIDAD'] ?></td>
                                    <td width="10%" class="text-center">Q<?php echo $producto['CTG_LCE_PRE'] ?></td>
                                    <td width="10%" class="text-center">Q<?php echo number_format($producto['CTG_LCE_PRE'] * $producto['CANTIDAD'], 2); ?></td>
                                    <td width="5%">


                                      <form action="" method="post">
                                        <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['ID'], COD, KEY);  ?>">

                                        <button class="btn btn-danger" name="btnAccionLab" value="eliminarLab" type="submit"><i class="fad fa-2x fa-ban"></i></button>
                                      </form>
                                    </td>
                                  </tr>
                                  <?php $total = $total + ($producto['CTG_LCE_PRE'] * $producto['CANTIDAD']); ?>
                                <?php } ?>
                                <tr>
                                  <td colspan="4" aling="right">Total</td>
                                  <td aling="right">
                                    <h4>Q<?php echo number_format($total, 2); ?></h4>
                                  </td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <td colspan="5">
                                    <form id="formDataLab" method="post">
                                      <input id="CTG_LCE_DESCRIP" name="CTG_LCE_DESCRIP" class="form-control" value="<?php echo $producto['CTG_LCE_DESCRIP']; ?>" type="hidden">
                                      <input id="CTG_LAB_NOMCOM" name="CTG_LAB_NOMCOM" class="form-control" value="<?php echo $producto['CTG_LAB_NOMCOM']; ?>" type="hidden">

                                      <input id="CTG_LCE_CONTRATO" name="CTG_LCE_CONTRATO" class="form-control" value="<?php echo $producto['CTG_LCE_CONTRATO']; ?>" type="hidden">
                                      <input id="CTG_LCE_CODE" name="CTG_LCE_CODE" class="form-control" value="<?php echo $producto['CTG_LCE_CODE']; ?>" type="hidden">

                                      <input id="CANTIDAD" name="CANTIDAD" class="form-control" value="<?php echo $producto['CANTIDAD']; ?>" type="hidden">
                                      <input id="CTG_LCE_PRE" name="CTG_LCE_PRE" class="form-control" value="<?php echo $producto['CTG_LCE_PRE']; ?>" type="hidden">
                                      <input id="TOTAL" name="TOTAL" class="form-control" value="<?php echo number_format($total, 2); ?>" type="hidden">
                                    </form>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          <?php } else { ?>
                            <div class="alert alert-success">
                              NO HAY PRODUCTOS SELECCIONADOS
                            </div>
                          <?php } ?>
                          <!--
                          <button type="button" class="btn btn-raised btn-primary" id="InsertLab" onclick="fntInsertLab()"><i class="fad fa-2x fa-save"></i></button>
                          -->

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-md-1 "></div>
          </div>
        </div>
</section>
<script>
  ////////////////////////////////////////////////////////////////////////////////////////////
  document.getElementById('exa').style.display = 'block';
  document.getElementById('sessionLaboratory').style.display = 'none';

  /////////////////////////////////////////////PRIMER NIVEL///////////////////////////////////////////////


  function fntLaboratory(intParametro) {

    document.getElementById('sessionLaboratory').style.display = 'none';
    document.getElementById('exa').style.display = 'block';

    fntDibujoTablaLabExa()
  }

  /////////////////////////////////////////////MODALES///////////////////////////////////////////////


  function fntModalLab(intParametro) {
    $("#modalLab").modal()

    intParametro = !intParametro ? 0 : intParametro;
    if (intParametro > 0) {
      var strFilterExa = $("#hidFilterExa_" + intParametro).val();
      // alert(strDPI + "                         strDPI");
      $("#filterExa").val(strFilterExa);
    }

    fntDibujoTablaLab()

  }

  ///////////////////////////////////////OPEN TABLE SESSION //////////////////////////////////////////////////////////////////////////////////////


  function fntLaboratorySession() {
    document.getElementById('sessionLaboratory').style.display = 'block';
    document.getElementById('exa').style.display = 'none';
  }

  ////////////////////CLOSE TABLE SESSION

  function fntLaboratorySessionClose() {
    document.getElementById('sessionLaboratory').style.display = 'none';
    document.getElementById('exa').style.display = 'block';
  }
</script>

<style>
  .color-label {
    color: #03a9f4 !important;
  }

  a.btn-center {
    text-align: center !important;
  }

  .custom-file-control,
  .form-control,
  .is-focused .custom-file-control,
  .is-focused .form-control {
    background-image: linear-gradient(0deg,
        #03a9f4 2px, rgba(0, 150, 136, 0) 0), linear-gradient(0deg, rgba(0, 0, 0, .26) 1px,
        transparent 0) !important;
  }
</style>