<section class="content col-md-12">
  <p>
    <p>
      <p>
        <p>
          <a class="btn btn-raised btn-info" href="index.php" role="button" aria-expanded="false" href="index.php">Menu</a>
          <a class="btn btn-raised btn-info" href="doctorsPatient.php" role="button" href="index.php">Regresar</a>
          <a class="btn btn-raised btn-info btn-center" type="button" data-toggle="collapse" data-target="#perfil" aria-expanded="false" aria-controls="perfil">Asociados Preferidos</a>

        </p>
        <div class="container-fluid">
          <div class="row">
            <div class=" col-md-2"></div>
            <div class="col-xl-8 col-md-6 ">
              <div class=" collapse show" id="perfil">
                <div class="card card-body">
                  <div class="card card-primary collapsed-card">
                    <div class="card-body " style="display: block;">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="row">
                            <form id="formData" method="POST">
                              <div class="col-md-12">
                                <div class="row">
                                  <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1" class=" color-label">Farmacia Preferida</label>
                                    <input type="text" class="form-control" id="name_far" value="<?php echo  $ctg_far_nomcom; ?>">
                                    <input class="form-control" type="hidden" id="code" name="code" value="<?php echo  $cod_id; ?>">
                                    <input type="hidden" class="form-control" id="hid_far" name="hid_far" value="<?php echo  $id_farmac; ?>">
                                  </div>
                                  <button type="button" class="btn btn-primary" id="far" data-toggle="modal" data-target="#farmacia"><i class="fad fa-2x fa-clinic-medical"></i></button>

                                  <div class="form-group col-md-12">
                                    <label for="exampleInputEmail1" class=" color-label">Direccion</label>
                                    <input type="email" class="form-control" id="dir_far" value="<?php echo  $ctg_far_dir; ?>">
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1" class=" color-label">Laboratorio Clinico Preferido</label>
                                    <input type="text" class="form-control" id="name_lab" value="<?php echo  $ctg_lab_nomcom; ?>">
                                    <input type="hidden" class="form-control" id="hid_lab" name="hid_lab" value="<?php echo  $id_lab; ?>">
                                  </div>
                                  <button type="button" class="btn btn-primary" id="lab" data-toggle="modal" data-target="#laboratorio"><i class="fad fa-2x fa-microscope"></i></button>

                                  <div class="form-group col-md-12">
                                    <label for="exampleInputEmail1" class=" color-label">Direccion</label>
                                    <input type="email" class="form-control" id="dir_lab" value="<?php echo  $ctg_lab_dir; ?>">
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1" class=" color-label">Hospital Preferido</label>
                                    <input type="text" class="form-control" id="name_hosp" value="<?php echo  $ctg_hos_nomcom; ?>">
                                    <input type="hidden" class="form-control" id="hid_hosp" name="hid_hosp" value="<?php echo  $id_hos; ?>">
                                  </div>
                                  <button type="button" class="btn btn-primary" id="hosp" data-toggle="modal" data-target="#hospital"><i class="fad fa-2x fa-hospital"></i></button>

                                  <div class="form-group col-md-12">
                                    <label for="exampleInputEmail1" class=" color-label">Direccion</label>
                                    <input type="email" class="form-control" id="dir_hosp" value="<?php echo  $ctg_hos_dir; ?>">
                                  </div>
                                </div>
                              </div>
                            </form>
                            <div class="col-md-6 row">
                              <div class="col-md-2">
                              <a type="button" class="btn btn-raised btn-primary" id="return" href="patientPerfilInfo.php"><i class="fad fa-2x fa-arrow-square-left"></i></a>
                              </div>
                              <div class="col-md-2">
                                <button type="button" class="btn btn-raised btn-primary" id="btnEdit" onclick="fntSelectEdit()"><i class="far fa-2x fa-pen-square"></i></button>
                                <button type="button" class="btn btn-raised btn-primary" id="btnUpdate" onclick="fntUpdate()"><i class="fad fa-2x fa-save"></i></button>
                              </div>
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
<!-- Modal -->
<div class="modal fade" id="farmacia"  role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Farmacias</h5>
        <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-sm-12 row">
          <div class="col-sm-6">
            <input class="form-control" name="SearchFar" id="SearchFar" type="text" style="text-transform:uppercase;" placeholder="Buscar Farmacias">
          </div>
          <div>
            <a type="button" class="btn btn-info" onclick="fntDibujoTablaFar() "><i class="fad fa-2x fa-search"></i></a>
          </div>
        </div>
        <div class="card-body">
          <div class="div1">
            <div id="Tabla" name="Tabla">
              <!-- DIBUJO DE TABLA CATEGORIA -->
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="laboratorio"  role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Laboratorios</h5>
        <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-sm-12 row">
          <div class="col-sm-6">
            <input class="form-control" name="SearchLab" id="SearchLab" type="text" style="text-transform:uppercase;" placeholder="Buscar Laboratorios">
          </div>
          <div>
            <a type="button" class="btn btn-info" onclick="fntDibujoTablaLab() "><i class="fad fa-2x fa-search"></i></a>
          </div>
        </div>
        <div class="card-body">
          <div class="div1">
            <div id="TablaTwo" name="TablaTwo">
              <!-- DIBUJO DE TABLA CATEGORIA -->
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="hospital" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="col-sm-12 row">
          <div class="col-sm-6">
            <input class="form-control" name="SearchHosp" id="SearchHosp" type="text" style="text-transform:uppercase;" placeholder="Buscar Hospitales">
          </div>
          <div>
            <a type="button" class="btn btn-info" onclick="fntDibujoTablaHosp() "><i class="fad fa-2x fa-search"></i></a>
          </div>
        </div>
        <div class="card-body">
          <div class="div1">
            <div id="TablaThre" name="TablaThre">
              <!-- DIBUJO DE TABLA CATEGORIA -->
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById('btnEdit').style.display = 'block';
  document.getElementById('btnUpdate').style.display = 'none';

  document.getElementById('far').style.display = 'none';
  document.getElementById('lab').style.display = 'none';
  document.getElementById('hosp').style.display = 'none';

  $(document).ready(function() {
    $('input,textarea,select,checkbox').attr('readonly', true)
  });

  function fntSelectEdit() {

    document.getElementById('btnEdit').style.display = 'none';
    document.getElementById('btnUpdate').style.display = 'block';

    document.getElementById('far').style.display = 'block';
    document.getElementById('lab').style.display = 'block';
    document.getElementById('hosp').style.display = 'block';

    $('input,textarea,select').attr('readonly', false)

  }


  function fntSelectHosp(intParametro) {
    intParametro = !intParametro ? 0 : intParametro;


    if (intParametro > 0) {

      var strId = $("#hidIdHosp_" + intParametro).val();
      var strName = $("#hidNameHosp_" + intParametro).val();
      var strDir = $("#hidDirHosp_" + intParametro).val();

      // alert(strDPI + "                         strDPI");

      $("#hid_hosp").val(strId);
      $("#name_hosp").val(strName);
      $("#dir_hosp").val(strDir);

    }

  }

  function fntSelectLab(intParametro) {
    intParametro = !intParametro ? 0 : intParametro;


    if (intParametro > 0) {

      var strId = $("#hidIdLab_" + intParametro).val();
      var strName = $("#hidNameLab_" + intParametro).val();
      var strDir = $("#hidDirLab_" + intParametro).val();

      // alert(strDPI + "                         strDPI");

      $("#hid_lab").val(strId);
      $("#name_lab").val(strName);
      $("#dir_lab").val(strDir);

    }

  }

  function fntSelectFar(intParametro) {
    intParametro = !intParametro ? 0 : intParametro;


    if (intParametro > 0) {

      var strId = $("#hidIdFar_" + intParametro).val();
      var strName = $("#hidNameFar_" + intParametro).val();
      var strDir = $("#hidDirFar_" + intParametro).val();

      // alert(strDPI + "                         strDPI");

      $("#hid_far").val(strId);
      $("#name_far").val(strName);
      $("#dir_far").val(strDir);

    }

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