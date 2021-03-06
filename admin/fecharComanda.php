<?php
    require_once '../conect.php';
    session_start();
    if((empty($_SESSION['id'])) or (empty($_SESSION['nome']))) {header("location: ../index.php");}

    if((!empty($_GET['idVelho'])) and (!empty($_POST['cpf']))) {
        $r = $db->prepare("SELECT SUM(totPedido) FROM pedido WHERE idComanda=?");
        $r->execute(array($_GET['idVelho']));
        $linhas = $r->fetchAll(PDO::FETCH_ASSOC);
        foreach($linhas as $l) {
            $r = $db->prepare("UPDATE comanda SET dtFechamento=now(),totComanda=?,cpfCliente=? WHERE id=?");
            $r->execute(array($l['SUM(totPedido)'],$_POST['cpf'],$_GET['idVelho']));
            $_SESSION['msg'] = "<br><div class='alert alert-success alert-dismissible fade show' role='alert'>Comanda fechada!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            header("location: index.php");
        }
    }
    if(!empty(base64_decode($_GET['id']))) {
        $r = $db->prepare("SELECT id FROM pedido WHERE idComanda=?");
        $r->execute(array(base64_decode($_GET['id'])));
        if($r->rowCount()==0) {
            $_SESSION['msg'] = "<br><div class='alert alert-danger alert-dismissible fade show' role='alert'>Comanda não possui pedidos!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            header("location: index.php");
        }
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
                        <a class="nav-link" href="atendentes.php">Atendentes</a>
                        <a class="nav-link" href="itens.php">Itens</a>
                        <a class="nav-link" href="mesas.php">Mesas</a>
                        <a class="nav-link" href="historico.php">Histórico</a>
                        <a class="nav-link" href="../logout.php" id="logout">Logout</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <h1>Fechar comanda <?=base64_decode($_GET['id'])?></h1>
            <form action="fecharComanda.php?idVelho=<?=base64_decode($_GET['id'])?>" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" required name="cpf" placeholder="Cpf (xxx.xxx.xxx-xx)">
                </div>
                <button type="button" class="btn btn-danger" onclick="window.location.href='index.php'">Cancelar</button>
                <button type="submit" class="btn btn-success">Finalizar</button>
            </form>
        </div>

        <div class="col-sm-12">
            <?php
                $r = $db->prepare("SELECT * FROM comanda WHERE id=?");
                $r->execute(array(base64_decode($_GET['id'])));
                $lihnas = $r->fetchAll(PDO::FETCH_ASSOC);
                foreach($lihnas as $l) {echo "<p><b>Mesa ".$l['idMesa']." <small>(".$l['dtAbertura'].")</small></b><br>";}
                $r = $db->prepare("SELECT nome FROM atendente WHERE id=?");
                $r->execute(array($l['idAtendente']));
                $linhas2 = $r->fetchAll(PDO::FETCH_ASSOC);
                foreach($linhas2 as $l2) {echo "Atendente ".$l['idAtendente']."- ".$l2['nome']."</p>";}
                $r = $db->prepare("SELECT SUM(totPedido) FROM pedido WHERE idComanda=?");
                $r->execute(array(base64_decode($_GET['id'])));
                $lihnas3 = $r->fetchAll(PDO::FETCH_ASSOC);
                foreach($lihnas3 as $l3) {echo "<h4>Total R$".number_format($l3['SUM(totPedido)'],2,',','')."</h4>";}
            ?>
            <hr>
            <h4>Pedidos:</h4>
            <?php
                $r = $db->prepare("SELECT * FROM pedido WHERE idComanda=? ORDER BY id");
                $r->execute(array(base64_decode($_GET['id'])));
                $linhas = $r->fetchAll(PDO::FETCH_ASSOC);
                foreach($linhas as $l) {
                    echo "<p><b>Pedido ".$l['id']." R$".number_format($l['totPedido'],2,',','')."</b><br>";
                    $r = $db->prepare("SELECT nome,preco FROM item WHERE id=?");
                    $r->execute(array($l['idItem']));
                    $linhas2 = $r->fetchAll(PDO::FETCH_ASSOC);
                    foreach($linhas2 as $l2) {echo $l2['nome']."<small>(Un R$".number_format($l2['preco'],2,',','').")</small> - ".$l['qtdItem']." - Tot R$".number_format(($l2['preco']*$l['qtdItem']),2,',','')." </p>";}
                    echo "<hr>";
                }
            ?>
        </div>
    </div>


</div>
</body>
</html>