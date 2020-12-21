<?php

include 'conexao.php';
session_start();

if(isset($_POST['btn-cadastrar'])){    
    $nome = mysqli_escape_string($connect, $_POST['nome']);
    $email = mysqli_escape_string($connect, $_POST['email']);
    $cpf = mysqli_escape_string($connect, $_POST['cpf']);
    $senha = mysqli_escape_string($connect, $_POST['senha']);

    $erros  = array();

    if(empty($email) or empty($senha) or empty($cpf) or empty($nome)){
        $erros[] = "Todos os campos precisam ser preenchidos";
    }else{
        $senha = md5($senha);

        $sql = "SELECT email FROM cliente WHERE email='$email'";
        $resultado = $connect->query($sql);

        if(mysqli_num_rows($resultado) == 0){
            $sql = "SELECT * FROM cliente WHERE cpf='$cpf'";
            $resultado = $connect->query($sql);

            if(mysqli_num_rows($resultado) == 0){
                $sql = "SELECT * FROM cliente WHERE senha='$senha'";
                $resultado = $connect->query($sql);
                if(mysqli_num_rows($resultado) == 0){
                    $sql = "INSERT INTO cliente (nome,email,cpf,senha) VALUES ('$nome','$email','$cpf','$senha')";
		            if($connect->query($sql)){
                        $sql = "SELECT * FROM cliente WHERE cpf='$cpf' AND senha='$senha' AND email='$email'";
                        $resultado = $connect->query($sql);

                        $dados =  mysqli_fetch_array($resultado);
                        $_SESSION['logado'] = true;
                        $_SESSION['id_cliente'] = $dados['id'];
                        header('Location: home.php');
                    }else{
                        $erros[] = "Erro na conexão";
                    }
                }else{
                    $erros[] = "Esta senha já é utilizada";
                }
            }else{
                $erros[] = "Este cpf já foi cadastrado";
            }
        }else{
            $erros[] = "Este email já foi cadastrado";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Clinicou - Cadastrar</title>
    <link rel="stylesheet" type="text/css" href="../css/cadastrar1.css">
    <link rel="icon" href="../img/coracao_logo.png" type ="image/x-icon">
</head>
<body>
    <div class="loginBox">
		<img src="../img/teamwork.png" class="user">
        <h2>Cadastrar</h2>
        
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <p>Nome</p>
            <input type="text" name="nome" placeholder="Digite seu nome e sobrenome" maxlength="50">
			<p>Email</p>
            <input type="email" name="email" placeholder="Digite seu email" maxlength="50">
            <p>CPF</p>
            <input type="text" name="cpf" placeholder="Digite seu CPF" maxlength="14">
			<p>Senha</p>
			<input type="password" name="senha" placeholder="Digite sua senha" maxlength="32" id="senha">
            <div id="olho" onclick="ver_senha();"></div>
            <input type="submit" name="btn-cadastrar" value="Cadastrar">
            
            <div class="link"><a href="logar.php">Já é cadastrado? Entre</a></div>
            <div class="link"><a href="index.php">Voltar</a></div>

            <div class="erros">
                <?php 
                    if(!empty($erros)){
                        foreach($erros as $erro){
                            echo "<li>".$erro."</li>";
                        }
                    }
                ?>
            </div>

		</form>
    </div>
    <script>
        var senha = document.getElementById('senha');
        var olho = document.getElementById('olho');

        function ver_senha(){
            if(senha.type === 'password'){
                senha.setAttribute('type', 'text');
                olho.classList.add('mostrar');
            }else{
                senha.setAttribute('type', 'password');
                olho.classList.remove('mostrar');
            }
        }
    </script>
</body>
</html>