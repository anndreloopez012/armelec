<?php session_start();?>
<?php require_once "../../api/globalFunctions.php"; ?>

<?php require_once "../../data/log/timeLog.php"; ?>

<?php $exit ='../../data/log/logout.php'; ?>

<?php $tittle = 'LABORATORIOS / PERFIL'; ?>

<?php require_once "../../api/laboratory/admLaboratoryInfo.php"; ?>
<?php require_once "../../api/admContacto.php"; ?>
<?php require_once "../dependencias_app.php"; ?>

<?php require_once "../../data/conexion/tmfAdm.php"; ?>
<?php require_once "../../api/config.php"; ?>

<?php require_once "../../api/laboratory/admLaboratoryInfoAJAX.php"; ?>
<?php require_once "../../api/admContactoAJAX.php"; ?>
<?php require_once "../../layout/Nav.php"; ?>

<?php require_once "../../layout/laboratory/laboratoryInfoComponent.php"; ?>

<?php require_once "../dependencias_app_footer.php"; ?>