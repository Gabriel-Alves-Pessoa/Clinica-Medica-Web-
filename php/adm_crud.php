<?php
    include 'conexao.php';
    session_start();
    if(isset($_SESSION['logado_sec'])){
    }else{
        header('Location: index.php');
    }
    //dados
    $cpf = $_SESSION['cpf_sec'];
    $sql = "SELECT * FROM secretaria WHERE cpf_sec='$cpf'";
    $resultado = $connect->query($sql);
    $dados = mysqli_fetch_array($resultado);
   
?>
<!DOCTYPE html>
<html lang="pt_br">
<head>
	<meta charset="utf-8">
	<title>Clinicou - ADM</title>
	<style type="text/css">
		body{
			font-family: cursive;
			background-color: #ccc;
		}
		h2{
			text-align: center;
			font-weight: bold;
			font-size: 40px;
			color: #111;
			text-transform: uppercase;
		}
		a{
			text-decoration: none;
			border: 2px solid #000;
			padding: 15px;
			background-color: #FFD42A;
			border-radius: 15px;
			color: #fff;
			font-weight: bold;
			font-size: 17px;
		}
		.a1{
			margin-left: 480px;
			margin-top: 100px;
		}
		a:hover{
			color: #000;
			background: #fff;
		}
		.administrador{
			margin-left: 680px;
			margin-top: 180px;
		}
		.administrador p{
			color: #fff;
			font-size: 25px;
			font-weight: bold;
			margin-bottom: 30px;
			margin-left: -20px;
		}
		nav{
			margin-left: 100px;
		}
	</style>
</head>
<body>
	<h2>Clinicou - ADM</h2>

	<nav class="menu">
		<a href="index.php" class="voltar">Voltar</a>
		<a href="adm_cadastrar_cliente.php">Crud Clientes</a>
		<a href="adm_cadastrar_medico.php">Crud Médicos</a>
		<a href="adm_cadastrar_secretarias.php">Crud Secretárias</a>
		<a href="adm_ver_consulta.php">Ver consultas</a>
		<a href="adm_ver_cliente.php">Ver Clientes</a>
		<a href="adm_ver_medico.php">Ver Médicos</a>
		<a href="adm_ver_sec.php">Ver Secretárias</a>
	</nav> 
	
	<div class="administrador">
		<p style="color: #000">
			<?php echo "Olá ".$dados['nome_sec'];?>
		</p>
		<a href="desconectar.php">Desconectar</a>
	</div>
</body>
</html>