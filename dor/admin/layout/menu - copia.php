<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="../../../lib/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">IRIMS MM 2.0</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../lib/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">ADMIN</a>
        </div>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <?php

        //print_r('<div>');
        //print_r($arrModulo);
        //print_r('</div>');
            if (  is_array($arrModulo) && ( count($arrModulo) >0 )  ){
              reset($arrModulo);
              foreach( $arrModulo as $keyC => $valueC ){
                $boolHasAccesos = isset($valueC["accesos"]) && is_array($valueC["accesos"]) && ( count($valueC["accesos"])>0 );
                ?>
                <li class="nav-item has-treeview">
                  <a href="<?php print (!$boolHasAccesos)?'/app/'.$valueC['link']:'#'; ?>" class="nav-link">
                    <p>
                      <?php echo  $valueC['nombre']; ?>
                      <?php print  ($valueC['btn']!='')?$valueC['btn']:'<i class="right fas fa-angle-left"></i>'; ?>                    
                    </p>
                  </a>
                  <?php
                  if ( $boolHasAccesos  ){
                    reset($valueC["accesos"]);
                    foreach( $valueC["accesos"] as $keyA => $valueA ){
                      $boolHasHijos = isset($valueA["hijos"]) && is_array($valueA["hijos"]) && ( count($valueA["hijos"])>0 );
                      ?>                         
                      <ul class="nav nav-treeview">
                          <li class="nav-item has-treeview">
                            <a href="<?php print (!$boolHasHijos)?'/app/'.$valueA['link']:'#'; ?>" class="nav-link ">
                              <?php print (!$boolHasHijos)?( ($valueA['btn'] != '' )? $valueA['btn']  :'<i class="far fa-circle nav-icon"></i>'):''; ?>
                              <p>
                                <?php echo  $valueA['nombre']; ?>
                                <?php print  ($boolHasHijos)?' <i class="fas fa-share"></i>':''; ?>
                              </p>
                            </a>
                            <?php
                            if( $boolHasHijos ){
                              reset($valueA["hijos"]);
                              foreach( $valueA["hijos"] as $keyH => $valueH ){
                                ?>                         
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                      <a href="<?php print '/app/'.$valueH['link']; ?>" class="nav-link ">
                                        <?php echo  ($valueH['btn'] != '')?$valueH['btn']:''; ?>
                                        <p>
                                          <?php echo  $valueH['nombre']; ?>
                                        </p>
                                      </a>
                                    </li>
                                </ul>
                                <?PHP
                              }
                            }
                            ?>
                          </li>
                      </ul>
                      <?PHP
                    }
                  }
                  ?>
                </li>
                <?php
              }
            }
        ?> 

        </ul>
      </nav>

    </div>
  </aside>




  <nav class="navbar  navbar-dark bg-dark">
    <ul class="nav nav-pills nav-sidebar " data-widget="treeview" role="menu" data-accordion="true">
    <?php

    //print_r('<div>');
    //print_r($arrModulo);
    //print_r('</div>');
        if (  is_array($arrModulo) && ( count($arrModulo) >0 )  ){
          reset($arrModulo);
          foreach( $arrModulo as $keyC => $valueC ){
            $boolHasAccesos = isset($valueC["accesos"]) && is_array($valueC["accesos"]) && ( count($valueC["accesos"])>0 );
            ?>
            <li class="nav-item has-treeview">
              <a href="<?php print (!$boolHasAccesos)?'/app/'.$valueC['link']:'#'; ?>" class="nav-link">
                <p>
                  <?php echo  $valueC['nombre']; ?>
                  <?php print  ($valueC['btn']!='')?$valueC['btn']:'<i class="right fas fa-angle-left"></i>'; ?>                    
                </p>
              </a>
              <?php
              if ( $boolHasAccesos  ){
                reset($valueC["accesos"]);
                foreach( $valueC["accesos"] as $keyA => $valueA ){
                  $boolHasHijos = isset($valueA["hijos"]) && is_array($valueA["hijos"]) && ( count($valueA["hijos"])>0 );
                  ?>                         
                  <ul class="nav nav-treeview" >
                      <li class="nav-item has-treeview">
                        <a href="<?php print (!$boolHasHijos)?'/irims_amd/app/'.$valueA['link']:'#'; ?>" class="nav-link ">
                          <i class="far fa-circle nav-icon"></i>
                          <p>
                            <?php echo  $valueA['nombre']; ?>
                            <?php print  ($boolHasHijos)?'<i class="right fas fa-angle-left"></i>':''; ?>
                          </p>
                        </a>
                        <?php
                        if( $boolHasHijos ){
                          reset($valueA["hijos"]);
                          foreach( $valueA["hijos"] as $keyH => $valueH ){
                            ?>                         
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                  <a href="../<?php print $valueH['link']; ?>" class="nav-link ">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>
                                      <?php echo  $valueH['nombre']; ?>
                                    </p>
                                  </a>
                                </li>
                            </ul>
                            <?PHP
                          }
                        }
                        ?>
                      </li>
                  </ul>
                  <?PHP
                }
              }
              ?>
            </li>
            <?php
          }
        }
    ?> 

    </ul>
  </nav>