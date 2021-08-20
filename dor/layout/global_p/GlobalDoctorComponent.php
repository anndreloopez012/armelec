<body>
  <section class="content col-md-12">
    <div class="col-md-12">
      <p>
        <p>
          <a class="btn btn-raised btn-info" href="../../app/patient/index.php" role="button" aria-expanded="false" href="index.php">Menu</a>
          <a class="btn btn-raised btn-info btn-center" type="button" data-toggle="collapse" data-target="#doctor" aria-expanded="false" aria-controls="doctor">MEDICOS</a>
        </p>
        <div class="collapse show" id="doctor">
          <div class="card-body">
            <div class="card-primary collapsed-card">
              <div class="card-body">
                <div class="col-sm-12 row">
                  <div class="col-sm-6">
                    <input class="form-control" name="Search" id="Search" type="text" style="text-transform:uppercase;" placeholder="ESCRIBA EL DATO A BUSCAR">
                  </div>
                  <div>
                    <a type="button" class="btn btn-info" onclick="fntDibujoTabla()"><i class="fad fa-2x fa-search"></i></a>
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
        </div>
    </div>

  </section>

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