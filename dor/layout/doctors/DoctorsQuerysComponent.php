<div id="loading-screen" style="display:none">
  <img src="../../asset/img/gif/spinning-circles.svg">
</div>
<section class="content col-md-12">
  <p>
    <p>
      <p>
        <p>
          <a class="btn btn-raised btn-info" href="index.php" role="button" aria-expanded="false" href="index.php">Menu</a>
          <a class="btn btn-raised btn-info btn-center" onclick="fntInfo()"><i class="fad fa-2x fa-user" style="color: black;"></i>Informacion <br> Personal </a>
          <a class="btn btn-raised btn-info btn-center" onclick="fntMedicament()"><i class="fad fa-2x fa-tablets" style="color: black;"></i>Seleccion de <br> Medicamentos <b><span style="color:black"> </span></b></a>
          <a class="btn btn-raised btn-info btn-center" onclick="fntVaccine()"><i class="fad fa-2x fa-syringe" style="color: black;"></i>Registro de <br> Vacunas Aplicadas <b><span style="color:black"> </span></b></a>
          <a class="btn btn-raised btn-info btn-center" onclick="fntLaboratory()"><i class="fad fa-2x fa-microscope" style="color: black;"></i> Orden de <br>Laboratorios <b><span style="color:black"></span></b></a>
          <a class="btn btn-raised btn-info btn-center" onclick="fntHospital()"><i class="fad fa-2x fa-hospital" style="color: black;"></i>Orden de <br>Servicios Hospitalarios <b><span style="color:black"> </span></b></a>
          <a class="btn btn-raised btn-warning btn-center" onclick="fntLimpiarSesionesLocal()"><i class="fad fa-2x fa-trash-undo-alt"></i>Limpiar Carrito<b><span style="color:black"> </span></b></a>

          <!--
          <a class="btn btn-raised btn-info btn-center" href="/app/doctors/doctorsMedicineSelect.php"><i class="fad fa-2x fa-tablets" style="color: black;"></i>Seleccion de <br> Medicamentos</a>
          <a class="btn btn-raised btn-info btn-center" href="/app/doctors/doctorsVaccineSelect.php"><i class="fad fa-2x fa-syringe" style="color: black;"></i>Registro de <br> Vacunas Aplicadas</a>
          <a class="btn btn-raised btn-info btn-center" href="/app/doctors/doctorsLaboratorySelect.php"><i class="fad fa-2x fa-microscope" style="color: black;"></i> Orden de <br>Laboratorios</a>
          <a class="btn btn-raised btn-info btn-center" href="/app/doctors/doctorsHospitalSelect.php"><i class="fad fa-2x fa-hospital" style="color: black;"></i>Orden de <br>Servicios Hospitalarios</a>
          -->
        </p>
        <div>
          <?php
          //HOSPITALES
          //print $mensajeHosp;
          //print_r($_POST);

          //MEDICAMENTOS
          //print $mensajeMed;
          //print_r($_SESSION['adm_usr_code']);

          //VACUNAS
          //print $mensajeVacc;
          //print_r($_POST);

          //LABORATORIOS
          //print $mensaje;
          //print_r($_POST);
          ?>
        </div>
        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-12 col-md-12 ">
              <div class=" collapse show" id="personalInfo">
                <div class="card-body">
                  <div class="card-primary collapsed-card">
                    <div class="card-body " style="display: block;">
                      <form id="formData" method="POST">
                        <div class="row">
                          <div class="form-group col-md-2">
                            <a href=" " data-toggle="modal" data-target="#basicExampleModal"><i class="fad fa-2x fa-search"></i></a>&nbsp&nbsp
                            <button type="button" class="btn btn-raised btn-info btn-center" id="Historial" name="Historial" onclick="fntInfoPatient()">Historial</button>
                            <input type="hidden" class="form-control" id="id" name="id">
                            <input type="hidden" class="form-control" id="code" name="code">
                            <input type="hidden" class="form-control" id="correo" name="correo">
                          </div>
                          <div class="form-group col-md-1" >
                            <label for="exampleInputEmail1" class=" color-label">Fecha de la consulta</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>">
                            <input type="hidden" class="form-control" id="hid_fecha_" name="hid_fecha_">
                          </div>
                          <div class="form-group col-md-2">
                            <label for="exampleSelect1" class=" color-label">Tipo de clinica</label>
                            <select class="form-control" id="sanitaria" name="sanitaria">
                              <option value="0">Seleccionar</option>
                              <?php
                              if (is_array($arrSan) && (count($arrSan) > 0)) {
                                reset($arrSan);
                                foreach ($arrSan as $rTMP['key'] => $rTMP['value']) {
                              ?>
                                  <option value="<?php echo  $rTMP["value"]['ctg_uns_cod']; ?>"><?php echo  $rTMP["value"]['ctg_uns_desc']; ?></option>
                              <?PHP
                                }
                              }
                              ?>
                            </select>
                          </div>
                          <div class="form-group col-md-2">
                            <label for="exampleInputEmail1" class=" color-label">No. de DPI </label>
                            <input type="email" class="form-control" id="dpi" name="dpi">
                            <span class="bmd-help"> Ingresas tu numero de identificacion personal</span>
                          </div>
                          <div class="form-group col-md-2">
                            <label for="exampleInputEmail1" class=" color-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre">
                            <input type="hidden" class="form-control" id="nombre_hid" name="nombre_hid">
                            <span class="bmd-help"> Ingresa tus dos nombres </span>
                          </div>
                          <div class="form-group col-md-2">
                            <label for="exampleInputEmail1" class=" color-label">Telefono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono">
                            <span class="bmd-help"> Ingresa tu numero telefonico personal </span>
                          </div>
                          <div class="form-group col-md-2">
                            <label for="exampleSelect1" class=" color-label">Sexo</label>
                            <select class="form-control" id="sexo" name="sexo">
                              <option value="0">Seleccionar</option>
                              <?php
                              if (is_array($arrSexos) && (count($arrSexos) > 0)) {
                                reset($arrSexos);
                                foreach ($arrSexos as $rTMP['key'] => $rTMP['value']) {
                                  $strSelected = ($sexo == $rTMP["value"]['ctg_sex_cod']) ? "selected='selected'" : '';
                              ?>
                                  <option <?php print $strSelected; ?> value="<?php echo  $rTMP["value"]['ctg_sex_cod']; ?>"><?php echo  $rTMP["value"]['ctg_sex_desc']; ?></option>
                              <?PHP
                                }
                              }
                              ?>
                            </select>
                          </div>
                          <div class="form-group col-md-2">
                            <label for="exampleSelect1" class="bmd-label-floating color-label">Región/Departamento</label>
                            <select class="form-control" name="region" id="region" onchange="fntDibujoDropMun() ">
                              <!-- DIBUJO DE DROPDOW DEPARTAMENTO-->
                            </select>
                            <input type="hidden" id="hid_region" name="hid_region">
                          </div>
                          <div class="form-group col-md-2">
                            <label for="exampleSelect1" class="bmd-label-floating color-label">Distrito/Municipio </label>
                            <select class="form-control" name="distrito" id="distrito">
                              <!-- DIBUJO DE DROPDOW MUNISIPIO-->
                            </select>
                            <input type="hidden" id="hid_distrito" name="hid_distrito">
                          </div>
                          <div class="form-group col-md-4">
                            <label for="exampleTextarea" class=" color-label">Direccion</label>
                            <textarea class="form-control" id="direc" name="direc" rows="3"></textarea>
                            <span class="bmd-help">Ingresa tu direccion exacta </span>
                          </div>
                          <div class="form-group col-md-1">
                            <label for="zona" class=" color-label">Zona</label>
                            <input type="email" class="form-control" id="zona" name="zona">
                          </div>
                          <div class="form-group col-md-5">
                            <label for="exampleTextarea" class=" color-label">MOTIVFO DE LA CONSULTA</label>
                            <textarea class="form-control" id="motivo" name="motivo" rows="3"></textarea>
                          </div>

                          <div class="form-group col-md-5">
                            <label for="exampleTextarea" class=" color-label">EXAMEN REALIZADO / DIAGNOSTICO</label>
                            <textarea class="form-control" id="examen" name="examen" rows="3"></textarea>
                          </div>
                          <div class="form-group col-md-2">
                            <label for="exampleSelect1" class=" color-label">Enfermedad Identificada</label>
                            <select class="form-control" id="enfermedad" name="enfermedad">
                              <option value="0">Seleccionar</option>
                              <?php
                              if (is_array($arrEnfermedades) && (count($arrEnfermedades) > 0)) {
                                reset($arrEnfermedades);
                                foreach ($arrEnfermedades as $rTMP['key'] => $rTMP['value']) {
                              ?>
                                  <option value="<?php echo  $rTMP["value"]['ctg_enf_cod']; ?>"><?php echo  $rTMP["value"]['ctg_enf_desc']; ?></option>
                              <?PHP
                                }
                              }
                              ?>
                            </select>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="exampleTextarea" class=" color-label">INDICACIONES EN LA RECETA</label>
                            <textarea class="form-control" id="receta" name="receta" rows="11"></textarea>
                          </div>
                          <div class="form-group col-md-6">
                            <a class="btn btn-raised btn-info" type="button" data-toggle="modal" data-target="#exampleModalDietas">INDICACIONES DE LA DIETA</a>
                            <textarea class="form-control" id="dieta" name="dieta" rows="9"></textarea>
                          </div>
                          <div class="form-group col-md-2">
                            <label for="exampleInputEmail1" class=" color-label">Proxima Cita</label>
                            <input type="date" class="form-control" id="proxima_cita" name="proxima_cita">
                          </div>
                        </div>
                      </form>
                      <div class="row">
                        <div class="col-1 ">
                          <a type="button" class="btn btn-raised btn-primary" id="return" href="index.php"><i class="fad fa-2x fa-arrow-square-left" aria-hidden="true"></i>
                            <div class="ripple-container"></div>
                          </a>
                        </div>
                        <div class="col-1 ">
                          <button type="button" class="btn btn-raised btn-primary" id="btnInsert" onclick="fntInsertMed()"><i class="fad fa-2x fa-save"></i></button>
                        </div>
                        <div class="col-1 ">
                          <button type="button" class="btn btn-raised btn-primary" id="btnUpdate" onclick="fntUpdate()"><i class="fad fa-2x fa-save"></i></button>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-md-1 "></div>
          </div>
        </div>

        <!--------------------------------- MODAL DIETAS-------------------------------------------------------------------------------->

        <div class="modal fade" id="exampleModalDietas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">DIETAS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row"> 
                <div class="col-sm-10">
                  <input class="form-control" name="SearchDieta" id="SearchDieta" type="text" style="text-transform:uppercase;" placeholder="Escriba el dato a buscar">
                </div>
                <div>
                  <a type="button" class="btn btn-info" onclick="fntDibujoTablaDietas() "><i class="fad fa-2x fa-search"></i></a>
                </div>
                </div>
                
                <div id="tableDietas" name="tableDietas">
                  <!-- DIBUJO DE TABLA -->
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <!--------------------------------- TABLAS DE PRIMER NIVEL-------------------------------------------------------------------------------->

        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-12 col-md-12 ">
              <div class=" collapse show" id="med">
                <div class="card-body">
                  <div class="card-primary collapsed-card">
                    <div class="card-body " style="display: block;">
                      <div class="div1">

                        <div class="row">
                          <h4 class="modal-title w-100" id="myModalLabel">MEDICINA</h4>
                          <a type="button" class="btn btn-raised btn-primary" onclick="fntInfo()"><i class="fad fa-2x fa-arrow-square-left"></i></a>&nbsp;&nbsp;
                          <a class="btn btn-raised btn-info btn-center" onclick="fntMedicamentSession()"><i class="fad fa-2x fa-shopping-cart"></i></a>

                          <div class="col-sm-6">
                            <input class="form-control" name="SearchMed" id="SearchMed" type="text" style="text-transform:uppercase;" placeholder="Escriba el dato a buscar">
                          </div>
                          <div>
                            <a type="button" class="btn btn-info" onclick="fntDibujoTablaMed() "><i class="fad fa-2x fa-search"></i></a>
                          </div>
                        </div>

                        <?php
                        if ($mensajeMed) {
                        ?>
                          <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong> <?php echo $mensajeMed; ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        <?php
                        }
                        ?>

                        <input type="hidden" class="form-control" id="filterMed" name="filterMed">
                        <input type="hidden" class="form-control" id="filterMedImg" name="filterMedImg">
                        <input type="hidden" class="form-control" id="filterMedImgPro" name="filterMedImgPro">
                        <div id="tableMed" name="tableMed">
                          <!-- DIBUJO DE TABLA -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-md-1 "></div>
          </div>
        </div>



        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-12 col-md-12 ">
              <div class=" collapse show" id="vaccine">
                <div class="card-body">
                  <div class="card-primary collapsed-card">
                    <div class="card-body " style="display: block;">
                      <div class="div1">

                        <div class="row">
                          <h4 class="modal-title w-100" id="myModalLabel">VACUNAS</h4>
                          <a type="button" class="btn btn-raised btn-primary" onclick="fntInfo()"><i class="fad fa-2x fa-arrow-square-left"></i></a>&nbsp;&nbsp;
                          <a class="btn btn-raised btn-info btn-center" onclick="fntVaccineSession()"><i class="fad fa-2x fa-shopping-cart"></i></a>
                          <div class="col-sm-6">
                            <input class="form-control" name="SearchVac" id="SearchVac" type="text" style="text-transform:uppercase;" placeholder="Escriba el dato a buscar">
                          </div>
                          <div>
                            <a type="button" class="btn btn-info" onclick="fntDibujoTablaVaccine() "><i class="fad fa-2x fa-search"></i></a>
                          </div>
                        </div>

                        <?php
                        if ($mensajeVacc) {
                        ?>
                          <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong> <?php echo $mensajeVacc; ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        <?php
                        }
                        ?>

                        <input type="hidden" class="form-control" id="filterVac" name="filterVac">
                        <div id="tableVaccine" name="tableVaccine">
                          <!-- DIBUJO DE TABLA -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-md-1 "></div>
          </div>
        </div>



        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-12 col-md-12 ">
              <div class=" collapse show" id="exa">
                <div class="card-body">
                  <div class="card-primary collapsed-card">
                    <div class="card-body " style="display: block;">
                      <div class="div1">

                        <div class="row">
                          <h4 class="modal-title w-100" id="myModalLabel">EXAMENES</h4>
                          <a type="button" class="btn btn-raised btn-primary" onclick="fntInfo()"><i class="fad fa-2x fa-arrow-square-left"></i></a>&nbsp;&nbsp;
                          <a class="btn btn-raised btn-info btn-center" onclick="fntLaboratorySession()"><i class="fad fa-2x fa-shopping-cart"></i></a>
                          <div class="col-sm-6">
                            <input class="form-control" name="SearchExa" id="SearchExa" type="text" style="text-transform:uppercase;" placeholder="Escriba el dato a buscar">
                          </div>
                          <div>
                            <a type="button" class="btn btn-info" onclick="fntDibujoTablaLabExa() "><i class="fad fa-2x fa-search"></i></a>
                          </div>
                        </div>

                        <?php
                        if ($mensaje) {
                        ?>
                          <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong> <?php echo $mensaje; ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        <?php
                        }
                        ?>

                        <input type="hidden" class="form-control" id="filterExa" name="filterExa">
                        <div id="tableLabExa" name="tableLabExa">
                          <!-- DIBUJO DE TABLA -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-md-1 "></div>
          </div>
        </div>



        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-12 col-md-12 ">
              <div class=" collapse show" id="serv">
                <div class="card-body">
                  <div class="card-primary collapsed-card">
                    <div class="card-body " style="display: block;">
                      <div class="div1">

                        <div class="row">
                          <h4 class="modal-title w-100" id="myModalLabel">SERVICIOS</h4>
                          <a type="button" class="btn btn-raised btn-primary" onclick="fntInfo()"><i class="fad fa-2x fa-arrow-square-left"></i></a>&nbsp;&nbsp;
                          <a class="btn btn-raised btn-info btn-center" onclick="fntHospitalSession()"><i class="fad fa-2x fa-shopping-cart"></i></a>
                          <div class="col-sm-6">
                            <input class="form-control" name="SearchServ" id="SearchServ" type="text" style="text-transform:uppercase;" placeholder="Escriba el dato a buscar">
                          </div>
                          <div>
                            <a type="button" class="btn btn-info" onclick="fntDibujoTablaHospServ() "><i class="fad fa-2x fa-search"></i></a>
                          </div>
                        </div>

                        <?php
                        if ($mensajeHosp) {
                        ?>
                          <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong> <?php echo $mensajeHosp; ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        <?php
                        }
                        ?>

                        <input type="hidden" class="form-control" id="filterServ" name="filterServ">
                        <div id="tableHospServ" name="tableHospServ">
                          <!-- DIBUJO DE TABLA -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-md-1 "></div>
          </div>
        </div>

        <!--------------------------------- TABLAS DE SEGUNDO NIVEL-------------------------------------------------------------------------------->

        <div class="modal fade" id="modalFar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">

                <div class="row">
                  <h4 class="modal-title w-100" id="myModalLabel">FARMACIAS</h4>
                  <div class="col-sm-10">
                    <input class="form-control" name="SearchFar" id="SearchFar" type="text" style="text-transform:uppercase;" placeholder="Escriba el dato a buscar">
                  </div>
                  <div>
                    <a type="button" class="btn btn-info" onclick="fntDibujoTablaMedFar() "><i class="fad fa-2x fa-search"></i></a>
                  </div>
                </div>

                <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="card-body">
                  <div class="card-primary collapsed-card">
                    <div class="card-body " style="display: block;">
                      <div class="div1">
                        <div id="tableMedFar" name="tableMedFar">
                          <!-- DIBUJO DE TABLA -->
                        </div>
                      </div>
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



        <div class="modal fade" id="modalLab" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">


                <div class="row">
                  <h4 class="modal-title w-100" id="myModalLabel">LABORATORIOS</h4>
                  <div class="col-sm-10">
                    <input class="form-control" name="SearchLab" id="SearchLab" type="text" style="text-transform:uppercase;" placeholder="Escriba el dato a buscar">
                  </div>
                  <div>
                    <a type="button" class="btn btn-info" onclick="fntDibujoTablaLab() "><i class="fad fa-2x fa-search"></i></a>
                  </div>
                </div>

                <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="card-body">
                  <div class="card-primary collapsed-card">
                    <div class="card-body " style="display: block;">
                      <div class="div1">
                        <div id="tableLab" name="tableLab">
                          <!-- DIBUJO DE TABLA -->
                        </div>
                      </div>
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



        <div class="modal fade" id="modalHosp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">

                <div class="row">
                  <h4 class="modal-title w-100" id="myModalLabel">HOSPITALES</h4>
                  <div class="col-sm-10">
                    <input class="form-control" name="SearchHosp" id="SearchHosp" type="text" style="text-transform:uppercase;" placeholder="Escriba el dato a buscar">
                  </div>
                  <div>
                    <a type="button" class="btn btn-info" onclick="fntDibujoTablaHosp() "><i class="fad fa-2x fa-search"></i></a>
                  </div>
                </div>

                <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="card-body">
                  <div class="card-primary collapsed-card">
                    <div class="card-body " style="display: block;">
                      <div class="div1">
                        <div id="tableHospital" name="tableHospital">
                          <!-- DIBUJO DE TABLA -->
                        </div>
                      </div>
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

        <!--------------------------------- MUESTRA DE IMAGEN EN TABLA DE SEGUNDO NIVEL ------------------------------------------------------------------->

        <div class="modal fade" id="modalFarimg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">

                <div class="row">
                  <h4 class="modal-title w-100" id="myModalLabel">&nbsp;&nbsp;&nbsp;&nbsp;IMAGEN DEL MEDICAMENTO</h4>
                </div>

                <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="card-body">
                  <div class="card-primary collapsed-card">
                    <div class="card-body " style="display: block;">
                      <div class="div1">
                        <div id="tableMedFarImg" name="tableMedFarImg">
                          <!-- DIBUJO DE TABLA -->
                        </div>
                      </div>
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


        <!--------------------------------- TABLAS DE SESSION-------------------------------------------------------------------------------->
        <div id="tableCarritoMed" name="tableCarritoMed">
          <!-- DIBUJO DE TABLA -->
        </div>

        <div id="tableCarritoVac" name="tableCarritoVac">
          <!-- DIBUJO DE TABLA -->
        </div>

        <div id="tableCarritoLab" name="tableCarritoLab">
          <!-- DIBUJO DE TABLA -->
        </div>

        <div id="tableCarritoHosp" name="tableCarritoHosp">
          <!-- DIBUJO DE TABLA -->
        </div>
</section>

<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="myModalLabel">PACIENTES</h4>
        <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-primary collapsed-card">
          <div class="col-sm-12 row">
            <div class="col-sm-6">
              <input class="form-control" name="Search" id="Search" type="text" style="text-transform:uppercase;" placeholder="Escriba el dato a buscar">
            </div>
            <div>
              <a type="button" class="btn btn-info" onclick="fntDibujoTablaPatient() "><i class="fad fa-2x fa-search"></i></a>
            </div>
            <div>
              <a type="button" class="btn btn-info" style="cursor:pointer;" alt="Crear Paciente" title="Crear Paciente" href="doctorsPatient.php" target=”_blank”><i class="fad fa-2x fa-user-plus"></i></a>
            </div>
          </div>
          <div class="card-body">
            <div class="div1">
              <div id="Tabla" name="Tabla">
                <!-- DIBUJO DE TABLA CATEGORIA PRODUCTO-->
              </div>
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

<div class="modal fade" id="modalTablaHistorial" tabindex="-1" role="dialog" aria-labelledby="modalTablaHistorial" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="myModalLabel">HISTORIAL DEL PACIENTE</h4>
        <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-primary collapsed-card">
          <div class="card-body">
            <div class="div1">
              <div id="tableHistorial" name="tableHistorial">
                <!-- DIBUJO DE TABLA CATEGORIA PRODUCTO-->
              </div>
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
  document.getElementById("fecha").disabled = true;
  document.getElementById("direc").disabled = true;
  document.getElementById("dpi").disabled = true;
  document.getElementById("nombre").disabled = true;
  document.getElementById("telefono").disabled = true;
  document.getElementById("sexo").disabled = true;
  document.getElementById("region").disabled = true;
  document.getElementById("distrito").disabled = true;
  document.getElementById("zona").disabled = true;
  document.getElementById("Historial").disabled = true;
  document.getElementById('btnInsert').style.display = 'block';
  document.getElementById('btnUpdate').style.display = 'none';

  ////////////////////////////////////////////////////////////////////////////////////////////
  document.getElementById('personalInfo').style.display = 'block';
  document.getElementById('med').style.display = 'none';
  document.getElementById('vaccine').style.display = 'none';
  document.getElementById('exa').style.display = 'none';
  document.getElementById('serv').style.display = 'none';

  /////////////////////////////////////////////PRIMER NIVEL///////////////////////////////////////////////
  function fntSelectView(intParametro) {
    document.getElementById('btnInsert').style.display = 'block';
    document.getElementById('btnUpdate').style.display = 'none';
    document.getElementById("Historial").disabled = false;
    intParametro = !intParametro ? 0 : intParametro;
    if (intParametro > 0) {
      var strId = $("#hidId_" + intParametro).val();
      var strCode = $("#hidCodigo_" + intParametro).val();
      var strDPI = $("#hidDpi_" + intParametro).val();
      var strName = $("#hidName_" + intParametro).val();
      var strSex = $("#hidSex_" + intParametro).val();
      var strReg = $("#hidReg_" + intParametro).val();
      var strDis = $("#hidDis_" + intParametro).val();
      var strCell = $("#hidCell_" + intParametro).val();
      var strAdress = $("#hidAdress_" + intParametro).val();
      var strMail = $("#hidMail_" + intParametro).val();
      // alert(strDPI + "                         strDPI");

      $("#id").val(strId);
      $("#code").val(strCode);
      $("#idPacienteVacuna").val(strCode);
      $("#idPacientebHospital").val(strCode);
      $("#idPacientecLaboratorio").val(strCode);
      $("#idPacientedFarmacia").val(strCode);

      $("#dpi").val(strDPI);

      $("#nombre").val(strName);
      $("#nombre_hid").val(strName);
      $("#nombrePacienteVacuna").val(strName);
      $("#nombrePacientebHospital").val(strName);
      $("#nombrePacientecLaboratorio").val(strName);
      $("#nombrePacientedFarmacia").val(strName);

      $("#sexo").val(strSex);
      $("#Region").val(strReg);
      $("#hid_region").val(strReg);
      $("#hid_distrito").val(strDis);
      $("#distrito").val(strDis);

      $("#hid_distrito").val(strDis);
      $("#telefono").val(strCell);
      $("#direc").val(strAdress);
      $("#correo").val(strMail);
    }
    fntDibujoDropDep()
  }

  function fntSelectViewSession_() {
    var strCode = $("#code").val();
    var strName = $("#nombre").val();
    // alert(strDPI + "                         strDPI");
    $("#idPacienteVacuna").val(strCode);
    $("#idPacientebHospital").val(strCode);
    $("#idPacientecLaboratorio").val(strCode);
    $("#idPacientedFarmacia").val(strCode);

    $("#nombrePacienteVacuna").val(strName);
    $("#nombrePacientebHospital").val(strName);
    $("#nombrePacientecLaboratorio").val(strName);
    $("#nombrePacientedFarmacia").val(strName);
  }

  function fntInfo() {
    document.getElementById('sessionMedicine').style.display = 'none';
    document.getElementById('sessionVaccine').style.display = 'none';
    document.getElementById('sessionLaboratory').style.display = 'none';
    document.getElementById('sessionHospital').style.display = 'none';

    document.getElementById('personalInfo').style.display = 'block';
    document.getElementById('med').style.display = 'none';
    document.getElementById('vaccine').style.display = 'none';
    document.getElementById('exa').style.display = 'none';
    document.getElementById('serv').style.display = 'none';
  }

  function fntMedicament() {
    document.getElementById('sessionMedicine').style.display = 'none';
    document.getElementById('sessionVaccine').style.display = 'none';
    document.getElementById('sessionLaboratory').style.display = 'none';
    document.getElementById('sessionHospital').style.display = 'none';

    document.getElementById('personalInfo').style.display = 'none';
    document.getElementById('med').style.display = 'block';
    document.getElementById('vaccine').style.display = 'none';
    document.getElementById('exa').style.display = 'none';
    document.getElementById('serv').style.display = 'none';

    fntDibujoTablaMed()
  }

  function fntVaccine(intParametro) {
    document.getElementById('sessionMedicine').style.display = 'none';
    document.getElementById('sessionVaccine').style.display = 'none';
    document.getElementById('sessionLaboratory').style.display = 'none';
    document.getElementById('sessionHospital').style.display = 'none';

    document.getElementById('personalInfo').style.display = 'none';
    document.getElementById('med').style.display = 'none';
    document.getElementById('vaccine').style.display = 'block';
    document.getElementById('exa').style.display = 'none';
    document.getElementById('serv').style.display = 'none';

    fntDibujoTablaVaccine()
  }

  function fntLaboratory(intParametro) {
    document.getElementById('sessionMedicine').style.display = 'none';
    document.getElementById('sessionVaccine').style.display = 'none';
    document.getElementById('sessionLaboratory').style.display = 'none';
    document.getElementById('sessionHospital').style.display = 'none';

    document.getElementById('personalInfo').style.display = 'none';
    document.getElementById('med').style.display = 'none';
    document.getElementById('vaccine').style.display = 'none';
    document.getElementById('exa').style.display = 'block';
    document.getElementById('serv').style.display = 'none';

    fntDibujoTablaLabExa()
  }

  function fntHospital(intParametro) {
    document.getElementById('sessionMedicine').style.display = 'none';
    document.getElementById('sessionVaccine').style.display = 'none';
    document.getElementById('sessionLaboratory').style.display = 'none';
    document.getElementById('sessionHospital').style.display = 'none';

    document.getElementById('personalInfo').style.display = 'none';
    document.getElementById('med').style.display = 'none';
    document.getElementById('vaccine').style.display = 'none';
    document.getElementById('exa').style.display = 'none';
    document.getElementById('serv').style.display = 'block';

    fntDibujoTablaHospServ()
  }

  /////////////////////////////////////////////MODALES///////////////////////////////////////////////
  function fntModalFar(intParametro) {
    $("#modalFar").modal()

    intParametro = !intParametro ? 0 : intParametro;
    if (intParametro > 0) {
      var strFilterMed = $("#hidFilterMed_" + intParametro).val();
      // alert(strDPI + "                         strDPI");
      $("#filterMed").val(strFilterMed);
    }

    fntDibujoTablaMedFar()

  }

  function fntModalFarImg(intParametro) {
    $("#modalFar").modal('hide')

    intParametro = !intParametro ? 0 : intParametro;
    if (intParametro > 0) {
      var strFilterMedImg = $("#hidFilterMedImg_" + intParametro).val();
      var strFilterMedImgPro = $("#hidFilterMedImgPro_" + intParametro).val();
      // alert(strFilterMedImgPro + "                         strFilterMedImgPro");
      $("#filterMedImg").val(strFilterMedImg);
      $("#filterMedImgPro").val(strFilterMedImgPro);
    }
    $("#modalFarimg").modal()

    fntDibujoTablaMedFarImg()

  }

  function fntModalFarImgReturn() {
    $("#modalFarimg").modal('hide')

    $("#modalFar").modal()

  }

  function fntModalLab(intParametro) {
    $("#modalLab").modal()

    intParametro = !intParametro ? 0 : intParametro;
    if (intParametro > 0) {
      var strFilterExa = $("#hidFilterExa_" + intParametro).val();
      // alert(strDPI + "                         strDPI");
      $("#filterExa").val(strFilterExa);
    }

    fntDibujoTablaLab()

  }

  function fntModalHosp(intParametro) {
    $("#modalHosp").modal()

    intParametro = !intParametro ? 0 : intParametro;
    if (intParametro > 0) {
      var strFilterServ = $("#hidFilterServ_" + intParametro).val();
      // alert(strDPI + "                         strDPI");
      $("#filterServ").val(strFilterServ);
    }

    fntDibujoTablaHosp()

  }

  ///////////////////////////////////////OPEN TABLE DIETAS //////////////////////////////////////////////////////////////////////////////////////

  function fntSelectDieta(intParametro) {
        intParametro = !intParametro ? 0 : intParametro;
        if (intParametro > 0) {
           
          var strhidMed_die_des_= $("#hidMed_die_des_" + intParametro).val();
            $('#dieta').val( $.trim($('#dieta').val()) +' \n\n\n ' + strhidMed_die_des_ );
        }

        alertify.alert('Dietas', 'Datos cargados en indicaciones de la dieta');
        $('#exampleModalDietas').modal('hide')

    }

  ///////////////////////////////////////OPEN TABLE SESSION //////////////////////////////////////////////////////////////////////////////////////

  function fntMedicamentSession() {
    document.getElementById('sessionMedicine').style.display = 'block';
    document.getElementById('tableMedSession_').style.display = 'block';
    document.getElementById('med').style.display = 'none';
  }

  function fntVaccineSession() {
    document.getElementById('sessionVaccine').style.display = 'block';
    document.getElementById('tableVaccineSession_').style.display = 'block';
    document.getElementById('vaccine').style.display = 'none';
  }

  function fntLaboratorySession() {
    document.getElementById('sessionLaboratory').style.display = 'block';
    document.getElementById('tableLabExaSession_').style.display = 'block';
    document.getElementById('exa').style.display = 'none';
  }

  function fntHospitalSession() {
    document.getElementById('sessionHospital').style.display = 'block';
    document.getElementById('tableHospServSession_').style.display = 'block';
    document.getElementById('serv').style.display = 'none';
  }

  ////////////////////CLOSE TABLE SESSION

  function fntMedicamentSessionClose() {
    document.getElementById('sessionMedicine').style.display = 'none';
    document.getElementById('tableMedSession_').style.display = 'none';
    document.getElementById('med').style.display = 'block';
  }

  function fntVaccineSessionClose() {
    document.getElementById('sessionVaccine').style.display = 'none';
    document.getElementById('tableVaccineSession_').style.display = 'none';
    document.getElementById('vaccine').style.display = 'block';
  }

  function fntLaboratorySessionClose() {
    document.getElementById('sessionLaboratory').style.display = 'none';
    document.getElementById('tableLabExaSession_').style.display = 'none';
    document.getElementById('exa').style.display = 'block';
  }

  function fntHospitalSessionClose() {
    document.getElementById('sessionHospital').style.display = 'none';
    document.getElementById('tableHospServSession_').style.display = 'none';
    document.getElementById('serv').style.display = 'block';
  }
</script>

<style>
  .center {
    text-align: center !important;
  }

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