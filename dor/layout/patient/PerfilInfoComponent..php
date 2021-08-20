<body>
  <section class="content col-md-12">
    <div class="col-md-12">
      <p>
      <p>
        <a class="btn btn-raised btn-info" role="button" aria-expanded="false" href="index.php">Menu</a>
        <a class="btn btn-raised btn-info" role="button" aria-expanded="false" href="index.php">Regresar</a>
        <a class="btn btn-raised btn-info" role="button" aria-expanded="false" href="patientPerfilInfo.php">Usuario</a>
        <a class="btn btn-raised btn-info btn-center" type="button" data-toggle="modal" data-target="#exampleModal">Fotografia</a>
        <a class="btn btn-raised btn-info" role="button" aria-expanded="false" href="patientPerfilClinical.php">Perfil Clinico</a>
        <a class="btn btn-raised btn-info" role="button" aria-expanded="false" href="patientAntecedent.php">Antecedentes</a>
        <a class="btn btn-raised btn-info" role="button" aria-expanded="false" href="patientPreferredPartners.php">Asociados Preferidos</a>
        <a class="btn btn-raised btn-info" role="button" aria-expanded="false" href="patientCurrentlySupplied.php">Medicamentos Suministrados</a>
        <a class="btn btn-raised btn-info" role="button" aria-expanded="false" href="patientMyDoctors.php">Tus Medicos</a>
      </p>

      <form id="formData" value="POST">
        <div class="col-xl-12 col-md-10 ">
          <div id="newPatient" style="display: block;">
            <div class="card-body">
              <div class="card-primary collapsed-card">
                <div class="card-body ">
                  <div class="row">
                    <div class="form-group col-md-3">
                      <label for="exampleInputEmail1" class=" color-label">No. De Documento Personal</label>
                      <input type="hidden" class="form-control" id="id" name="id">
                      <input type="text" class="form-control" id="DocPersonal" name="DocPersonal" maxlength="13">
                      <input type="hidden" class="form-control" id="Hid_DocPersonal" name="Hid_DocPersonal" maxlength="13">
                      <span class="bmd-help"> Ingresa numero de documento personal </span>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="exampleInputEmail1" class=" color-label">Nombre </label>
                      <input type="text" class="form-control" id="Name" name="Name">
                      <span class="bmd-help"> Ingresas tus dos nombres</span>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="exampleInputEmail1" class=" color-label">Apellido </label>
                      <input type="text" class="form-control" id="LastName" name="LastName">
                      <span class="bmd-help"> Ingresa tus dos apellidos </span>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="exampleSelect1" class=" color-label">Sexo</label>
                      <select class="form-control" id="Sex" name="Sex">
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
                      <input type="hidden" id="hid_region" name="hid_region">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="exampleSelect1" class="bmd-label-floating color-label">Distrito/Municipio </label>
                      <select class="form-control" name="distrito" id="distrito">
                        <!-- DIBUJO DE DROPDOW MUNISIPIO-->
                      </select>
                      <input type="hidden" id="hid_distrito" name="hid_distrito">
                    </div>
                    <div class="form-group col-md-1">
                      <label for="exampleInputEmail1" class=" color-label">Zona </label>
                      <input type="text" class="form-control" id="Zona" name="Zona">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="exampleInputEmail1" class=" color-label">Telefono </label>
                      <input type="text" class="form-control" id="Tell" name="Tell">
                      <span class="bmd-help"> Ingresa tu numero telefonico </span>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="exampleInputEmail1" class=" color-label">Correo </label>
                      <input type="text" class="form-control" id="Mail" name="Mail">
                      <span class="bmd-help"> Ingresa tu correo electronico </span>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleTextarea" class=" color-label">Direccion</label>
                      <textarea class="form-control" id="Adress" name="Adress" rows="3"></textarea>
                      <span class="bmd-help">Ingresa tu direccion exacta </span>
                    </div>
                    <div class="form-group col-md-12">
                      <h6>EN CASO DE EMERGENCIA CONTACTAR A:</h6>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="exampleInputEmail1" class=" color-label">Nombre Completo </label>
                      <input type="text" class="form-control" id="FullName" name="FullName">
                      <span class="bmd-help"> Escriba el nombre completo </span>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="exampleInputEmail1" class=" color-label">Telefono </label>
                      <input type="text" class="form-control" id="Cell" name="Cell">
                      <span class="bmd-help"> Ingresas el numero telefonico</span>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="exampleInputEmail1" class=" color-label">Correo </label>
                      <input type="text" class="form-control" id="Email" name="Email">
                      <span class="bmd-help"> Ingresa el correo electronico </span>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 row">
                  &nbsp;&nbsp;<a type="button" class="btn btn-raised btn-primary" id="return" href="index.php"><i class="fad fa-2x fa-arrow-square-left" aria-hidden="true"></i></a>

                  <div class="col-md-2">

                    <button type="button" class="btn btn-raised btn-primary" id="btnUpdate" onclick="fntUpdate()"><i class="fad fa-2x fa-save"></i></button>
                    <button type="button" class="btn btn-raised btn-primary" id="btnEdit" onclick="fntSelectEdit()"><i class="far fa-2x fa-pen-square"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Fotografia</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div id="divData">
              <div class="row">
                <div class="form-group col-md-3" >
                  <div class="card-body" style="width:650px;">
                    <div class="row " id="form-perfil" >
                      <img src="<?php echo  $ctg_pac_pict; ?>" id="img_path" class="img-responsive" alt="" name="img_path" style="height:400px;width:600px;" class="responsive" >
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
  </section>



  <div id="Tabla_patient_adm" name="Tabla_patient_adm">
    <!-- DIBUJO DE TABLA -->
  </div>


  <script>
    document.getElementById('btnEdit').style.display = 'block';
    document.getElementById('btnUpdate').style.display = 'none';

    $(document).ready(function() {
      $('input,textarea,select').attr('readonly', true)
    });


    function fntSelectEdit() {

      document.getElementById('btnEdit').style.display = 'none';
      document.getElementById('btnUpdate').style.display = 'block';

      $('input,textarea,select').attr('readonly', false)

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
</body>