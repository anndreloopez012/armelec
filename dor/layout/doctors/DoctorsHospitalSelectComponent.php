<body>
    <section class="content col-md-12">
        <div class="col-md-12">
        <p>
        <p>
            <a class="btn btn-raised btn-info" href="../../app/doctors/index.php" role="button" aria-expanded="false" href="index.php">Menu</a>
            <a class="btn btn-raised btn-info btn-center" type="button" data-toggle="collapse" data-target="#patient" aria-expanded="false" aria-controls="patient">Hospital</a>
            <?php if ($mensaje != "") { ?>
                <?PHP echo $mensaje; ?>
                <a class="btn btn-raised btn-info btn-center" type="button" onclick="fntNuevoMostrarVacineShop()">VER CARRITO</a>
            <?php } ?>
        </p>
        <?php if (!empty($_SESSION['CARRITO'])) { ?>
            <div class="collapse" id="shop">
                <div class="card card-body">
                    <div class="card card-primary collapsed-card">
                        <div class="card-body">
                            <table id="tableShop" class="table table-bordered table-striped table-hover table-sm">
                                <thead>
                                    <tr class="table-info">
                                        <th>Farmacia</th>
                                        <th>Medicamento</th>
                                        <th>Direccion</th>
                                        <th>Zona</th>
                                        <th>Precio</th>
                                        <th>Agregar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($_SESSION['CARRITO'] as $indice => $producto) { ?>
                                        <tr>
                                            <td><?php echo $producto['ctg_far_nomcom'] ?></td>
                                            <td><?php echo $producto['ctg_fap_nomcom'] ?></td>
                                            <td><?php echo $producto['ctg_far_dir'] ?></td>
                                            <td><?php echo $producto['ctg_far_zona'] ?></td>
                                            <td><?php echo $producto['ctg_fap_pre'] ?></td>

                                            <td>
                                                <form action="" method="post">
                                                    <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['ID'], COD, KEY);  ?>">
                                                    <button class="btn btn-danger" name="btnAccion" value="eliminar" type="submit"><i class="fas fa-ban"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php } else { ?>
                            <div class="alert alert-success">
                                No hay productos en el carrito
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="collapse show" id="patient">
                <div class="card card-body">
                    <div class="card card-primary collapsed-card">
                        <div class="col-sm-12 row">
                            <div class="col-sm-6">
                                <input class="form-control" name="Search" id="Search" type="text" style="text-transform:uppercase;" placeholder="Escriba el dato a buscar">
                            </div>
                            <div>
                                <a type="button" class="btn btn-info" onchange="fntDibujoTabla() "><i class="fad fa-2x fa-search"></i></a>
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
            </div>
        </div>
    </section>
    <script>

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
</body>