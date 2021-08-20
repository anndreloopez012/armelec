
<?php session_start();?>
<?php require_once "../../api/globalFunctions.php" ?>

<?php require_once "../../data/log/timeLog.php"; ?>

<?php $exit ='../../data/log/logout.php'; ?>

<?php $mod = '2110'; ?>

<?php require_once "../../data/conexion/tmfAdm.php"; ?>
<?php require_once "../../api/config.php"; ?>

<?php require_once "../../api/admLenguaje.php" ?>

<?php $tittle = $_SESSION['M_020110']; ?>

<?php require_once "../../api/doctors/medDoctorsPerfilInfo.php"; ?>
<?php require_once "../../api/admContacto.php"; ?>
<?php require_once "../dependencias_app.php"; ?>
<?php require_once "../../data/conexion/tmfAdm.php"; ?>
<?php require_once "../../api/config.php"; ?>

<?php require_once "../../api/doctors/medDoctorsPerfilInfoAJAX.php"; ?>
<?php require_once "../../api/admContactoAJAX.php"; ?>
<?php require_once "../../layout/Nav.php"; ?>

<?php require_once "../../layout/doctors/DoctorsPerfilInfoComponent.php"; ?>

<?php require_once "../dependencias_app_footer.php"; ?>