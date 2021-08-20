<?php session_start();?>
<?php require_once "../../api/globalFunctions.php"; ?>

<?php require_once "../../data/log/timeLog.php"; ?>

<?php $exit ='../../data/log/logout.php'; ?>

<?php $tittle = 'INFORMACION PERSONAL / TU PERFIL'; ?>

<?php require_once "../../api/patient/admPatientPerfil.php"; ?>
<?php require_once "../../api/admContacto.php"; ?>
<?php require_once "../dependencias_app.php"; ?>

<?php require_once "../../data/conexion/tmfAdm.php"; ?>
<?php require_once "../../api/config.php"; ?>

<?php require_once "../../api/patient/admPatientPerfilAJAX.php"; ?>
<?php require_once "../../api/admContactoAJAX.php"; ?>
<?php require_once "../../layout/Nav.php"; ?>

<?php require_once "../../layout/patient/PerfilInfoComponent..php"; ?>

<?php require_once "../dependencias_app_footer.php"; ?>