<body>
  <section class="content col-md-12">
    <div class="col-md-12">
      <p>
        <p>
          <a class="btn btn-raised btn-info" href="../../app/doctors/index.php" role="button" aria-expanded="false" href="index.php">Menu</a>
          <a class="btn btn-raised btn-info btn-center" type="button" data-toggle="collapse" data-target="#patient" aria-expanded="false" aria-controls="patient">FARMACIAS</a>
        </p>
        <div class="collapse show" id="patient">
          <div class="card-body">
            <div class="card-primary collapsed-card">
              <div class="card-body">
                <a type="button" class="btn btn-raised btn-primary" href="../../app/doctors/index.php" ><i class="fad fa-2x fa-arrow-square-left"></i></a>&nbsp;&nbsp;
                <div class="row">

                  <div class="col-sm-6">
                    <input class="form-control" name="SearchMed" id="SearchMed" type="text" style="text-transform:uppercase;" placeholder="Escriba el dato a buscar">
                  </div>
                  <div>
                    <a type="button" class="btn btn-info" onclick="fntDibujoTablaMedFar() "><i class="fad fa-2x fa-search"></i></a>
                  </div>
                </div>
              </div>



              <input type="hidden" class="form-control" id="filterMed" name="filterMed">
              <input type="hidden" class="form-control" id="filterMedImg" name="filterMedImg">
              <input type="hidden" class="form-control" id="filterMedImgPro" name="filterMedImgPro">
              <div id="tableMedFar" name="tableMedFar">
                <!-- DIBUJO DE TABLA -->
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