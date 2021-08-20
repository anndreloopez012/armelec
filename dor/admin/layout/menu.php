<body >
    <div class=" imgmenu  "> 
        <div class="row">
            <div class="col-12" >
                <img src="../../lib/dist/img/<?php echo $adm_enc_img?>" class="img">
            </div>
            <div class="col-6 ">
                <a>&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $adm_enc_izq_lg?></a>
            </div>
            <div class="col-6 scrmenu">
                <a><?php echo $adm_enc_der_lg?>&nbsp&nbsp&nbsp&nbsp&nbsp</a>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav pull-sm-left">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><?php echo $user?></a>
      </li>
    </ul>
    <ul class="navbar-nav mx-auto">
      <li class="nav-item d-none d-sm-inline-block">
        <a href="home.php" class="nav-link"><b><?php echo $title?></b></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav pull-sm-right">
      <li class="nav-item" data-toggle="tooltip" data-placement="top" title="Home">
        <div id="home" > 
          <a class="nav-link" href="<?php echo $home?>">
            <i class="fas fa-home" ></i>
          </a>
        </div>
      </li>
      <li class="nav-item" data-toggle="tooltip" data-placement="top" title=" New Window">
        <div id="window">
        <a class="nav-link"  href="<?php echo $home?>" target="_blank">
          <i class="far fa-window-restore"></i>
        </a>
        </div>
      </li>
      <li class="nav-item" data-toggle="tooltip" data-placement="top" title="Log out">
        <div id="logout">
          <a class="nav-link"  href="<?php echo $logout?>">
            <i class="fas fa-times-circle"></i>
          </a>
        </div>
      </li>
    </ul>
  </nav>

  <style>
  div.scrmenu{
    text-align: right !important;
  }
  .nav-sidebar .nav-link > .right, .nav-sidebar .nav-link > p > .right {
    position: initial !important;
    right: 1rem;
    top: .7rem;
  }
  .navbar {
    padding: .1rem .1rem;
  }




  .cont {
    text-align: 
    right !important;
  }
  
  .checkRadio {
    text-align: 
    left !important;
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
