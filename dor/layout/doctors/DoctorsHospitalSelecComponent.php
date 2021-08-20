<body>
<section class="content col-md-12">
  <div class="col-md-12">
      <p><p>
        <a class="btn btn-raised btn-info"  href="../../app/doctors/index.php" role="button" aria-expanded="false" href="index.php">Menu</a>
        <a class="btn btn-raised btn-info btn-center"  type="button" data-toggle="collapse" data-target="#patient" aria-expanded="false" aria-controls="patient">LABORATORIOS</a>
        </p>
        <div class="collapse show" id="patient">
            <div class="card card-body">
                <div class="card card-primary collapsed-card">
                    <div class="card-body">
                        <table id="tableHosp" class="table table-bordered table-striped table-hover table-sm">
                            <thead>
                            <tr  class="table-info">
                                <th>Nombre Del Hospital</th>
                                <th>Direccion</th>
                                <th>Telefono</th>
                                <th>Servicio</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if ( is_array($arrTableLab) && ( count($arrTableLab)>0 ) ){
                                        reset($arrTableLab);
                                    foreach( $arrTableLab as $rTMP['key'] => $rTMP['value'] ){
                                ?> 
                                    <tr>
                                        <td><?php echo  $rTMP["value"]['ctg_hos_nomcom']; ?></td>
                                        <td><?php echo  $rTMP["value"]['ctg_hos_dir']; ?></td>
                                        <td><?php echo  $rTMP["value"]['ctg_hos_tels']; ?></td>
                                        <td><?php echo  $rTMP["value"]['ctg_hos_descrip']; ?></td>
                                    </tr>
                                <?PHP
                                    }
                                        }
                                ?>     
                            </tbody>
                        </table>
                        <table id="tableHosp" class="table table-bordered table-striped table-hover table-sm">
                            <thead>
                            <tr  class="table-info">
                                <th>Nombre Del Hospital</th>
                                <th>Servicio</th>
                                <th>Precio</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                               
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    
                                </tr>
                               
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div> 
        </div>
    </div> 
    
</section>

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