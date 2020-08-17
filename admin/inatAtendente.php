<?php
require_once '../conect.php';
session_start();
$r = $db->prepare("UPDATE atendente SET ativo=0 WHERE id=?");
$r->execute(array(base64_decode($_GET['id'])));
$_SESSION['msg'] = "<br><div class='alert alert-success alert-dismissible fade show' role='alert'>Atendente inativado!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
header("location: atendentes.php");