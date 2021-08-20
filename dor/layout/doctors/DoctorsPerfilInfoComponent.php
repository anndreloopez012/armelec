<div id="loading-screen" style="display:none">
  <img src="../../asset/img/gif/spinning-circles.svg">
</div>

<section class="content col-md-12">
  <p>
  <p>
  <p>
  <p>
    <a class="btn btn-raised btn-info" href="index.php" role="button" aria-expanded="false" href="index.php"><?php echo $_SESSION['M_02011001']; ?></a>
    <a class="btn btn-raised btn-info btn-center" type="button" data-toggle="collapse" data-target="#personalInfo" aria-expanded="false" aria-controls="personalInfo">Informacion Personal</a>
    <a class="btn btn-raised btn-info btn-center" type="button" data-toggle="modal" data-target="#exampleModal">Fotografia y Clinica</a>
  </p>
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-2 col-md-1 "></div>
      <div class="col-xl-8 col-md-10 ">
        <div class=" collapse show" id="personalInfo">
          <div class="card card-body">
            <form id="formData" method="POST">
              <div class="card card-primary collapsed-card">
                <div class="card-body " style="display: block;">
                  <div id="divData">
                    <div class="row">
                      <input type="hidden" class="form-control" name="id_p" id="id_p" value="<?php echo  $id_p; ?>">

                      <div class="form-group col-md-4">
                        <label for="exampleInputEmail1" class="bmd-label-floating color-label"><?php echo $_SESSION['M_0202']; ?></label>
                        <input type="text" class="form-control" name="colegiado_" id="colegiado_" value="<?php echo  $colegiado; ?>">
                        <span class="bmd-help"> Ingresa numero de colegiado Activo </span>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="exampleInputEmail1" class="bmd-label-floating color-label">Nombre </label>
                        <input type="text" class="form-control" name="nombre_" id="nombre_" value="<?php echo  $nombre; ?>">
                        <span class="bmd-help"> Ingresas tus dos nombres</span>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="exampleInputEmail1" class="bmd-label-floating color-label">Apellido </label>
                        <input type="text" class="form-control" name="apellido_" id="apellido_" value="<?php echo  $apellido; ?>">
                        <span class="bmd-help"> Ingresa tus dos apellidos </span>
                      </div>
                      <div class="form-group col-md-2">
                        <label for="exampleSelect1" class="bmd-label-floating color-label">Sexo</label>
                        <select class="form-control" name="sexo_" id="sexo_">
                          <option value="0">Seleccionar</option>
                          <?php
                          if (is_array($arrSexos) && (count($arrSexos) > 0)) {
                            reset($arrSexos);
                            foreach ($arrSexos as $rTMP['key'] => $rTMP['value']) {
                              $strSelected = ($sexo == $rTMP["value"]['ctg_sex_cod']) ? "selected='selected'" : '';
                          ?>
                              <option <?php print $strSelected; ?> value="<?php echo  $rTMP["value"]['ctg_sex_cod']; ?>"><?php echo  $rTMP["value"]['ctg_sex_desc']; ?></option>
                          <?PHP
                            }
                          }
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="exampleSelect1" class="bmd-label-floating color-label">Región/Departamento</label>
                        <select class="form-control" name="region" id="region" onchange="fntDibujoDropMun() ">
                          <!-- DIBUJO DE DROPDOW DEPARTAMENTO-->
                        </select>
                        <input type="hidden" id="hid_region" name="hid_region" value="<?php echo  $departamento; ?>">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="exampleSelect1" class="bmd-label-floating color-label">Distrito/Municipio </label>
                        <select class="form-control" name="distrito" id="distrito">
                          <!-- DIBUJO DE DROPDOW MUNISIPIO-->
                        </select>
                        <input type="hidden" id="hid_distrito" name="hid_distrito" value="<?php echo  $municipio; ?>">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="exampleTextarea" class="bmd-label-floating color-label">Direccion</label>
                        <textarea class="form-control" name="direccion_" id="direccion_" rows="3"><?php echo  $direccion; ?></textarea>
                        <span class="bmd-help">Ingresa tu direccion exacta </span>
                      </div>
                      <div class="form-group col-md-1">
                        <label for="exampleTextarea" class="bmd-label-floating color-label">Zona</label>
                        <input type="text" class="form-control" name="zona_" id="zona_" value="<?php echo  $zona; ?>">
                      </div>
                      <div class="form-group col-md-2">
                        <label for="exampleTextarea" class="bmd-label-floating color-label">Telefono</label>
                        <input type="text" class="form-control" name="tell_" id="tell_" value="<?php echo  $telefono; ?>">
                      </div>
                      <div class="form-group col-md-3">
                        <label for="exampleSelect1" class="bmd-label-floating color-label">Especialidad</label>
                        <select class="form-control" name="espec_" id="espec_">
                          <option value="0">Seleccionar</option>
                          <?php
                          if (is_array($arrEspecialidad) && (count($arrEspecialidad) > 0)) {
                            reset($arrEspecialidad);
                            foreach ($arrEspecialidad as $rTMP['key'] => $rTMP['value']) {
                              $strSelected = ($esp == $rTMP["value"]['ctg_esp_cod']) ? "selected='selected'" : ''; //especialidad
                          ?>
                              <option <?php print $strSelected; ?> value="<?php echo  $rTMP["value"]['ctg_esp_cod']; ?>"><?php echo  $rTMP["value"]['ctg_esp_desc']; ?></option>
                          <?PHP
                            }
                          }
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-md-12">
                        <label for="exampleTextarea" class="bmd-label-floating color-label">Informacion Profesional</label>
                        <textarea class="form-control" name="informacion_" id="informacion_" rows="3"><?php echo  $informacion; ?></textarea>
                        <span class="bmd-help">Ingresa Tu Informacion Profesional </span>
                      </div>
                    </div>
                  </div>
                  <div class="col-2 row">
                    <a type="button" class="btn btn-raised btn-primary" id="return" href="index.php"><i class="fad fa-2x fa-arrow-square-left" aria-hidden="true"></i></a>&nbsp;&nbsp;

                    <button type="button" class="btn btn-raised btn-primary" id="btnUpdate" onclick="fntUpdate()"><i class="fad fa-2x fa-save"></i></button>
                    <button type="button" class="btn btn-raised btn-primary" id="btnEdit" onclick="fntSelectEdit()"><i class="far fa-2x fa-pen-square"></i></button>
                  </div>
                </div>
              </div>

              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Fotografia y Clinica</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div id="divData">
                        <div class="row">
                          <div class="form-group col-md-3">
                            <div class="card-body">
                              <div class="row " id="form-img">
                                <label for="exampleInputEmail1" class="bmd-label-floating color-label">Foto de Perfil </label>
                                <img src="<?php echo  $ctg_med_cli_pict; ?>" id="img_path_pre" class="img-responsive" alt="" name="img_path_pre" style="height:auto;width:100%;" class="responsive">
                              </div>

                              <div class="row " id="form-perfil">
                                <img src="<?php echo  $ctg_med_cli_pict; ?>" id="img_path" class="img-responsive" alt="" name="img_path" style="height:auto;width:100%;" class="responsive">
                                <br><br>
                                <div class="input-group mb-3">
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="path" name="path" value="">
                                    <label class="custom-file-label" for="inputGroupFile02">Seleccionar</label>
                                  </div>
                                </div>

                              </div>
                            </div>
                          </div>
                          <hr>

                          <div class="col-9 row">
                            <div class="col-2"></div>
                            <div class="form-group col-md-4">
                              <label class="color-label">Lunes de</label>
                              <input type="time" class="form-control" name="ctg_med_cli_11" id="ctg_med_cli_11" value="<?php echo  $ctg_med_cli_11; ?>">
                            </div>
                            <div class="form-group col-md-4">
                              <label class="color-label">a </label>
                              <input type="time" class="form-control" name="ctg_med_cli_12" id="ctg_med_cli_12" value="<?php echo  $ctg_med_cli_12; ?>">
                            </div>
                            <div class="col-2"></div>

                            <div class="col-2"></div>
                            <div class="form-group col-md-4">
                              <label class="color-label">Martes de</label>
                              <input type="time" class="form-control" name="ctg_med_cli_21" id="ctg_med_cli_21" value="<?php echo  $ctg_med_cli_21; ?>">
                            </div>
                            <div class="form-group col-md-4">
                              <label class="color-label">a </label>
                              <input type="time" class="form-control" name="ctg_med_cli_22" id="ctg_med_cli_22" value="<?php echo  $ctg_med_cli_22; ?>">
                            </div>
                            <div class="col-2"></div>

                            <div class="col-2"></div>
                            <div class="form-group col-md-4">
                              <label class="color-label">Miercoles </label>
                              <input type="time" class="form-control" name="ctg_med_cli_31" id="ctg_med_cli_31" value="<?php echo  $ctg_med_cli_31; ?>">
                            </div>
                            <div class="form-group col-md-4">
                              <label class="color-label">a </label>
                              <input type="time" class="form-control" name="ctg_med_cli_32" id="ctg_med_cli_32" value="<?php echo  $ctg_med_cli_32; ?>">
                            </div>
                            <div class="col-2"></div>

                            <div class="col-2"></div>
                            <div class="form-group col-md-4">
                              <label class="color-label">Jueves </label>
                              <input type="time" class="form-control" name="ctg_med_cli_41" id="ctg_med_cli_41" value="<?php echo  $ctg_med_cli_41; ?>">
                            </div>
                            <div class="form-group col-md-4">
                              <label class="color-label">a </label>
                              <input type="time" class="form-control" name="ctg_med_cli_42" id="ctg_med_cli_42" value="<?php echo  $ctg_med_cli_42; ?>">
                            </div>
                            <div class="col-2"></div>

                            <div class="col-2"></div>
                            <div class="form-group col-md-4">
                              <label class="color-label">Viernes </label>
                              <input type="time" class="form-control" name="ctg_med_cli_51" id="ctg_med_cli_51" value="<?php echo  $ctg_med_cli_51; ?>">
                            </div>
                            <div class="form-group col-md-4">
                              <label class="color-label">a </label>
                              <input type="time" class="form-control" name="ctg_med_cli_52" id="ctg_med_cli_52" value="<?php echo  $ctg_med_cli_52; ?>">
                            </div>
                            <div class="col-2"></div>

                            <div class="col-2"></div>
                            <div class="form-group col-md-4">
                              <label class="color-label">Sabado </label>
                              <input type="time" class="form-control" name="ctg_med_cli_61" id="ctg_med_cli_61" value="<?php echo  $ctg_med_cli_61; ?>">
                            </div>
                            <div class="form-group col-md-4">
                              <label class="color-label">a </label>
                              <input type="time" class="form-control" name="ctg_med_cli_62" id="ctg_med_cli_62" value="<?php echo  $ctg_med_cli_62; ?>">
                            </div>
                            <div class="col-2"></div>
                          </div>
                          <div class="col-12 row">


                            <hr>

                            <div class="form-group col-md-4">
                              <label for="exampleInputEmail1" class="bmd-label-floating color-label">Telefono 1</label>
                              <input type="text" class="form-control" name="ctg_med_cli_tel1" id="ctg_med_cli_tel1" value="<?php echo  $ctg_med_cli_tel1; ?>">
                            </div>
                            <div class="form-group col-md-4">
                              <label for="exampleInputEmail1" class="bmd-label-floating color-label">Telefono 2</label>
                              <input type="text" class="form-control" name="ctg_med_cli_tel2" id="ctg_med_cli_tel2" value="<?php echo  $ctg_med_cli_tel2; ?>">
                            </div>
                            <div class="form-group col-md-4">
                              <label for="exampleInputEmail1" class="bmd-label-floating color-label">Telefono 3</label>
                              <input type="text" class="form-control" name="ctg_med_cli_tel3" id="ctg_med_cli_tel3" value="<?php echo  $ctg_med_cli_tel3; ?>">
                            </div>
                            <div class="form-group col-md-4">
                              <label for="exampleInputEmail1" class="bmd-label-floating color-label">Telefono 4</label>
                              <input type="text" class="form-control" name="ctg_med_cli_tel4" id="ctg_med_cli_tel4" value="<?php echo  $ctg_med_cli_tel4; ?>">
                            </div>
                            <div class="form-group col-md-4">
                              <label for="exampleInputEmail1" class="bmd-label-floating color-label">Telefono 5</label>
                              <input type="text" class="form-control" name="ctg_med_cli_tel5" id="ctg_med_cli_tel5" value="<?php echo  $ctg_med_cli_tel5; ?>">
                            </div>

                            <hr>

                            <div class="form-group col-md-12">
                              <label for="exampleInputEmail1" class="bmd-label-floating color-label">Direccion de la clinica</label>
                              <input type="text" class="form-control" name="ctg_med_cli_dir" id="ctg_med_cli_dir" value="<?php echo  $ctg_med_cli_dir; ?>">
                            </div>
                            <div class="form-group col-md-6">
                              <label for="exampleInputEmail1" class="bmd-label-floating color-label">Correo Electronico</label>
                              <input type="text" class="form-control" name="ctg_med_cli_email" id="ctg_med_cli_email" value="<?php echo  $ctg_med_cli_email; ?>">
                            </div>
                            <div class="form-group col-md-6">
                              <label for="exampleInputEmail1" class="bmd-label-floating color-label">Pagina de Internet</label>
                              <input type="text" class="form-control" name="ctg_med_cli_pweb" id="ctg_med_cli_pweb" value="<?php echo  $ctg_med_cli_pweb; ?>">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-xl-2 col-md-1 "></div>
    </div>
  </div>
</section>

<script>
  document.getElementById('btnEdit').style.display = 'block';
  document.getElementById('btnUpdate').style.display = 'none';
  document.getElementById('form-perfil').style.display = 'none';

  $(document).ready(function() {
    $('input,textarea,select').attr('readonly', true)
  });

  function fntSelectEdit() {

    document.getElementById('btnEdit').style.display = 'none';
    document.getElementById('btnUpdate').style.display = 'block';
    document.getElementById('form-perfil').style.display = 'block';
    document.getElementById('form-img').style.display = 'none';


    $('input,textarea,select').attr('readonly', false)

    document.getElementById("colegiado_").disabled = true;

  }


  //PROCESO DE GUARDADO IMG
</script>
<style>
  .color-label {
    color: #03a9f4 !important;
  }

  /* FOTOGRAFIA */
  .responsive {
    width: 165px;
    height: 235px;
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