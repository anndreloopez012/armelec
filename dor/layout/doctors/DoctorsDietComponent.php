<body>
  <section class="content col-md-12">
    <div class="col-md-12">
      <p>
        <p>
          <a class="btn btn-raised btn-info" href="index.php" role="button" aria-expanded="false" href="index.php">Menu</a>
          <a class="btn btn-raised btn-info btn-center" id="tab_diet" name="tab_diet" type="button" onclick="fntDietMostrarOcultar()">DIETAS</a>
          <a class="btn btn-raised btn-info btn-center" id="form_diet" name="form_diet" type="button" onclick="fntDietFormMostrarOcultar()">AGREGAR</a>
        </p>
        <div class="collapse show" id="diet">
          <div class="card-body">
            <div class="card-primary collapsed-card">
              <div class="col-sm-12 row">
                &nbsp;&nbsp; <a type="button" class="btn btn-raised btn-primary" id="return" href="index.php"><i class="fad fa-2x fa-arrow-square-left" aria-hidden="true"></i></a>&nbsp;&nbsp;

                <div class="col-sm-6">
                  <input class="form-control" name="Search" id="Search" type="text" style="text-transform:uppercase;" placeholder="ESCRIBA EL DATO A BUSCAR">
                </div>
                <div>
                  <a type="button" class="btn btn-info" onclick="fntDibujoTabla() "><i class="fad fa-2x fa-search"></i></a>
                </div>
              </div>
              <div class="card-body">
                <div class="div1">
                  <div id="Tabla" name="Tabla">
                    <!-- DIBUJO DE TABLA CATEGORIA PRODUCTO-->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="collapse show" id="formDiet">
          <div class="card-body">
            <div class="card-primary collapsed-card">
              <div class="card-body">
                <form id="formData" method="POST">
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1" class=" color-label">Nombre Dieta</label>
                    <input type="hidden" class="form-control" id="idDiet" name="idDiet">
                    <input type="text" class="form-control" id="nombre" name="nombre">
                  </div>
                  <div class="form-group col-md-12">
                    <label for="exampleInputEmail1" class=" color-label">Descripcion</label>
                    <textarea class="form-control" style="background-color: #def;" name="descripcion" id="descripcion" rows="30"></textarea>
                  </div>
                </form>
                <div class="col-4 row">
                  <div class="col-2 ">
                    <button type="button" class="btn btn-raised btn-primary" id="btnreturn" onclick="fntDietMostrarOcultar()"><i class="fad fa-2x fa-arrow-square-left"></i></button>
                  </div>
                  <div class="col-2 ">
                    <button type="button" class="btn btn-raised btn-primary" id="btnInsert" onclick="fntInsert()"><i class="fad fa-2x fa-save"></i></button>
                    <button type="button" class="btn btn-raised btn-primary" id="btnUpdate" onclick="fntUpdate()"><i class="fad fa-2x fa-save"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

  </section>

  <script>
    // MOSTRAR Y OCULTAR MODULOS
    document.getElementById('formDiet').style.display = 'none';
    document.getElementById('diet').style.display = 'block';
    document.getElementById('btnInsert').style.display = 'block';
    document.getElementById('btnUpdate').style.display = 'none';

    function fntSelectView(intParametro) {

      document.getElementById('formDiet').style.display = 'block';
      document.getElementById('diet').style.display = 'none';
      document.getElementById('btnInsert').style.display = 'none';
      document.getElementById('btnUpdate').style.display = 'none';

      document.getElementById('form_diet').style.display = 'none';
      document.getElementById('tab_diet').style.display = 'none';

      intParametro = !intParametro ? 0 : intParametro;

      if (intParametro > 0) {

        var strId = $("#hidId_" + intParametro).val();
        var strName = $("#hidName_" + intParametro).val();
        var strDescrip = $("#hidDescrip_" + intParametro).val();

        //alert(strId + "                         strDPI");
        //alert(strName + "                         strDPI");
        //alert(strDescrip + "                         strDPI");

        $("#idDiet").val(strId);
        $("#nombre").val(strName);
        $("#descripcion").val(strDescrip);

      }

      $('input,textarea,select,checkbox').attr('readonly', true)

    }

    function fntSelectEdit(intParametro) {
      document.getElementById('formDiet').style.display = 'block';
      document.getElementById('diet').style.display = 'none';
      document.getElementById('btnInsert').style.display = 'none';
      document.getElementById('btnUpdate').style.display = 'block';
      document.getElementById('form_diet').style.display = 'none';
      document.getElementById('tab_diet').style.display = 'none';

      intParametro = !intParametro ? 0 : intParametro;

      if (intParametro > 0) {

        var strId = $("#hidId_" + intParametro).val();
        var strName = $("#hidName_" + intParametro).val();
        var strDescrip = $("#hidDescrip_" + intParametro).val();

        //alert(strId + "                         strDPI");
        //alert(strName + "                         strDPI");
        //alert(strDescrip + "                         strDPI");

        $("#idDiet").val(strId);
        $("#nombre").val(strName);
        $("#descripcion").val(strDescrip);
      }

      $('input,textarea,select,checkbox').attr('readonly', false)
    }

    function fntDietMostrarOcultar() {
      document.getElementById('formDiet').style.display = 'none';
      document.getElementById('form_diet').style.display = 'inline';
      document.getElementById('tab_diet').style.display = 'inline';
      var elemento = document.getElementById('diet');
      if (!elemento) {
        return true;
      }
      if (elemento.style.display == "none") {
        elemento.style.display = "block"
      } else {
        elemento.style.display = "none"
      };

      $('#formData')[0].reset();
      $('input,textarea,select,checkbox').attr('readonly', false)

      return true;
    };


    function fntDietFormMostrarOcultar() {

      document.getElementById('diet').style.display = 'none';
      document.getElementById('form_diet').style.display = 'inline';
      document.getElementById('tab_diet').style.display = 'none';
      var elemento = document.getElementById('formDiet');
      if (!elemento) {
        return true;
      }
      if (elemento.style.display == "none") {
        elemento.style.display = "block"
      } else {
        elemento.style.display = "none"
      };

      $('#formData')[0].reset();
      $('input,textarea,select,checkbox').attr('readonly', false)



      return true;
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