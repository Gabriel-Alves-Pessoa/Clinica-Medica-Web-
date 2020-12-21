<!DOCTYPE html>

<?php
    include 'conexao.php';
    session_start();

    if(!isset($_SESSION['logado'])){
        header('Location: index.php');
    }
    
    //dados
    if(isset($_SESSION['id_cliente'])){
        $id = $_SESSION['id_cliente'];
        $sql = "SELECT * FROM cliente WHERE id='$id'";
        $resultado = $connect->query($sql);
        $dados_cliente = mysqli_fetch_array($resultado);

        $sql = "SELECT * FROM medico";
        $resultado = $connect->query($sql);
        $dados_med = mysqli_fetch_array($resultado);

        $sql = "SELECT * FROM consulta WHERE id_cliente='$id'";
        $resultado_cons = $connect->query($sql);
        $dados_cons = mysqli_fetch_array($resultado_cons);
    }
?>

<?php
    if(isset($_POST['marcar'])){    
        $data_c = mysqli_escape_string($connect, $_POST['data']);
        $horario_c = mysqli_escape_string($connect, $_POST['horario']);
        $id_med_c = mysqli_escape_string($connect, $_POST['medico']);
        $descricao_c = mysqli_escape_string($connect, $_POST['descricao']);

        $erros  = array();

        if(empty($data_c) or empty($horario_c) or empty($id_med_c) or empty($descricao_c)){
            $erros[] = "Todos os campos precisam ser preenchidos";
        }else{
            $sql = "SELECT * FROM medico WHERE id_med='$id_med_c'";
            $result_c = $connect->query($sql);

            if(mysqli_num_rows($result_c) > 0){

                $sql = "INSERT INTO consulta (data_cons,descricao_cons,horario_cons,id_cliente,id_med) VALUES ('$data_c','$descricao_c','$horario_c','$id','$id_med_c')";
                if($connect->query($sql)){
                    $erros[] = "Consulta Marcada";
                    header('Location: home.php');
                }else{
                    $erros[] = "Erro no banco";
                }
            }
        }
    }
?>


<?php
    if(isset($_POST['cancelar'])){    
        $id_consulta = mysqli_escape_string($connect, $_POST['id_consulta']);

        $erros_canc  = array();

        if(empty($id_consulta)){
            $erros_canc[] = "Todos os campos precisam ser preenchidos";
        }else{
            $sql = "SELECT * FROM consulta WHERE id_cons='$id_consulta'";
            $result_c = $connect->query($sql);

            if(mysqli_num_rows($result_c) > 0){

                $sql = "DELETE FROM consulta WHERE id_cons='$id_consulta'";
                if($connect->query($sql)){
                    $erros_canc[] = "Consulta Cancelada";
                    header('Location: home.php');
                }else{
                    $erros_canc[] = "Erro no banco";
                }
            }
        }
    }
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Home - Clinicou</title>
    <link rel="stylesheet" href="../css/estilo_home1.css">
    <link rel="icon" href="../img/coracao_logo.png" type ="image/x-icon"> 
</head>
<body>
    <div class="services-section">
        <div class="inner-width">
            <h1 class="section-title">Clinicou - <?php echo $dados_cliente['nome']?></h1>
            <div class="border"></div>
            <div class="services-container">

                <div class="service-box">
                    <a href="#ver-consultas">
                        <img src="../img/ver_consultas.svg" width="90">
                        <div class="service-title">Ver Consultas</div>
                    </a>
                </div>

                <div class="service-box">
                    <a href="#cancelar">
                        <img src="../img/cancelar.svg" width="90">
                        <div class="service-title">Cancelar Consulta</div>
                    </a>
                </div>

                <div class="service-box">
                    <a href="#marcar">
                        <img src="../img/add.svg" width="90">
                        <div class="service-title">Marcar Consulta</div>
                    </a>
                </div>

                <div class="service-box">
                    <a href="#infors">
                        <img src="../img/info.svg" width="90">
                        <div class="service-title">Informações</div>
                    </a>
                </div>

                <div class="service-box">
                    <a href="https://coronavirus.saude.gov.br/">
                        <img src="../img/coronavirus.svg" width="90">
                        <div class="service-title">Informações Covid-19 </div>
                    </a>
                </div>

                <div class="service-box">
                    <a href="desconectar.php">
                        <img src="../img/logout.svg" width="90">
                        <div class="service-title">Desconectar</div>
                    </a>
                </div>
            </div>
        </div>
    </div>


    <div class="ver_consultas-section" id="ver-consultas">
        <div class="consultas-tabela">
            <h2>Suas Consultas</h2>
            <table>
                <tr>
                    <th>Médico</th>
                    <th>Horário</th>
                    <th>Data</th>
                </tr>
                <?php
                     if(mysqli_num_rows($resultado_cons) > 0){
                        foreach ($resultado_cons as $res) {
                            $id_med = $res["id_med"];
                            $sql = "SELECT nome_med FROM medico WHERE id_med='$id_med'";
                            $resultado = $connect->query($sql);
                            $resultado = mysqli_fetch_array($resultado);

                            echo '<tr><td>'.utf8_encode($resultado["nome_med"]).'</td><td>'.utf8_encode($res["horario_cons"]).'</td><td>'.utf8_encode($res["data_cons"]).'</td></tr>';  
                        }                  
                    }
                ?>
            </table>
        </div>
        <div class="consultas-img">
            <img src="../img/un_medicine.svg">
        </div>
    </div>

    <div class="cancelar-section" id="cancelar">
        <div class="cancelar-img">
            <img src="../img/un_doctor.svg">
        </div>
        <div class="cancelar-tabela">
            <h2>Cancelar Consulta</h2>
                <table>
                    <tr>
                        <th>Médico</th>
                        <th>Horário</th>
                        <th>Data</th>
                        <th>Cancelar</th>
                    </tr>
                    <?php
                         if(mysqli_num_rows($resultado_cons) > 0){
                            foreach ($resultado_cons as $res) {
                                $id_med = $res["id_med"];
                                $sql = "SELECT nome_med FROM medico WHERE id_med='$id_med'";
                                $resultado = $connect->query($sql);
                                $resultado = mysqli_fetch_array($resultado);

                                $id_cons = $res["id_cons"];

                                echo '<tr><td>'.utf8_encode($resultado["nome_med"]).'</td><td>'.utf8_encode($res["horario_cons"]).'</td><td>'.utf8_encode($res["data_cons"]).'</td><td><form action="home.php" method="post"><input type="hidden" name="id_consulta" value="'.$id_cons.'"><input type="submit" name="cancelar" value="Cancelar"></form></td></tr>';  
                            }                  
                        }
                    ?>
                </table>
        </div>
    </div>


    <div class="marcar_consultas-section" id="marcar">
        <div class="marcar-form">
            <h2>Marcar Consulta</h2>
            <center>
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                    <input type="date" name="data"><br>

                    <select name="horario">
                        <option value="07:00">07:00 - manhã</option>
                        <option value="09:00">09:00 - manhã</option>
                        <option value="13:00">13:00 - tarde</option>
                        <option value="15:00">15:00 - tarde</option>
                    </select><br>

                    <input type="text" name="descricao" placeholder="Descrição"><br>

                    <div class="marcar-label">Selecionar Médico</div><br>

                    <?php
                        $sql = "SELECT * FROM medico";
                        $resultado = $connect->query($sql);
                    ?>

                    <select id="medico" name="medico">

                        <?php
                            if(mysqli_num_rows($resultado) > 0){
                                foreach ($resultado as $res) {
                                    $id_medico_op = $res["id_med"];
                                    echo '<option value="'.$id_medico_op.'">'.utf8_encode($res["nome_med"]).'</option>';  
                                }                  
                            }
                        ?>
                    </select><br>

                    <input type="submit" name="marcar" value="Marcar">
                </form>
            </center>
        </div>
        <div class="marcar-img">
            <img src="../img/undraw.svg">
        </div>
    </div>

    <div class="infor-section" id="infors">
        <div class="infor-dados">
            <h2>Mais Informações</h2>
            <center>
                <p>
                    Aqui você encontra a solução certa para cuidar da sua saúde e dos seus funcionarios com mais praticidade, eficiênica e cuidado.
                </p>

                <p>
                    Paraipaba - CE
                    <br>
                    Monte Alverne
                    <br>
                    Av. Maria Moreira, 323
                    <br>
                    62685-000
                </p>
            </center>
        </div>
        <div class="infor-img">
            <img src="../img/un_information.svg">
        </div>
    </div>

    <div class="copyright">
        <p>
            © Copyright 2020 - Todos os direitos reservados
            <br>
            CLINICOU
        </p>
    </div>
</body>
</html>