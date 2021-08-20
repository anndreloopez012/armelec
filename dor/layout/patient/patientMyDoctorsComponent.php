<body>
    <section class="content col-md-10">
        <div class="col-md-12">
            <p>
                <p>
                    <a class="btn btn-raised btn-info" role="button" aria-expanded="false" href="index.php">Menu</a>
                    <a class="btn btn-raised btn-info" role="button" href="index.php">Regresar</a>
                    <a class="btn btn-raised btn-info btn-center" type="button" data-toggle="collapse" data-target="#AddCita" aria-expanded="false" aria-controls="AddCita">DOCTORES</a>

                </p>
                <div class=" collapse show" id="AddCita">
                    <div class="card card-body">
                        <div class="card card-primary collapsed-card">
                            <div class="card-body " style="display: block;">
                                <form id="formData" method="POST">
                                    <div class="row">
                                        <input class="form-control" type="hidden" id="code" name="code" value="<?php echo  $cod_id; ?>">

                                        <div class="form-group col-md-1">
                                            <a href=" " data-toggle="modal" id="btnespe" data-target="#basicExampleModalEspe"><i class="fad fa-2x fa-search"></i></a>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="Nombres" class="color-label">Nombre Medico de Cabecera</label>
                                            <input type="text" class="form-control" id="ctg_pac_medico_cabe_descrip" name="ctg_pac_medico_cabe_descrip" value="<?php echo  $ctg_pac_medico_cabe_descrip; ?>">
                                            <input type="hidden" class="form-control" id="ctg_pac_medico_cabe_code" name="ctg_pac_medico_cabe_code" value="<?php echo  $ctg_pac_medico_cabe_code; ?>">

                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Estado" class=" color-label">Especialidad</label>
                                            <input type="hidden" class="form-control" id="ctg_pac_medico_cabe_espe_" name="ctg_pac_medico_cabe_espe_" value="<?php echo  $ctg_pac_medico_espe2; ?>">

                                            <select class="form-control" id="ctg_pac_medico_cabe_espe" name="ctg_pac_medico_cabe_espe" onchange="fntSelectDropCabe()">
                                                <option value="0">Seleccionar</option>
                                                <?php
                                                if (is_array($arrDataEspecialidad) && (count($arrDataEspecialidad) > 0)) {
                                                    $intContador = 1;
                                                    reset($arrDataEspecialidad);
                                                    foreach ($arrDataEspecialidad as $rTMP['key'] => $rTMP['value']) {

                                                        $strSelected_ = ($rTMP["value"]['ctg_esp_cod'] == $ctg_pac_medico_cabe_espe) ? "selected='selected'" : '';
                                                ?>
                                                        <option <?php print $strSelected_ ?> value="<?php echo $rTMP["value"]['ctg_esp_cod']; ?>"><?php echo $rTMP["value"]['ctg_esp_desc']; ?></option>
                                                <?php
                                                        $intContador++;
                                                    }
                                                }
                                                ?>

                                            </select>


                                        </div>
                                        <div class="form-group col-md-4 borrar"><br></br>
                                            <a id="delete_espe" name="delete_espe" onclick="fntDeleteRow_espe()"><i class="fad fa-2x fa-trash-alt"></i></a>
                                        </div>



                                        <div class="form-group col-md-1">
                                            <a href=" " data-toggle="modal" id="btn1" data-target="#basicExampleModal1"><i class="fad fa-2x fa-search"></i></a>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="Nombres" class="color-label">Nombre </label>
                                            <input type="text" class="form-control" id="ctg_pac_medico_descrip1" name="ctg_pac_medico_descrip1" value="<?php echo  $ctg_pac_medico_descrip1; ?>">
                                            <input type="hidden" class="form-control" id="ctg_pac_medico_code1" name="ctg_pac_medico_code1" value="<?php echo  $ctg_pac_medico_code1; ?>">

                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Estado" class=" color-label">Especialidad</label>
                                            <input type="hidden" class="form-control" id="ctg_pac_medico_espe1_" name="ctg_pac_medico_espe1_" value="<?php echo  $ctg_pac_medico_espe1; ?>">

                                            <select class="form-control" id="ctg_pac_medico_espe1" name="ctg_pac_medico_espe1" onchange="fntSelectDrop1()">
                                                <option value="0">Seleccionar</option>
                                                <?php
                                                if (is_array($arrDataEspecialidad) && (count($arrDataEspecialidad) > 0)) {
                                                    $intContador = 1;
                                                    reset($arrDataEspecialidad);
                                                    foreach ($arrDataEspecialidad as $rTMP['key'] => $rTMP['value']) {

                                                        $strSelected_ = ($ctg_pac_medico_espe1 == $rTMP["value"]['ctg_esp_cod']) ? "selected='selected'" : '';
                                                ?>
                                                        <option <?php print $strSelected_ ?> value="<?php echo $rTMP["value"]['ctg_esp_cod']; ?>"><?php echo $rTMP["value"]['ctg_esp_desc']; ?></option>
                                                <?php
                                                        $intContador++;
                                                    }
                                                }
                                                ?>

                                            </select>

                                        </div>
                                        <div class="form-group col-md-4 borrar"><br></br>
                                            <a id="delete_1" name="delete_1" onclick="fntDeleteRow_1()"><i class="fad fa-2x fa-trash-alt"></i></a>
                                        </div>

                                        <div class="form-group col-md-1">
                                            <a href=" " data-toggle="modal" id="btn2" data-target="#basicExampleModal2"><i class="fad fa-2x fa-search"></i></a>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="Nombres" class="color-label">Nombre </label>
                                            <input type="text" class="form-control" id="ctg_pac_medico_descrip2" name="ctg_pac_medico_descrip2" value="<?php echo  $ctg_pac_medico_descrip2; ?>">
                                            <input type="hidden" class="form-control" id="ctg_pac_medico_code2" name="ctg_pac_medico_code2" value="<?php echo  $ctg_pac_medico_code2; ?>">

                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Estado" class=" color-label">Especialidad</label>
                                            <input type="hidden" class="form-control" id="ctg_pac_medico_espe2_" name="ctg_pac_medico_espe2_" value="<?php echo  $ctg_pac_medico_espe2; ?>">

                                            <select class="form-control" id="ctg_pac_medico_espe2" name="ctg_pac_medico_espe2" onchange="fntSelectDrop2()">
                                                <option value="0">Seleccionar</option>
                                                <?php
                                                if (is_array($arrDataEspecialidad) && (count($arrDataEspecialidad) > 0)) {
                                                    $intContador = 1;
                                                    reset($arrDataEspecialidad);
                                                    foreach ($arrDataEspecialidad as $rTMP['key'] => $rTMP['value']) {

                                                        $strSelected_ = ($rTMP["value"]['ctg_esp_cod'] == $ctg_pac_medico_espe2) ? "selected='selected'" : '';
                                                ?>
                                                        <option <?php print $strSelected_ ?> value="<?php echo $rTMP["value"]['ctg_esp_cod']; ?>"><?php echo $rTMP["value"]['ctg_esp_desc']; ?></option>
                                                <?php
                                                        $intContador++;
                                                    }
                                                }
                                                ?>

                                            </select>


                                        </div>
                                        <div class="form-group col-md-4 borrar"><br></br>
                                            <a id="delete_2" name="delete_2" onclick="fntDeleteRow_2()"><i class="fad fa-2x fa-trash-alt"></i></a>
                                        </div>

                                        <div class="form-group col-md-1">
                                            <a href=" " data-toggle="modal" id="btn3" data-target="#basicExampleModal3"><i class="fad fa-2x fa-search"></i></a>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="Nombres" class="color-label">Nombre </label>
                                            <input type="text" class="form-control" id="ctg_pac_medico_descrip3" name="ctg_pac_medico_descrip3" value="<?php echo  $ctg_pac_medico_descrip3; ?>">
                                            <input type="hidden" class="form-control" id="ctg_pac_medico_code3" name="ctg_pac_medico_code3" value="<?php echo  $ctg_pac_medico_code3; ?>">

                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Estado" class=" color-label">Especialidad</label>
                                            <input type="hidden" class="form-control" id="ctg_pac_medico_espe3_" name="ctg_pac_medico_espe3_" value="<?php echo  $ctg_pac_medico_espe3; ?>">

                                            <select class="form-control" id="ctg_pac_medico_espe3" name="ctg_pac_medico_espe3" onchange="fntSelectDrop3()">
                                                <option value="0">Seleccionar</option>
                                                <?php
                                                if (is_array($arrDataEspecialidad) && (count($arrDataEspecialidad) > 0)) {
                                                    $intContador = 1;
                                                    reset($arrDataEspecialidad);
                                                    foreach ($arrDataEspecialidad as $rTMP['key'] => $rTMP['value']) {

                                                        $strSelected_ = ($rTMP["value"]['ctg_esp_cod'] == $ctg_pac_medico_espe3) ? "selected='selected'" : '';
                                                ?>
                                                        <option <?php print $strSelected_ ?> value="<?php echo $rTMP["value"]['ctg_esp_cod']; ?>"><?php echo $rTMP["value"]['ctg_esp_desc']; ?></option>
                                                <?php
                                                        $intContador++;
                                                    }
                                                }
                                                ?>

                                            </select>


                                        </div>
                                        <div class="form-group col-md-4 borrar"><br></br>
                                            <a id="delete_3" name="delete_3" onclick="fntDeleteRow_3()"><i class="fad fa-2x fa-trash-alt"></i></a>
                                        </div>

                                        <div class="form-group col-md-1">
                                            <a href=" " data-toggle="modal" id="btn4" data-target="#basicExampleModal4"><i class="fad fa-2x fa-search"></i></a>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="Nombres" class="color-label">Nombre </label>
                                            <input type="text" class="form-control" id="ctg_pac_medico_descrip4" name="ctg_pac_medico_descrip4" value="<?php echo  $ctg_pac_medico_descrip4; ?>">
                                            <input type="hidden" class="form-control" id="ctg_pac_medico_code4" name="ctg_pac_medico_code4" value="<?php echo  $ctg_pac_medico_code4; ?>">

                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Estado" class=" color-label">Especialidad</label>
                                            <input type="hidden" class="form-control" id="ctg_pac_medico_espe4_" name="ctg_pac_medico_espe4_" value="<?php echo  $ctg_pac_medico_espe4; ?>">

                                            <select class="form-control" id="ctg_pac_medico_espe4" name="ctg_pac_medico_espe4" onchange="fntSelectDrop4()">
                                                <option value="0">Seleccionar</option>
                                                <?php
                                                if (is_array($arrDataEspecialidad) && (count($arrDataEspecialidad) > 0)) {
                                                    $intContador = 1;
                                                    reset($arrDataEspecialidad);
                                                    foreach ($arrDataEspecialidad as $rTMP['key'] => $rTMP['value']) {

                                                        $strSelected_ = ($rTMP["value"]['ctg_esp_cod'] == $ctg_pac_medico_espe4) ? "selected='selected'" : '';
                                                ?>
                                                        <option <?php print $strSelected_ ?> value="<?php echo $rTMP["value"]['ctg_esp_cod']; ?>"><?php echo $rTMP["value"]['ctg_esp_desc']; ?></option>
                                                <?php
                                                        $intContador++;
                                                    }
                                                }
                                                ?>

                                            </select>


                                        </div>
                                        <div class="form-group col-md-4 borrar"><br></br>
                                            <a id="delete_4" name="delete_4" onclick="fntDeleteRow_4()"><i class="fad fa-2x fa-trash-alt"></i></a>
                                        </div>

                                        <div class="form-group col-md-1">
                                            <a href=" " data-toggle="modal" id="btn5" data-target="#basicExampleModal5"><i class="fad fa-2x fa-search"></i></a>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="Nombres" class="color-label">Nombre </label>
                                            <input type="text" class="form-control" id="ctg_pac_medico_descrip5" name="ctg_pac_medico_descrip5" value="<?php echo  $ctg_pac_medico_descrip5; ?>">
                                            <input type="hidden" class="form-control" id="ctg_pac_medico_code5" name="ctg_pac_medico_code5" value="<?php echo  $ctg_pac_medico_code5; ?>">

                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Estado" class=" color-label">Especialidad</label>
                                            <input type="hidden" class="form-control" id="ctg_pac_medico_espe5_" name="ctg_pac_medico_espe5_" value="<?php echo  $ctg_pac_medico_espe5; ?>">

                                            <select class="form-control" id="ctg_pac_medico_espe5" name="ctg_pac_medico_espe5" onchange="fntSelectDrop5()">
                                                <option value="0">Seleccionar</option>
                                                <?php
                                                if (is_array($arrDataEspecialidad) && (count($arrDataEspecialidad) > 0)) {
                                                    $intContador = 1;
                                                    reset($arrDataEspecialidad);
                                                    foreach ($arrDataEspecialidad as $rTMP['key'] => $rTMP['value']) {

                                                        $strSelected_ = ($rTMP["value"]['ctg_esp_cod'] == $ctg_pac_medico_espe5) ? "selected='selected'" : '';
                                                ?>
                                                        <option <?php print $strSelected_ ?> value="<?php echo $rTMP["value"]['ctg_esp_cod']; ?>"><?php echo $rTMP["value"]['ctg_esp_desc']; ?></option>
                                                <?php
                                                        $intContador++;
                                                    }
                                                }
                                                ?>

                                            </select>


                                        </div>
                                        <div class="form-group col-md-4 borrar"><br></br>
                                            <a id="delete_5" name="delete_5" onclick="fntDeleteRow_5()"><i class="fad fa-2x fa-trash-alt"></i></a>
                                        </div>

                                        <div class="form-group col-md-1">
                                            <a href=" " data-toggle="modal" id="btn6" data-target="#basicExampleModal6"><i class="fad fa-2x fa-search"></i></a>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="Nombres" class="color-label">Nombre </label>
                                            <input type="text" class="form-control" id="ctg_pac_medico_descrip6" name="ctg_pac_medico_descrip6" value="<?php echo  $ctg_pac_medico_descrip6; ?>">
                                            <input type="hidden" class="form-control" id="ctg_pac_medico_code6" name="ctg_pac_medico_code6" value="<?php echo  $ctg_pac_medico_code6; ?>">

                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Estado" class=" color-label">Especialidad</label>
                                            <input type="hidden" class="form-control" id="ctg_pac_medico_espe6_" name="ctg_pac_medico_espe6_" value="<?php echo  $ctg_pac_medico_espe6; ?>">

                                            <select class="form-control" id="ctg_pac_medico_espe6" name="ctg_pac_medico_espe6" onchange="fntSelectDrop6()">
                                                <option value="0">Seleccionar</option>
                                                <?php
                                                if (is_array($arrDataEspecialidad) && (count($arrDataEspecialidad) > 0)) {
                                                    $intContador = 1;
                                                    reset($arrDataEspecialidad);
                                                    foreach ($arrDataEspecialidad as $rTMP['key'] => $rTMP['value']) {

                                                        $strSelected_ = ($rTMP["value"]['ctg_esp_cod'] == $ctg_pac_medico_espe6) ? "selected='selected'" : '';
                                                ?>
                                                        <option <?php print $strSelected_ ?> value="<?php echo $rTMP["value"]['ctg_esp_cod']; ?>"><?php echo $rTMP["value"]['ctg_esp_desc']; ?></option>
                                                <?php
                                                        $intContador++;
                                                    }
                                                }
                                                ?>

                                            </select>


                                        </div>
                                        <div class="form-group col-md-4 borrar"><br></br>
                                            <a id="delete_6" name="delete_6" onclick="fntDeleteRow_6()"><i class="fad fa-2x fa-trash-alt"></i></a>
                                        </div>

                                        <div class="form-group col-md-1">
                                            <a href=" " data-toggle="modal" id="btn7" data-target="#basicExampleModal7"><i class="fad fa-2x fa-search"></i></a>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="Nombres" class="color-label">Nombre </label>
                                            <input type="text" class="form-control" id="ctg_pac_medico_descrip7" name="ctg_pac_medico_descrip7" value="<?php echo  $ctg_pac_medico_descrip7; ?>">
                                            <input type="hidden" class="form-control" id="ctg_pac_medico_code7" name="ctg_pac_medico_code7" value="<?php echo  $ctg_pac_medico_code7; ?>">

                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Estado" class=" color-label">Especialidad</label>
                                            <input type="hidden" class="form-control" id="ctg_pac_medico_espe7_" name="ctg_pac_medico_espe7_" value="<?php echo  $ctg_pac_medico_espe7; ?>">

                                            <select class="form-control" id="ctg_pac_medico_espe7" name="ctg_pac_medico_espe8" onchange="fntSelectDrop7()">
                                                <option value="0">Seleccionar</option>
                                                <?php
                                                if (is_array($arrDataEspecialidad) && (count($arrDataEspecialidad) > 0)) {
                                                    $intContador = 1;
                                                    reset($arrDataEspecialidad);
                                                    foreach ($arrDataEspecialidad as $rTMP['key'] => $rTMP['value']) {

                                                        $strSelected_ = ($rTMP["value"]['ctg_esp_cod'] == $ctg_pac_medico_espe7) ? "selected='selected'" : '';
                                                ?>
                                                        <option <?php print $strSelected_ ?> value="<?php echo $rTMP["value"]['ctg_esp_cod']; ?>"><?php echo $rTMP["value"]['ctg_esp_desc']; ?></option>
                                                <?php
                                                        $intContador++;
                                                    }
                                                }
                                                ?>

                                            </select>


                                        </div>
                                        <div class="form-group col-md-4 borrar"><br></br>
                                            <a id="delete_7" name="delete_7" onclick="fntDeleteRow_7()"><i class="fad fa-2x fa-trash-alt"></i></a>
                                        </div>

                                        <div class="form-group col-md-1">
                                            <a href=" " data-toggle="modal" id="btn8" data-target="#basicExampleModal8"><i class="fad fa-2x fa-search"></i></a>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="Nombres" class="color-label">Nombre </label>
                                            <input type="text" class="form-control" id="ctg_pac_medico_descrip8" name="ctg_pac_medico_descrip8" value="<?php echo  $ctg_pac_medico_descrip8; ?>">
                                            <input type="hidden" class="form-control" id="ctg_pac_medico_code8" name="ctg_pac_medico_code8" value="<?php echo  $ctg_pac_medico_code8; ?>">

                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Estado" class=" color-label">Especialidad</label>
                                            <input type="hidden" class="form-control" id="ctg_pac_medico_espe8_" name="ctg_pac_medico_espe8_" value="<?php echo  $ctg_pac_medico_espe8; ?>">

                                            <select class="form-control" id="ctg_pac_medico_espe8" name="ctg_pac_medico_espe8" onchange="fntSelectDrop8()">
                                                <option value="0">Seleccionar</option>
                                                <?php
                                                if (is_array($arrDataEspecialidad) && (count($arrDataEspecialidad) > 0)) {
                                                    $intContador = 1;
                                                    reset($arrDataEspecialidad);
                                                    foreach ($arrDataEspecialidad as $rTMP['key'] => $rTMP['value']) {

                                                        $strSelected_ = ($rTMP["value"]['ctg_esp_cod'] == $ctg_pac_medico_espe8) ? "selected='selected'" : '';
                                                ?>
                                                        <option <?php print $strSelected_ ?> value="<?php echo $rTMP["value"]['ctg_esp_cod']; ?>"><?php echo $rTMP["value"]['ctg_esp_desc']; ?></option>
                                                <?php
                                                        $intContador++;
                                                    }
                                                }
                                                ?>

                                            </select>


                                        </div>
                                        <div class="form-group col-md-4 borrar"><br></br>
                                            <a id="delete_8" name="delete_8" onclick="fntDeleteRow_8()"><i class="fad fa-2x fa-trash-alt"></i></a>
                                        </div>

                                        <div class="form-group col-md-1">
                                            <a href=" " data-toggle="modal" id="btn9" data-target="#basicExampleModal9"><i class="fad fa-2x fa-search"></i></a>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="Nombres" class="color-label">Nombre </label>
                                            <input type="text" class="form-control" id="ctg_pac_medico_descrip9" name="ctg_pac_medico_descrip9" value="<?php echo  $ctg_pac_medico_descrip9; ?>">
                                            <input type="hidden" class="form-control" id="ctg_pac_medico_code9" name="ctg_pac_medico_code9" value="<?php echo  $ctg_pac_medico_code9; ?>">

                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Estado" class=" color-label">Especialidad</label>
                                            <input type="hidden" class="form-contro9" id="ctg_pac_medico_espe9_" name="ctg_pac_medico_espe9_" value="<?php echo  $ctg_pac_medico_espe9; ?>">

                                            <select class="form-control" id="ctg_pac_medico_espe9" name="ctg_pac_medico_espe9" onchange="fntSelectDrop9()">
                                                <option value="0">Seleccionar</option>
                                                <?php
                                                if (is_array($arrDataEspecialidad) && (count($arrDataEspecialidad) > 0)) {
                                                    $intContador = 1;
                                                    reset($arrDataEspecialidad);
                                                    foreach ($arrDataEspecialidad as $rTMP['key'] => $rTMP['value']) {

                                                        $strSelected_ = ($rTMP["value"]['ctg_esp_cod'] == $ctg_pac_medico_espe9) ? "selected='selected'" : '';
                                                ?>
                                                        <option <?php print $strSelected_ ?> value="<?php echo $rTMP["value"]['ctg_esp_cod']; ?>"><?php echo $rTMP["value"]['ctg_esp_desc']; ?></option>
                                                <?php
                                                        $intContador++;
                                                    }
                                                }
                                                ?>

                                            </select>


                                        </div>
                                        <div class="form-group col-md-4 borrar"><br></br>
                                            <a id="delete_9" name="delete_9" onclick="fntDeleteRow_9()"><i class="fad fa-2x fa-trash-alt"></i></a>
                                        </div>
                                    </div>




                                </form>
                                <div class="col-md-4 row">
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
                </div>
    </section>
    <div class="modal fade bd-example-modal-lg" id="basicExampleModalEspe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100" id="myModalLabel">DOCTOR DE CABECERA</h4>
                    <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12 row">
                        <div class="col-sm-6">
                            <input class="form-control" name="SearchCabe" id="SearchCabe" type="text" style="text-transform:uppercase;" placeholder="Buscar doctor">
                        </div>
                        <div>
                            <a type="button" class="btn btn-info" onclick="fntDibujoTablaCabe() "><i class="fad fa-2x fa-search"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="div1">
                            <div id="TablaCabe" name="TablaCabe">
                                <!-- DIBUJO DE TABLA CATEGORIA PRODUCTO-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CERRAR</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="basicExampleModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100" id="myModalLabel">DOCTORES</h4>
                    <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12 row">
                        <div class="col-sm-6">
                            <input class="form-control" name="Search1" id="Search1" type="text" style="text-transform:uppercase;" placeholder="Buscar doctor">
                        </div>
                        <div>
                            <a type="button" class="btn btn-info" onclick="fntDibujoTabla1() "><i class="fad fa-2x fa-search"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="div1">
                            <div id="Tabla1" name="Tabla1">
                                <!-- DIBUJO DE TABLA CATEGORIA PRODUCTO-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CERRAR</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="basicExampleModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100" id="myModalLabel">DOCTORES</h4>
                    <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12 row">
                        <div class="col-sm-6">
                            <input class="form-control" name="Search2" id="Search2" type="text" style="text-transform:uppercase;" placeholder="Buscar doctor">
                        </div>
                        <div>
                            <a type="button" class="btn btn-info" onclick="fntDibujoTabla2() "><i class="fad fa-2x fa-search"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="div1">
                            <div id="Tabla2" name="Tabla2">
                                <!-- DIBUJO DE TABLA CATEGORIA PRODUCTO-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CERRAR</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="basicExampleModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100" id="myModalLabel">DOCTORES</h4>
                    <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12 row">
                        <div class="col-sm-6">
                            <input class="form-control" name="Search3" id="Search3" type="text" style="text-transform:uppercase;" placeholder="Buscar doctor">
                        </div>
                        <div>
                            <a type="button" class="btn btn-info" onclick="fntDibujoTabla3() "><i class="fad fa-2x fa-search"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="div1">
                            <div id="Tabla3" name="Tabla3">
                                <!-- DIBUJO DE TABLA CATEGORIA PRODUCTO-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CERRAR</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="basicExampleModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100" id="myModalLabel">DOCTORES</h4>
                    <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12 row">
                        <div class="col-sm-6">
                            <input class="form-control" name="Search4" id="Search4" type="text" style="text-transform:uppercase;" placeholder="Buscar doctor">
                        </div>
                        <div>
                            <a type="button" class="btn btn-info" onclick="fntDibujoTabla4() "><i class="fad fa-2x fa-search"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="div1">
                            <div id="Tabla4" name="Tabla4">
                                <!-- DIBUJO DE TABLA CATEGORIA PRODUCTO-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CERRAR</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="basicExampleModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100" id="myModalLabel">DOCTORES</h4>
                    <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12 row">
                        <div class="col-sm-6">
                            <input class="form-control" name="Search5" id="Search5" type="text" style="text-transform:uppercase;" placeholder="Buscar doctor">
                        </div>
                        <div>
                            <a type="button" class="btn btn-info" onclick="fntDibujoTabla5() "><i class="fad fa-2x fa-search"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="div1">
                            <div id="Tabla5" name="Tabla5">
                                <!-- DIBUJO DE TABLA CATEGORIA PRODUCTO-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CERRAR</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="basicExampleModal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100" id="myModalLabel">DOCTORES</h4>
                    <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12 row">
                        <div class="col-sm-6">
                            <input class="form-control" name="Search6" id="Search6" type="text" style="text-transform:uppercase;" placeholder="Buscar doctor">
                        </div>
                        <div>
                            <a type="button" class="btn btn-info" onclick="fntDibujoTabla6() "><i class="fad fa-2x fa-search"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="div1">
                            <div id="Tabla6" name="Tabla6">
                                <!-- DIBUJO DE TABLA CATEGORIA PRODUCTO-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CERRAR</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="basicExampleModal7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100" id="myModalLabel">DOCTORES</h4>
                    <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12 row">
                        <div class="col-sm-6">
                            <input class="form-control" name="Search7" id="Search7" type="text" style="text-transform:uppercase;" placeholder="Buscar doctor">
                        </div>
                        <div>
                            <a type="button" class="btn btn-info" onclick="fntDibujoTabla7() "><i class="fad fa-2x fa-search"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="div1">
                            <div id="Tabla7" name="Tabla7">
                                <!-- DIBUJO DE TABLA CATEGORIA PRODUCTO-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CERRAR</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="basicExampleModal8" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100" id="myModalLabel">DOCTORES</h4>
                    <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12 row">
                        <div class="col-sm-6">
                            <input class="form-control" name="Search8" id="Search8" type="text" style="text-transform:uppercase;" placeholder="Buscar doctor">
                        </div>
                        <div>
                            <a type="button" class="btn btn-info" onclick="fntDibujoTabla8() "><i class="fad fa-2x fa-search"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="div1">
                            <div id="Tabla8" name="Tabla8">
                                <!-- DIBUJO DE TABLA CATEGORIA PRODUCTO-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CERRAR</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="basicExampleModal9" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100" id="myModalLabel">DOCTORES</h4>
                    <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12 row">
                        <div class="col-sm-6">
                            <input class="form-control" name="Search9" id="Search9" type="text" style="text-transform:uppercase;" placeholder="Buscar doctor">
                        </div>
                        <div>
                            <a type="button" class="btn btn-info" onclick="fntDibujoTabla9() "><i class="fad fa-2x fa-search"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="div1">
                            <div id="Tabla9" name="Tabla9">
                                <!-- DIBUJO DE TABLA CATEGORIA PRODUCTO-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CERRAR</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('btnEdit').style.display = 'block';
        document.getElementById('btnUpdate').style.display = 'none';

        document.getElementById('btnespe').style.display = 'none';
        document.getElementById('btn1').style.display = 'none';
        document.getElementById('btn2').style.display = 'none';
        document.getElementById('btn3').style.display = 'none';
        document.getElementById('btn4').style.display = 'none';
        document.getElementById('btn5').style.display = 'none';
        document.getElementById('btn6').style.display = 'none';
        document.getElementById('btn7').style.display = 'none';
        document.getElementById('btn8').style.display = 'none';
        document.getElementById('btn9').style.display = 'none';

        document.getElementById('delete_espe').style.display = 'none';
        document.getElementById('delete_1').style.display = 'none';
        document.getElementById('delete_2').style.display = 'none';
        document.getElementById('delete_3').style.display = 'none';
        document.getElementById('delete_4').style.display = 'none';
        document.getElementById('delete_5').style.display = 'none';
        document.getElementById('delete_6').style.display = 'none';
        document.getElementById('delete_7').style.display = 'none';
        document.getElementById('delete_8').style.display = 'none';
        document.getElementById('delete_9').style.display = 'none';

        $(document).ready(function() {
            $('input,textarea,select').attr('readonly', true)
        });

        function fntSelectEdit() {

            document.getElementById('btnEdit').style.display = 'none';
            document.getElementById('btnUpdate').style.display = 'block';

            document.getElementById('btnespe').style.display = 'block';
            document.getElementById('btn1').style.display = 'block';
            document.getElementById('btn2').style.display = 'block';
            document.getElementById('btn3').style.display = 'block';
            document.getElementById('btn4').style.display = 'block';
            document.getElementById('btn5').style.display = 'block';
            document.getElementById('btn6').style.display = 'block';
            document.getElementById('btn7').style.display = 'block';
            document.getElementById('btn8').style.display = 'block';
            document.getElementById('btn9').style.display = 'block';

            document.getElementById('delete_espe').style.display = 'block';
            document.getElementById('delete_1').style.display = 'block';
            document.getElementById('delete_2').style.display = 'block';
            document.getElementById('delete_3').style.display = 'block';
            document.getElementById('delete_4').style.display = 'block';
            document.getElementById('delete_5').style.display = 'block';
            document.getElementById('delete_6').style.display = 'block';
            document.getElementById('delete_7').style.display = 'block';
            document.getElementById('delete_8').style.display = 'block';
            document.getElementById('delete_9').style.display = 'block';

            $('input,textarea,select').attr('readonly', false)

        }


        function fntSelectViewCabe(intParametro) {
            intParametro = !intParametro ? 0 : intParametro;

            if (intParametro > 0) {

                var strId = $("#hidId_" + intParametro).val();
                var strNombre = $("#hidNombre_" + intParametro).val();
                var strApellido = $("#hidApellido_" + intParametro).val();
                var strEspacio = " ";

                // alert(strDPI + "                         strDPI");

                $("#ctg_pac_medico_cabe_descrip").val(strNombre.concat(strEspacio, strApellido));
                $("#ctg_pac_medico_cabe_code").val(strId);

            }

        }

        function fntSelectView1(intParametro) {
            intParametro = !intParametro ? 0 : intParametro;

            if (intParametro > 0) {

                var strId = $("#hidId_" + intParametro).val();
                var strNombre = $("#hidNombre_" + intParametro).val();
                var strApellido = $("#hidApellido_" + intParametro).val();
                var strEspacio = " ";

                // alert(strDPI + "                         strDPI");

                $("#ctg_pac_medico_descrip1").val(strNombre.concat(strEspacio, strApellido));
                $("#ctg_pac_medico_code1").val(strId);

            }

        }

        function fntSelectView2(intParametro) {
            intParametro = !intParametro ? 0 : intParametro;

            if (intParametro > 0) {

                var strId = $("#hidId_" + intParametro).val();
                var strNombre = $("#hidNombre_" + intParametro).val();
                var strApellido = $("#hidApellido_" + intParametro).val();
                var strEspacio = " ";


                // alert(strDPI + "                         strDPI");

                $("#ctg_pac_medico_descrip2").val(strNombre.concat(strEspacio, strApellido));
                $("#ctg_pac_medico_code2").val(strId);

            }

        }

        function fntSelectView3(intParametro) {
            intParametro = !intParametro ? 0 : intParametro;

            if (intParametro > 0) {

                var strId = $("#hidId_" + intParametro).val();
                var strNombre = $("#hidNombre_" + intParametro).val();
                var strApellido = $("#hidApellido_" + intParametro).val();
                var strEspacio = " ";


                // alert(strDPI + "                         strDPI");

                $("#ctg_pac_medico_descrip3").val(strNombre.concat(strEspacio, strApellido));
                $("#ctg_pac_medico_code3").val(strId);

            }

        }

        function fntSelectView4(intParametro) {
            intParametro = !intParametro ? 0 : intParametro;

            if (intParametro > 0) {

                var strId = $("#hidId_" + intParametro).val();
                var strNombre = $("#hidNombre_" + intParametro).val();
                var strApellido = $("#hidApellido_" + intParametro).val();
                var strEspacio = " ";


                // alert(strDPI + "                         strDPI");

                $("#ctg_pac_medico_descrip4").val(strNombre.concat(strEspacio, strApellido));
                $("#ctg_pac_medico_code4").val(strId);

            }

        }

        function fntSelectView5(intParametro) {
            intParametro = !intParametro ? 0 : intParametro;

            if (intParametro > 0) {

                var strId = $("#hidId_" + intParametro).val();
                var strNombre = $("#hidNombre_" + intParametro).val();
                var strApellido = $("#hidApellido_" + intParametro).val();
                var strEspacio = " ";


                // alert(strDPI + "                         strDPI");

                $("#ctg_pac_medico_descrip5").val(strNombre.concat(strEspacio, strApellido));
                $("#ctg_pac_medico_code5").val(strId);

            }

        }

        function fntSelectView6(intParametro) {
            intParametro = !intParametro ? 0 : intParametro;

            if (intParametro > 0) {

                var strId = $("#hidId_" + intParametro).val();
                var strNombre = $("#hidNombre_" + intParametro).val();
                var strApellido = $("#hidApellido_" + intParametro).val();
                var strEspacio = " ";


                // alert(strDPI + "                         strDPI");

                $("#ctg_pac_medico_descrip6").val(strNombre.concat(strEspacio, strApellido));
                $("#ctg_pac_medico_code6").val(strId);

            }

        }

        function fntSelectView7(intParametro) {
            intParametro = !intParametro ? 0 : intParametro;

            if (intParametro > 0) {

                var strId = $("#hidId_" + intParametro).val();
                var strNombre = $("#hidNombre_" + intParametro).val();
                var strApellido = $("#hidApellido_" + intParametro).val();
                var strEspacio = " ";


                // alert(strDPI + "                         strDPI");

                $("#ctg_pac_medico_descrip7").val(strNombre.concat(strEspacio, strApellido));
                $("#ctg_pac_medico_code7").val(strId);

            }

        }

        function fntSelectView8(intParametro) {
            intParametro = !intParametro ? 0 : intParametro;

            if (intParametro > 0) {

                var strId = $("#hidId_" + intParametro).val();
                var strNombre = $("#hidNombre_" + intParametro).val();
                var strApellido = $("#hidApellido_" + intParametro).val();
                var strEspacio = " ";


                // alert(strDPI + "                         strDPI");

                $("#ctg_pac_medico_descrip8").val(strNombre.concat(strEspacio, strApellido));
                $("#ctg_pac_medico_code8").val(strId);

            }

        }

        function fntSelectView9(intParametro) {
            intParametro = !intParametro ? 0 : intParametro;

            if (intParametro > 0) {

                var strId = $("#hidId_" + intParametro).val();
                var strNombre = $("#hidNombre_" + intParametro).val();
                var strApellido = $("#hidApellido_" + intParametro).val();
                var strEspacio = " ";


                // alert(strDPI + "                         strDPI");

                $("#ctg_pac_medico_descrip9").val(strNombre.concat(strEspacio, strApellido));
                $("#ctg_pac_medico_code9").val(strId);

            }

        }

        function fntSelectDropCabe() {

            var strId = $("#ctg_pac_medico_cabe_espe").val();

            //   alert(strId + "                         strId");

            $("#ctg_pac_medico_cabe_espe_").val(strId);

        }

        function fntSelectDrop1() {

            var strId = $("#ctg_pac_medico_espe1").val();

            //   alert(strId + "                         strId");

            $("#ctg_pac_medico_espe1_").val(strId);

        }

        function fntSelectDrop2() {

            var strId = $("#ctg_pac_medico_espe2").val();

            //   alert(strId + "                         strId");

            $("#ctg_pac_medico_espe2_").val(strId);

        }

        function fntSelectDrop3() {

            var strId = $("#ctg_pac_medico_espe3").val();

            //   alert(strId + "                         strId");

            $("#ctg_pac_medico_espe3_").val(strId);

        }

        function fntSelectDrop4() {

            var strId = $("#ctg_pac_medico_espe4").val();

            //   alert(strId + "                         strId");

            $("#ctg_pac_medico_espe4_").val(strId);

        }

        function fntSelectDrop5() {

            var strId = $("#ctg_pac_medico_espe5").val();

            //     alert(strId + "                         strId");

            $("#ctg_pac_medico_espe5_").val(strId);

        }

        function fntSelectDrop6() {

            var strId = $("#ctg_pac_medico_espe6").val();

            //   alert(strId + "                         strId");

            $("#ctg_pac_medico_espe6_").val(strId);

        }

        function fntSelectDrop7() {

            var strId = $("#ctg_pac_medico_espe7").val();

            //   alert(strId + "                         strId");

            $("#ctg_pac_medico_espe7_").val(strId);

        }

        function fntSelectDrop8() {

            var strId = $("#ctg_pac_medico_espe8").val();

            // alert(strId + "                         strId");

            $("#ctg_pac_medico_espe8_").val(strId);

        }

        function fntSelectDrop9() {

            var strId = $("#ctg_pac_medico_espe9").val();

            // alert(strId + "                         strId");

            $("#ctg_pac_medico_espe9_").val(strId);

        }



        function fntDeleteRow_espe() {
            document.getElementById("ctg_pac_medico_cabe_descrip").value = "";
            document.getElementById("ctg_pac_medico_cabe_espe").value = "";
            document.getElementById("ctg_pac_medico_cabe_espe_").value = "";
            document.getElementById("ctg_pac_medico_cabe_code").value = "";
        }

        function fntDeleteRow_1() {
            document.getElementById("ctg_pac_medico_descrip1").value = "";
            document.getElementById("ctg_pac_medico_espe1").value = "";
            document.getElementById("ctg_pac_medico_espe1_").value = "";
            document.getElementById("ctg_pac_medico_code1").value = "";
        }

        function fntDeleteRow_2() {
            document.getElementById("ctg_pac_medico_descrip2").value = "";
            document.getElementById("ctg_pac_medico_espe2").value = "";
            document.getElementById("ctg_pac_medico_espe2_").value = "";
            document.getElementById("ctg_pac_medico_code2").value = "";
        }

        function fntDeleteRow_3() {
            document.getElementById("ctg_pac_medico_descrip3").value = "";
            document.getElementById("ctg_pac_medico_espe3").value = "";
            document.getElementById("ctg_pac_medico_espe3_").value = "";
            document.getElementById("ctg_pac_medico_code3").value = "";
        }

        function fntDeleteRow_4() {
            document.getElementById("ctg_pac_medico_descrip4").value = "";
            document.getElementById("ctg_pac_medico_espe4").value = "";
            document.getElementById("ctg_pac_medico_espe4_").value = "";
            document.getElementById("ctg_pac_medico_code4").value = "";
        }

        function fntDeleteRow_5() {
            document.getElementById("ctg_pac_medico_descrip5").value = "";
            document.getElementById("ctg_pac_medico_espe5").value = "";
            document.getElementById("ctg_pac_medico_espe5_").value = "";
            document.getElementById("ctg_pac_medico_code5").value = "";
        }

        function fntDeleteRow_6() {
            document.getElementById("ctg_pac_medico_descrip6").value = "";
            document.getElementById("ctg_pac_medico_espe6").value = "";
            document.getElementById("ctg_pac_medico_espe6_").value = "";
            document.getElementById("ctg_pac_medico_code6").value = "";
        }

        function fntDeleteRow_7() {
            document.getElementById("ctg_pac_medico_descrip7").value = "";
            document.getElementById("ctg_pac_medico_espe7").value = "";
            document.getElementById("ctg_pac_medico_espe7_").value = "";
            document.getElementById("ctg_pac_medico_code7").value = "";
        }

        function fntDeleteRow_8() {
            document.getElementById("ctg_pac_medico_descrip8").value = "";
            document.getElementById("ctg_pac_medico_espe8").value = "";
            document.getElementById("ctg_pac_medico_espe8_").value = "";
            document.getElementById("ctg_pac_medico_code8").value = "";
        }

        function fntDeleteRow_9() {
            document.getElementById("ctg_pac_medico_descrip9").value = "";
            document.getElementById("ctg_pac_medico_espe9").value = "";
            document.getElementById("ctg_pac_medico_espe9_").value = "";
            document.getElementById("ctg_pac_medico_code9").value = "";
        }



        window.addEventListener('load', fntSelect, false)
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

        th {
            background: #d6eaf8 !important;
        }
    </style>
</body>