<?php
require_once '../conect.php';
session_start();
if((empty($_SESSION['id'])) or (empty($_SESSION['nome']))) {header("location: ../index.php");}
$r = $db->prepare("UPDATE atendente SET ativo=1 WHERE id=?");
$r->execute(array(base64_decode($_GET['id'])));
$_SESSION['msg'] = "<br><div class='alert alert-success alert-dismissible fade show' role='alert'>Atendente ativado!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
header("location: atendentes.php");