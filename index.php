<?php 
    require_once './init.php';
    
    $modulo = Url::getURL(0);

    if($modulo == null){
        $modulo = "home";
    }

    if(Url::getURL(1) != ''){
        $acao = Url::getURL(1);
    } else {
        $acao = 'default';
    }
    
    if(isset($_GET['pagina'])){
        $pagina = $_GET['pagina'];
    } else {
        $pagina = '';
    }
    
    if (!$pagina) {
        $pc = "1";
    } else {
        $pc = $pagina;
    }
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
        
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        
    <link rel="shortcut icon" href="<?php echo BASE; ?>assets/favicon.ico" type="image/x-icon">
    <link type="text/css" rel="stylesheet" href="<?php echo BASE; ?>assets/dbheroes.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo BASE; ?>assets/dbheroes-vendor.css" />
    <script type="text/javascript" src="<?php echo BASE; ?>assets/jquery.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" integrity="sha384-kW+oWsYx3YpxvjtZjFXqazFpA7UP/MbiY4jvs+RWZo2+N94PFZ36T6TFkc9O3qoB" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?php echo BASE; ?>assets/db-heroes-vendor.min.js?v=15042019.2"></script>
    <script type="text/javascript" src="<?php echo BASE; ?>assets/modernizr.custom.js"></script>
    <script type="text/javascript" src="<?php echo BASE; ?>assets/jquery.dlmenu.js"></script>
    <script src="<?php echo BASE; ?>assets/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="<?php echo BASE; ?>assets/db-heroes.min.js"></script>
</head>
<body class="<?php echo $modulo; ?>">
        <div class="top-bar">
            <button id="playTema" style="display: none;"></button>
            <audio id="intro">
                <source src="<?php echo BASE; ?>assets/soco.mp3" type="audio/mpeg">
            </audio>
        </div>
    
        <?php require_once 'includes/menu-mobile.php'; ?>
        
        <?php require_once 'includes/header.php'; ?>
                  
        <div class="nao-validado-top">
            <p>Seu e-mail ainda não foi confirmado, confirme clicando no link enviado para seu email. Caso não tenha recebido <a href="<?php echo BASE; ?>perfil">Clique Aqui.</a></p>
        </div>  

    <div class="container">        

            <div class="float-msg">
                <span>novo nivel 2</span>
                <form method="post">
                    <input type="submit" name="confirmarMSG" value="Confirmar" />
                </form>
            </div>

                <div class="cacada-running">
                    <span>Você está em uma caçada, aguarde o tempo terminar para iniciar missões, arena e caçadas.</span>
                    <a class="bts-form" id="cancelarCacada">Cancelar Caçada</a>
                    <input type="hidden" name="idCacada" id="idCacada" value="'.$idCacada.'" />
                    <div class="contador"></div>
                </div>

                <div class="pvp-paused">
                    <span>Você está em uma batalha PVP, volte para o combate para finalizar.</span>
                    <a href="<?php echo BASE; ?>combate/1" class="bts-form" id="voltarBatalha">Ir para Batalha</a>
                </div>
        

                <div class="npc-paused">
                    <span>Você está em uma batalha do Torneio de Artes Marciais NPC, volte para o combate para finalizar.</span>
                    <a href="<?php echo BASE; ?>npc/1" class="bts-form" id="voltarBatalha">Ir para Batalha</a>
                </div>
        
        
            <div class="pvp-running">
                <span>Você atacou recentemente, por isso deve aguardar o período de penalidade para novos ataques.</span>
                <div class="contador"></div>
            </div>
        

            <div class="punicao-adversario">
                <span>Este guerreiro foi atacado recentemente, aguarde a penalidade dele terminar para atacá-lo.</span>
                <div class="contador"></div>
            </div>
        
        <?php require_once 'includes/menu-lateral.php'; ?>
        
        <?php require_once 'includes/menu-flutuante.php'; ?>

        <div class="conteudo">
            <?php
                if( file_exists( $modulo . ".php" )){
                    require $modulo . ".php";
                } else {
                    require "erro.php";
                }
            ?>
        </div>
    </div>
            
    <input type="hidden" id="baseSite" value="<?php echo BASE; ?>" />
    
        <div class="copy">
            <div class="container">
                <p>©2018 DB Heroes Game - <a href="<?php echo BASE; ?>doc/aviso-legal.pdf" target="_blank">Aviso Legal</a> - <a href="<?php echo BASE; ?>doc/politica-de-privacidade.pdf" target="_blank">Política de Privacidade</a> - <a href="<?php echo BASE; ?>doc/termos-de-uso.pdf" target="_blank">Termos de Uso</a> - <a href="<?php echo BASE; ?>doc/regras.pdf" target="_blank">Regras & Punições</a></p>
                <p>Personagens e desenhos © CopyRight 1984 by Akira Toriyama. Todos os direitos reservados</p>
            </div>
        </div>
            
    <div id="load-game">
        <img src="<?php echo BASE; ?>assets/load.gif" alt="Carregando..." />
    </div>
    
    <script type="text/javascript">
        var id = $('#personagemLogged').val();
        var data_string = 'id=' + id;

        if($('.missao-running').length > 0){
            console.log(data_string);
            $.ajax({
                type: "POST",
                url: "<?php echo BASE; ?>ajax/ajaxMissao.php",
                data: data_string,
                success: function (res) {
                    startCountdownMissao(res);
                }
            });
        }
            
        function startCountdownMissao(tempo){
            // Se o tempo não for zerado
            if((tempo - 1) >= 0){

                var min = parseInt(tempo/60);
                var horas = parseInt(min/60);
                min = min % 60;
                var seg = tempo%60;

                // Formata o número menor que dez, ex: 08, 07, ...
                if(min < 10){
                    min = "0"+min;
                    min = min.substr(0, 2);
                }

                if(seg <=9){
                    seg = "0"+seg;
                }

                if(horas <=9){
                    horas = "0"+horas;
                }

                // Cria a variável para formatar no estilo hora/cronômetro
                horaImprimivel = horas + ':' + min + ':' + seg;
                //JQuery pra setar o valor

                $(".missao-running .contador").html(horaImprimivel);

                // Define que a função será executada novamente em 1000ms = 1 segundo
                setTimeout(function(){ 
                    startCountdownMissao(tempo);
                }, 1000);

                // diminui o tempo
                tempo --;

                reload = 0;
            } else {

            }
        }
            
        $('#cancelarCacada').on('click', function(){
            swal({
                title: 'Confirmar Cancelamento?',
                text: "Cancelando você não irá receber os prêmios!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, cancelar'
            }).then((result) => {
                if (result.value) {
                    var id = $('#idCacada').val();
                    var data_string = 'id=' + id;

                    $.ajax({
                        type: "POST",
                        url: "ajax/ajaxCancelarCacada.php",
                        data: data_string,
                        success: function (res) {
                            swal(
                                'Cancelado!',
                                'Caçada cancelada com sucesso.',
                                'success'
                            );
                            location.reload(true);
                        }
                    });
                }
            });
        });
        
        $('#cancelarMissao').on('click', function(){
            swal({
                title: 'Confirmar Cancelamento?',
                text: "Cancelando você não irá receber os prêmios!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, cancelar'
            }).then((result) => {
                if (result.value) {
                    var id = $('#idMissao').val();
                    var data_string = 'id=' + id;

                    $.ajax({
                        type: "POST",
                        url: "ajax/ajaxCancelarMissao.php",
                        data: data_string,
                        success: function (res) {
                            swal(
                                'Cancelado!',
                                'Missão cancelada com sucesso.',
                                'success'
                            );
                            location.reload(true);
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>