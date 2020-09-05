<?php
    require_once '../conect.php';
    session_start();
    if((empty($_SESSION['id'])) or (empty($_SESSION['nome']))) {header("location: ../index.php");}
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
    <link rel="stylesheet" href="../estilo.css">
    <link rel="shortcut icon" href="https://img.icons8.com/pastel-glyph/64/000000/dining-room.png">
    <title>FoodsTech</title>
</head>
<body>
<div class="container-fluid">


    <div class="row">
        <div class="col-sm-12" id="menu">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="index.php"><img src="https://img.icons8.com/pastel-glyph/24/000000/dining-room.png"/> FoodsTech</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link" href="index.php">Home</a>
                        <a class="nav-link active" href="atendentes.php">Atendentes</a>
                        <a class="nav-link" href="itens.php">Itens</a>
                        <a class="nav-link" href="mesas.php">Mesas</a>
                        <a class="nav-link" href="../logout.php" id="logout">Logout</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <h1>Atendentes</h1>
            <?if($_SESSION['msg']!=null){echo $_SESSION['msg'];$_SESSION['msg']=null;}?>
            <a href="addAtendente.php" class="btn btn-dark btn-sm">Adicionar</a>
            <br><br>
            <h3>Ativos</h3>
            <?php
                $r = $db->query("SELECT * FROM atendente WHERE ativo=1 ORDER BY nome");
                $linhas = $r->fetchAll(PDO::FETCH_ASSOC);
                foreach($linhas as $l) {
                    echo "<p>".$l['nome']." <small>(Cod ".$l['id'].")</small> <a href='edAtendente.php?id=".base64_encode($l['id'])."' class='btn btn-warning btn-sm'>Editar</a> <a href='inatAtendente.php?id=".base64_encode($l['id'])."' class='btn btn-danger btn-sm'>Inativar</a></p><hr>";
                }
            ?>
            <br>
            <h3>Inativos</h3>
            <?php
                $r = $db->query("SELECT * FROM atendente WHERE ativo=0 ORDER BY nome");
                $linhas = $r->fetchAll(PDO::FETCH_ASSOC);
                foreach($linhas as $l) {
                    echo "<p class='text-muted'>".$l['nome']." <small>(Cod ".$l['id'].")</small> <a href='atAtendente.php?id=".base64_encode($l['id'])."' class='btn btn-success btn-sm'>Ativar</a></p><hr>";
                }
            ?>
        </div>
    </div>


</div>
</body>
</html>