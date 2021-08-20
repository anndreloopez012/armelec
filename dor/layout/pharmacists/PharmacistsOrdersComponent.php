<body>
  <section class="content col-md-12">
    <div class="col-md-12">
      <p>
      <p>
        <a class="btn btn-raised btn-info" href="index.php" role="button" aria-expanded="false" href="index.php">Menu</a>
        <a class="btn btn-raised btn-info btn-center" id="tab_order" name="tab_order" type="button" onclick="fntOrderMostrarOcultar()">PEDIDOS ONLINE</a>
        <a class="btn btn-raised btn-info btn-center" id="form_order" name="form_order" type="button" onclick="fntOrderFormMostrarOcultar()">PEDIDOS TIENDA</a>
      </p>
      <div class=" " id="order">
        <div class=" card-primary collapsed-card">
          <div class="col-sm-12 row">
            &nbsp;&nbsp; <a type="button" class="btn btn-raised btn-primary" id="return" href="index.php"><i class="fad fa-2x fa-arrow-square-left" aria-hidden="true"></i></a>&nbsp;&nbsp;

            <div class="col-sm-6">
              <input class="form-control" name="Search" id="Search" type="text" style="text-transform:uppercase;" placeholder="ESCRIBA EL DATO A BUSCAR">
            </div>
            <div>
              <a type="button" class="btn btn-info" onclick="fntDibujoTabla() "><i class="fad fa-2x fa-search"></i></a>
            </div>
          </div>
          <form id="formDataPed" method="POST">
            <input type="hidden" class="form-control" id="id_orden" name="id_orden">
          </form>

          <div class="card-body">
            <div class="div1">
              <div id="Tabla" name="Tabla">
                <!-- DIBUJO DE TABLA CATEGORIA PRODUCTO-->
              </div>
            </div>
          </div>
        </div>
      </div>
      <div  id="formOrder">
        <div class="card-primary collapsed-card">
          <div class="card-body">
            <form id="formData" method="POST">
              <div class="form-group col-md-6">
                <label for="exampleInputEmail1" class=" color-label">Nombre Del Paciente</label>
                <input type="text" class="form-control" id="Paciente" name="Paciente">
              </div>

              <div id="TablaCaja" name="TablaCaja">
                <!-- DIBUJO DE TABLA CATEGORIA PRODUCTO-->
              </div>

            </form>
            <div class="col-4 row">
              <div class="col-2 ">
                <button type="button" class="btn btn-raised btn-primary" id="btnreturn" onclick="fntOrderMostrarOcultar()"><i class="fad fa-2x fa-arrow-square-left"></i></button>
              </div>
              <div class="col-2 ">
                <button type="button" class="btn btn-raised btn-primary" id="btnInsert" onclick="fntInsert()"><i class="fad fa-2x fa-save"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>

  <script>
    // MOSTRAR Y OCULTAR MODULOS
    document.getElementById('formOrder').style.display = 'none';
    document.getElementById('order').style.display = 'block';
    document.getElementById('btnInsert').style.display = 'block';


    function fntOrderMostrarOcultar() {
      document.getElementById('formOrder').style.display = 'none';
      document.getElementById('form_order').style.display = 'inline';
      document.getElementById('tab_order').style.display = 'inline';
      var elemento = document.getElementById('order');
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


    function fntOrderFormMostrarOcultar() {

      document.getElementById('order').style.display = 'none';
      document.getElementById('form_order').style.display = 'inline';
      document.getElementById('tab_order').style.display = 'none';
      var elemento = document.getElementById('formOrder');
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