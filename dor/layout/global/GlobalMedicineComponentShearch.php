<section class="content col-md-12">
  <p>
    <p>
      <p>
        <p>
        <a class="btn btn-raised btn-info" href="../../app/doctors/index.php" role="button" aria-expanded="false" href="index.php">Menu</a>
          <a class="btn btn-raised btn-info btn-center" onclick="fntMedicament()"><i class="fad fa-2x fa-tablets" style="color: black;"></i>Seleccion de Medicamentos <b></b></a>
        </p>
        <div>
          <?php

          //MEDICAMENTOS
          //print $mensajeMed;
          //print_r($_POST);

          ?>
        </div>
        <!--------------------------------- TABLAS DE PRIMER NIVEL-------------------------------------------------------------------------------->

        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-12 col-md-12 ">
              <div class=" collapse show" id="med">
                <div class="card-body">
                  <div class="card-primary collapsed-card">
                    <div class="card-body " style="display: block;">
                      <div class="div1">

                        <div class="row">
                          <h4 class="modal-title w-100" id="myModalLabel">MEDICINA</h4>
                          <a type="button" class="btn btn-raised btn-primary" href="../../app/doctors/index.php" ><i class="fad fa-2x fa-arrow-square-left"></i></a>&nbsp;&nbsp;


                          <div class="col-sm-6">
                            <input class="form-control" name="SearchMed" id="SearchMed" type="text" style="text-transform:uppercase;" placeholder="Escriba el dato a buscar">
                          </div>
                          <div>
                            <a type="button" class="btn btn-info" onclick="fntDibujoTablaMed() "><i class="fad fa-2x fa-search"></i></a>
                          </div>
                        </div>

                        <?php
                            if($mensajeMed){ 
                          ?>
                          <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong> <?php echo $mensajeMed; ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <?php
                            }
                        ?>

                        <input type="hidden" class="form-control" id="filterMed" name="filterMed">
                        <div id="tableMed" name="tableMed">
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

        <div class="modal fade" id="modalFar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">

                <div class="row">
                  <h4 class="modal-title w-100" id="myModalLabel">FARMACIAS</h4>
                  <div class="col-sm-10">
                    <input class="form-control" name="SearchFar" id="SearchFar" type="text" style="text-transform:uppercase;" placeholder="Escriba el dato a buscar">
                  </div>
                  <div>
                    <a type="button" class="btn btn-info" onclick="fntDibujoTablaMedFar() "><i class="fad fa-2x fa-search"></i></a>
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
                        <div id="tableMedFar" name="tableMedFar">
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
              <div class=" collapse show" id="SessionMedicine">
                <div class="card-body">
                  <div class="card-primary collapsed-card">
                    <div class="card-body " style="display: block;">
                      <div class="div1">
                        <div id="tableMedSession" name="tableMedSession">
                        <h4>ORDENES DE MEDICAMENTOS</h4>
                          <a class="btn btn-raised btn-info btn-center" onclick="fntMedicamentSessionClose()"><i class="fad fa-2x fa-reply"></i></a>
                          <!-- DIBUJO DE TABLA -->
                          <?php if (!empty($_SESSION['CARRITOMED'])) { ?>
                            <table class="table table-bordered table-striped table-hover table-sm">
                              <tbody>
                                <thead>
                                  <tr>
                                    <th width="30%">Medicamento</th>
                                    <th width="30%">Farmacia</th>
                                    <th width="15%" class="text-center">Cantidad</th>
                                    <th width="10%" class="text-center">Precio</th>
                                    <th width="10%" class="text-center">Total</th>
                                    <th width="5%"></th>
                                  </tr>
                                </thead>
                                <?php $total = 0; ?>
                                <?php foreach ($_SESSION['CARRITOMED'] as $indice => $producto) { ?>
                                  <tr>
                                    <td width="30%"><?php echo $producto['CTG_FAP_NOMCOM'] ?></td>
                                    <td width="30%"><?php echo $producto['CTG_FAR_NOMCOM'] ?></td>
                                    <td width="15%" class="text-center"><?php echo $producto['CANTIDAD'] ?></td>
                                    <td width="10%" class="text-center">Q<?php echo $producto['CTG_FAP_PRE'] ?></td>
                                    <td width="10%" class="text-center">Q<?php echo number_format($producto['CTG_FAP_PRE'] * $producto['CANTIDAD'], 2); ?></td>
                                    <td width="5%">


                                      <form action="" method="post">
                                        <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['ID'], COD, KEY);  ?>">

                                        <button class="btn btn-danger" name="btnAccionMed" value="eliminarMed" type="submit"><i class="fad fa-2x fa-ban"></i></button>
                                      </form>
                                    </td>
                                  </tr>
                                  <?php $total = $total + ($producto['CTG_FAP_PRE'] * $producto['CANTIDAD']); ?>
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
                                    <form id="formDataMed" method="POST">
                                      <input id="CTG_FAP_NOMCOM" name="CTG_FAP_NOMCOM" class="form-control" value="<?php echo $producto['CTG_FAP_NOMCOM']; ?>" type="hidden">
                                      <input id="CTG_FAR_NOMCOM" name="CTG_FAR_NOMCOM" class="form-control" value="<?php echo $producto['CTG_FAR_NOMCOM']; ?>" type="hidden">

                                      <input id="CTG_FAP_CONTRATO" name="CTG_FAP_CONTRATO" class="form-control" value="<?php echo $producto['CTG_FAP_CONTRATO']; ?>" type="hidden">
                                      <input id="CTG_FAR_CODE" name="CTG_FAR_CODE" class="form-control" value="<?php echo $producto['CTG_FAR_CODE']; ?>" type="hidden">

                                      <input id="CANTIDAD" name="CANTIDAD" class="form-control" value="<?php echo $producto['CANTIDAD']; ?>" type="hidden">
                                      <input id="CTG_FAP_PRE" name="CTG_FAP_PRE" class="form-control" value="<?php echo $producto['CTG_FAP_PRE']; ?>" type="hidden">
                                      <input id="CTG_TOTAL" name="CTG_TOTAL" class="form-control" value="<?php echo number_format($total, 2); ?>" type="hidden">
                                      
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
                          <button type="button" class="btn btn-raised btn-primary" id="InsertMed" onclick="fntInsertMed()"><i class="fad fa-2x fa-save"></i></button>
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


  document.getElementById('med').style.display = 'block';

  document.getElementById('SessionMedicine').style.display = 'none';
  /////////////////////////////////////////////PRIMER NIVEL///////////////////////////////////////////////

  function fntMedicament() {
    document.getElementById('SessionMedicine').style.display = 'none';
    document.getElementById('sessionVaccine').style.display = 'none';
    document.getElementById('sessionLaboratory').style.display = 'none';
    document.getElementById('sessionHospital').style.display = 'none';

    document.getElementById('personalInfo').style.display = 'none';
    document.getElementById('med').style.display = 'block';
    document.getElementById('vaccine').style.display = 'none';
    document.getElementById('exa').style.display = 'none';
    document.getElementById('serv').style.display = 'none';

    fntDibujoTablaMed()
  }

  /////////////////////////////////////////////MODALES///////////////////////////////////////////////
  function fntModalFar(intParametro) {
    $("#modalFar").modal()

    intParametro = !intParametro ? 0 : intParametro;
    if (intParametro > 0) {
      var strFilterMed = $("#hidFilterMed_" + intParametro).val();
      // alert(strDPI + "                         strDPI");
      $("#filterMed").val(strFilterMed);
    }

    fntDibujoTablaMedFar()

  }


  ///////////////////////////////////////OPEN TABLE SESSION //////////////////////////////////////////////////////////////////////////////////////

  function fntMedicamentSession() {
    document.getElementById('SessionMedicine').style.display = 'block';
    document.getElementById('med').style.display = 'none';
  }

  function fntMedicamentSessionClose() {
    document.getElementById('SessionMedicine').style.display = 'none';
    document.getElementById('med').style.display = 'block';
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