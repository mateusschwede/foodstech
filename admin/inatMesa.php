<?php
require_once '../conect.php';
session_start();
if((empty($_SESSION['id'])) or (empty($_SESSION['nome']))) {header("location: ../index.php");}
$r = $db->prepare("SELECT id FROM comanda WHERE dtFechamento is null AND idMesa=?");
$r->execute(array(base64_decode($_GET['id'])));
if($r->rowCount()==0) {
    $r = $db->prepare("UPDATE mesa SET ativo=0 WHERE id=?");
    $r->execute(array(base64_decode($_GET['id'])));
    $_SESSION['msg'] = "<br><div class='alert alert-success alert-dismissible fade show' role='alert'>Mesa inativada!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
    header("location: mesas.php");
} else {$_SESSION['msg'] = "<br><div class='alert alert-danger alert-dismissible fade show' role='alert'>Mesa com comanda aberta!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>"; header("location: mesas.php");}