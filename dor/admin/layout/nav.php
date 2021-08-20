<body>
  <nav class="navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->

    <li class="nav-item d-none d-sm-inline-block">
      <a class="nav-link"><b>VisualMed.online</b> <img src="../../lib/dist/img/flags/<?php echo $pais?>.jpg" alt="logo" width="30" height="20"></a>
      </li>
    <ul class="navbar-nav mx-auto">
      <li class="nav-item d-none d-sm-inline-block">
       <a href="home.php" class="nav-link"><b><?php echo $title ?></b></a>
      </li>
    </ul>

    <!-- Right navbar links -->

    <ul class="navbar-nav pull-sm-right">
      <li class="nav-item" data-toggle="tooltip" data-placement="top" title=" New Window">
        <div id="window">
          <a class="nav-link" href="<?php echo $home ?>" target="_blank">
            <i class="far fa-window-restore"></i>
          </a>
        </div>
      </li>
      <li class="nav-item">
        <div id="home" data-toggle="tooltip" data-placement="top" title="Hone">
          <a class="nav-link" href="<?php echo $home ?>">
            <i class="fas fa-home"></i>
          </a>
        </div>
      </li>
      <li class="nav-item">
        <div id="logout" data-toggle="tooltip" data-placement="top" title="Log out">
          <a class="nav-link" href="<?php echo $logout ?>">
            <i class="fas fa-times-circle"></i>
          </a>
        </div>
      </li>
    </ul>
  </nav>

  <div id="menu_area" class="menu-area">
    <div class="row">
      <nav class="navbar navbar-light navbar-expand-lg mainmenu">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <?php
            if (is_array($arrModulo) && (count($arrModulo) > 0)) {
              reset($arrModulo);
              foreach ($arrModulo as $keyC => $valueC) {
                $boolHasAccesos = isset($valueC["accesos"]) && is_array($valueC["accesos"]) && (count($valueC["accesos"]) > 0);
            ?>
                <li class="dropdown">
                  <a class="dropdown-toggle" href="<?php print (!$boolHasAccesos) ? '/' . $urlAdm . '/admin/app/' . $valueC['link'] : '#'; ?>" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo  $valueC['nombre']; ?></a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php
                    if ($boolHasAccesos) {
                      reset($valueC["accesos"]);
                      foreach ($valueC["accesos"] as $keyA => $valueA) {
                        $boolHasHijos = isset($valueA["hijos"]) && is_array($valueA["hijos"]) && (count($valueA["hijos"]) > 0);
                        //print_r($valueA);
                    ?>
                        <li class="dropdown">
                          <?php
                          if ($boolHasHijos) {
                          ?>
                            <a class="dropdown-toggle" href='#' id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="far fa-circle nav-icon"></i>&nbsp&nbsp<?php echo  $valueA['nombre']; ?>&nbsp&nbsp<i class="fas fa-arrow-alt-right"></i></a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <?php
                              if ($boolHasHijos) {
                                reset($valueA["hijos"]);
                                foreach ($valueA["hijos"] as $keyH => $valueH) {
                              ?>
                                  <li><a href="/<?php echo  $urlAdm; ?>/admin/app/<?php print $valueH['link']; ?>"><i class="far fa-dot-circle nav-icon"></i>&nbsp&nbsp<?php echo  $valueH['nombre']; ?></a></li>
                              <?php
                                }
                              }
                              ?>
                            </ul>
                          <?php
                          } else {
                          ?>
                            <a class="dropdown-toggle" href="<?php print ($valueA['link'] != '') ?  '/' . $urlAdm . '/admin/app/' . $valueA['link'] : '#'; ?>" id="navbarDropdown" aria-haspopup="true" aria-expanded="false"><i class="far fa-dot-circle nav-icon"></i>&nbsp&nbsp<?php echo  $valueA['nombre']; ?>&nbsp&nbsp</a>
                          <?php
                          }
                          ?>
                        </li>
                    <?PHP
                      }
                    }
                    ?>
                  </ul>
                </li>
            <?php
              }
            }
            ?>
          </ul>
        </div>
      </nav>
    </div>
  </div>




  <style>
    div.scrmenu {
      text-align: right !important;
    }

    .nav-sidebar .nav-link>.right,
    .nav-sidebar .nav-link>p>.right {
      position: initial !important;
      right: 1rem;
      top: .7rem;
    }

    .navbar {
      padding: .1rem .1rem;
    }

    .menu-area {
      background: #333333
    }

    .dropdown-menu {
      padding: 0;
      margin: 0;
      border: 0 solid transition !important;
      border: 0 solid rgba(0, 0, 0, .15);
      border-radius: 0;
      -webkit-box-shadow: none !important;
      box-shadow: none !important
    }

    .mainmenu a,
    .navbar-default .navbar-nav>li>a,
    .mainmenu ul li a,
    .navbar-expand-lg .navbar-nav .nav-link {
      color: #fff;
      font-size: 14px;
      padding: 10px 15px;
      display: block !important;
    }

    .mainmenu .active a,
    .mainmenu .active a:focus,
    .mainmenu .active a:hover,
    .mainmenu li a:hover,
    .mainmenu li a:focus,
    .navbar-default .navbar-nav>.show>a,
    .navbar-default .navbar-nav>.show>a:focus,
    .navbar-default .navbar-nav>.show>a:hover {
      color: #fff;
      background: #6610f2;
      outline: 0;
    }

    /*==========Sub Menu=v==========*/
    .mainmenu .collapse ul>li:hover>a {
      background: #273746;
    }

    .mainmenu .collapse ul ul>li:hover>a,
    .navbar-default .navbar-nav .show .dropdown-menu>li>a:focus,
    .navbar-default .navbar-nav .show .dropdown-menu>li>a:hover {
      background: #212f3d;
    }

    .mainmenu .collapse ul ul ul>li:hover>a {
      background: #273746;
    }

    .mainmenu .collapse ul ul,
    .mainmenu .collapse ul ul.dropdown-menu {
      background: #273746;
    }

    .mainmenu .collapse ul ul ul,
    .mainmenu .collapse ul ul ul.dropdown-menu {
      background: #1c2833;
    }

    .mainmenu .collapse ul ul ul ul,
    .mainmenu .collapse ul ul ul ul.dropdown-menu {
      background: #1c2833;
    }

    /******************************Drop-down menu work on hover**********************************/
    .mainmenu {
      background: none;
      border: 0 solid;
      margin: 0;
      padding: 0;
      min-height: 20px;
      width: 100%;
    }

    @media only screen and (min-width: 767px) {
      .mainmenu .collapse ul li:hover>ul {
        display: block
      }

      .mainmenu .collapse ul ul {
        position: absolute;
        top: 100%;
        left: 0;
        min-width: 250px;
        display: none
      }

      /*******/
      .mainmenu .collapse ul ul li {
        position: relative
      }

      .mainmenu .collapse ul ul li:hover>ul {
        display: block
      }

      .mainmenu .collapse ul ul ul {
        position: absolute;
        top: 0;
        left: 100%;
        min-width: 250px;
        display: none
      }

      /*******/
      .mainmenu .collapse ul ul ul li {
        position: relative
      }

      .mainmenu .collapse ul ul ul li:hover ul {
        display: block
      }

      .mainmenu .collapse ul ul ul ul {
        position: absolute;
        top: 0;
        left: -100%;
        min-width: 250px;
        display: none;
        z-index: 1
      }

    }

    @media only screen and (max-width: 767px) {
      .navbar-nav .show .dropdown-menu .dropdown-menu>li>a {
        padding: 16px 15px 16px 35px
      }

      .navbar-nav .show .dropdown-menu .dropdown-menu .dropdown-menu>li>a {
        padding: 16px 15px 16px 45px
      }
    }

    select {
      -moz-appearance: none;
      -webkit-appearance: none;
      -ms-appearance: none;
      -o-appearance: none;
      appearance: none;
      cursor: pointer;
    }

    .dropdown-toggle::after {
      display: none;
    }




    .cont {
      text-align:
        right !important;
    }

    label.checkRadio {
      text-align:
        left !important;
    }

    .bottomRadio {
      text-align:
        center !important;
    }

    #div1 {
      overflow: scroll !important;
      height: 500px !important;
    }

    #div1 table {
      width: 100% !important;
    }

    /* FORMA DE TABLAS APP */
    .tableFixHead {
      overflow-y: auto;
      height: 400px;
    }

    .tableFixHead thead th {
      position: sticky;
      top: 0;
    }

    table {
      border-collapse: collapse;
      width: 100%;
    }

    th,
    td {
      padding: 8px 16px;
    }

    th {
      background: #eee;
    }
  </style>