<?php session_start();?>
<?php require_once "../../api/globalFunctions.php" ?>

<?php require_once "../../data/log/timeLog.php"; ?>

<?php $exit ='../../data/log/logout.php'; ?>

<?php $tittle = 'MEDICOS / MEDICAMENTOS SUMINISTRADOS ACTUALMENTE'; ?>

<?php require_once "../../api/doctors/admDoctorCurrentlySupplied.php"; ?>
<?php require_once "../../api/admContacto.php"; ?>
<?php require_once "../../api/shop/doctorVaccineShop.php"; ?>

<?php require_once "../dependencias_app.php"; ?>

<?php require_once "../../data/conexion/tmfAdm.php"; ?>
<?php require_once "../../api/config.php"; ?>

<?php require_once "../../api/doctors/admDoctorCurrentlySuppliedAJAX.php"; ?>
<?php require_once "../../api/admContactoAJAX.php"; ?>
<?php require_once "../../layout/Nav.php"; ?>

<?php require_once "../../layout/doctors/DoctorCurrentlySuppliedComponent.php"; ?>

<?php require_once "../dependencias_app_footer.php"; ?>