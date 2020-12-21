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

   
    if(empty($nome) || empty($cpf)){
        $avisos[] = "Preencha todos os campos";
    }else{
        $sql = "INSERT INTO medico (nome_med, cpf_med) VALUES ('$nome', '$cpf')";
        $connect->query($sql);
        $avisos[] = "Medico cadastrado com sucesso";
    }
}else if(isset($_POST['atualizar'])){
    $avisos = array();

    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];

    if(empty($nome) || empty($cpf) || empty($id)){
        $avisos[] = "Preencha todos os campos";
    }else{
        $sql = "UPDATE medico SET nome_med='$nome', cpf_med='$cpf' WHERE id_med='$id';";
        $connect->query($sql);
        $avisos[] = "Medico atualizado com sucesso";
    }
}else if(isset($_POST['ver'])){
    header('Location: adm_ver_medico.php'); 
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Crud Médico</title>
    <link rel="stylesheet" type="text/css" href="../css/estilo_adm.css">
</head>
<body>
    <a href="adm_crud.php">Página inicial</a>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <h1>Crud Médico</h1>
        <p>Id</p>
        <input type="text" name="id" placeholder="insira o id">
        <p>Nome</p>
        <input type="text" name="nome" placeholder="insira o nome">
        <p>CPF</p>
        <input type="text" name="cpf" placeholder="insira o cpf">
        <br>
        <input type="submit" name="cadastrar" value="Cadastrar">
        <br>
        <input type="submit" name="atualizar" value="Atualizar">
        <br>
        <input type="submit" name="ver" value="Ver Médicos">
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