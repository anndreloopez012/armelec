<body>
  <section class="content col-md-12">
    <div class="col-md-12">
      <p>
        <p>
          <a class="btn btn-raised btn-info" href="index.php" role="button" aria-expanded="false" href="index.php">Menu</a>
          <a class="btn btn-raised btn-info btn-center" type="button" onclick="fntCitaActiveMostrarOcultar()">CITAS ACTIVAS</a>
         <!-- <a class="btn btn-raised btn-info btn-center" type="button" id="buy" onclick="fntAddCitaMostrarOcultar()"><i class="fad fa-1x fa-user-plus"></i>AGREGAR</a>-->

        </p>
        <div class="collapse show" id="citaActive">
          <div class="card-body">
            <div class="card-primary collapsed-card">

              <div class="card-body">
                <div class="col-sm-12 row">
                &nbsp;&nbsp; <a type="button" class="btn btn-raised btn-primary" id="return" href="index.php"><i class="fad fa-2x fa-arrow-square-left" aria-hidden="true"></i></a>&nbsp;&nbsp;

                  <div class="col-sm-6">
                    <input class="form-control" name="Search" id="Search" type="text" style="text-transform:uppercase;" placeholder="Buscar citas">
                    <input class="form-control" name="idGetPac" id="idGetPac" type="hidden" value="<?php echo $_GET['cod']; ?>">
                  </div>
                  <div>
                    <a type="button" class="btn btn-info" onchange="fntDibujoTabla() "><i class="fad fa-2x fa-search"></i></a>
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
            </div>
          </div>
        </div>
        <div class=" collapse show" id="AddCita">
          <div class="card-body">
            <div class="card-primary collapsed-card">
              <div class="card-body " style="display: block;">
                <form id="formData" method="POST">
                  <div class="row">
                    <div class="form-group col-md-1">
                      <a href=" " data-toggle="modal" data-target="#basicExampleModal"><i class="fad fa-2x fa-search"></i></a>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="Nombres" class="color-label">Nombre Completo</label>
                      <input type="hidden" class="form-control" id="NombresId" name="NombresId">
                      <input type="text" class="form-control" id="Nombres" name="Nombres">
                      <span class="bmd-help"> Ingresas sus dos nombres</span>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="Fecha" class=" color-label">Fecha</label>
                      <input type="hidden" class="form-control" id="id" name="id">
                      <input type="date" value='' class="form-control" id="Fecha" name="Fecha">
                    </div>
                    <div class="form-group col-md-2">
                      <label for="Estado" class=" color-label">Estado</label>
                      <select class="form-control" id="Estado" name="Estado">
                        <option id="0">Select</option>
                        <option value="1">Programada</option>
                        <option value="2">Realizada</option>
                        <option value="3">Cancelada</option>
                      </select>
                    </div>
                    <div class="form-group col-md-12">
                      <label for="Motivo" class=" color-label">Motivo</label>
                      <textarea class="form-control" id="Motivo" rows="3" name="Motivo"></textarea>
                      <span class="bmd-help">Ingresa el motivo de la consulta</span>
                    </div>
                  </div>
                </form>
                <div class="col-4 row">
                <div class="col-2 ">
                  <button type="button" class="btn btn-raised btn-primary" id="btnreturn" onclick="fntCitaActiveMostrarOcultar()"><i class="fad fa-2x fa-arrow-square-left"></i></button>
                </div>
                <div class="col-2">
                  <button type="button" class="btn btn-raised btn-primary" id="btnInsert" onclick="fntInsert()"><i class="fad fa-2x fa-save"></i></button>
                  <button type="button" class="btn btn-raised btn-primary" id="btnUpdate" onclick="fntUpdate()"><i class="fad fa-2x fa-save"></i></button>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
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
          <div class="div1">
            <div id="TablaTwo" name="TablaTwo">
              <!-- DIBUJO DE TABLA CATEGORIA -->
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CERRAR</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    // MOSTRAR Y OCULTAR MODULOS
    document.getElementById('AddCita').style.display = 'none';
    document.getElementById('citaActive').style.display = 'block';
    document.getElementById('btnInsert').style.display = 'block';
    document.getElementById('btnUpdate').style.display = 'none';


    function fntCitaActiveMostrarOcultar() {
      // PACIENTES
      document.getElementById('AddCita').style.display = 'none';

      document.getElementById('btnInsert').style.display = 'block';
      document.getElementById('btnUpdate').style.display = 'none';

      var elemento = document.getElementById('citaActive');
      if (!elemento) {
        return true;
      }
      if (elemento.style.display == "none") {
        elemento.style.display = "block"
      } else {
        elemento.style.display = "none"
      };

      document.getElementById('buy').style.display = 'inline';

      $('input,textarea,select,checkbox').attr('readonly', false)

      return true;
    };

    function fntAddCitaMostrarOcultar() {
      // PACIENTES
      document.getElementById('citaActive').style.display = 'none';

      document.getElementById('btnInsert').style.display = 'block';
      document.getElementById('btnUpdate').style.display = 'none';

      var elemento = document.getElementById('AddCita');
      if (!elemento) {
        return true;
      }
      if (elemento.style.display == "none") {
        elemento.style.display = "block"
      } else {
        elemento.style.display = "none"
      };
      document.getElementById('buy').style.display = 'inline';

      $('input,textarea,select,checkbox').attr('readonly', false)
      
      return true;
    };

    function fntSelectView(intParametro) {
      document.getElementById('AddCita').style.display = 'block';
      document.getElementById('citaActive').style.display = 'none';
      document.getElementById('btnInsert').style.display = 'none';
      document.getElementById('btnUpdate').style.display = 'none';

      document.getElementById('buy').style.display = 'none';

      intParametro = !intParametro ? 0 : intParametro;
      if (intParametro > 0) {

        var strId = $("#med_id_" + intParametro).val();
        var strCitCitaDt = $("#med_cit_cita_dt_" + intParametro).val();
        var strPacNom = $("#med_pac_nom_" + intParametro).val();
        var strPacNomId = $("#med_pac_nom_id" + intParametro).val();
        var strCitMotivo = $("#med_cit_motivo_" + intParametro).val();
        var strCitEstatus = $("#med_cit_estatus_" + intParametro).val();

        // alert(strDPI + "                         strDPI");

        $("#id").val(strId);
        //$("#date").val(strCitCitaDt);
        $("#Fecha").val(strCitCitaDt.substring(0, 10));
        $("#NombresId").val(strPacNomId);
        $("#Nombres").val(strPacNom);
        $("#Estado").val(strCitEstatus);
        $("#Motivo").val(strCitMotivo);

      }

      $('input,textarea,select,checkbox').attr('readonly', true)

    }

    function fntSelectEdit(intParametro) {
      document.getElementById('AddCita').style.display = 'block';
      document.getElementById('citaActive').style.display = 'none';
      document.getElementById('btnInsert').style.display = 'none';
      document.getElementById('btnUpdate').style.display = 'block';

      intParametro = !intParametro ? 0 : intParametro;
      if (intParametro > 0) {

        var strId = $("#med_id_" + intParametro).val();
        var strCitCitaDt = $("#med_cit_cita_dt_" + intParametro).val();
        var strPacNom = $("#med_pac_nom_" + intParametro).val();
        var strPacNomId = $("#med_pac_nom_id" + intParametro).val();
        var strCitMotivo = $("#med_cit_motivo_" + intParametro).val();
        var strCitEstatus = $("#med_cit_estatus_" + intParametro).val();

        // alert(strDPI + "                         strDPI");
        //console.log(strCitCitaDt)
        $("#id").val(strId);
        $("#Fecha").val(strCitCitaDt.substring(0, 10));
        $("#NombresId").val(strPacNomId);
        $("#Nombres").val(strPacNom);
        $("#Estado").val(strCitEstatus);
        $("#Motivo").val(strCitMotivo);
      }

      $('input,textarea,select,checkbox').attr('readonly', false)
    }

    function fntSelectPatient(intParametro) {
      intParametro = !intParametro ? 0 : intParametro;


      if (intParametro > 0) {

        var strId = $("#hidId_" + intParametro).val();
        var strName = $("#hidName_" + intParametro).val();

        // alert(strDPI + "                         strDPI");

        $("#NombresId").val(strId);
        $("#Nombres").val(strName);

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
</body>