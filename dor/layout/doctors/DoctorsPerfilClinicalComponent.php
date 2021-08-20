<section class="content col-md-12">
    <p>
    <p>
    <p>
    <p>
        <a class="btn btn-raised btn-info" href="index.php" role="button" href="index.php">Menu</a>
        <a class="btn btn-raised btn-info" href="doctorsPatient.php" role="button" href="index.php">Regresar</a>
        <a class="btn btn-raised btn-info btn-center" type="button" data-toggle="collapse" data-target="#perfil" aria-expanded="false" aria-controls="perfil">Perfil Clinico</a>

    </p>
    <form id="formData" value="POST">
        <div class="container-fluid">
            <div class="row">
                <div class=" col-md-2"></div>
                <div class="col-xl-10 col-md-6 ">
                    <div class=" collapse show" id="perfil">
                        <div class="card-body">
                            <div class="card-primary collapsed-card">
                                <div class="card-body " style="display: block;">
                                    <div class="row">
                                        <div class="col-md-4">

                                            <?php
                                            $codUrl = $_GET['cod'];
                                            $codUrl =  decrypt($codUrl, $key);
                                            $codUrl = isset($codUrl) ? $codUrl  : '';
                                            ?>
                                            <input type="hidden" class="form-control" id="id_url" name="id_url" value="<?php echo  $codUrl; ?>">

                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <h6>LUGAR DE NACIMIENTO</h6>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="exampleSelect1" class="bmd-label-floating color-label">Región/Departamento</label>
                                                    <select class="form-control" name="region" id="region" onchange="fntDibujoDropMun() ">
                                                        <!-- DIBUJO DE DROPDOW -->
                                                    </select>

                                                    <input type="hidden" id="hid_region" name="hid_region" value="<?php echo  $departamento; ?>">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="exampleSelect1" class="bmd-label-floating color-label">Distrito/Municipio </label>
                                                    <select class="form-control" name="distrito" id="distrito">
                                                        <!-- DIBUJO DE DROPDOW -->
                                                    </select>

                                                    <input type="hidden" id="hid_distrito" name="hid_distrito" value="<?php echo  $municipio; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <h6>FECHA DE NACIMIENTO</h6>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="exampleInputEmail1" class="bmd-label-floating color-label">Dia</label>
                                                    <input type="text" class="form-control" id="dia" name="dia" value="<?php echo  $ctg_pac_nac_dia; ?>">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="exampleSelect1" class="bmd-label-floating color-label">Mes</label>
                                                    <?php
                                                    $strSelected1 = ($ctg_pac_nac_mes == 1) ? "selected='selected'" : '';
                                                    $strSelected2 = ($ctg_pac_nac_mes == 2) ? "selected='selected'" : '';
                                                    $strSelected3 = ($ctg_pac_nac_mes == 3) ? "selected='selected'" : '';
                                                    $strSelected4 = ($ctg_pac_nac_mes == 4) ? "selected='selected'" : '';
                                                    $strSelected5 = ($ctg_pac_nac_mes == 5) ? "selected='selected'" : '';
                                                    $strSelected6 = ($ctg_pac_nac_mes == 6) ? "selected='selected'" : '';
                                                    $strSelected7 = ($ctg_pac_nac_mes == 7) ? "selected='selected'" : '';
                                                    $strSelected8 = ($ctg_pac_nac_mes == 8) ? "selected='selected'" : '';
                                                    $strSelected9 = ($ctg_pac_nac_mes == 9) ? "selected='selected'" : '';
                                                    $strSelected10 = ($ctg_pac_nac_mes == 10) ? "selected='selected'" : '';
                                                    $strSelected11 = ($ctg_pac_nac_mes == 11) ? "selected='selected'" : '';
                                                    $strSelected12 = ($ctg_pac_nac_mes == 12) ? "selected='selected'" : '';
                                                    ?>

                                                    <select class="form-control" id="mes" name="mes">
                                                        <option value="0">Select</option>
                                                        <option <?php print $strSelected1; ?> value="1">enero</option>
                                                        <option <?php print $strSelected2; ?> value="2">febrero</option>
                                                        <option <?php print $strSelected3; ?> value="3">marzo</option>
                                                        <option <?php print $strSelected4; ?> value="4">abril</option>
                                                        <option <?php print $strSelected5; ?> value="5">mayo</option>
                                                        <option <?php print $strSelected6; ?> value="6">junio</option>
                                                        <option <?php print $strSelected7; ?> value="7">julio</option>
                                                        <option <?php print $strSelected8; ?> value="8">agosto</option>
                                                        <option <?php print $strSelected9; ?> value="9">septiembre</option>
                                                        <option <?php print $strSelected10; ?> value="10">octubre</option>
                                                        <option <?php print $strSelected11; ?> value="11">noviembre</option>
                                                        <option <?php print $strSelected12; ?> value="12">diciembre</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="exampleInputEmail1" class="bmd-label-floating color-label">Año</label>
                                                    <input type="text" class="form-control" id="año" name="año" value="<?php echo  $ctg_pac_nac_ano; ?>">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="exampleInputEmail1" class="bmd-label-floating color-label">Edad</label>
                                                    <input type="text" class="form-control" id="edad" name="edad" value="<?php echo  $edad; ?>">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <h6>INFORMACION MEDICA</h6>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="exampleInputEmail1" class="bmd-label-floating color-label">Peso (libras)</label>
                                                    <input type="text" class="form-control" id="peso" name="peso" value="<?php echo  $ctg_pac_pcl_peso; ?>">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="exampleInputEmail1" class="bmd-label-floating color-label">Estatura (cms)</label>
                                                    <input type="text" class="form-control" id="estatura" name="estatura" value="<?php echo  $ctg_pac_pcl_esta; ?>">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="exampleSelect1" class="bmd-label-floating color-label">Tipo de Sangre</label>
                                                    <select class="form-control" name="tip_sangre" name="tip_sangre" id="tip_sangre">
                                                        <!-- DIBUJO DE DROPDOW -->
                                                    </select>
                                                    <input type="hidden" id="hid_sangre" name="hid_sangre" value="<?php echo  $ctg_pac_pcl_tpsa; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="button" style="background: #d6eaf8;" class="btn btn-info col-12" data-toggle="collapse" data-target="#demo">FICHA CLINICA</button>
                                        </div>
                                        <div id="demo" class="collapse">
                                            <div class="card-body">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="form-group col-md-12 is-focused">
                                                            <label for="exampleInputEmail1" class="bmd-label-floating color-label">Alergias</label>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" value="1" class="custom-control-input" id="alergias_c" name="alergias_c">
                                                                <label class="custom-control-label" for="defaultUnchecked"></label>
                                                            </div>
                                                            <input type="hidden" class="form-control" id="hid_alergias_c" name="hid_alergias_c" value="<?php echo  $ctg_pac_pcl_aler; ?>">
                                                            <textarea class="form-control" name="alergias" id="alergias" onchange="fntCheckOn1()" rows="3"><?php echo  $ctg_pac_pcl_aler_desc; ?></textarea>
                                                            <span class="bmd-help"> Observaciones</span>
                                                        </div>
                                                        <div class="form-group col-md-12 is-focused">
                                                            <label for="exampleInputEmail1" class="bmd-label-floating color-label">Enfermedades</label>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" value="1" class="custom-control-input" id="enfermedades_c" name="enfermedades_c">
                                                                <label class="custom-control-label" for="defaultUnchecked"></label>
                                                            </div>
                                                            <input type="hidden" class="form-control" id="hid_enfermedades_c" name="hid_enfermedades_c" value="<?php echo  $ctg_pac_pcl_enfe; ?>">
                                                            <textarea class="form-control" name="enfermedades" id="enfermedades" onchange="fntCheckOn2()" rows="3"><?php echo  $ctg_pac_pcl_enfe_desc; ?></textarea>
                                                            <span class="bmd-help"> Observaciones </span>
                                                        </div>
                                                        <div class="form-group col-md-12 is-focused">
                                                            <label for="exampleInputEmail1" class="bmd-label-floating color-label">Toma algun medicamento</label>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" value="1" class="custom-control-input" id="medicamento_c" name="medicamento_c">
                                                                <label class="custom-control-label" for="defaultUnchecked"></label>
                                                            </div>
                                                            <input type="hidden" class="form-control" id="hid_medicamento_c" name="hid_medicamento_c" value="<?php echo  $ctg_pac_pcl_medi; ?>">
                                                            <textarea class="form-control" name="medicamento" id="medicamento" onchange="fntCheckOn3()" rows="3"><?php echo  $ctg_pac_pcl_medi_desc; ?></textarea>
                                                            <span class="bmd-help"> Observaciones </span>
                                                        </div>
                                                        <div class="form-group col-md-12 is-focused">
                                                            <label for="exampleTextarea" class="bmd-label-floating color-label">Hipertension</label>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" value="1" class="custom-control-input" id="hipertension_c" name="hipertension_c">
                                                                <label class="custom-control-label" for="defaultUnchecked"></label>
                                                            </div>
                                                            <input type="hidden" class="form-control" id="hid_hipertension_c" name="hid_hipertension_c" value="<?php echo  $ctg_pac_pcl_hipe; ?>">
                                                            <textarea class="form-control" name="hipertension" id="hipertension" onchange="fntCheckOn4()" rows="3"><?php echo  $ctg_pac_pcl_hipe_desc; ?></textarea>
                                                            <span class="bmd-help">Ingresa las hipertension que espesifica </span>
                                                        </div>
                                                        <div class="form-group col-md-12 is-focused">
                                                            <label for="exampleInputEmail1" class="bmd-label-floating color-label">VIH</label>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" value="1" class="custom-control-input" id="vih_c" name="vih_c">
                                                                <label class="custom-control-label" for="defaultUnchecked"></label>
                                                            </div>
                                                            <input type="hidden" class="form-control" id="hid_vih_c" name="hid_vih_c" value="<?php echo  $ctg_pac_pcl_vih; ?>">
                                                            <textarea class="form-control" name="vih" id="vih" onchange="fntCheckOn5()" rows="3"><?php echo  $ctg_pac_pcl_vih_desc; ?></textarea>
                                                            <span class="bmd-help"> Observaciones</span>
                                                        </div>
                                                        <div class="form-group col-md-12 is-focused">
                                                            <label for="exampleInputEmail1" class="bmd-label-floating color-label">Parkinson</label>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" value="1" class="custom-control-input" id="parkinson_c" name="parkinson_c">
                                                                <label class="custom-control-label" for="defaultUnchecked"></label>
                                                            </div>
                                                            <input type="hidden" class="form-control" id="hid_parkinson_c" name="hid_parkinson_c" value="<?php echo  $ctg_pac_pcl_park; ?>">
                                                            <textarea class="form-control" name="parkinson" id="parkinson" onchange="fntCheckOn6()" rows="3"><?php echo  $ctg_pac_pcl_park_desc; ?></textarea>
                                                            <span class="bmd-help"> Observaciones </span>
                                                        </div>
                                                        <div class="form-group col-md-12 is-focused">
                                                            <label for="exampleInputEmail1" class="bmd-label-floating color-label">EPOC</label>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" value="1" class="custom-control-input" id="epoc_c" name="epoc_c">
                                                                <label class="custom-control-label" for="defaultUnchecked"></label>
                                                            </div>
                                                            <input type="hidden" class="form-control" id="hid_epoc_c" name="hid_epoc_c" value="<?php echo  $ctg_pac_pcl_epoc; ?>">
                                                            <textarea class="form-control" name="epoc" id="epoc" onchange="fntCheckOn7()" rows="3"><?php echo  $ctg_pac_pcl_epoc_desc; ?></textarea>
                                                            <span class="bmd-help"> Observaciones </span>
                                                        </div>
                                                        <div class="form-group col-md-12 is-focused">
                                                            <label for="exampleTextarea" class="bmd-label-floating color-label">TBC</label>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" value="1" class="custom-control-input" id="tbc_c" name="tbc_c">
                                                                <label class="custom-control-label" for="defaultUnchecked"></label>
                                                            </div>
                                                            <input type="hidden" class="form-control" id="hid_tbc_c" name="hid_tbc_c" value="<?php echo  $ctg_pac_pcl_tbc; ?>">
                                                            <textarea class="form-control" name="tbc" id="tbc" onchange="fntCheckOn8()" rows="3"><?php echo  $ctg_pac_pcl_tbc_desc; ?></textarea>
                                                            <span class="bmd-help">Observaciones </span>
                                                        </div>
                                                        <div class="form-group col-md-12 is-focused">
                                                            <label for="exampleInputEmail1" class="bmd-label-floating color-label">Demencias</label>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" value="1" class="custom-control-input" id="demencias_c" name="demencias_c">
                                                                <label class="custom-control-label" for="defaultUnchecked"></label>
                                                            </div>
                                                            <input type="hidden" class="form-control" id="hid_demencias_c" name="hid_demencias_c" value="<?php echo  $ctg_pac_pcl_deme; ?>">
                                                            <textarea class="form-control" name="demencias" id="demencias" onchange="fntCheckOn9()" rows="3"><?php echo  $ctg_pac_pcl_deme_desc; ?></textarea>
                                                            <span class="bmd-help"> Observaciones</span>
                                                        </div>
                                                        <div class="form-group col-md-12 is-focused">
                                                            <label for="exampleInputEmail1" class="bmd-label-floating color-label">Diabetes</label>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" value="1" class="custom-control-input" id="diabetes_c" name="diabetes_c">
                                                                <label class="custom-control-label" for="defaultUnchecked"></label>
                                                            </div>
                                                            <input type="hidden" class="form-control" id="hid_diabetes_c" name="hid_diabetes_c" value="<?php echo  $ctg_pac_pcl_diab; ?>">
                                                            <textarea class="form-control" name="diabetes" id="diabetes" onchange="fntCheckOn10()" rows="3"><?php echo  $ctg_pac_pcl_diab_desc; ?></textarea>
                                                            <span class="bmd-help"> Observaciones </span>
                                                        </div>
                                                        <div class="form-group col-md-12 is-focused">
                                                            <label for="exampleInputEmail1" class="bmd-label-floating color-label">ACV con secuelas</label>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" value="1" class="custom-control-input" id="acv_c" name="acv_c">
                                                                <label class="custom-control-label" for="defaultUnchecked"></label>
                                                            </div>
                                                            <input type="hidden" class="form-control" id="hid_acv_c" name="hid_acv_c" value="<?php echo  $ctg_pac_pcl_acv; ?>">
                                                            <textarea class="form-control" name="acv" id="acv" onchange="fntCheckOn11()" rows="3"><?php echo  $ctg_pac_pcl_acv_desc; ?></textarea>
                                                            <span class="bmd-help"> Observaciones </span>
                                                        </div>
                                                        <div class="form-group col-md-12 is-focused">
                                                            <label for="exampleTextarea" class="bmd-label-floating color-label">Enfermedad Terminal</label>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" value="1" class="custom-control-input" id="terminal_c" name="terminal_c">
                                                                <label class="custom-control-label" for="defaultUnchecked"></label>
                                                            </div>
                                                            <input type="hidden" class="form-control" id="hid_terminal_c" name="hid_terminal_c" value="<?php echo  $ctg_pac_pcl_enft; ?>">
                                                            <textarea class="form-control" name="terminal" id="terminal" onchange="fntCheckOn12()" rows="3"><?php echo  $ctg_pac_pcl_enft_desc; ?></textarea>
                                                            <span class="bmd-help">Observaciones </span>
                                                        </div>
                                                        <div class="form-group col-md-12 is-focused">
                                                            <label for="exampleInputEmail1" class="bmd-label-floating color-label">Insuficiencia renal,dialisis</label>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" value="1" class="custom-control-input" id="insuficiencia_c" name="insuficiencia_c">
                                                                <label class="custom-control-label" for="defaultUnchecked"></label>
                                                            </div>
                                                            <input type="hidden" class="form-control" id="hid_insuficiencia_c" name="hid_insuficiencia_c" value="<?php echo  $ctg_pac_pcl_insr; ?>">
                                                            <textarea class="form-control" name="insuficiencia" id="insuficiencia" onchange="fntCheckOn13()" rows="3"><?php echo  $ctg_pac_pcl_insr_desc; ?></textarea>
                                                            <span class="bmd-help"> Observaciones </span>
                                                        </div>
                                                        <div class="form-group col-md-12 is-focused">
                                                            <label for="exampleInputEmail1" class="bmd-label-floating color-label">IAM o ICC</label>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" value="1" class="custom-control-input" id="iam_c" name="iam_c">
                                                                <label class="custom-control-label" for="defaultUnchecked"></label>
                                                            </div>
                                                            <input type="hidden" class="form-control" id="hid_iam_c" name="hid_iam_c" value="<?php echo  $ctg_pac_pcl_iamicc; ?>">
                                                            <textarea class="form-control" name="iam" id="iam" onchange="fntCheckOn14()" rows="3"><?php echo  $ctg_pac_pcl_iamicc_desc; ?></textarea>
                                                            <span class="bmd-help"> Observaciones </span>
                                                        </div>
                                                        <div class="form-group col-md-12 is-focused">
                                                            <label for="exampleTextarea" class="bmd-label-floating color-label">Otras</label>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" value="1" class="custom-control-input" id="otr_c" name="otr_c">
                                                                <label class="custom-control-label" for="defaultUnchecked"></label>
                                                            </div>
                                                            <input type="hidden" class="form-control" id="hid_otr_c" name="hid_otr_c" value="<?php echo  $ctg_pac_pcl_otra; ?>">
                                                            <textarea class="form-control" name="otr" id="otr" onchange="fntCheckOn15()" rows="3"><?php echo  $ctg_pac_pcl_otra_desc; ?></textarea>
                                                            <span class="bmd-help">Observaciones </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 row">
                                    <div class="col-md-2">
                                        <a type="button" class="btn btn-raised btn-primary" id="return" href="doctorsPatient.php"><i class="fad fa-2x fa-arrow-square-left"></i></a>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-raised btn-primary" id="btnEdit" onclick="fntSelectEdit()"><i class="far fa-2x fa-pen-square"></i></button>
                                        <button type="button" class="btn btn-raised btn-primary" id="btnUpdate" onclick="fntUpdate()"><i class="fad fa-2x fa-save"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-1 "></div>
                </div>
            </div>
        </div>

    </form>
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

    //segmento de funcion check al ingresar texto a campos

    function fntCheckOn1() {
        document.getElementById("alergias_c").checked = true;
    }

    function fntCheckOn2() {
        document.getElementById("enfermedades_c").checked = true;
    }

    function fntCheckOn3() {
        document.getElementById("medicamento_c").checked = true;
    }

    function fntCheckOn4() {
        document.getElementById("hipertension_c").checked = true;
    }

    function fntCheckOn5() {
        document.getElementById("vih_c").checked = true;
    }

    function fntCheckOn6() {
        document.getElementById("parkinson_c").checked = true;
    }

    function fntCheckOn7() {
        document.getElementById("epoc_c").checked = true;
    }

    function fntCheckOn8() {
        document.getElementById("tbc_c").checked = true;
    }

    function fntCheckOn9() {
        document.getElementById("demencias_c").checked = true;
    }

    function fntCheckOn10() {
        document.getElementById("diabetes_c").checked = true;
    }

    function fntCheckOn11() {
        document.getElementById("acv_c").checked = true;
    }

    function fntCheckOn12() {
        document.getElementById("terminal_c").checked = true;
    }

    function fntCheckOn13() {
        document.getElementById("insuficiencia_c").checked = true;
    }

    function fntCheckOn14() {
        document.getElementById("iam_c").checked = true;
    }

    function fntCheckOn15() {
        document.getElementById("otr_c").checked = true;
    }

    //checked antecedent inputs
    var str_hid_alergias_c = $("#hid_alergias_c").val();
    var str_hid_enfermedades_c = $("#hid_enfermedades_c").val();
    var str_hid_medicamento_c = $("#hid_medicamento_c").val();
    var str_hid_hipertension_c = $("#hid_hipertension_c").val();
    var str_hid_vih_c = $("#hid_vih_c").val();
    var str_hid_parkinson_c = $("#hid_parkinson_c").val();
    var str_hid_epoc_c = $("#hid_epoc_c").val();
    var str_hid_tbc_c = $("#hid_tbc_c").val();
    var str_hid_demencias_c = $("#hid_demencias_c").val();
    var str_hid_diabetes_c = $("#hid_diabetes_c").val();
    var str_hid_acv_c = $("#hid_acv_c").val();
    var str_hid_terminal_c = $("#hid_terminal_c").val();
    var str_hid_insuficiencia_c = $("#hid_insuficiencia_c").val();
    var str_hid_iam_c = $("#hid_iam_c").val();
    var str_hid_otr_c = $("#hid_otr_c").val();

    var boolCheckPass1 = (str_hid_alergias_c == 1) ? true : false;
    $("[name=alergias_c]").prop('checked', boolCheckPass1);
    //$("#alergias_c").val(str_hid_alergias_c);

    var boolCheckPass2 = (str_hid_enfermedades_c == 1) ? true : false;
    $("[name=enfermedades_c]").prop('checked', boolCheckPass2);
    // $("#enfermedades_c").val(str_hid_enfermedades_c);

    var boolCheckPass3 = (str_hid_medicamento_c == 1) ? true : false;
    $("[name=medicamento_c]").prop('checked', boolCheckPass3);
    //$("#medicamento_c").val(str_hid_medicamento_c);

    var boolCheckPass4 = (str_hid_hipertension_c == 1) ? true : false;
    $("[name=hipertension_c]").prop('checked', boolCheckPass4);
    //$("#hipertension_c").val(str_hid_hipertension_c);

    var boolCheckPass5 = (str_hid_vih_c == 1) ? true : false;
    $("[name=vih_c]").prop('checked', boolCheckPass5);
    //$("#vih_c").val(str_hid_vih_c);

    var boolCheckPass6 = (str_hid_parkinson_c == 1) ? true : false;
    $("[name=parkinson_c]").prop('checked', boolCheckPass6);
    //$("#parkinson_c").val(str_hid_parkinson_c);

    var boolCheckPass7 = (str_hid_epoc_c == 1) ? true : false;
    $("[name=epoc_c]").prop('checked', boolCheckPass7);
    //$("#epoc_c").val(str_hid_epoc_c);

    var boolCheckPass8 = (str_hid_tbc_c == 1) ? true : false;
    $("[name=tbc_c]").prop('checked', boolCheckPass8);
    //$("#tbc_c").val(str_hid_tbc_c);

    var boolCheckPass9 = (str_hid_demencias_c == 1) ? true : false;
    $("[name=demencias_c]").prop('checked', boolCheckPass9);
    //$("#demencias_c").val(str_hid_demencias_c);

    var boolCheckPass10 = (str_hid_diabetes_c == 1) ? true : false;
    $("[name=diabetes_c]").prop('checked', boolCheckPass10);
    //$("#diabetes_c").val(str_hid_diabetes_c);

    var boolCheckPass11 = (str_hid_acv_c == 1) ? true : false;
    $("[name=acv_c]").prop('checked', boolCheckPass11);
    //$("#acv_c").val(str_hid_acv_c);

    var boolCheckPass12 = (str_hid_terminal_c == 1) ? true : false;
    $("[name=terminal_c]").prop('checked', boolCheckPass12);
    //$("#terminal_c").val(str_hid_terminal_c);

    var boolCheckPass13 = (str_hid_insuficiencia_c == 1) ? true : false;
    $("[name=insuficiencia_c]").prop('checked', boolCheckPass13);
    //$("#insuficiencia_c").val(str_hid_insuficiencia_c);

    var boolCheckPass14 = (str_hid_iam_c == 1) ? true : false;
    $("[name=iam_c]").prop('checked', boolCheckPass14);
    //$("#iam_c").val(str_hid_iam_c);

    var boolCheckPass15 = (str_hid_otr_c == 1) ? true : false;
    $("[name=otr_c]").prop('checked', boolCheckPass15);
    //$("#otr_c").val(str_hid_otr_c);
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