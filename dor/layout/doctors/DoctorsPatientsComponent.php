<body>
  <section class="content col-md-12">
    <div class="col-md-12">
      <p>
      <p>
        <a class="btn btn-raised btn-info" href="index.php" role="button" aria-expanded="false" href="index.php">Menu</a>
        <a class="btn btn-raised btn-info btn-center" onclick="fntPacienteMostrarOcultar()" id="paciente" type="button">PACIENTES</a>
        <a class="btn btn-raised btn-info btn-center" onclick="fntNuevoMostrarOcultar()" type="button" id="agregar"><i class="fad fa-1x fa-user-plus"></i>AGREGAR</a>

      </p>
      <div id="patient">
        <div class="row">
          <div class=" col-md-1"></div>
          <div class=" col-md-10">
            <div class="card-body">
              <div class="card-primary collapsed-card">
                <div class="card-body">
                  <div class="col-sm-12 row">
                    &nbsp;&nbsp;<a type="button" class="btn btn-raised btn-primary" id="return" href="index.php"><i class="fad fa-2x fa-arrow-square-left" aria-hidden="true"></i></a>&nbsp;&nbsp;

                    <div class="col-sm-6">
                      <input class="form-control" name="Search" id="Search" type="text" style="text-transform:uppercase;" placeholder="ESCRIBA EL DATO A BUSCAR">
                    </div>
                    <div>
                      <a type="button" class="btn btn-info" onclick="fntDibujoTablaPatientMed() "><i class="fad fa-2x fa-search"></i></a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="div1">
                      <div id="Tabla" name="Tabla">
                        <!-- DIBUJO DE TABLA -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class=" col-md-2"></div>
        </div>
      </div>
      <form id="formData" value="POST">
        <div class="col-xl-12 col-md-10 ">
          <div id="newPatient" style="display: none;">
            <div class="card-body">
              <div class="card-primary collapsed-card">
                <div class="card-body ">
                  <div class="row">
                    <div class="form-group col-md-1">
                      <a href=" " data-toggle="modal" id="search" data-target="#basicExampleModal"><i class="fad fa-2x fa-search"></i></a>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="exampleInputEmail1" class=" color-label">No. De Documento Personal </label>
                      <input type="hidden" class="form-control" id="id" name="id">
                      <input type="text" class="form-control" id="DocPersonal" name="DocPersonal" maxlength="13" onblur="fntValDpi()">
                      <input type="hidden" class="form-control" id="DocPersonal_" name="DocPersonal_">
                      <input type="hidden" class="form-control" id="Hid_DocPersonal" name="Hid_DocPersonal">
                      <input type="hidden" class="form-control" id="id_med_pac" name="id_med_pac">
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
                      <input type="email" class="form-control" id="Tell" name="Tell">
                      <span class="bmd-help"> Ingresa tu numero telefonico </span>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="exampleInputEmail1" class=" color-label">Correo </label>
                      <input type="email" class="form-control" id="Mail" name="Mail" onblur="fntValMail()">
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
                      <input type="email" class="form-control" id="FullName" name="FullName">
                      <span class="bmd-help"> Escriba el nombre completo </span>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="exampleInputEmail1" class=" color-label">Telefono </label>
                      <input type="email" class="form-control" id="Cell" name="Cell">
                      <span class="bmd-help"> Ingresas el numero telefonico</span>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="exampleInputEmail1" class=" color-label">Correo </label>
                      <input type="email" class="form-control" id="Email" name="Email">
                      <span class="bmd-help"> Ingresa el correo electronico </span>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 row">
                  <div class="col-md-2">
                    <a type="button" class="btn btn-raised btn-primary" id="return" onclick="fntPacienteMostrarOcultar()"><i class="fad fa-2x fa-arrow-square-left"></i></a>
                  </div>
                  <div class="col-md-2">
                    <button type="button" class="btn btn-raised btn-primary" id="btnInsert" onclick="fntInsert()"><i class="fad fa-2x fa-save"></i></button>
                    <button type="button" class="btn btn-raised btn-primary" id="btnUpdate" onclick="fntUpdate()"><i class="fad fa-2x fa-save"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    </form>
  </section>

  <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title w-100" id="myModalLabel">PACIENTES</h4>
          <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-sm-12 row">
            <div class="col-sm-6">
              <input class="form-control" name="SearchAdm" id="SearchAdm" type="text" style="text-transform:uppercase;" placeholder="ESCRIBA EL DATO A BUSCAR">
            </div>
            <div>
              <a type="button" class="btn btn-info" onclick="fntDibujoTablaPatientAdm()"><i class="fad fa-2x fa-search"></i></a>
            </div>
          </div>

          <div id="Tabla_patient_adm" name="Tabla_patient_adm">
            <!-- DIBUJO DE TABLA -->
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CERRAR</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    function fntSelectPatientAdm(intParametro) {
      intParametro = !intParametro ? 0 : intParametro;

      if (intParametro > 0) {

        var strId = $("#hid_Id_" + intParametro).val();
        var strDPI = $("#hid_Dpi_" + intParametro).val();
        var strCode = $("#hid_Codigo_" + intParametro).val();
        var strName = $("#hid_Name_" + intParametro).val();
        var strLastName = $("#hid_LasName_" + intParametro).val();
        var strSex = $("#hid_Sex_" + intParametro).val();
        var strZona = $("#hid_Zona_" + intParametro).val();
        var strEmailPac = $("#hid_EmailPac_" + intParametro).val();

        var strReg = $("#hid_Reg_" + intParametro).val();
        var strDis = $("#hid_Dis_" + intParametro).val();
        var strCell = $("#hid_Cell_" + intParametro).val();
        var strAdress = $("#hid_Adress_" + intParametro).val();
        var strFullName = $("#hid_FullName_" + intParametro).val();
        var strTell = $("#hid_Tell_" + intParametro).val();
        var strEmail = $("#hid_Email_" + intParametro).val();

        //alert(strId + "                         strId");
        //alert(strDPI + "                         strDPI");
        //alert(strName + "                         strName");
        //alert(strLastName + "                         strLastName");

        $("#id").val(strId);
        $("#DocPersonal").val(strDPI);
        $("#DocPersonal_").val(strDPI);
        $("#Hid_DocPersonal").val(strDPI);
        $("#id_med_pac").val(strCode);
        $("#Name").val(strName);
        $("#LastName").val(strLastName);
        $("#Sex").val(strSex);
        $("#Zona").val(strZona);
        $("#Mail").val(strEmailPac);

        $("#Region").val(strReg);
        $("#hid_region").val(strReg);
        $("#hid_distrito").val(strDis);
        $("#distrito").val(strDis);

        $("#Tell").val(strCell);
        $("#Adress").val(strAdress);
        $("#FullName").val(strFullName);
        $("#Cell").val(strTell);
        $("#Email").val(strEmail);

      }

      fntDibujoDropDep()

    }

    function fntSelectEdit(intParametro) {
      document.getElementById('newPatient').style.display = 'block';
      document.getElementById('patient').style.display = 'none';
      document.getElementById('btnUpdate').style.display = 'block';
      document.getElementById('btnInsert').style.display = 'none';
      document.getElementById('search').style.display = 'none';
      intParametro = !intParametro ? 0 : intParametro;


      if (intParametro > 0) {

        var strId = $("#hidId_" + intParametro).val();
        var strDPI = $("#hidDpi_" + intParametro).val();
        var strName = $("#hidName_" + intParametro).val();
        var strLastName = $("#hidLastName_" + intParametro).val();
        var strSex = $("#hidSex_" + intParametro).val();
        var strReg = $("#hidReg_" + intParametro).val();
        var strDis = $("#hidDis_" + intParametro).val();
        var strCell = $("#hidCell_" + intParametro).val();
        var strAdress = $("#hidAdress_" + intParametro).val();
        var strMail = $("#hidMail_" + intParametro).val();
        var strZona = $("#hid_Zona_" + intParametro).val();

        var strReg = $("#hidDep_" + intParametro).val();
        var strDis = $("#hidMun_" + intParametro).val();

        var strFullName = $("#hidEmerName_" + intParametro).val();
        var strTell = $("#hidEmerCell_" + intParametro).val();
        var strEmail = $("#hidEmerEmail_" + intParametro).val();

         //alert(strZona + "                         strZona");

        $("#id").val(strId);
        $("#DocPersonal").val(strDPI);
        $("#DocPersonal_").val(strDPI);
        $("#Name").val(strName);
        $("#LastName").val(strLastName);
        $("#Sex").val(strSex);
        $("#Tell").val(strCell);
        $("#Adress").val(strAdress);
        $("#Mail").val(strMail);
        $("#Zona").val(strZona);

        $("#hid_region").val(strReg);
        $("#region").val(strReg);
        $("#hid_distrito").val(strDis);
        $("#distrito").val(strDis);

        $("#FullName").val(strFullName);
        $("#Cell").val(strTell);
        $("#Email").val(strEmail);

      }
      document.getElementById("DocPersonal").disabled = true;
      document.getElementById("Mail").disabled = true;
      fntDibujoDropDep()

    }

    function fntSelectView(intParametro) {
      document.getElementById('newPatient').style.display = 'block';
      document.getElementById('patient').style.display = 'none';
      document.getElementById('btnInsert').style.display = 'none';
      document.getElementById('agregar').style.display = 'none';
      document.getElementById('search').style.display = 'none';
      intParametro = !intParametro ? 0 : intParametro;

      if (intParametro > 0) {

        var strId = $("#hidId_" + intParametro).val();
        var strDPI = $("#hidDpi_" + intParametro).val();
        var strName = $("#hidName_" + intParametro).val();
        var strLastName = $("#hidLastName_" + intParametro).val();
        var strSex = $("#hidSex_" + intParametro).val();
        var strReg = $("#hidReg_" + intParametro).val();
        var strDis = $("#hidDis_" + intParametro).val();
        var strCell = $("#hidCell_" + intParametro).val();
        var strAdress = $("#hidAdress_" + intParametro).val();
        var strMail = $("#hidMail_" + intParametro).val();
        var strZona = $("#hid_Zona_" + intParametro).val();

        var strReg = $("#hidDep_" + intParametro).val();
        var strDis = $("#hidMun_" + intParametro).val();

        var strFullName = $("#hidEmerName_" + intParametro).val();
        var strTell = $("#hidEmerCell_" + intParametro).val();
        var strEmail = $("#hidEmerEmail_" + intParametro).val();

        // alert(strDPI + "                         strDPI");

        $("#id").val(strId);
        $("#DocPersonal").val(strDPI);
        $("#DocPersonal_").val(strDPI);
        $("#Name").val(strName);
        $("#LastName").val(strLastName);
        $("#Sex").val(strSex);
        $("#Tell").val(strCell);
        $("#Adress").val(strAdress);
        $("#Mail").val(strMail);
        $("#Zona").val(strZona);

        $("#hid_region").val(strReg);
        $("#region").val(strReg);
        $("#hid_distrito").val(strDis);
        $("#distrito").val(strDis);

        $("#FullName").val(strFullName);
        $("#Cell").val(strTell);
        $("#Email").val(strEmail);

      }

      fntDibujoDropDep()

      $('input,textarea,select').attr('readonly', true)
    }

    // VER Y OCULTAR BOTONES INSERT UPDATE 
    document.getElementById('btnUpdate').style.display = 'none';
    // MOSTRAR Y OCULTAR MODULOS
    document.getElementById('patient').style.display = 'block';
    document.getElementById('newPatient').style.display = 'none';

    function fntNuevoMostrarOcultar() {
      // PACIENTES add
      document.getElementById('patient').style.display = 'none';
      var elemento = document.getElementById('newPatient');
      if (!elemento) {
        return true;
      }
      if (elemento.style.display == "none") {
        elemento.style.display = "block"
      } else {
        elemento.style.display = "none"
      };

      //document.getElementById("DocPersonal").disabled = true;
      return true;
    };

    function fntPacienteMostrarOcultar() {
      document.getElementById('newPatient').style.display = 'none';
      // PACIENTES
      var elemento = document.getElementById('patient');
      if (!elemento) {
        return true;
      }
      if (elemento.style.display == "none") {
        elemento.style.display = "block"
      } else {
        elemento.style.display = "none"
      };

      document.getElementById('agregar').style.display = 'inline';
      document.getElementById('search').style.display = 'block';
      $('#formData')[0].reset();
      $('input,textarea,select').attr('readonly', false)

      //document.getElementById("DocPersonal").disabled = false;
      return true;
    };
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