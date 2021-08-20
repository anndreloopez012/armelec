<body>
    <section class="content col-md-12">
        <div class="col-md-12">
            <p>
                <p>
                    <a class="btn btn-raised btn-info" href="index.php" role="button" aria-expanded="false" href="index.php">Menu</a>
                    <a class="btn btn-raised btn-info" href="doctorsPatient.php" role="button" href="index.php">Regresar</a>
                    <a class="btn btn-raised btn-info btn-center" type="button" data-toggle="collapse" data-target="#AddCita" aria-expanded="false" aria-controls="AddCita">Medicamentos Suministrados</a>

                </p>
                <div class=" collapse show" id="AddCita">
                    <div class="card card-body">
                        <div class="card card-primary collapsed-card">
                            <div class="card-body " style="display: block;">
                                <form id="formData" method="POST">
                                    <div class="row">
                                        <input class="form-control" type="hidden" id="code" name="code" value="<?php echo  $cod_id; ?>">
                                        <div class="form-group col-md-1">
                                            <a href=" " data-toggle="modal" id="btn1" data-target="#basicExampleModal1"><i class="fad fa-2x fa-search"></i></a>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Nombres" class="color-label">Nombre Del Medicamento</label>
                                            <input type="text" class="form-control" id="ctg_pac_medica_espe1" name="ctg_pac_medica_espe1" value="<?php echo  $ctg_pac_medica_espe1; ?>">
                                            <input type="hidden" class="form-control" id="ctg_pac_medica_code1" name="ctg_pac_medica_code1" value="<?php echo  $ctg_pac_medica_code1; ?>">
                                            <span class="bmd-help"> Ingresas sus dos nombres</span>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="Fecha" class=" color-label">Cronico</label>
                                            <input type="checkbox" value="1" class="form-control" id="ctg_pac_medica_cron1" name="ctg_pac_medica_cron1">
                                            <input type="hidden" class="form-control" id="hid_ctg_pac_medica_cron1" name="hid_ctg_pac_medica_cron1" value="<?php echo  $ctg_pac_medica_cron1; ?>">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Estado" class=" color-label">Frecuencia</label>
                                            <?php
                                                $strSelected1_1 = ($ctg_pac_medica_freq1 == 1) ? "selected='selected'" : '';
                                                $strSelected2_1 = ($ctg_pac_medica_freq1 == 2) ? "selected='selected'" : '';
                                                $strSelected3_1 = ($ctg_pac_medica_freq1 == 3) ? "selected='selected'" : '';
                                            ?>
                                            <select class="form-control" id="ctg_pac_medica_freq1" name="ctg_pac_medica_freq1">
                                                <option  value="0">Seleccionar</option>
                                                <option <?php print $strSelected1_1; ?> value="1">Diaria</option>
                                                <option <?php print $strSelected2_1; ?> value="2">Mensual</option>
                                                <option <?php print $strSelected3_1; ?> value="3">Semanal</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Fecha" class=" color-label">Fecha</label>
                                            <input type="date" class="form-control" id="ctg_pac_medica_date1" name="ctg_pac_medica_date1" value="<?php echo  $ctg_pac_medica_date1; ?>">
                                        </div>

                                        <div class="form-group col-md-1">
                                            <a href=" " data-toggle="modal" id="btn2" data-target="#basicExampleModal2"><i class="fad fa-2x fa-search"></i></a>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Nombres" class="color-label">Nombre Del Medicamento</label>
                                            <input type="text" class="form-control" id="ctg_pac_medica_espe2" name="ctg_pac_medica_espe2" value="<?php echo  $ctg_pac_medica_espe2; ?>">
                                            <input type="hidden" class="form-control" id="ctg_pac_medica_code2" name="ctg_pac_medica_code2" value="<?php echo  $ctg_pac_medica_code2; ?>">
                                            <span class="bmd-help"> Ingresas sus dos nombres</span>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="Fecha" class=" color-label">Cronico</label>
                                            <input type="checkbox" value="1" class="form-control" id="ctg_pac_medica_cron2" name="ctg_pac_medica_cron2">
                                            <input type="hidden" class="form-control" id="hid_ctg_pac_medica_cron2" name="hid_ctg_pac_medica_cron2" value="<?php echo  $ctg_pac_medica_cron2; ?>">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Estado" class=" color-label">Frecuencia</label>
                                            <?php
                                                $strSelected1_2 = ($ctg_pac_medica_freq2 == 1) ? "selected='selected'" : '';
                                                $strSelected2_2 = ($ctg_pac_medica_freq2 == 2) ? "selected='selected'" : '';
                                                $strSelected3_2 = ($ctg_pac_medica_freq2 == 3) ? "selected='selected'" : '';
                                            ?>
                                            <select class="form-control" id="ctg_pac_medica_freq2" name="ctg_pac_medica_freq2" value="<?php echo  $ctg_pac_medica_freq2; ?>">
                                                <option value="0">Seleccionar</option>
                                                <option <?php print $strSelected1_2; ?> value="1">Diaria</option>
                                                <option <?php print $strSelected2_2; ?> value="2">Mensual</option>
                                                <option <?php print $strSelected3_2; ?> value="3">Semanal</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Fecha" class=" color-label">Fecha</label>
                                            <input type="date" class="form-control" id="ctg_pac_medica_date2" name="ctg_pac_medica_date2" value="<?php echo  $ctg_pac_medica_date2; ?>">
                                        </div>

                                        <div class="form-group col-md-1">
                                            <a href=" " data-toggle="modal" id="btn3" data-target="#basicExampleModal3"><i class="fad fa-2x fa-search"></i></a>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Nombres" class="color-label">Nombre Del Medicamento</label>
                                            <input type="text" class="form-control" id="ctg_pac_medica_espe3" name="ctg_pac_medica_espe3" value="<?php echo  $ctg_pac_medica_espe3; ?>">
                                            <input type="hidden" class="form-control" id="ctg_pac_medica_code3" name="ctg_pac_medica_code3" value="<?php echo  $ctg_pac_medica_code3; ?>">
                                            <span class="bmd-help"> Ingresas sus dos nombres</span>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="Fecha" class=" color-label">Cronico</label>
                                            <input type="checkbox" value="1" class="form-control" id="ctg_pac_medica_cron3" name="ctg_pac_medica_cron3">
                                            <input type="hidden" class="form-control" id="hid_ctg_pac_medica_cron3" name="hid_ctg_pac_medica_cron3" value="<?php echo  $ctg_pac_medica_cron3; ?>">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Estado" class=" color-label">Frecuencia</label>
                                            <?php
                                                $strSelected1_3 = ($ctg_pac_medica_freq3 == 1) ? "selected='selected'" : '';
                                                $strSelected2_3 = ($ctg_pac_medica_freq3 == 2) ? "selected='selected'" : '';
                                                $strSelected3_3 = ($ctg_pac_medica_freq3 == 3) ? "selected='selected'" : '';
                                            ?>
                                            <select class="form-control" id="ctg_pac_medica_freq1" name="ctg_pac_medica_freq3" value="<?php echo  $ctg_pac_medica_freq3; ?>">
                                                <option value="0">Seleccionar</option>
                                                <option <?php print $strSelected1_3; ?> value="1">Diaria</option>
                                                <option <?php print $strSelected2_3; ?> value="2">Mensual</option>
                                                <option <?php print $strSelected3_3; ?> value="3">Semanal</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Fecha" class=" color-label">Fecha</label>
                                            <input type="date" class="form-control" id="ctg_pac_medica_date1" name="ctg_pac_medica_date3" value="<?php echo  $ctg_pac_medica_date3; ?>">
                                        </div>

                                        <div class="form-group col-md-1">
                                            <a href=" " data-toggle="modal" id="btn4" data-target="#basicExampleModal4"><i class="fad fa-2x fa-search"></i></a>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Nombres" class="color-label">Nombre Del Medicamento</label>
                                            <input type="text" class="form-control" id="ctg_pac_medica_espe4" name="ctg_pac_medica_espe4" value="<?php echo  $ctg_pac_medica_espe4; ?>">
                                            <input type="hidden" class="form-control" id="ctg_pac_medica_code4" name="ctg_pac_medica_code4" value="<?php echo  $ctg_pac_medica_code4; ?>">
                                            <span class="bmd-help"> Ingresas sus dos nombres</span>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="Fecha" class=" color-label">Cronico</label>
                                            <input type="checkbox" value="1" class="form-control" id="ctg_pac_medica_cron4" name="ctg_pac_medica_cron4">
                                            <input type="hidden" class="form-control" id="hid_ctg_pac_medica_cron4" name="hid_ctg_pac_medica_cron4" value="<?php echo  $ctg_pac_medica_cron4; ?>">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Estado" class=" color-label">Frecuencia</label>
                                            <?php
                                                $strSelected1_4 = ($ctg_pac_medica_freq4 == 1) ? "selected='selected'" : '';
                                                $strSelected2_4 = ($ctg_pac_medica_freq4 == 2) ? "selected='selected'" : '';
                                                $strSelected3_4 = ($ctg_pac_medica_freq4 == 3) ? "selected='selected'" : '';
                                            ?>
                                            <select class="form-control" id="ctg_pac_medica_freq4" name="ctg_pac_medica_freq4" value="<?php echo  $ctg_pac_medica_freq4; ?>">
                                                <option value="0">Seleccionar</option>
                                                <option <?php print $strSelected1_4; ?> value="1">Diaria</option>
                                                <option <?php print $strSelected2_4; ?> value="2">Mensual</option>
                                                <option <?php print $strSelected3_4; ?> value="3">Semanal</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Fecha" class=" color-label">Fecha</label>
                                            <input type="date" class="form-control" id="ctg_pac_medica_date4" name="ctg_pac_medica_date4" value="<?php echo  $ctg_pac_medica_date4; ?>">
                                        </div>

                                        <div class="form-group col-md-1">
                                            <a href=" " data-toggle="modal" id="btn5" data-target="#basicExampleModal5"><i class="fad fa-2x fa-search"></i></a>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Nombres" class="color-label">Nombre Del Medicamento</label>
                                            <input type="text" class="form-control" id="ctg_pac_medica_espe5" name="ctg_pac_medica_espe5" value="<?php echo  $ctg_pac_medica_espe5; ?>">
                                            <input type="hidden" class="form-control" id="ctg_pac_medica_code5" name="ctg_pac_medica_code5" value="<?php echo  $ctg_pac_medica_code5; ?>">
                                            <span class="bmd-help"> Ingresas sus dos nombres</span>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="Fecha" class=" color-label">Cronico</label>
                                            <input type="checkbox" value="1" class="form-control" id="ctg_pac_medica_cron5" name="ctg_pac_medica_cron5">
                                            <input type="hidden" class="form-control" id="hid_ctg_pac_medica_cron5" name="hid_ctg_pac_medica_cron5" value="<?php echo  $ctg_pac_medica_cron5; ?>">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Estado" class=" color-label">Frecuencia</label>
                                            <?php
                                                $strSelected1_5 = ($ctg_pac_medica_freq5 == 1) ? "selected='selected'" : '';
                                                $strSelected2_5 = ($ctg_pac_medica_freq5 == 2) ? "selected='selected'" : '';
                                                $strSelected3_5 = ($ctg_pac_medica_freq5 == 3) ? "selected='selected'" : '';
                                            ?>
                                            <select class="form-control" id="ctg_pac_medica_freq5" name="ctg_pac_medica_freq5" value="<?php echo  $ctg_pac_medica_freq5; ?>">
                                                <option value="0">Seleccionar</option>
                                                <option <?php print $strSelected1_5; ?> value="1">Diaria</option>
                                                <option <?php print $strSelected2_5; ?> value="2">Mensual</option>
                                                <option <?php print $strSelected3_5; ?> value="3">Semanal</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Fecha" class=" color-label">Fecha</label>
                                            <input type="date" class="form-control" id="ctg_pac_medica_date5" name="ctg_pac_medica_date5" value="<?php echo  $ctg_pac_medica_date5; ?>">
                                        </div>

                                        <div class="form-group col-md-1">
                                            <a href=" " data-toggle="modal" id="btn6" data-target="#basicExampleModal6"><i class="fad fa-2x fa-search"></i></a>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Nombres" class="color-label">Nombre Del Medicamento</label>
                                            <input type="text" class="form-control" id="ctg_pac_medica_espe6" name="ctg_pac_medica_espe6" value="<?php echo  $ctg_pac_medica_espe6; ?>">
                                            <input type="hidden" class="form-control" id="ctg_pac_medica_code6" name="ctg_pac_medica_code6" value="<?php echo  $ctg_pac_medica_code6; ?>">
                                            <span class="bmd-help"> Ingresas sus dos nombres</span>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="Fecha" class=" color-label">Cronico</label>
                                            <input type="checkbox" value="1" class="form-control" id="ctg_pac_medica_cron6" name="ctg_pac_medica_cron6">
                                            <input type="hidden" class="form-control" id="hid_ctg_pac_medica_cron6" name="hid_ctg_pac_medica_cron6" value="<?php echo  $ctg_pac_medica_cron6; ?>">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Estado" class=" color-label">Frecuencia</label>
                                            <?php
                                                $strSelected1_6 = ($ctg_pac_medica_freq6 == 1) ? "selected='selected'" : '';
                                                $strSelected2_6 = ($ctg_pac_medica_freq6 == 2) ? "selected='selected'" : '';
                                                $strSelected3_6 = ($ctg_pac_medica_freq6 == 3) ? "selected='selected'" : '';
                                            ?>
                                            <select class="form-control" id="ctg_pac_medica_freq6" name="ctg_pac_medica_freq6" value="<?php echo  $ctg_pac_medica_freq6; ?>">
                                                <option value="0">Seleccionar</option>
                                                <option <?php print $strSelected1_6; ?> value="1">Diaria</option>
                                                <option <?php print $strSelected2_6; ?> value="2">Mensual</option>
                                                <option <?php print $strSelected3_6; ?> value="3">Semanal</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Fecha" class=" color-label">Fecha</label>
                                            <input type="date" class="form-control" id="ctg_pac_medica_date6" name="ctg_pac_medica_date6" value="<?php echo  $ctg_pac_medica_date6; ?>">
                                        </div>

                                        <div class="form-group col-md-1">
                                            <a href=" " data-toggle="modal" id="btn7" data-target="#basicExampleModal7"><i class="fad fa-2x fa-search"></i></a>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Nombres" class="color-label">Nombre Del Medicamento</label>
                                            <input type="text" class="form-control" id="ctg_pac_medica_espe7" name="ctg_pac_medica_espe7" value="<?php echo  $ctg_pac_medica_espe7; ?>">
                                            <input type="hidden" class="form-control" id="ctg_pac_medica_code7" name="ctg_pac_medica_code7" value="<?php echo  $ctg_pac_medica_code7; ?>">
                                            <span class="bmd-help"> Ingresas sus dos nombres</span>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="Fecha" class=" color-label">Cronico</label>
                                            <input type="checkbox" value="1" class="form-control" id="ctg_pac_medica_cron7" name="ctg_pac_medica_cron7">
                                            <input type="hidden" class="form-control" id="hid_ctg_pac_medica_cron7" name="hid_ctg_pac_medica_cron7" value="<?php echo  $ctg_pac_medica_cron7; ?>">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Estado" class=" color-label">Frecuencia</label>
                                            <?php
                                                $strSelected1_7 = ($ctg_pac_medica_freq7 == 1) ? "selected='selected'" : '';
                                                $strSelected2_7 = ($ctg_pac_medica_freq7 == 2) ? "selected='selected'" : '';
                                                $strSelected3_7 = ($ctg_pac_medica_freq7 == 3) ? "selected='selected'" : '';
                                            ?>
                                            <select class="form-control" id="ctg_pac_medica_freq7" name="ctg_pac_medica_freq7" value="<?php echo  $ctg_pac_medica_freq7; ?>">
                                                <option value="0">Seleccionar</option>
                                                <option <?php print $strSelected1_7; ?> value="1">Diaria</option>
                                                <option <?php print $strSelected2_7; ?> value="2">Mensual</option>
                                                <option <?php print $strSelected3_7; ?> value="3">Semanal</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Fecha" class=" color-label">Fecha</label>
                                            <input type="date" class="form-control" id="ctg_pac_medica_date7" name="ctg_pac_medica_date7" value="<?php echo  $ctg_pac_medica_date7; ?>">
                                        </div>

                                        <div class="form-group col-md-1">
                                            <a href=" " data-toggle="modal" id="btn8" data-target="#basicExampleModal8"><i class="fad fa-2x fa-search"></i></a>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Nombres" class="color-label">Nombre Del Medicamento</label>
                                            <input type="text" class="form-control" id="ctg_pac_medica_espe8" name="ctg_pac_medica_espe8" value="<?php echo  $ctg_pac_medica_espe8; ?>">
                                            <input type="hidden" class="form-control" id="ctg_pac_medica_code8" name="ctg_pac_medica_code8" value="<?php echo  $ctg_pac_medica_code8; ?>">
                                            <span class="bmd-help"> Ingresas sus dos nombres</span>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="Fecha" class=" color-label">Cronico</label>
                                            <input type="checkbox" value="1" class="form-control" id="ctg_pac_medica_cron8" name="ctg_pac_medica_cron8">
                                            <input type="hidden" class="form-control" id="hid_ctg_pac_medica_cron8" name="hid_ctg_pac_medica_cron8" value="<?php echo  $ctg_pac_medica_cron8; ?>">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Estado" class=" color-label">Frecuencia</label>
                                            <?php
                                                $strSelected1_8 = ($ctg_pac_medica_freq8 == 1) ? "selected='selected'" : '';
                                                $strSelected2_8 = ($ctg_pac_medica_freq8 == 2) ? "selected='selected'" : '';
                                                $strSelected3_8 = ($ctg_pac_medica_freq8 == 3) ? "selected='selected'" : '';
                                            ?>
                                            <select class="form-control" id="ctg_pac_medica_freq8" name="ctg_pac_medica_freq8" value="<?php echo  $ctg_pac_medica_freq8; ?>">
                                                <option value="0">Seleccionar</option>
                                                <option <?php print $strSelected1_8; ?> value="1">Diaria</option>
                                                <option <?php print $strSelected2_8; ?> value="2">Mensual</option>
                                                <option <?php print $strSelected3_8; ?> value="3">Semanal</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Fecha" class=" color-label">Fecha</label>
                                            <input type="date" class="form-control" id="ctg_pac_medica_date8" name="ctg_pac_medica_date8" value="<?php echo  $ctg_pac_medica_date8; ?>">
                                        </div>

                                        <div class="form-group col-md-1">
                                            <a href=" " data-toggle="modal" id="btn9" data-target="#basicExampleModal9"><i class="fad fa-2x fa-search"></i></a>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Nombres" class="color-label">Nombre Del Medicamento</label>
                                            <input type="text" class="form-control" id="ctg_pac_medica_espe9" name="ctg_pac_medica_espe9" value="<?php echo  $ctg_pac_medica_espe9; ?>">
                                            <input type="hidden" class="form-control" id="ctg_pac_medica_code9" name="ctg_pac_medica_code9" value="<?php echo  $ctg_pac_medica_code9; ?>">
                                            <span class="bmd-help"> Ingresas sus dos nombres</span>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="Fecha" class=" color-label">Cronico</label>
                                            <input type="checkbox" value="1" class="form-control" id="ctg_pac_medica_cron9" name="ctg_pac_medica_cron9">
                                            <input type="hidden" class="form-control" id="hid_ctg_pac_medica_cron9" name="hid_ctg_pac_medica_cron9" value="<?php echo  $ctg_pac_medica_cron9; ?>">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Estado" class=" color-label">Frecuencia</label>
                                            <?php
                                                $strSelected1_9 = ($ctg_pac_medica_freq9 == 1) ? "selected='selected'" : '';
                                                $strSelected2_9 = ($ctg_pac_medica_freq9 == 2) ? "selected='selected'" : '';
                                                $strSelected3_9 = ($ctg_pac_medica_freq9 == 3) ? "selected='selected'" : '';
                                            ?>
                                            <select class="form-control" id="ctg_pac_medica_freq9" name="ctg_pac_medica_freq9" value="<?php echo  $ctg_pac_medica_freq9; ?>">
                                                <option value="0">Seleccionar</option>
                                                <option <?php print $strSelected1_9; ?> value="1">Diaria</option>
                                                <option <?php print $strSelected2_9; ?> value="2">Mensual</option>
                                                <option <?php print $strSelected3_9; ?> value="3">Semanal</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Fecha" class=" color-label">Fecha</label>
                                            <input type="date" class="form-control" id="ctg_pac_medica_date9" name="ctg_pac_medica_date9" value="<?php echo  $ctg_pac_medica_date9; ?>">
                                        </div>
                                    </div>
                                </form>
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
                </div>
    </section>
    <div class="modal fade bd-example-modal-lg" id="basicExampleModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100" id="myModalLabel">MEDICAMENTOS</h4>
                    <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12 row">
                        <div class="col-sm-6">
                            <input class="form-control" name="Search" id="Search" type="text" style="text-transform:uppercase;" placeholder="Escribe el dato a buscar">
                        </div>
                        <div>
                            <a type="button" class="btn btn-info" onchange="fntDibujoTabla1() "><i class="fad fa-2x fa-search"></i></a>
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
                    <h4 class="modal-title w-100" id="myModalLabel">MEDICAMENTOS</h4>
                    <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12 row">
                        <div class="col-sm-6">
                            <input class="form-control" name="Search" id="Search" type="text" style="text-transform:uppercase;" placeholder="Escribe el dato a buscar">
                        </div>
                        <div>
                            <a type="button" class="btn btn-info" onchange="fntDibujoTabla2() "><i class="fad fa-2x fa-search"></i></a>
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
                    <h4 class="modal-title w-100" id="myModalLabel">MEDICAMENTOS</h4>
                    <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12 row">
                        <div class="col-sm-6">
                            <input class="form-control" name="Search" id="Search" type="text" style="text-transform:uppercase;" placeholder="Escribe el dato a buscar">
                        </div>
                        <div>
                            <a type="button" class="btn btn-info" onchange="fntDibujoTabla3() "><i class="fad fa-2x fa-search"></i></a>
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
                    <h4 class="modal-title w-100" id="myModalLabel">MEDICAMENTOS</h4>
                    <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12 row">
                        <div class="col-sm-6">
                            <input class="form-control" name="Search" id="Search" type="text" style="text-transform:uppercase;" placeholder="Escribe el dato a buscar">
                        </div>
                        <div>
                            <a type="button" class="btn btn-info" onchange="fntDibujoTabla4() "><i class="fad fa-2x fa-search"></i></a>
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
                    <h4 class="modal-title w-100" id="myModalLabel">MEDICAMENTOS</h4>
                    <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12 row">
                        <div class="col-sm-6">
                            <input class="form-control" name="Search" id="Search" type="text" style="text-transform:uppercase;" placeholder="Escribe el dato a buscar">
                        </div>
                        <div>
                            <a type="button" class="btn btn-info" onchange="fntDibujoTabla5() "><i class="fad fa-2x fa-search"></i></a>
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
                    <h4 class="modal-title w-100" id="myModalLabel">MEDICAMENTOS</h4>
                    <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12 row">
                        <div class="col-sm-6">
                            <input class="form-control" name="Search" id="Search" type="text" style="text-transform:uppercase;" placeholder="Escribe el dato a buscar">
                        </div>
                        <div>
                            <a type="button" class="btn btn-info" onchange="fntDibujoTabla6() "><i class="fad fa-2x fa-search"></i></a>
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
                    <h4 class="modal-title w-100" id="myModalLabel">MEDICAMENTOS</h4>
                    <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12 row">
                        <div class="col-sm-6">
                            <input class="form-control" name="Search" id="Search" type="text" style="text-transform:uppercase;" placeholder="Escribe el dato a buscar">
                        </div>
                        <div>
                            <a type="button" class="btn btn-info" onchange="fntDibujoTabla7() "><i class="fad fa-2x fa-search"></i></a>
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
                    <h4 class="modal-title w-100" id="myModalLabel">MEDICAMENTOS</h4>
                    <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12 row">
                        <div class="col-sm-6">
                            <input class="form-control" name="Search" id="Search" type="text" style="text-transform:uppercase;" placeholder="Escribe el dato a buscar">
                        </div>
                        <div>
                            <a type="button" class="btn btn-info" onchange="fntDibujoTabla8() "><i class="fad fa-2x fa-search"></i></a>
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
                    <h4 class="modal-title w-100" id="myModalLabel">MEDICAMENTOS</h4>
                    <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12 row">
                        <div class="col-sm-6">
                            <input class="form-control" name="Search" id="Search" type="text" style="text-transform:uppercase;" placeholder="Escribe el dato a buscar">
                        </div>
                        <div>
                            <a type="button" class="btn btn-info" onchange="fntDibujoTabla9() "><i class="fad fa-2x fa-search"></i></a>
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

        document.getElementById('btn1').style.display = 'none';
        document.getElementById('btn2').style.display = 'none';
        document.getElementById('btn3').style.display = 'none';
        document.getElementById('btn4').style.display = 'none';
        document.getElementById('btn5').style.display = 'none';
        document.getElementById('btn6').style.display = 'none';
        document.getElementById('btn7').style.display = 'none';
        document.getElementById('btn8').style.display = 'none';
        document.getElementById('btn9').style.display = 'none';

        $(document).ready(function() {
            $('input,textarea,select').attr('readonly', true)
        });

        function fntSelectEdit() {

            document.getElementById('btnEdit').style.display = 'none';
            document.getElementById('btnUpdate').style.display = 'block';

            document.getElementById('btn1').style.display = 'block';
            document.getElementById('btn2').style.display = 'block';
            document.getElementById('btn3').style.display = 'block';
            document.getElementById('btn4').style.display = 'block';
            document.getElementById('btn5').style.display = 'block';
            document.getElementById('btn6').style.display = 'block';
            document.getElementById('btn7').style.display = 'block';
            document.getElementById('btn8').style.display = 'block';
            document.getElementById('btn9').style.display = 'block';

            $('input,textarea,select').attr('readonly', false)

        }


        function fntSelect() {
            //VALIDAR CHECK

            var str_ctg_pac_medica_cron1 = $("#hid_ctg_pac_medica_cron1").val();
            var str_ctg_pac_medica_cron2 = $("#hid_ctg_pac_medica_cron2").val();
            var str_ctg_pac_medica_cron3 = $("#hid_ctg_pac_medica_cron3").val();
            var str_ctg_pac_medica_cron4 = $("#hid_ctg_pac_medica_cron4").val();
            var str_ctg_pac_medica_cron5 = $("#hid_ctg_pac_medica_cron5").val();
            var str_ctg_pac_medica_cron6 = $("#hid_ctg_pac_medica_cron6").val();
            var str_ctg_pac_medica_cron7 = $("#hid_ctg_pac_medica_cron7").val();
            var str_ctg_pac_medica_cron8 = $("#hid_ctg_pac_medica_cron8").val();
            var str_ctg_pac_medica_cron9 = $("#hid_ctg_pac_medica_cron9").val();


            // alert(strDPI + "                         strDPI");

            var boolCheckPass1 = (str_ctg_pac_medica_cron1 == 1) ? true : false;
            $("[name=ctg_pac_medica_cron1]").prop('checked', boolCheckPass1);
            

            var boolCheckPass2 = (str_ctg_pac_medica_cron2 == 1) ? true : false;
            $("[name=ctg_pac_medica_cron2]").prop('checked', boolCheckPass2);
            //$("#ctg_pac_medica_cron2").val(str_ctg_pac_medica_cron2);

            var boolCheckPass3 = (str_ctg_pac_medica_cron3 == 1) ? true : false;
            $("[name=ctg_pac_medica_cron3]").prop('checked', boolCheckPass3);
           // $("#ctg_pac_medica_cron3").val(str_ctg_pac_medica_cron3);

            var boolCheckPass4 = (str_ctg_pac_medica_cron4 == 1) ? true : false;
            $("[name=ctg_pac_medica_cron4]").prop('checked', boolCheckPass4);
            //$("#ctg_pac_medica_cron4").val(str_ctg_pac_medica_cron4);

            var boolCheckPass5 = (str_ctg_pac_medica_cron5 == 1) ? true : false;
            $("[name=ctg_pac_medica_cron5]").prop('checked', boolCheckPass5);
            //$("#ctg_pac_medica_cron5").val(str_ctg_pac_medica_cron5);

            var boolCheckPass6 = (str_ctg_pac_medica_cron6 == 1) ? true : false;
            $("[name=ctg_pac_medica_cron6]").prop('checked', boolCheckPass6);
            //$("#ctg_pac_medica_cron6").val(str_ctg_pac_medica_cron6);

            var boolCheckPass7 = (str_ctg_pac_medica_cron7 == 1) ? true : false;
            $("[name=ctg_pac_medica_cron7]").prop('checked', boolCheckPass7);
            //$("#ctg_pac_medica_cron7").val(str_ctg_pac_medica_cron7);

            var boolCheckPass8 = (str_ctg_pac_medica_cron8 == 1) ? true : false;
            $("[name=ctg_pac_medica_cron8]").prop('checked', boolCheckPass8);
            //$("#ctg_pac_medica_cron8").val(str_ctg_pac_medica_cron8);

            var boolCheckPass9 = (str_ctg_pac_medica_cron9 == 1) ? true : false;
            $("[name=ctg_pac_medica_cron9]").prop('checked', boolCheckPass9);
           // $("#ctg_pac_medica_cron9").val(str_ctg_pac_medica_cron9);

        };

        function fntSelectView1(intParametro) {
            intParametro = !intParametro ? 0 : intParametro;

            if (intParametro > 0) {

                var strId = $("#hidId_" + intParametro).val();
                var strNombre = $("#hidNombre_" + intParametro).val();

                // alert(strDPI + "                         strDPI");

                $("#ctg_pac_medica_espe1").val(strNombre);
                $("#ctg_pac_medica_code1").val(strId);

            }

        }

        function fntSelectView2(intParametro) {
            intParametro = !intParametro ? 0 : intParametro;

            if (intParametro > 0) {

                var strId = $("#hidId_" + intParametro).val();
                var strNombre = $("#hidNombre_" + intParametro).val();

                // alert(strDPI + "                         strDPI");

                $("#ctg_pac_medica_espe2").val(strNombre);
                $("#ctg_pac_medica_code2").val(strId);

            }

        }

        function fntSelectView3(intParametro) {
            intParametro = !intParametro ? 0 : intParametro;

            if (intParametro > 0) {

                var strId = $("#hidId_" + intParametro).val();
                var strNombre = $("#hidNombre_" + intParametro).val();

                // alert(strDPI + "                         strDPI");

                $("#ctg_pac_medica_espe3").val(strNombre);
                $("#ctg_pac_medica_code3").val(strId);

            }

        }

        function fntSelectView4(intParametro) {
            intParametro = !intParametro ? 0 : intParametro;

            if (intParametro > 0) {

                var strId = $("#hidId_" + intParametro).val();
                var strNombre = $("#hidNombre_" + intParametro).val();

                // alert(strDPI + "                         strDPI");

                $("#ctg_pac_medica_espe4").val(strNombre);
                $("#ctg_pac_medica_code4").val(strId);

            }

        }

        function fntSelectView5(intParametro) {
            intParametro = !intParametro ? 0 : intParametro;

            if (intParametro > 0) {

                var strId = $("#hidId_" + intParametro).val();
                var strNombre = $("#hidNombre_" + intParametro).val();

                // alert(strDPI + "                         strDPI");

                $("#ctg_pac_medica_espe5").val(strNombre);
                $("#ctg_pac_medica_code5").val(strId);

            }

        }

        function fntSelectView6(intParametro) {
            intParametro = !intParametro ? 0 : intParametro;

            if (intParametro > 0) {

                var strId = $("#hidId_" + intParametro).val();
                var strNombre = $("#hidNombre_" + intParametro).val();

                // alert(strDPI + "                         strDPI");

                $("#ctg_pac_medica_espe6").val(strNombre);
                $("#ctg_pac_medica_code6").val(strId);

            }

        }

        function fntSelectView7(intParametro) {
            intParametro = !intParametro ? 0 : intParametro;

            if (intParametro > 0) {

                var strId = $("#hidId_" + intParametro).val();
                var strNombre = $("#hidNombre_" + intParametro).val();

                // alert(strDPI + "                         strDPI");

                $("#ctg_pac_medica_espe7").val(strNombre);
                $("#ctg_pac_medica_code7").val(strId);

            }

        }

        function fntSelectView8(intParametro) {
            intParametro = !intParametro ? 0 : intParametro;

            if (intParametro > 0) {

                var strId = $("#hidId_" + intParametro).val();
                var strNombre = $("#hidNombre_" + intParametro).val();

                // alert(strDPI + "                         strDPI");

                $("#ctg_pac_medica_espe8").val(strNombre);
                $("#ctg_pac_medica_code8").val(strId);

            }

        }

        function fntSelectView9(intParametro) {
            intParametro = !intParametro ? 0 : intParametro;

            if (intParametro > 0) {

                var strId = $("#hidId_" + intParametro).val();
                var strNombre = $("#hidNombre_" + intParametro).val();

                // alert(strDPI + "                         strDPI");

                $("#ctg_pac_medica_espe9").val(strNombre);
                $("#ctg_pac_medica_code9").val(strId);

            }

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