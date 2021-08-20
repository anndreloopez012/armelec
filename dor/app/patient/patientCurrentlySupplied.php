<?php session_start();?>
<?php require_once "../../api/globalFunctions.php"; ?>

<?php require_once "../../data/log/timeLog.php"; ?>

<?php $exit ='../../data/log/logout.php'; ?>

<?php $tittle = 'MEDICACMENTOS SUMINISTRADOS / TU PERFIL'; ?>

<?php require_once "../../api/patient/admPatientCurrentlySupplied.php"; ?>
<?php require_once "../../api/admContacto.php"; ?>
<?php require_once "../dependencias_app.php"; ?>

<?php require_once "../../data/conexion/tmfAdm.php"; ?>
<?php require_once "../../api/config.php"; ?>

<?php require_once "../../api/patient/admPatientCurrentlySuppliedAJAX.php"; ?>
<?php require_once "../../api/admContactoAJAX.php"; ?>

<?php require_once "../../layout/Nav.php"; ?>

<?php require_once "../../layout/patient/patientCurrentlySuppliedComponent.php"; ?>

<?php require_once "../dependencias_app_footer.php"; ?>