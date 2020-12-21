<?php
    include 'conexao.php';
    session_start();

    if(isset($_SESSION['logado'])){
    }
    //dados
    if(isset($_SESSION['id_cliente'])){
        $id = $_SESSION['id_cliente'];
        $sql = "SELECT * FROM cliente WHERE id='$id'";
        $resultado = $connect->query($sql);
        $dados = mysqli_fetch_array($resultado);
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/home1.css">
    <title>Home - Clinicou</title>
    <link rel="icon" href="../img/coracao_logo.png" type ="image/x-icon"> 
    <script type="text/javascript" src="../js/jquery-2.1.4.min.js"></script>

    <script type="text/javascript">
        jQuery(document).ready(function($) {
        $(".rolar").click(function(event){
        event.preventDefault();
         $('html,body').animate({scrollTop:$(this.hash).offset().top}, 800);
        });
         });
    </script>
</head>
<body>
    <header>
        <a href="index.php" class="logo"><img src="../img/coracao_logo.png" width="45" height="42"><p>Clinicou</p></a>
        <ul>
            <li><a href="adm.php">ADM</a></li>
            <li><a class="rolar" href="#localizacao">Endereço</a></li>
            <li><a class="rolar" href="#contato">Contato</a></li>
            <li class="cadastrar"><a href="cadastrar.php">Cadastrar</a></li>
        </ul>
    </header>
    <!-- <div class="entrar">
        <div class="login">
            <a href="cadastrar.php">
                <img src="../img/conecte.png" alt="" width="50" height="49">
            </a>
        </div>
        <p><?php //if(isset($dados['nome'])){echo $dados['nome'];}?></p> 
    </div> -->
    <div class="btn_login">
        <a href="logar.php">
            <img src="../img/login.svg" alt="" width="80" height="75">
        </a>
    </div>

    <section class="banner">
        <div class="nome">
            <h1>Clinicou</h1>
            <h3>Adoeceu ligou</h3>
        </div>

        <div class="pulsar">
            <img src="../img/coracao_logo.png">
        </div>
        
    </section>

    <section class="esp" id="especialidades">
        <div class="screen">
			<div class="content">
				<h2>Odontologia</h2>
				<p>Faça consultas com os melhores dentistas da cidade.</p>
			</div>
		</div>
		<div class="screen">
			<div class="content">
				<h2>Exame de Sangue</h2>
				<p>Faça exames laboratoriais realizados no sangue para adquirir informações sanguíneas.</p>
			</div>
		</div>
		<div class="screen">
			<div class="content">
				<h2>Obstetrícia</h2>
				<p>Tenha acompanhamento na sua gravidez e pós-parto com o nosso obstetra.</p>
			</div>
		</div>
    </section>

    <section class="local" id="localizacao">
        <h2>Unidade em Paraipaba:</h2>
        <div class="local_foto_maps">
            <div class="local_foto">
                <img src="../img/foto_local1.jpg">
            </div>
            <div class="local_maps">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1955.033610080631!2d-39.14820835470003!3d-3.4307619996393637!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7c0e2c9a8b47bd1%3A0x45e03d7fabe65fa9!2sEscola%20Estadual%20de%20Educa%C3%A7%C3%A3o%20Profissional%20Flavio%20Gomes%20Grangeiro!5e1!3m2!1spt-BR!2sbr!4v1582580947339!5m2!1spt-BR!2sbr" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
            </div>
            <!-- <div class="local_maps_print"></div> -->
        </div>
    </section>

    <section class="rodape"> 
        <div class="contatos" id="contato">
            <h3>Contatos</h3>
            <div class="cont">
                <a href="https://www.facebook.com/" target="_blank"><img src="../img/facebook.png" width="40" height="40"></a>
                <a href="https://www.instagram.com" target="_blank"><img src="../img/instagram.png" width="40" height="40"></a>
                <div class="mail">
                    <img src="../img/gmail.png" width="40" height="40">
                </div>
            </div>
            <p id="p">clinicou@gmail.com</p>
        </div>
        <div class="end">
            <h3>Endereço</h3>
            <p>
                Paraipaba - CE
                <br>
                Monte Alverne
                <br>
                Av. Maria Moreira, 323
                <br>
                62685-000
            </p>
        </div>
        <div class="sobre">
            <h3>Sobre</h3>
            <p>
                Aqui você encontra a solução certa para cuidar da sua saúde e dos seus funcionarios com mais praticidade, eficiênica e cuidado.
            </p>
        </div>
        <div class="copy">
            <p>
                © Copyright 2020 - Todos os direitos reservados
                <br>
                CLINICOU
            </p>
        </div>
    </section>

    <script src="../js/main.js"></script>
</body>
</html>