<?php
include 'conexao.php';
session_start();
if(isset($_SESSION['logado_sec'])){
    }else{
        header('Location: index.php');
    }
$sql = "SELECT * FROM secretaria";
$resultado = $connect->query($sql);
          
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Ver Secretários(as)</title>
<style>
    body{
        font-family: cursive;
        background-color: #ccc;
        font-weight: bold;
    }
    h1{
        text-align: center;
        color: #000;
        font-size: 35px;
    }
    a{
        position: relative;
        top: 135px;
        left: 20%;
        transform: translateX(-50%);
        margin-top: 60px;
        text-decoration: none;
        border: 2px solid #000;
        background-color: #FFD42A;
        padding: 20px;
        border-radius: 15px;
        color: #fff;
        font-weight: bold;
        font-size: 20px;
    }
    a:hover{
        color: #000;
        background: #fff;
    }
    #emp{
        margin-top: 110px;
        border-collapse: collapse;
        width: 70%;
    }
    
    #emp td, #emp th{
        border: 1px solid #000;
        padding: 8px;
    } 
    #emp tr:nth-child(n){background-color: #f2f2f2;}
    #emp  tr:hover {background-color: #ddd;}
    #emp th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #FFD42A;
        color: white;
    }       
</style>
</head>
<body>
    <a href="adm_crud.php">Página inicial</a>
    <a href="adm_cadastrar_secretarias.php">Crud Secretários(as)</a>
    <h1>Secretárias</h1>

    <div align="center">
        <table border="1px " id="emp">
            <thead>
                <tr>
                    <th>Senha</th>
                    <th>CPF</th>
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody>
         <?php
             if(mysqli_num_rows($resultado) > 0){
                foreach ($resultado as $res) {
                    echo '<tr><td>'.utf8_encode($res["senha_sec"]).'</td><td>'.utf8_encode($res["cpf_sec"]).'</td><td>'.utf8_encode($res["nome_sec"]).'</td></tr>';  
                }                  
            }
        ?>    
            </tbody>  
        </table>
    </div>
</body>
</html>