<section class="content col-md-12">
  <p>
    <p>
      <p>
        <p>
          <a class="btn btn-raised btn-info" role="button" aria-expanded="false" href="index.php">Menu</a>
          <a class="btn btn-raised btn-info" role="button" aria-expanded="false" href="patientPerfilInfo.php">Regresar</a>
          <a class="btn btn-raised btn-info btn-center" type="button" data-toggle="collapse" data-target="#perfil" aria-expanded="false" aria-controls="perfil">Antecedentes</a>

        </p>
        <div class="container-fluid">
          <div class="row">
            <div class=" col-md-2"></div>
            <div class="col-xl-8 col-md-6 ">
              <div class=" collapse show" id="perfil">
                <div class="card card-body">
                  <div class="card card-primary collapsed-card">
                    <div class="card-body " style="display: block;">
                      <div class="row">
                        <form id="formData" method="POST">
                          <div class="col-md-10">
                            <div class="row">
                              <div class="form-group col-md-6">
                                <label for="exampleTextarea" class="bmd-label-floating color-label">Antecedentes mórbidos</label>
                                <textarea class="form-control" id="morbidos" name="morbidos" rows="5"><?php echo  $ctg_pac_ant_morb; ?></textarea>
                                <input class="form-control" type="hidden" id="code" name="code" value="<?php echo  $cod_id; ?>">
                                <span class="bmd-help">Abarca afecciones, traumatismos, operaciones que el paciente ha tenido durante toda su vida. Se acentúan las patologías más notables.</span>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="exampleTextarea" class="bmd-label-floating color-label">Antecedentes familiares</label>
                                <textarea class="form-control" id="familiares" name="familiares" rows="5"><?php echo  $ctg_pac_ant_fami; ?></textarea>
                                <span class="bmd-help">En esta parte se plasman afecciones que presenten o hayan manifestado familiares muy cercanos por la probabilidad de heredarlas..</span>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="exampleTextarea" class="bmd-label-floating color-label">Antecedentes ginecoobstétricos</label>
                                <textarea class="form-control" id="ginecobstetricos" name="ginecobstetricos" rows="5"><?php echo  $ctg_pac_ant_gine; ?></textarea>
                                <span class="bmd-help">Menciona datos sobre embarazo, períodos menstruales, entre otros</span>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="exampleTextarea" class="bmd-label-floating color-label">Inmunizaciones</label>
                                <textarea class="form-control" id="imnunizaciones" name="imnunizaciones" rows="5"><?php echo  $ctg_pac_ant_inmu; ?></textarea>
                                <span class="bmd-help">Dependiendo el cuadro clínico que tenga el paciente puede ser importante abarcar las vacunaciones que le paciente ha obtenido.</span>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="exampleTextarea" class="bmd-label-floating color-label">Hábitos</label>
                                <textarea class="form-control" id="habitos" name="habitos" rows="5"><?php echo  $ctg_pac_ant_habi; ?></textarea>
                                <span class="bmd-help">Bebidas alcohólicas, tabaquismo, uso de drogas, alimentación, etc</span>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="exampleTextarea" class="bmd-label-floating color-label">Antecedentes sociales y personales</label>
                                <textarea class="form-control" id="personales" name="personales" rows="5"><?php echo  $ctg_pac_ant_soci; ?></textarea>
                                <span class="bmd-help">En este punto se estudian temas personales del paciente que facilitan conocerlo mejor. Lo que se quiere es entender y evaluar cómo la enfermedad afecta a la persona y qué ayuda podría llegar a requerir en el ámbito familiar, de su previsión, trabajo, y de sus vínculos interpersonales.</span>
                              </div>
                              <div class="col-md-6 row">
                                <div class="col-md-2">
                                <a type="button" class="btn btn-raised btn-primary" id="return" href="patientPerfilInfo.php"><i class="fad fa-2x fa-arrow-square-left"></i></a>
                                </div>
                                <div class="col-md-2">
                                  <button type="button" class="btn btn-raised btn-primary" id="btnEdit" onclick="fntSelectEdit()"><i class="far fa-2x fa-pen-square"></i></button>
                                  <button type="button" class="btn btn-raised btn-primary" id="btnUpdate" onclick="fntUpdate()"><i class="fad fa-2x fa-save"></i></button>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-md-1 "></div>
          </div>
        </div>
</section>
<script>
  document.getElementById('btnEdit').style.display = 'block';
  document.getElementById('btnUpdate').style.display = 'none';

  $(document).ready(function() {
    $('input,textarea,select,checkbox').attr('readonly', true)
  });

  function fntSelectEdit() {

    document.getElementById('btnEdit').style.display = 'none';
    document.getElementById('btnUpdate').style.display = 'block';

    $('input,textarea,select').attr('readonly', false)

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