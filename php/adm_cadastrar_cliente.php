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
    $email = $_POST['email'];

    $senha = md5($senha);

    if(empty($nome) || empty($cpf) || empty($senha) || empty($email)){
        $avisos[] = "Preencha todos os campos";
    }else{
        $sql = "INSERT INTO cliente (nome, cpf, senha, email) VALUES ('$nome', '$cpf', '$senha', '$email')";
        $connect->query($sql);
        $avisos[] = "Cliente cadastrado com sucesso";
    }
}else if(isset($_POST['atualizar'])){
    $avisos = array();

    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];

    $senha = md5($senha);

    if(empty($nome) || empty($cpf) || empty($senha) || empty($email) || empty($id)){
        $avisos[] = "Preencha todos os campos";
    }else{
        $sql = "UPDATE cliente SET nome='$nome', cpf='$cpf', senha='$senha', email='$email' WHERE id='$id';";
        $connect->query($sql);
        $avisos[] = "Cliente atualizado com sucesso";
    }
}else if(isset($_POST['ver'])){
    header('Location: adm_ver_cliente.php'); 
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Crud Cliente</title>
    <link rel="stylesheet" type="text/css" href="../css/estilo_adm.css">
</head>


<body>
    <a href="adm_crud.php">Página inicial</a>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <h1>Crud Cliente</h1>
        <p>Id</p>
        <input type="text" name="id" placeholder="insira o id">
        <p>Nome</p>
        <input type="text" name="nome" placeholder="insira o nome">
        <p>CPF</p>
        <input type="text" name="cpf" placeholder="insira o cpf">
        <p>Email</p>
        <input type="email" name="email" placeholder="insira o email">
        <p>Senha</p>
        <input type="text" name="senha" placeholder="insira a senha">
        <br>
        <input type="submit" name="cadastrar" value="Cadastrar">
        <br>
        <input type="submit" name="atualizar" value="Atualizar">
        <br>
        <input type="submit" name="ver" value="Ver Clientes">
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