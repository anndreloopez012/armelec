<?php 
    session_start();
    define("KEY","develoteca");
    define("COD","aes-128-ECB");
?>
<?php require_once "../../api/globalFunctions.php" ?>

<?php require_once "../../data/log/timeLog.php"; ?>

<?php $exit ='../../data/log/logout.php'; ?>

<?php $tittle = 'PACIENTE / MEDICINA'; ?>

<?php require_once "../../api/global_p/admGlobalMedicine.php"; ?>
<?php require_once "../../api/admContacto.php"; ?>
<?php require_once "../../api/shop/doctorFarmacShop.php"; ?>

<?php require_once "../dependencias_app.php"; ?>

<?php require_once "../../data/conexion/tmfAdm.php"; ?>
<?php require_once "../../api/config.php"; ?>

<?php require_once "../../api/global_p/admGlobalMedicineAJAX.php"; ?>
<?php require_once "../../api/admContactoAJAX.php"; ?>
<?php require_once "../../layout/Nav.php"; ?>

<?php require_once "../../layout/global_p/GlobalMedicineComponentShearch.php"; ?>

<?php require_once "../dependencias_app_footer.php"; ?>