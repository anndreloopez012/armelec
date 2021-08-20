<section class="content col-md-12">
    <p>
    <p>
    <p>
    <p>
        <a class="btn btn-raised btn-info" href="index.php" role="button" aria-expanded="false" href="index.php">Menu</a>
        <a class="btn btn-raised btn-info btn-center" type="button" data-toggle="collapse" data-target="#personalInfo" aria-expanded="false" aria-controls="personalInfo">Informacion Personal</a>
        <a class="btn btn-raised btn-info btn-center" type="button" data-toggle="modal" data-target="#exampleModal">Imagen de Perfil</a>
    </p>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-2 col-md-1 "></div>
            <div class="col-xl-8 col-md-10 ">
                <div class=" collapse show" id="personalInfo">
                    <div class="card card-body">
                        <form id="formData" method="POST">
                            <div class="card card-primary collapsed-card">
                                <div class="card-body " style="display: block;">
                                    <div id="divData">
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label for="exampleInputEmail1" class="bmd-label-floating color-label">Nombre Comercial</label>
                                                <input type="text" class="form-control" name="ctg_hos_nomcom_" id="ctg_hos_nomcom_" value="<?php echo  $ctg_hos_nomcom; ?>">
                                                <input type="hidden" class="form-control" name="ctg_hos_nomcom" id="ctg_hos_nomcom" value="<?php echo  $ctg_hos_nomcom; ?>">
                                                <input type="hidden" class="form-control" name="id_reg" id="id_reg" value="<?php echo  $id; ?>">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="exampleInputEmail1" class="bmd-label-floating color-label">Numero de Nit </label>
                                                <input type="text" class="form-control" name="ctg_hos_nit_" id="ctg_hos_nit_" value="<?php echo  $ctg_hos_nit; ?>">
                                                <input type="hidden" class="form-control" name="ctg_hos_nit" id="ctg_hos_nit" value="<?php echo  $ctg_hos_nit; ?>">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="exampleTextarea" class="bmd-label-floating color-label">Direccion</label>
                                                <textarea class="form-control" name="ctg_hos_dir" id="ctg_hos_dir" rows="3"><?php echo  $ctg_hos_dir; ?></textarea>
                                                <span class="bmd-help">Ingresa tu direccion exacta </span>
                                            </div>
                                            <div class="form-group col-md-1">
                                                <label for="exampleTextarea" class="bmd-label-floating color-label">Zona</label>
                                                <input type="text" class="form-control" name="ctg_hos_zona" id="ctg_hos_zona" value="<?php echo  $ctg_hos_zona; ?>">
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="exampleSelect1" class="bmd-label-floating color-label">Región/Departamento</label>
                                                <select class="form-control" name="region" id="region" onchange="fntDibujoDropMun() ">
                                                    <!-- DIBUJO DE DROPDOW DEPARTAMENTO-->
                                                </select>
                                                <input type="hidden" id="hid_region" name="hid_region" value="<?php echo  $ctg_hos_dep; ?>">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="exampleSelect1" class="bmd-label-floating color-label">Distrito/Municipio </label>
                                                <select class="form-control" name="distrito" id="distrito">
                                                    <!-- DIBUJO DE DROPDOW MUNISIPIO-->
                                                </select>
                                                <input type="hidden" id="hid_distrito" name="hid_distrito" value="<?php echo  $ctg_hos_mun; ?>">
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="exampleTextarea" class="bmd-label-floating color-label">Telefono</label>
                                                <input type="text" class="form-control" name="ctg_hos_tels" id="ctg_hos_tels" value="<?php echo  $ctg_hos_tels; ?>">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <h2>INFORMACION DEL ENCARGADO</h2>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="exampleTextarea" class="bmd-label-floating color-label">no.Doc Personal</label>
                                                <input type="text" class="form-control" name="ctg_hos_enc_dpi" id="ctg_hos_enc_dpi" value="<?php echo  $ctg_hos_enc_dpi; ?>">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="exampleTextarea" class="bmd-label-floating color-label">Nombre</label>
                                                <input type="text" class="form-control" name="ctg_hos_enc_nom1" id="ctg_hos_enc_nom1" value="<?php echo  $ctg_hos_enc_nomcom;  ?>">
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="exampleSelect1" class="bmd-label-floating color-label">Sexo</label>
                                                <select class="form-control" name="sexo_" id="sexo_">
                                                    <option value="0">Seleccionar</option>
                                                    <?php
                                                    if (is_array($arrSexos) && (count($arrSexos) > 0)) {
                                                        reset($arrSexos);
                                                        foreach ($arrSexos as $rTMP['key'] => $rTMP['value']) {
                                                            $strSelected = ($ctg_hos_enc_sexo == $rTMP["value"]['ctg_sex_cod']) ? "selected='selected'" : '';
                                                    ?>
                                                            <option <?php print $strSelected; ?> value="<?php echo  $rTMP["value"]['ctg_sex_cod']; ?>"><?php echo  $rTMP["value"]['ctg_sex_desc']; ?></option>
                                                    <?PHP
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-2 row">
                                        <a type="button" class="btn btn-raised btn-primary" id="return" href="index.php"><i class="fad fa-2x fa-arrow-square-left" aria-hidden="true"></i></a>&nbsp;&nbsp;

                                        <button type="button" class="btn btn-raised btn-primary" id="btnUpdate" onclick="fntUpdate()"><i class="fad fa-2x fa-save"></i></button>
                                        <button type="button" class="btn btn-raised btn-primary" id="btnEdit" onclick="fntSelectEdit()"><i class="far fa-2x fa-pen-square"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Fotografia</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="divData">
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <div class="card-body">
                                                            <div class="row " id="form-perfil">
                                                                <img src="<?php echo  $ctg_hos_pict; ?>" id="img_path" class="img-responsive" alt="" name="img_path" style="height:auto;width:100%;" class="responsive">
                                                                <br><br>
                                                                <div class="input-group mb-3">
                                                                    <div class="custom-file">
                                                                        <input type="file" class="custom-file-input" id="path" name="path" value="">
                                                                        <label class="custom-file-label" for="inputGroupFile02">Seleccionar</label>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
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
        $('input,textarea,select').attr('readonly', true)
    });

    function fntSelectEdit() {

        document.getElementById('btnEdit').style.display = 'none';
        document.getElementById('btnUpdate').style.display = 'block';

        $('input,textarea,select').attr('readonly', false)

        document.getElementById("ctg_hos_nomcom_").disabled = true;
        document.getElementById("ctg_hos_nit_").disabled = true;

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