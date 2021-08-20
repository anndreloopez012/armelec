<?php session_start();?>

<!-- nombre del modulo -->
<?php $tittle = 'LABORATORIOS'; ?>

<!-- nombre del id de menu -->
<?php $menu = 4; ?>
<?php $exit ='../../data/log/logout.php'; ?>
<?php require_once "../../api/globalFunctions.php" ?>


<!-- cargando conexion inicial -->
<?php require_once "../../api/admContacto.php"; ?>
<?php require_once "../../data/conexion/tmfAdm.php"; ?>
<?php require_once "../../api/config.php"; ?>

<!-- cargando dependencias -->
<?php require_once "../dependencias.php"; ?>

<!-- consumiendo api-->
<?php require_once "../../api/admContactoAJAX.php"; ?>
<?php require_once "../../api/admMenu.php"; ?>

<!-- cargando nav-->
<?php require_once "../../layout/Nav.php"; ?>

<!-- cargando menu-->
<?php require_once "../../layout/Menu.php"; ?>

