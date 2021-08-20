<?php 
    session_start();
?>
<?php require_once "../../api/globalFunctions.php" ?>

<?php require_once "../../data/log/timeLog.php"; ?>

<?php $exit ='../../data/log/logout.php'; ?>

<?php $tittle = 'MEDICOS / TUS CONSULTAS'; ?>

<?php require_once "../../api/doctors/medDoctorsQuery.php"; ?>
<?php require_once "../../api/admContacto.php"; ?>

<?php require_once "../../api/shop/doctorFarmacShop.php"; ?>
<?php require_once "../../api/shop/doctorHospitalShop.php"; ?>
<?php require_once "../../api/shop/doctorLaboratoryShop.php"; ?>
<?php require_once "../../api/shop/doctorVaccineShop.php"; ?>

<?php require_once "../dependencias_app.php"; ?>
<?php require_once "../../data/conexion/tmfAdm.php"; ?>
<?php require_once "../../api/config.php"; ?>

<?php require_once "../../api/doctors/medDoctorsQueryAJAX.php"; ?>
<?php require_once "../../api/admContactoAJAX.php"; ?>

<?php require_once "../../layout/Nav.php"; ?>

<?php require_once "../../layout/doctors/DoctorsQuerysComponent.php"; ?>

<?php require_once "../dependencias_app_footer.php"; ?>