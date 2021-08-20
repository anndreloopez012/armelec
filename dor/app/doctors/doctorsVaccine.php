<?php session_start();?>
<?php require_once "../../api/globalFunctions.php" ?>

<?php require_once "../../data/log/timeLog.php"; ?>

<?php $exit ='../../data/log/logout.php'; ?>

<?php $tittle = 'MEDICOS / TUS VACUNAS'; ?>

<?php require_once "../../api/doctors/medDoctorVaccine.php"; ?>
<?php require_once "../../api/admContacto.php"; ?>
<?php require_once "../dependencias_app.php"; ?>
<?php require_once "../../data/conexion/tmfAdm.php"; ?>
<?php require_once "../../api/config.php"; ?>

<?php require_once "../../api/doctors/medDoctorVaccineAJAX.php"; ?>
<?php require_once "../../api/admContactoAJAX.php"; ?>
<?php require_once "../../layout/Nav.php"; ?>

<?php require_once "../../layout/doctors/DoctorsVaccineListComponent.php"; ?>

<?php require_once "../dependencias_app_footer.php"; ?>