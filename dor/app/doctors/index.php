<?php session_start();?>
<?php 
$vSesion = "doc";
// require_once "../../data/log/valide_session.php";

?>
<?php require_once "../../api/globalFunctions.php" ?>

<?php require_once "../../data/log/timeLog.php"; ?>

<?php $exit ='../../data/log/logout.php'; ?>

<?php $menu = 2; ?>

<?php $mod = '21'; ?>
<?php require_once "../../api/admContacto.php"; ?>
<?php require_once "../../data/conexion/tmfAdm.php"; ?>
<?php require_once "../../api/config.php"; ?>

<?php require_once "../../api/admLenguaje.php" ?>

<?php $tittle = $_SESSION['M_0201']; ?>

<?php require_once "../dependencias_app.php"; ?>

<?php require_once "../../api/admContactoAJAX.php"; ?>

<?php require_once "../../api/admMenu.php"; ?>

<?php require_once "../../layout/Nav.php"; ?>

<?php require_once "../../layout/Menu.php"; ?>

<?php require_once "../dependencias_app_footer.php"; ?>


