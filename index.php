<?php
    require_once 'conect.php';
    $erro = null;

    if((!empty($_POST['id'])) and (!empty($_POST['nome']))) {
        if(($_POST['id']==1) and ($_POST['nome']=="admin")) {
            session_start();
            $_SESSION['id'] = $_POST['id'];
            $_SESSION['nome'] = $_POST['nome'];
            $_SESSION['msg'] = null;
            header("location: admin/index.php");
        }
        $r = $db->prepare("SELECT * FROM atendente WHERE id=? AND nome=?");
        $r->execute(array($_POST['id'],$_POST['nome']));
        if($r->rowCount()>0) {
            session_start();
            $_SESSION['id'] = $_POST['id'];
            $_SESSION['nome'] = $_POST['nome'];
            $_SESSION['msg'] = null;
            header("location: atendente/index.php");
        } else {$erro = "<br><div class='alert alert-danger alert-dismissible fade show' role='alert'>Dado(s) incorreto(s)!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";}
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilo.css">
    <link rel="shortcut icon" href="https://img.icons8.com/pastel-glyph/64/000000/dining-room.png">
    <title>FoodsTech</title>
</head>
<body>
<div class="container-fluid">


<div class="row">
    <div class="col-sm-12" id="offline">
        <img src="https://img.icons8.com/pastel-glyph/64/000000/dining-room.png"/>
        <h1>FoodsTech</h1>
        <h5 class="text-muted">Gestor de comandas</h5>
        <form action="index.php" method="post">
            <div class="form-group">
                <input type="number" class="form-control" required name="id" placeholder="código" min=1 max=999>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" required name="nome" placeholder="nome" maxlength="30" style="text-transform: lowercase;">
            </div>
            <input type="submit" class="btn btn-dark" value="Entrar">
        </form>
        <?if($erro!=null){echo $erro;$erro=null;}?>
    </div>
</div>


</div>
</body>
</html>