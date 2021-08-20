<?php 
    session_start();
    define("KEY","develoteca");
    define("COD","aes-128-ECB");
?>
<?php require_once "../../api/globalFunctions.php" ?>


<?php require_once "../../data/log/timeLog.php"; ?>

<?php $exit ='../../data/log/logout.php'; ?>

<?php $tittle = 'PACIENTE / FARMACIAS'; ?>

<?php require_once "../../api/global_p/admGlobalFarmac.php"; ?>
<?php require_once "../../api/shop/doctorFarmacShop.php"; ?>
<?php require_once "../../api/admContacto.php"; ?>
<?php require_once "../dependencias_app.php"; ?>

<?php require_once "../../data/conexion/tmfAdm.php"; ?>
<?php require_once "../../api/config.php"; ?>

<?php require_once "../../api/global_p/admGlobalFarmacAJAX.php"; ?>
<?php require_once "../../api/admContactoAJAX.php"; ?>
<?php require_once "../../layout/Nav.php"; ?>

<?php require_once "../../layout/global_p/GlobalFarmacComponent.php"; ?>

<?php require_once "../dependencias_app_footer.php"; ?>