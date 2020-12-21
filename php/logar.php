<?php
    //conexao
    include 'conexao.php';

    //sessao
    session_start();

    //botao entrar
    if (isset($_POST['btn-entrar'])){
        $erros  = array();
        $email = mysqli_escape_string($connect, $_POST['email']);
        $senha = mysqli_escape_string($connect, $_POST['senha']);
    

        if(empty($email) or empty($senha)){

            $erros[] = "O campo email/senha precisa ser preenchido";
            
        }else{

            $sql = "SELECT email FROM cliente WHERE email='$email'";
            $resultado = $connect->query($sql);

            if(mysqli_num_rows($resultado) > 0){

                $senha = md5($senha);
                $sql = "SELECT * FROM cliente WHERE email='$email' AND senha='$senha'";
                $resultado = $connect->query($sql);
                $dados =  mysqli_fetch_array($resultado);

                if(mysqli_num_rows($resultado) == 1){

                    $_SESSION['logado'] = true;
                    $_SESSION['id_cliente'] = $dados['id'];
                    header('Location: home.php');

                }else{

                    $erros[] = "Email e senha não conferem";
                }
            }else{

                $erros[] = "Cliente inexistente";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/logar.css">
    <title>Clinicou - Entrar</title>
    <link rel="icon" href="../img/coracao_logo.png" type ="image/x-icon"> 
</head>
<body>
<div class="loginBox">
		<img src="../img/teamwork.png" class="user">
        <h2>Logar</h2>
        
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
			<p>Email</p>
            <input type="email" name="email" placeholder="Digite seu email" maxlength="50">
			<p>Senha</p>
            <input type="password" name="senha" placeholder="Digite sua senha" maxlength="32" id="senha">
            <div id="olho" onclick="ver_senha();"></div>
            <input type="submit" name="btn-entrar" value="Entrar">
            
            <div class="link"><a href="cadastrar.php">Não é cadastrado? Cadastre-se</a></div>
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