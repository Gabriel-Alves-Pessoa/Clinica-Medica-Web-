<?php
    //conexao
    include 'conexao.php';

    //sessao
    session_start();

    //botao entrar
    if (isset($_POST['btn-entrar'])){
        $erros  = array();
        $cpf = mysqli_escape_string($connect, $_POST['cpf']);
        $senha = mysqli_escape_string($connect, $_POST['senha']);


        if(empty($senha) or empty($cpf)){

            $erros[] = "Preencha todos os campos";
            
        }else{

            $sql = "SELECT cpf_sec FROM secretaria WHERE cpf_sec ='$cpf'";
            $resultado = $connect->query($sql);

            if(mysqli_num_rows($resultado) > 0){

                $sql = "SELECT * FROM secretaria WHERE cpf_sec='$cpf' AND senha_sec='$senha'";
                $resultado = $connect->query($sql);
                $dados =  mysqli_fetch_array($resultado);

                if(mysqli_num_rows($resultado) == 1){

                    $_SESSION['logado_sec'] = true;
                    $_SESSION['cpf_sec'] = $dados['cpf_sec'];
                    header('Location: adm_crud.php');

                }else{

                    $erros[] = "CPF e senha não conferem";
                }
            }else{

                $erros[] = "CPF inexistente";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/logaradm.css">
    <title>Clinicou - Entrar</title>
    <link rel="icon" href="../img/coracao_logo.png" type ="image/x-icon"> 
</head>
<body>
<div class="loginBox">
		<img src="../img/teamwork.png" class="user">
        <h2>Logar - ADM</h2>
        
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <p>CPF</p>
            <input type="text" name="cpf" placeholder="Digite seu CPF" maxlength="14">
			<p>Senha</p>
            <input type="password" name="senha" placeholder="Digite sua senha" maxlength="32" id="senha">

            <div id="olho" onclick="ver_senha();"></div>
            <input type="submit" name="btn-entrar" value="Entrar">
            
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