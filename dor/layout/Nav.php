<nav class="navbar navbar-expand-lg navbar-dark bg-info">
  <img src="../../lib/dist/img/vmo_log_<?php echo $pais ?>.png" alt="logo" class="rounded mx-auto d-block" alt="Responsive image">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
      </li>
    </ul>
    <ul class="nav justify-content-center">
      <div class="col-12 center">
        <b class="navbar-brand center" href="#"><?php echo $tittle ?></b>
      </div><br>
      <div class="col-12 center">
        <?php $NombreUsuarioNav = isset($_SESSION['nombre_completo']) ? $_SESSION['nombre_completo']  : 'USUARIO'; ?>

        <b class="navbar-brand center" href="#"><?php echo $NombreUsuarioNav ?></b>
      </div>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item d-none d-sm-inline-block">
      <li class="nav-item d-none d-sm-inline-block">
        <a data-toggle="modal" data-target="#menbresiaModal" class="nav-link"><b>Membresia</b></a>
      </li>
      <a data-toggle="modal" data-target="#contactoModal" class="nav-link"><b>Contacto</b></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="https://www.visualmed.online/gut/guias/" target="_blank" class="nav-link"><b>Ayuda</b></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo $exit; ?>" class="nav-link"><b>Salir<b></a>
      </li>
    </ul>
  </div>
</nav>

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

<div class="modal fade" id="menbresiaModal" tabindex="-1" role="dialog" aria-labelledby="menbresiaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="menbresiaModalLabel">INFORMACION DE TU MEMBRESIA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <h1 class="col-sm-5 col-form-label">Fecha De Inicio</h1>
            <div class="col-sm-4">
              <input type="text" readonly class="form-control" id="staticEmail" value="<?php echo substr($ctg_mem_fec,0,10); ?> "disabled>
            </div>
            <h1 class="col-sm-5 col-form-label">Fecha De Vencimiento</h1>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="inputPassword" value="<?php echo substr($ctg_mem_fec_venc,0,10); ?>" disabled>
            </div>
            <h1 class="col-sm-5 col-form-label">Tipo De Menbresia</h1>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="inputPassword" value="<?php echo $ctg_mem_formpag; ?>" disabled>
            </div>
            <h1 class="col-sm-5 col-form-label">Valor Membresia</h1>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="inputPassword" value="<?php echo $ctg_mem_valor; ?>" disabled>
            </div>
            <h1 class="col-sm-5 col-form-label">Cuotas Pagadas</h1>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="inputPassword"value="<?php echo $ctg_mem_ccacuotas; ?>" disabled>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
    height: 700px;
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

  .center {
    text-align: center !important;
  }
</style>