<!-- ruta de salida -->
<?php $exit = 'index.php'; ?>

<!-- nombre del modulo -->
<?php $tittle = 'BIENVENIDOS'; ?>

<!-- cargando conexion inicial -->
<?php require_once "api/globalFunctions.php" ?>
<?php require_once "data/conexion/tmfAdm.php"; ?>
<?php require_once "api/config.php"; ?>

<!-- cargando dependencias -->
<?php require_once "dependencias.php"; ?>

<!-- consumiendo api-->
<?php require_once "api/preLog/admPreLogMenu.php"; ?>

<!-- cargando nav-->
<?php require_once "layout/nav_prelog.php"; ?>

<!-- cargando menu-->
<?php require_once "layout/preLogMenu.php"; ?>

