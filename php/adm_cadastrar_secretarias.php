<?php
include 'conexao.php';
session_start();
if(isset($_SESSION['logado_sec'])){
    }else{
        header('Location: index.php');
    }

if(isset($_POST['cadastrar'])){
    $avisos = array();

    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];

    if(empty($nome) || empty($cpf) || empty($senha)){
        $avisos[] = "Preencha todos os campos";
    }else{
        $sql = "INSERT INTO secretaria (nome_sec, cpf_sec, senha_sec) VALUES ('$nome', '$cpf', '$senha')";
        $connect->query($sql);
        $avisos[] = "Secretário(a) cadastrado com sucesso";
    }
}else if(isset($_POST['atualizar'])){
    $avisos = array();

    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha']; 
    if(empty($nome) || empty($cpf) || empty($senha)){
        $avisos[] = "Preencha todos os campos";
    }else{
        $sql = "UPDATE secretaria SET nome_sec='$nome', cpf_sec='$cpf' WHERE cpf_sec='$cpf';";
        $connect->query($sql);
        $avisos[] = "Secretário(a) atualizado com sucesso";
    }
}else if(isset($_POST['ver'])){
    header('Location: adm_ver_sec.php'); 
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Crud Secretários(as)</title>
    <link rel="stylesheet" type="text/css" href="../css/estilo_adm.css">
</head>
<body>
    <a href="adm_crud.php">Página inicial</a>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <h1>Crud Secretários(as)</h1>
        <p>Nome</p>
        <input type="text" name="nome" placeholder="insira o nome">
        <p>CPF</p>
        <input type="text" name="cpf" placeholder="insira o cpf">
        <p>Senha</p>
        <input type="text" name="senha" placeholder="insira a senha">
        <br>
        <input type="submit" name="cadastrar" value="Cadastrar">
        <br>
        <input type="submit" name="atualizar" value="Atualizar">
        <br>
        <input type="submit" name="ver" value="Ver Secretários(as)">
        <br>
    </form>
    <div class="avisos">
        <?php 
            if(!empty($avisos)){
                foreach($avisos as $aviso){
                    echo "<li>".$aviso."</li>";
                }
            }
        ?>
    </div>
</body>
</html>