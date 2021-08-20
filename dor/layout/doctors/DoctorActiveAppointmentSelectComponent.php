<body>
<section class="content col-md-12">
  <div class="col-md-12">
      <p><p>
        <a class="btn btn-raised btn-info"  href="index.php" role="button" href="index.php">Menu</a>
        <a class="btn btn-raised btn-info"  href="doctorsPatient.php" role="button" href="index.php">Regresar</a>
        <a class="btn btn-raised btn-info btn-center"  type="button" data-toggle="collapse" data-target="#patient" aria-expanded="false" aria-controls="patient">CITAS</a>
        <a class="btn btn-raised btn-info btn-center"  type="button" data-toggle="collapse" data-target="#cita" aria-expanded="false" aria-controls="cita">ADD</a>
        </p>
        <div class="collapse show" id="patient">
            <div class="card card-body">
                <div class="card card-primary collapsed-card">
                    
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="bmd-form-group bmd-collapse-inline pull-xs-right">
                                    <button class="btn bmd-btn-icon" for="search" data-toggle="collapse" data-target="#collapse-search" aria-expanded="false" aria-controls="collapse-search">
                                    <i class="fad fa-print-search"></i>
                                    </button>  
                                    <span id="collapse-search" class="collapse">
                                        <input class="form-control" type="text" id="search" placeholder="Escribe lo que deseas buscar">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="tableVaccine" class="table table-bordered table-striped table-hover table-sm">
                            <thead>
                            <tr  class="table-info">
                                <th>Fecha</th>
                                <th>Paciente</th>
                                <th>Motivo</th>
                                <th>Estatus</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if ( is_array($arrTableCita) && ( count($arrTableCita)>0 ) ){
                                        reset($arrTableCita);
                                    foreach( $arrTableCita as $rTMP['key'] => $rTMP['value'] ){
                                ?> 
                                    <tr>
                                        <td><?php echo  $rTMP["value"]['med_cit_cita_dt']; ?></td>
                                        <td><?php echo  $rTMP["value"]['med_pac_nom']; ?></td>
                                        <td><?php echo  $rTMP["value"]['med_cit_motivo']; ?></td>
                                        <td><?php echo  $rTMP["value"]['med_cit_estatus']; ?></td>
                                        
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
        <div class=" collapse show" id="cita">
          <div class="card card-body">
            <div class="card card-primary collapsed-card">
                <div class="card-body " style="display: block;">                    
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="exampleInputEmail1" class=" color-label">Fecha</label>
                            <input type="date" class="form-control" id="Fecha" >
                        </div>
                        <div class="form-group col-md-3">
                            <label for="exampleInputEmail1" class="color-label">Nombres</label>
                            <input type="text" class="form-control" id="Nombres" value="<?php echo  $ctg_pac_nombres; ?>">
                            <span class="bmd-help"> Ingresas sus dos nombres</span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="exampleInputEmail1" class="color-label">Apellidos</label>
                            <input type="text" class="form-control" id="Apellidos" value="<?php echo  $ctg_pac_apellidos; ?>">
                            <span class="bmd-help"> Ingresas sus dos apellidos</span>
                        </div>
                        <div class="form-group col-md-2">
                          <label for="exampleSelect1" class="bmd-label-floating color-label">Estado</label>
                            <select class="form-control" id="Estado" value=" ">
                              <option>Select</option>
                              <option>Programada</option>
                              <option>Realizada</option>
                              <option>Cancelada</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                          <label for="exampleTextarea" class="bmd-label-floating color-label">Motivo</label>
                          <textarea class="form-control" id="Motivo" value="" rows="3"></textarea>
                          <span class="bmd-help">Ingresa el motivo de la consulta</span>
                        </div>
                    </div>
                </div>  
            </div>
          </div>
        </div>
    </div> 
    
</section>

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