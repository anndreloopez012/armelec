<nav class="navbar navbar-expand-lg navbar-dark bg-info">
  <img src="lib/dist/img/Vmo_log_<?php echo $pais ?>.png" alt="logo" class="rounded mx-auto d-block" alt="Responsive image">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
      </li>
    </ul>
    <ul class="nav justify-content-center">
      <b class="navbar-brand" href="#"><?php echo $tittle ?></b>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item d-none d-sm-inline-block">
        <a data-toggle="modal" data-target="#contactoModal" class="nav-link"><b>Contacto</b></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="https://www.visualmed.online/gut/guias/" target="_blank" class="nav-link"><b>Ayuda</b></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo $exit; ?>" class="nav-link"><b>Salir</b></a>
      </li>
    </ul>
  </div>
</nav>
<div id="loading-screen" style="display:none">
  <img src="../../asset/img/gif/spinning-circles.svg">
</div>
<div class="modal fade" id="contactoModal" tabindex="-1" role="dialog" aria-labelledby="contactoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="contactoModalLabel">Contacto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formDataContacto" method="POST">
          <div class="col-12">
            <input type="text" id="ctg_nombre_completo" name="ctg_nombre_completo" class="form-control" placeholder="Nombre">
          </div><br>
          <div class="col-12">
            <input type="text" id="ctg_telefono" name="ctg_telefono" class="form-control" placeholder="Telefono">
          </div><br>
          <div class="col-12">
            <input type="text" id="ctg_correo" name="ctg_correo" class="form-control" placeholder="Correo">
          </div><br>
          <div class="col-12">
            <textarea class="form-control" id="ctg_mensaje" name="ctg_mensaje" rows="3" placeholder="Mensaje"></textarea>
          </div><br>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button onclick="fntInsertUs()" class="btn btn-primary" data-dismiss="modal">Enviar Mensaje</button>
      </div>
    </div>
  </div>
</div>
<style>
  .bg-info {
    background-color:
      #03a9f4 !important;
  }

  #div1 {
    overflow: scroll !important;
    height: 500px !important;
  }

  #div1 table {
    width: 100% !important;
  }

  /* FORMA DE TABLAS APP */
  .tableFixHead {
    overflow-y: auto;
    height: 400px;
  }

  .tableFixHead thead th {
    position: sticky;
    top: 0;
  }

  table {
    border-collapse: collapse;
    width: 100%;
  }

  th,
  td {
    padding: 8px 16px;
  }

  th {
    background: #eee;
  }
</style>
<style>
    #loading-screen {
        background-color: rgba(36, 113, 163 , 0.2);
        height: 100%;
        width: 100%;
        position: fixed;
        z-index: 9999;
        margin-top: 0;
        top: 0;
        text-align: center;
    }

    #loading-screen img {
        width: 200px;
        height: 200px;
        position: relative;
        margin-top: -50px;
        margin-left: -50px;
        top: 50%;
    }
</style>