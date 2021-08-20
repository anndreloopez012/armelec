<?php session_start();?>
<?php require_once "../../api/globalFunctions.php"; ?>

<?php require_once "../../data/log/timeLog.php"; ?>

<?php $exit ='../../data/log/logout.php'; ?>

<?php $tittle = 'FARMACIA / PRODUCTOS'; ?>

<?php require_once "../../api/pharmacists/admPharmacistsProducts.php"; ?>
<?php require_once "../../api/admContacto.php"; ?>
<?php require_once "../dependencias_app.php"; ?>

<?php require_once "../../data/conexion/tmfAdm.php"; ?>
<?php require_once "../../api/config.php"; ?>

<?php require_once "../../api/pharmacists/admPharmacistsProductsAJAX.php"; ?>
<?php require_once "../../api/admContactoAJAX.php"; ?>
<?php require_once "../../layout/Nav.php"; ?>

<?php require_once "../../layout/pharmacists/PharmacistsProductComponent.php"; ?>

<?php require_once "../dependencias_app_footer.php"; ?>