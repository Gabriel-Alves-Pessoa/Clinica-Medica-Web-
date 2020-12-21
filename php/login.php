<?php 
    include 'conexao.php';
    session_start();
    if(isset('bnt-login')==true){
    $senha = mysqli_escape_string($connect, $_POST['senha']); // a função mysqli_escape_string() não permite a inserção de tags;
    $email = mysqli_escape_string($connect, $_POST['email']); // em outras palavras, protege o banco de possiveis ataques;
    }

    $erros=array();

    if(empyt($senha) or empyt($email)){
        $erros[]= "Todos os campos precisam ser preenchidos";
        }else{
            $senha= md5($senha);

            $sql="SELECT (email, senha) FROM cliente WHERE email='$email'";
            $result = $connect -> query($sql);
            if(utf8_encode($result['email'])==$email && utf8_encode($result['senha'])==$senha){
                $sql = "SELECT * FROM cliente WHERE cpf='$cpf' AND senha='$senha' AND email='$email'";
                $resultado = $connect->query($sql);

                $dados =  mysqli_fetch_array($resultado);
                $_SESSION['logado'] = true;
                $_SESSION['id_cliente'] = $dados['id'];
                header('Location: home.php');
            }else{
                
            }
        }
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Home - Logar</title>
    <link rel="stylesheet" type="text/css" href="../css/cadastrar.css">
    <link rel="icon" href="../img/coracao_logo.png" type ="image/x-icon"> 
</head>
<body>
<div class="loginBox">
		<img src="../img/teamwork.png" class="user">
        <h2>Login</h2>
        
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
			<p>Email</p>
            <input type="text" name="cpf" placeholder="Digite seu E-mail" maxlength="14">
			<p>Senha</p>
			<input type="password" name="senha" placeholder="Digite sua senha" maxlength="32">
            <input type="submit" name="btn-login" value="Entrar">
            
    <div class="link"><a href="cadastrar.php">Não é cadastrado? Cadastre-se!!</a></div>
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
</body>
</html>