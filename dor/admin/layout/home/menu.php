 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="../admin/lib/dist/img/log_fw.png"  class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?php  $NombreUsuarioNav = isset($_SESSION['nombre_completo']) ? $_SESSION['nombre_completo']  : '';?> <?php echo $NombreUsuarioNav ?></span>
    </a><br>

    <!-- Sidebar -->
    <div class="sidebar">

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <?php
            if ( is_array($arrModulo) && ( count($arrModulo)>0 ) ){
                reset($arrModulo);
            foreach( $arrModulo as $rTMP['key'] => $rTMP['value'] ){
        ?>                         
            
          <li class="nav-item">
            <a href="app/<?php echo  $rTMP["value"]['adm_rtu']; ?>" class="nav-link">
            <?php echo  $rTMP["value"]['adm_btn']; ?>
              <p>
                <?php echo  $rTMP["value"]['adm_name']; ?>
              </p>
            </a>
          </li>
                   
        <?PHP
            }
                }
        ?> 

        </ul>
      </nav>

    </div>
  </aside>
  