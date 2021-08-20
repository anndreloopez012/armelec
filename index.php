<?php require_once "api/globalFunctions.php" ?>
<?php require_once "data/conexion/tmfWeb.php"; ?>
<?php require_once "data/conexion/tmfAdm.php"; ?>


<head>
  <?php require_once "dependencias.php"; ?>
</head>
<?php

$arrNation = array();
$var_consulta = "SELECT * FROM ctg_geografia where geo_parent = '0' ORDER BY id ";

$qTMP = pg_query($tmfWeb, $var_consulta);
while ($rTMP = pg_fetch_assoc($qTMP)) {
  $arrNation[$rTMP["id"]]["id"]                               = $rTMP["id"];
  $arrNation[$rTMP["id"]]["geo_flag"]                         = $rTMP["geo_flag"];
  $arrNation[$rTMP["id"]]["geo_desc"]                         = $rTMP["geo_desc"];
  $arrNation[$rTMP["id"]]["geo_obs"]                          = $rTMP["geo_obs"];
}
pg_free_result($qTMP);


$arrTableDoctor = array();
$var_consulta = "SELECT * 
                        FROM ctg_medicos medic
                        INNER JOIN ctg_especialidades as esp
                        ON medic.ctg_med_esp = esp.ctg_esp_cod
                        ORDER BY medic.id  ";
$sql = pg_query($rmfAdm, $var_consulta);
$totalArticle = pg_num_rows($sql);


while ($rTMP = pg_fetch_assoc($sql)) {

  $arrTableDoctor[$rTMP["id"]]["id"]                       = $rTMP["id"];
  $arrTableDoctor[$rTMP["id"]]["ctg_med_col"]              = $rTMP["ctg_med_col"];
  $arrTableDoctor[$rTMP["id"]]["ctg_med_dpi"]              = $rTMP["ctg_med_dpi"];
  $arrTableDoctor[$rTMP["id"]]["ctg_med_code"]             = $rTMP["ctg_med_code"];
  $arrTableDoctor[$rTMP["id"]]["ctg_med_nombres"]          = $rTMP["ctg_med_nombres"];
  $arrTableDoctor[$rTMP["id"]]["ctg_med_apellidos"]        = $rTMP["ctg_med_apellidos"];
  $arrTableDoctor[$rTMP["id"]]["ctg_med_esp"]              = $rTMP["ctg_med_esp"];
  $arrTableDoctor[$rTMP["id"]]["ctg_med_espotr"]           = $rTMP["ctg_med_espotr"];
  $arrTableDoctor[$rTMP["id"]]["ctg_med_sexo"]             = $rTMP["ctg_med_sexo"];
  $arrTableDoctor[$rTMP["id"]]["ctg_med_civil"]            = $rTMP["ctg_med_civil"];
  $arrTableDoctor[$rTMP["id"]]["ctg_med_nac_dia"]          = $rTMP["ctg_med_nac_dia"];
  $arrTableDoctor[$rTMP["id"]]["ctg_med_nac_mes"]          = $rTMP["ctg_med_nac_mes"];
  $arrTableDoctor[$rTMP["id"]]["ctg_med_nac_ano"]          = $rTMP["ctg_med_nac_ano"];
  $arrTableDoctor[$rTMP["id"]]["ctg_med_dir"]              = $rTMP["ctg_med_dir"];
  $arrTableDoctor[$rTMP["id"]]["ctg_med_zona"]             = $rTMP["ctg_med_zona"];
  $arrTableDoctor[$rTMP["id"]]["ctg_med_dep"]              = $rTMP["ctg_med_dep"];
  $arrTableDoctor[$rTMP["id"]]["ctg_med_mun"]              = $rTMP["ctg_med_mun"];
  $arrTableDoctor[$rTMP["id"]]["ctg_med_telcel"]           = $rTMP["ctg_med_telcel"];
  $arrTableDoctor[$rTMP["id"]]["ctg_med_telpar"]           = $rTMP["ctg_med_telpar"];
  $arrTableDoctor[$rTMP["id"]]["ctg_med_email"]            = $rTMP["ctg_med_email"];
  $arrTableDoctor[$rTMP["id"]]["ctg_med_val_con"]          = $rTMP["ctg_med_val_con"];
  $arrTableDoctor[$rTMP["id"]]["ctg_med_sol_dt"]           = $rTMP["ctg_med_sol_dt"];
  $arrTableDoctor[$rTMP["id"]]["ctg_med_aut_dt"]           = $rTMP["ctg_med_aut_dt"];
  $arrTableDoctor[$rTMP["id"]]["ctg_med_ven_dt"]           = $rTMP["ctg_med_ven_dt"];
  $arrTableDoctor[$rTMP["id"]]["ctg_med_pass"]             = $rTMP["ctg_med_pass"];
  $arrTableDoctor[$rTMP["id"]]["ctg_med_username"]         = $rTMP["ctg_med_username"];
  $arrTableDoctor[$rTMP["id"]]["ctg_med_estatus"]          = $rTMP["ctg_med_estatus"];
  $arrTableDoctor[$rTMP["id"]]["ctg_med_infpro"]           = $rTMP["ctg_med_infpro"];
  $arrTableDoctor[$rTMP["id"]]["ctg_med_sta"]              = $rTMP["ctg_med_sta"];
  $arrTableDoctor[$rTMP["id"]]["ctg_med_dt"]               = $rTMP["ctg_med_dt"];
  $arrTableDoctor[$rTMP["id"]]["ctg_med_usr"]              = $rTMP["ctg_med_usr"];
  $arrTableDoctor[$rTMP["id"]]["ctg_esp_desc"]             = $rTMP["ctg_esp_desc"];
}
pg_free_result($sql);

$arrTableFarmac = array();
$var_consulta = "SELECT * FROM ctg_farmacias ORDER BY ctg_fac_nom DESC LIMIT 100";
$sql = pg_query($rmfAdm, $var_consulta);
$totalArticle = pg_num_rows($sql);


while ($rTMP = pg_fetch_assoc($sql)) {

  $arrTableFarmac[$rTMP["id"]]["id"]                       = $rTMP["id"];
  $arrTableFarmac[$rTMP["id"]]["ctg_fac_contrato"]         = $rTMP["ctg_fac_contrato"];
  $arrTableFarmac[$rTMP["id"]]["ctg_fac_razsoc"]         = $rTMP["ctg_fac_razsoc"];
  $arrTableFarmac[$rTMP["id"]]["ctg_fac_nit"]              = $rTMP["ctg_fac_nit"];
  $arrTableFarmac[$rTMP["id"]]["ctg_fac_nom"]           = $rTMP["ctg_fac_nom"];
  $arrTableFarmac[$rTMP["id"]]["ctg_fac_dir"]              = $rTMP["ctg_fac_dir"];
  $arrTableFarmac[$rTMP["id"]]["ctg_fac_tels"]             = $rTMP["ctg_fac_tels"];
}
pg_free_result($sql);

$arrTableHosp = array();
        $var_consulta = "SELECT hop.*
                        FROM ctg_hospitales hop 
                        ORDER BY hop.ctg_hos_nomcom DESC
                        LIMIT 100";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);
        //print_r($var_consulta);


        while ($rTMP = pg_fetch_assoc($sql)) {

  $arrTableHosp[$rTMP["id"]]["id"]                       = $rTMP["id"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_contrato"]         = $rTMP["ctg_hos_contrato"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_nit"]              = $rTMP["ctg_hos_nit"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_nomcom"]           = $rTMP["ctg_hos_nomcom"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_code"]             = $rTMP["ctg_hos_code"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_dir"]              = $rTMP["ctg_hos_dir"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_zona"]             = $rTMP["ctg_hos_zona"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_dep"]              = $rTMP["ctg_hos_dep"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_mun"]              = $rTMP["ctg_hos_mun"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_tels"]             = $rTMP["ctg_hos_tels"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_email"]            = $rTMP["ctg_hos_email"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_ced1"]         = $rTMP["ctg_hos_enc_ced1"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_ced2"]         = $rTMP["ctg_hos_enc_ced2"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_dpi"]          = $rTMP["ctg_hos_enc_dpi"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_nom1"]         = $rTMP["ctg_hos_enc_nom1"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_nom2"]         = $rTMP["ctg_hos_enc_nom2"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_ape1"]         = $rTMP["ctg_hos_enc_ape1"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_ape2"]         = $rTMP["ctg_hos_enc_ape2"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_ape3"]         = $rTMP["ctg_hos_enc_ape3"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_sexo"]         = $rTMP["ctg_hos_enc_sexo"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_civil"]        = $rTMP["ctg_hos_enc_civil"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_nac_dia"]      = $rTMP["ctg_hos_enc_nac_dia"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_nac_mes"]      = $rTMP["ctg_hos_enc_nac_mes"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_nac_ano"]      = $rTMP["ctg_hos_enc_nac_ano"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_dir"]          = $rTMP["ctg_hos_enc_dir"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_zona"]         = $rTMP["ctg_hos_enc_zona"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_dep"]          = $rTMP["ctg_hos_enc_dep"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_mun"]          = $rTMP["ctg_hos_enc_mun"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_cel"]          = $rTMP["ctg_hos_enc_cel"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_tels"]         = $rTMP["ctg_hos_enc_tels"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_email"]        = $rTMP["ctg_hos_enc_email"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_username"]         = $rTMP["ctg_hos_username"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_pass"]             = $rTMP["ctg_hos_pass"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_estatus"]          = $rTMP["ctg_hos_estatus"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_sol_dt"]           = $rTMP["ctg_hos_sol_dt"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_aut_dt"]           = $rTMP["ctg_hos_aut_dt"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_ven_dt"]           = $rTMP["ctg_hos_ven_dt"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_sta"]              = $rTMP["ctg_hos_sta"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_dt"]               = $rTMP["ctg_hos_dt"];
  $arrTableHosp[$rTMP["id"]]["ctg_hos_usr"]              = $rTMP["ctg_hos_usr"];
}
pg_free_result($sql);

$arrTableLab = array();
$var_consulta = "SELECT lab.*  
                FROM ctg_lab_clinicos lab
                ORDER BY lab.ctg_lab_nomcom DESC
                LIMIT 100";
$sql = pg_query($rmfAdm, $var_consulta);
$totalArticle = pg_num_rows($sql);


while ($rTMP = pg_fetch_assoc($sql)) {

    // LAB CLINICOS
    $arrTableLab[$rTMP["id"]]["id"]                       = $rTMP["id"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_contrato"]         = $rTMP["ctg_lab_contrato"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_nit"]              = $rTMP["ctg_lab_nit"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_nomcom"]           = $rTMP["ctg_lab_nomcom"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_suc"]              = $rTMP["ctg_lab_suc"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_code"]             = $rTMP["ctg_lab_code"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_hortda1"]          = $rTMP["ctg_lab_hortda1"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_hortda2"]          = $rTMP["ctg_lab_hortda2"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_dir"]              = $rTMP["ctg_lab_dir"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_zona"]             = $rTMP["ctg_lab_zona"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_mun"]              = $rTMP["ctg_lab_mun"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_tels"]             = $rTMP["ctg_lab_tels"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_email"]            = $rTMP["ctg_lab_email"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_enc_ced1"]         = $rTMP["ctg_lab_enc_ced1"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_enc_ced2"]         = $rTMP["ctg_lab_enc_ced2"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_enc_dpi"]          = $rTMP["ctg_lab_enc_dpi"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_enc_nom1"]         = $rTMP["ctg_lab_enc_nom1"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_enc_nom2"]         = $rTMP["ctg_lab_enc_nom2"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_enc_ape2"]         = $rTMP["ctg_lab_enc_ape2"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_enc_ape3"]         = $rTMP["ctg_lab_enc_ape3"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_enc_sexo"]         = $rTMP["ctg_lab_enc_sexo"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_enc_civil"]        = $rTMP["ctg_lab_enc_civil"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_enc_nac_dia"]      = $rTMP["ctg_lab_enc_nac_dia"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_enc_nac_mes"]      = $rTMP["ctg_lab_enc_nac_mes"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_enc_nac_ano"]      = $rTMP["ctg_lab_enc_nac_ano"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_enc_dir"]          = $rTMP["ctg_lab_enc_dir"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_enc_zona"]         = $rTMP["ctg_lab_enc_zona"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_enc_dep"]          = $rTMP["ctg_lab_enc_dep"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_enc_mun"]          = $rTMP["ctg_lab_enc_mun"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_enc_cel"]          = $rTMP["ctg_lab_enc_cel"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_enc_tels"]         = $rTMP["ctg_lab_enc_tels"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_enc_email"]        = $rTMP["ctg_lab_enc_email"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_username"]         = $rTMP["ctg_lab_username"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_pass"]             = $rTMP["ctg_lab_pass"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_estatus"]          = $rTMP["ctg_lab_estatus"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_censuc"]           = $rTMP["ctg_lab_censuc"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_sol_dt"]           = $rTMP["ctg_lab_sol_dt"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_aut_dt"]           = $rTMP["ctg_lab_aut_dt"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_ven_dt"]           = $rTMP["ctg_lab_ven_dt"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_sta"]              = $rTMP["ctg_lab_sta"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_dt"]               = $rTMP["ctg_lab_dt"];
    $arrTableLab[$rTMP["id"]]["ctg_lab_usr"]              = $rTMP["ctg_lab_usr"];

}
pg_free_result($sql);

$arrTableMed = array();
        $var_consulta = "SELECT pro.*
                        FROM ctg_productos pro
                        ORDER BY pro.ctg_pro_desc ASC
                        LIMIT 100";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);
        //print_r($var_consulta);

        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableMed[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_cod"]              = $rTMP["ctg_pro_cod"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_desc"]             = $rTMP["ctg_pro_desc"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_prinact"]          = $rTMP["ctg_pro_prinact"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_indi"]             = $rTMP["ctg_pro_indi"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_labfar"]           = $rTMP["ctg_pro_labfar"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_fecaut"]           = $rTMP["ctg_pro_fecaut"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_fecven"]           = $rTMP["ctg_pro_fecven"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_psinar"]           = $rTMP["ctg_pro_psinar"];
        }
        pg_free_result($sql);
?>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-info">
    <img src="lib/dist/img/armelec_logo3.png" alt="logo" class="rounded mx-auto d-block" alt="Responsive image">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item ">
        </li>
      </ul>
      <ul class="nav justify-content-center">
        <b class="navbar-brand" ></b>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item d-none d-sm-inline-block">
          <a  class="nav-link">Contacto</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a  class="nav-link">Ayuda</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block active">
          <a  class="nav-link" style="cursor:pointer;  text-align:center;" href="pre_log.php">Ingresar</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block active">
          <a  class="nav-link" style="cursor:pointer;  text-align:center;"  type="button" href="http://visualmed.online/" target="_parent">Inicio</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="modal fade" id="updatemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">

          <h5 class="modal-title" id="exampleModalLabel">Selecciona un pais</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <select class="my-select" onchange="javascript:handleSelect(this)">
              <option selected="selected">Seleccionar</option>
              <?php
              if (is_array($arrNation) && (count($arrNation) > 0)) {
                reset($arrNation);
                foreach ($arrNation as $rTMP['key'] => $rTMP['value']) {
              ?>
                  <option value="<?php echo  $rTMP["value"]['geo_obs']; ?>" data-img-src="lib/dist/img/flags/<?php echo  $rTMP["value"]['geo_flag']; ?>"><?php echo  $rTMP["value"]['geo_desc']; ?></option>
              <?PHP
                }
              }
              ?>
            </select>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>


<div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-1z" data-slide-to="1"></li>
    <li data-target="#carousel-example-1z" data-slide-to="2"></li>
    <li data-target="#carousel-example-1z" data-slide-to="3"></li>
    <li data-target="#carousel-example-1z" data-slide-to="4"></li>
    <li data-target="#carousel-example-1z" data-slide-to="5"></li>
  </ol>
  <div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
      <div class="view">
        <div class="mask rgba-black-light d-flex justify-content-center align-items-center">
          <img src="asset/img/web/0.jpg" class="responsive">
          <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
      </div>
    </div>
    <div class="carousel-item">
      <div class="view">
        <div class="mask rgba-black-light d-flex justify-content-center align-items-center">
          <img src="asset/img/web/1.jpg" class="responsive">
          <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
      </div>
    </div>
    <div class="carousel-item">
      <div class="view">
        <div class="mask rgba-black-light d-flex justify-content-center align-items-center">
          <img src="asset/img/web/2.jpg" class="responsive">

          <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
      </div>
    </div>
    <div class="carousel-item">
      <div class="view">
        <div class="mask rgba-black-light d-flex justify-content-center align-items-center">
          <img src="asset/img/web/3.jpg" class="responsive">
          <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
      </div>
    </div>
    <div class="carousel-item">
      <div class="view">
        <div class="mask rgba-black-light d-flex justify-content-center align-items-center">
          <img src="asset/img/web/4.jpg" class="responsive">
          <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
      </div>
    </div>
    <div class="carousel-item">
      <div class="view">
        <div class="mask rgba-black-light d-flex justify-content-center align-items-center">
          <img src="asset/img/web/5.jpg" class="responsive">
          <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<main>
  <div class="container">
    <section>
      <h2 class="my-5 h3 text-center">Que deseas Buscar?</h2>
      <div class="row features-small mt-4 wow fadeIn">
        <div class="col-xl-1"></div>
        <div class="col-xl-2 col-lg-6 abs-center" data-toggle="modal" data-target="#exampleModalMed" style="cursor:pointer;">
          <div class="row">
            <div class="col-12 abs-center">
              <a > <i class="fad fa-6x fa-pills text-info" style="cursor:pointer;"></i></a>
              <b style="font-size:15px" class="my-5 h4 text-center">MEDICAMENTOS</b>
            </div>
          </div>

        </div>
        <div class="col-xl-2 col-lg-6 abs-center" data-toggle="modal" data-target="#exampleModalDoc" style="cursor:pointer;">
          <div class="row">
            <div class="col-12">
              <a ><i class="fad fa-6x fa-user-md text-info" style="cursor:pointer;"></i></a></br>
              <b style="font-size:15px" class="my-5 h4 text-center">&nbsp;&nbsp; MEDICOS</b>
            </div>
          </div>
        </div>
        <div class="col-xl-2 col-lg-6 abs-center" data-toggle="modal" data-target="#exampleModalFar" style="cursor:pointer;">
          <div class="row">
            <div class="col-12">
              <a ><i class="fad fa-6x fa-laptop-medical text-info" style="cursor:pointer;"></i></a>
              <b style="font-size:15px" class="my-5 h4 text-center">FARMACIAS</b>

            </div>
          </div>
        </div>
        <div class="col-xl-2 col-lg-6 abs-center" data-toggle="modal" data-target="#exampleModalHos" style="cursor:pointer;">
          <div class="row">
            <div class="col-12">
              <a ><i class="fad fa-6x fa-hospitals text-info" style="cursor:pointer;"></i></a>
              <b style="font-size:15px" class="my-5 h4 text-center">HOSPITALES</b>
            </div>
          </div>
        </div>
        <div class="col-xl-2 col-lg-6 abs-center" data-toggle="modal" data-target="#exampleModalLab" style="cursor:pointer;">
          <div class="row">
            <div class="col-12 abs-center">
              <a ><i class="fad fa-6x fa-microscope text-info" style="cursor:pointer;"></i></a>
              <b style="font-size:15px" class="my-5 h4 text-center">LABORATORIOS CLINICOS</b>
            </div>
          </div>
        </div>
        <div class="col-xl-1"></div>
      </div>
    </section>
  </div>

  <div class="modal fade" id="exampleModalDoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalDoc" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="medicos">MEDICOS</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-md-12 tableFixHead">
            <table id="tableFarmac" class="table table-bordered table-striped table-hover table-sm">
              <thead>
                <tr class="table-info">
                  <th>Nombre</th>
                  <th>Especialidad</th>
                  <th>Direccion</th>
                  <th>Telefono</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (is_array($arrTableDoctor) && (count($arrTableDoctor) > 0)) {
                  reset($arrTableDoctor);
                  foreach ($arrTableDoctor as $rTMP['key'] => $rTMP['value']) {
                ?>
                    <tr>
                      <td><?php echo  $rTMP["value"]['ctg_med_nombres'];
                          $rTMP["value"]['ctg_med_apellidos']; ?></td>
                      <td><?php echo  $rTMP["value"]['ctg_esp_desc']; ?></td>
                      <td><?php echo  $rTMP["value"]['ctg_med_dir']; ?></td>
                      <td><?php echo  $rTMP["value"]['ctg_med_telcel']; ?></td>
                    </tr>
                <?PHP
                  }
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="exampleModalFar" tabindex="-1" role="dialog" aria-labelledby="exampleModalFar" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="farmacia">FARMACIA</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-md-12 tableFixHead">
            <table id="tableFarmac" class="table table-bordered table-striped table-hover table-sm">
              <thead>
                <tr class="table-info">
                  <th>Farmacia</th>
                  <th>Direccion</th>
                  <th>Telefono</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (is_array($arrTableFarmac) && (count($arrTableFarmac) > 0)) {
                  reset($arrTableFarmac);
                  foreach ($arrTableFarmac as $rTMP['key'] => $rTMP['value']) {
                ?>
                    <tr>
                      <td><?php echo  $rTMP["value"]['ctg_fac_razsoc']; ?></td>
                      <td><?php echo  $rTMP["value"]['ctg_fac_dir']; ?></td>
                      <td><?php echo  $rTMP["value"]['ctg_fac_tels']; ?></td>
                    </tr>
                <?PHP
                  }
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="exampleModalHos" tabindex="-1" role="dialog" aria-labelledby="exampleModalHos" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="hospital">HOSPITAL</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <div class="col-md-12 tableFixHead">
            <table id="tableHosp" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>Nombre Del Hospital</th>
                        <th>Zona</th>
                        <th>Direccion</th>
                        <th>Telefono</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableHosp) && (count($arrTableHosp) > 0)) {
                        reset($arrTableHosp);
                        foreach ($arrTableHosp as $rTMP['key'] => $rTMP['value']) {
                    ?>
                            <tr>
                                <td><?php echo  $rTMP["value"]['ctg_hos_nomcom']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_hos_zona']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_hos_dir']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_hos_tels']; ?></td>
                            </tr>
                    <?PHP
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="exampleModalLab" tabindex="-1" role="dialog" aria-labelledby="exampleModalLab" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="laboratorio">LABORATORIO</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <div class="col-md-12 tableFixHead">
            <table id="tableFarmac" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>Nombre Del Laboratorio</th>
                        <th>Sucursal</th>
                        <th>Direccion</th>
                        <th>Telefono</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableLab) && (count($arrTableLab) > 0)) {
                        reset($arrTableLab);
                        foreach ($arrTableLab as $rTMP['key'] => $rTMP['value']) {
                    ?>
                            <tr>
                                <td><?php echo  $rTMP["value"]['ctg_lab_nomcom']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_lab_suc']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_lab_dir']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_lab_tels']; ?></td>
                            </tr>
                    <?PHP
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="exampleModalMed" tabindex="-1" role="dialog" aria-labelledby="exampleModalMed" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="medicamentos">MEDICAMENTOS</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <div class="col-md-12 tableFixHead">
            <table id="tableHosp" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>No. de Registro</th>
                        <th>Nombre</th>
                        <th>Principio Activo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableMed) && (count($arrTableMed) > 0)) {
                        $intContador = 1;
                        reset($arrTableMed);
                        foreach ($arrTableMed as $rTMP['key'] => $rTMP['value']) {
                    ?>
                            <tr>
                                <td><?php echo  $rTMP["value"]['ctg_pro_cod']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_pro_desc']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_pro_prinact']; ?></td>
                            </tr>

                    <?PHP
                            $intContador++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</main>

<script>
  $(".my-select").chosen({
    width: "100%",
    height: "50px"
  });
</script>
<script type="text/javascript">
  function handleSelect(elm) {
    window.location = elm.value;
  }
</script>
<style>
  .abs-center {
    text-align: center !important;
  }

  .bg-info {
    background-color:
      #03a9f4 !important;
  }

  .responsive {
    width: 100%;
    height: auto;
  }

.bg-info {
    background-color: 
    #03a9f4 !important;
}

#div1 {
        overflow:scroll !important;
        height:500px !important;
  }
  #div1 table {
      width:100% !important;
  }

  /* FORMA DE TABLAS APP */
  .tableFixHead          { overflow-y: auto; height: 400px; }
  .tableFixHead thead th { position: sticky; top: 0; }

  table  { border-collapse: collapse; width: 100%; }
  th, td { padding: 8px 16px; }
  th     { background:#eee; }
</style>
