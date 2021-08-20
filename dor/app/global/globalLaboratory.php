<?php 
    session_start();
?>
<?php require_once "../../api/globalFunctions.php"; ?>

<?php require_once "../../data/log/timeLog.php"; ?>

<?php $exit ='../../data/log/logout.php'; ?>

<?php $tittle = 'MEDICOS / LABORATORIOS CLINICOS'; ?>

<?php require_once "../../api/global/admGlobalLaboratory.php"; ?>

<?php require_once "../../api/shop/doctorLaboratoryShop.php"; ?>
<?php require_once "../../api/admContacto.php"; ?>
<?php require_once "../dependencias_app.php"; ?>
<?php require_once "../../data/conexion/tmfAdm.php"; ?>
<?php require_once "../../api/config.php"; ?>

<?php require_once "../../api/global/admGlobalLaboratoryAJAX.php"; ?>
<?php require_once "../../api/admContactoAJAX.php"; ?>
<?php require_once "../../layout/Nav.php"; ?>

<?php require_once "../../layout/global/GlobalLaboratoryComponent.php"; ?>

<?php require_once "../dependencias_app_footer.php"; ?>