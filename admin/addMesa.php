<?php
require_once '../conect.php';
session_start();
if((empty($_SESSION['id'])) or (empty($_SESSION['nome']))) {header("location: ../index.php");}
$r = $db->query("INSERT INTO mesa VALUES ()");
$_SESSION['msg'] = "<br><div class='alert alert-success alert-dismissible fade show' role='alert'>Mesa adicionada!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
header("location: mesas.php");