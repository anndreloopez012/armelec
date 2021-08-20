<body>
<section class="content col-md-12">
  <div class="col-md-12">
      <p><p>
        <a class="btn btn-raised btn-info"  href="../../app/doctors/index.php" role="button" aria-expanded="false" href="index.php">Home</a>
        <a class="btn btn-raised btn-info"  href="../../app/doctors/doctorsQuery.php" role="button" aria-expanded="false" href="index.php">Regresar</a>
        <a class="btn btn-raised btn-info btn-center"  type="button" data-toggle="collapse" data-target="#patient" aria-expanded="false" aria-controls="patient">Medicamentos</a>
      <?php if($mensaje!=""){ ?>
      <?PHP echo $mensaje; ?>
        <a class="btn btn-raised btn-info btn-center"  type="button" data-toggle="collapse" data-target="#shop" aria-expanded="false" aria-controls="shop">VER CARRITO</a>
      <?php } ?>
        </p>
        <div class="collapse show" id="patient">
            <div class="card card-body">
                <div class="card card-primary collapsed-card">
                    <div class="card-body">
                        <table id="tableHosp" class="table table-bordered table-striped table-hover table-sm">
                            <thead>
                            <tr  class="table-info">
                                <th>No. de Registro</th>
                                <th>Nombre</th>
                                <th>Principio Activo</th>
                                <th>Ficha Tecnica</th>
                                <th>Vence</th>
                                <th>Comprar</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if ( is_array($arrTableMed) && ( count($arrTableMed)>0 ) ){
                                        reset($arrTableMed);
                                    foreach( $arrTableMed as $rTMP['key'] => $rTMP['value'] ){
                                ?> 
                                    <tr>
                                        <td><?php echo  $rTMP["value"]['ctg_pro_cod']; ?></td>
                                        <td><?php echo  $rTMP["value"]['ctg_pro_desc']; ?></td>
                                        <td><?php echo  $rTMP["value"]['ctg_pro_prinact']; ?></td>
                                        <td><?php echo  $rTMP["value"]['ctg_pro_indi']; ?></td>
                                        <td><?php echo  $rTMP["value"]['ctg_pro_fecven']; ?></td>
                                        <td><a class="btn btn-raised btn-info btn-center" data-toggle="modal" data-target="#basicExampleModal" ><i class="fad fa-user-minus"></i></a></td>
                                    </tr>
                                <?PHP
                                    }
                                        }
                                ?>     
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> 
        </div>
        
        <?php if(!empty($_SESSION['CARRITO'])){ ?> 
        <div class="collapse" id="shop">
            <div class="card card-body">
                <div class="card card-primary collapsed-card">
                    <div class="card-body">
                    <table id="tableShop" class="table table-bordered table-striped table-hover table-sm">
                      <thead>
                        <tr  class="table-info">
                            <th>Farmacia</th>
                            <th>Medicamento</th>
                            <th>Direccion</th>
                            <th>Zona</th>
                            <th>Precio</th>
                            <th>Agregar</th>
                        </tr>
                      </thead>
                      <tbody>
                            <?php foreach($_SESSION['CARRITO'] as $indice=>$producto){ ?>
                              <tr>
                                  <td><?php echo $producto['ctg_far_nomcom'] ?></td>
                                  <td><?php echo $producto['ctg_fap_nomcom'] ?></td>
                                  <td><?php echo $producto['ctg_far_dir'] ?></td>
                                  <td><?php echo $producto['ctg_far_zona'] ?></td>
                                  <td><?php echo $producto['ctg_fap_pre'] ?></td>
                               
                                  <td><form action="" method="post">
                                      <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt( $producto['ID'],COD,KEY);  ?>">
                                        <button class="btn btn-danger" name="btnAccion" value="eliminar" type="submit"><i class="fas fa-ban"></i></button>
                                      </form>
                                  </td>
                              </tr>
                            <?php }?>    
                      </tbody>
                  </table>
                  <?php }else{ ?>
                      <div class="alert alert-success">
                        No hay productos en el carrito  
                      </div>
                  <?php } ?>
                    </div>
                </div>
            </div> 
        </div>
    </div> 
    
</section>


<!-- Modal -->
<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="myModalLabel">Farmacias</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table id="tableFar" class="table table-bordered table-striped table-hover table-sm">
            <thead>
              <tr  class="table-info">
                  <th>Farmacia</th>
                  <th>Medicamento</th>
                  <th>Direccion</th>
                  <th>Zona</th>
                  <th>Precio</th>
                  <th>Agregar</th>
              </tr>
            </thead>
            <tbody>
                <?php
                    if ( is_array($arrTableFarProduct) && ( count($arrTableFarProduct)>0 ) ){
                        reset($arrTableFarProduct);
                    foreach( $arrTableFarProduct as $rTMP['key'] => $rTMP['value'] ){
                ?> 
                    <form action="" method="post">
                      <input type="hidden" name="ctg_far_nomcom" id="ctg_far_nomcom" value="<?php echo  openssl_encrypt( $rTMP["value"]['ctg_far_nomcom'],COD,KEY); ?>">
                      <input type="hidden" name="ctg_fap_nomcom" id="ctg_fap_nomcom" value="<?php echo  openssl_encrypt( $rTMP["value"]['ctg_fap_nomcom'],COD,KEY); ?>">
                      <input type="hidden" name="ctg_far_dir" id="ctg_far_dir" value="<?php echo  openssl_encrypt( $rTMP["value"]['ctg_far_dir'],COD,KEY); ?>">
                      <input type="hidden" name="ctg_far_zona" id="ctg_far_zona" value="<?php echo  openssl_encrypt( $rTMP["value"]['ctg_far_zona'],COD,KEY); ?>">
                      <input type="hidden" name="ctg_fap_pre" id="ctg_fap_pre" value="<?php echo  openssl_encrypt( $rTMP["value"]['ctg_fap_pre'],COD,KEY); ?>">
                      <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1,COD,KEY); ?>"> 
                    </form>
                    <tr>
                        <td><?php echo  $rTMP["value"]['ctg_far_nomcom']; ?></td>
                        <td><?php echo  $rTMP["value"]['ctg_fap_nomcom']; ?></td>
                        <td><?php echo  $rTMP["value"]['ctg_far_dir']; ?></td>
                        <td><?php echo  $rTMP["value"]['ctg_far_zona']; ?></td>
                        <td><?php echo  $rTMP["value"]['ctg_fap_pre']; ?></td>
                        <td><button class="btn btn-dark btn-responsive btninter centrado" name="btnAccion" value="agregar" type="submit"><i class="fas fa-shipping-fast"></i>Agregar</button></td>
                    </tr>
                  
                <?PHP
                    }
                        }
                ?> 
                   
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="../../lib/plugins/datatables/jquery.dataTables.js"></script>
<script src="../../lib/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<script>
  $(function () {
    $('#tableHosp').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
  $(function () {
    $('#tableFar').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
  $(function () {
    $('#tableShop').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>

<style>
  .color-label{
    color:#03a9f4 !important;
  }
  a.btn-center{
    text-align: center !important;
  }
  .custom-file-control, .form-control, .is-focused .custom-file-control, .is-focused .form-control {
      background-image: linear-gradient(0deg,
                        #03a9f4 2px,rgba(0,150,136,0) 0),linear-gradient(0deg,rgba(0,0,0,.26) 1px,
                        transparent 0) !important;
  }
</style>
</body>