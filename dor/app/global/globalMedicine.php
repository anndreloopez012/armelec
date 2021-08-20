<?php 
    session_start();
?>
<?php require_once "../../api/globalFunctions.php" ?>

<?php require_once "../../data/log/timeLog.php"; ?>

<?php $exit ='../../data/log/logout.php'; ?>

<?php $tittle = 'MEDICOS / MEDICINA'; ?>

<?php require_once "../../api/global/admGlobalMedicine.php"; ?>
<?php require_once "../../api/admContacto.php"; ?>
<?php require_once "../../api/shop/doctorFarmacShop.php"; ?>

<?php require_once "../dependencias_app.php"; ?>

<?php require_once "../../data/conexion/tmfAdm.php"; ?>
<?php require_once "../../api/config.php"; ?>

<?php require_once "../../api/global/admGlobalMedicineAJAX.php"; ?>
<?php require_once "../../api/admContactoAJAX.php"; ?>
<?php require_once "../../layout/Nav.php"; ?>

<?php require_once "../../layout/global/GlobalMedicineComponentShearch.php"; ?>

<?php require_once "../dependencias_app_footer.php"; ?>