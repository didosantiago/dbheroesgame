<?php 
    if(isset($_POST['votar_enquete'])){
        $dados = $core->getDados('adm_enquetes_opcoes', "WHERE id = ".addslashes($_POST['votar_enquete']));
        
        $campos = array(
            'votos' => intval($dados->votos) + 1
        );

        $where = 'id = '.addslashes($_POST['votar_enquete']);

        if($core->update('adm_enquetes_opcoes', $campos, $where)){
            
            $campos = array(
                'idEnquete' => $dados->idEnquete,
                'idUsuario' => $user->id,
                'data' => date('Y-m-d H:i:s'),
                'voto' => addslashes($_POST['votar_enquete'])
            );
            
            if($core->insert('adm_enquetes_usuarios', $campos)){
                $core->msg('sucesso', 'Votação Realizada.');
                header('Location: '.BASE.'portal');
            }
        } else {
            $core->msg('error', 'Erro ao Votar.');
        }
        
        
    }
?>

<div class="video-bar">
    <a href="https://www.youtube.com/channel/UC88PqK6ByP47PrcyW5oCYrQ" target="_blank">
        <img src="<?php echo BASE; ?>assets/banner-youtube.jpg" />
        <script src="https://apis.google.com/js/platform.js"></script>
        <div class="g-ytsubscribe" data-channelid="UC88PqK6ByP47PrcyW5oCYrQ" data-layout="default" data-count="default"></div>
    </a>
</div>

<div class="widgets widget-news">
    <div class="mural">
        <div class="news">
            <div class="info img">
                <h3>Título da notícia</h3>
                <span>Publicado em 05/01/2022</span>
                <div class="descricao">dsnfdjsnfjsdfjdsbbfdshbfsdhjbfhjsbdhfjbsdhjbfhsdbfhsdbfhdjsbfhjsdf</div>
            </div>
        </div>
    </div>
</div>

<div class="evento">
    <a href="<?php echo BASE; ?>invasao">
        <img src="<?php echo BASE.'assets/boss/boss_freeza.jpg'; ?>" />
    </a>
</div>

<ul class="ultimos-acontecimentos">
    <li class="double-exp">
        <img src="<?php echo BASE; ?>assets/bg-double-exp.jpg" />
        <h4>DOUBLE EXP</h4>
            <div class="contador-double-exp cont">00:00:00</div>
            <span>Tempo Restante</span>
    </li>
    <li class="nf">
        <img src="<?php echo BASE.'assets/bg-ultimos-avisos.jpg'; ?>" />
        <h4>teste</h4>
        <p>dfgdfgdfgdfgd</p>
    </li>
</ul>

<div class="video h-mobile">
    <iframe width="503" height="320" src="https://www.youtube.com/embed/<?php echo $config->video_destaque; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>

<div class="video h-mobile">
    <iframe width="503" height="320" src="https://www.youtube.com/embed/<?php echo $config->video_destaque_prev; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>

<ul class="lista-acesso-rapido">
    <li class="h-mobile" style="margin-right: 0; width: 252px;">
        <a href="<?php echo BASE; ?>vantagens">
            <i class="fas fa-crown"></i>
            <div class="bundle">Novo</div>
            <span>Seja VIP</span>
            <p>Seja vip sem tempo de expiração</p>
        </a>
    </li>
    <li class="h-mobile">
        <a href="<?php echo BASE; ?>loja">
            <i class="fas fa-store"></i>
            <div class="bundle">Novo</div>
            <span>Loja de Items</span>
            <p>Itens Diários com duração de 24 Horas</p>
        </a>
    </li>
    <li>
        <a href="<?php echo BASE; ?>banco">
            <i class="fas fa-piggy-bank"></i>
            <span>Banco Central</span>
            <p>Depósitos, Saques de Gold e Venda de Itens</p>
        </a>
    </li>
    <li>
        <a href="<?php echo BASE; ?>bonus-diario">
            <i class="fas fa-box"></i>
            <span>Bônus Diário</span>
            <p>Colete itens e Gold todo dia</p>
        </a>
    </li>
    <li class="h-mobile" style="margin-right: 0; width: 252px;">
        <a href="<?php echo BASE; ?>market">
            <i class="fas fa-cart-plus"></i>
            <span>Mercado</span>
            <p>Compre e Venda seus itens no Mercado</p>
        </a>
    </li>
    <li>
        <a href="<?php echo BASE; ?>troca-guerreiro">
            <i class="fas fa-male"></i>
            <span>Troca de Guerreiro FREE</span>
            <p>Troque agora seu guerreiro por outro personagem</p>
        </a>
    </li>
    <li>
        <a href="<?php echo BASE; ?>treinar">
            <i class="fas fa-upload"></i>
            <span>Treinar Guerreiro</span>
            <p>Treine os Atributos de seu Guerreiro</p>
        </a>
    </li>
    <li class="h-mobile">
        <a href="<?php echo BASE; ?>equipes">
            <i class="fas fa-users"></i>
            <span>Equipes</span>
            <p>Crie ou participe de Equipes e aumente seus Atributos</p>
        </a>
    </li>
</ul>

<div class="video-mobile v-mobile">
    <a href="https://www.youtube.com/watch?v=<?php echo $config->video_destaque; ?>" target="_blank">
        <i class="fab fa-youtube"></i>
        <span>Vídeo Tutorial</span>
    </a>
</div>

<?php if($administrar->existsEnquete()){ ?>
    <div class="enquete">
        <h3>Enquete</h3>
        <?php $dadosEnquete = $administrar->getEnquete(); ?>
        
        <h4><?php echo $dadosEnquete->pergunta ?></h4>
        
        <?php if(!$core->isExists('adm_enquetes_usuarios', "WHERE idUsuario = $user->id AND idEnquete = ".$dadosEnquete->id)){ ?>
            <form id="formEnquete" action="" method="post">
                <?php echo $administrar->getOptionsEnquete($dadosEnquete->id); ?>
            </form>
        <?php } else { ?>
            <ul>
                <?php echo $administrar->getPorcentagensEnquete($dadosEnquete->id); ?>
            </ul>
        <?php } ?>
    </div>
<?php } ?>

<div class="redes-sociais">
    <div class="banner-1 h-mobile">
        <a href="https://www.instagram.com/dbheroesgame/" target="_blank">
            <img src="<?php echo BASE; ?>assets/bn-insta.jpg" />
        </a>
    </div>

    <div class="banner-2 h-mobile">
        <a href="https://www.facebook.com/dbheroesgame" target="_blank">
            <img src="<?php echo BASE; ?>assets/bn-face.jpg" />
        </a>
    </div>
</div>

<script type="text/javascript">
    startCountdownDouble(<?php echo $tempoRestanteDouble; ?>);

    function startCountdownDouble(tempo){
        if((tempo - 1) >= 0){

            var min = parseInt(tempo/60);
            var horas = parseInt(min/60);
            min = min % 60;
            var seg = tempo%60;

            if(min < 10){
                min = "0"+min;
                min = min.substr(0, 2);
            }

            if(seg <=9){
                seg = "0"+seg;
            }

            if(horas <=9){
                horas = "0" + horas;
            }

            horaImprimivel = horas + ':' + min + ':' + seg;

            $(".contador-double-exp.cont").html(horaImprimivel);

            setTimeout(function(){ 
                startCountdownDouble(tempo);
            }, 1000);

            tempo --;
        } else {
            <?php if($dadosDouble->status == 1 && $dadosDouble->periodo == 1){ ?>
                location.reload(true);
            <?php } ?>
        }
    }
</script>

<script type="text/javascript">
    $('#formEnquete input[name="votar_enquete"]').on('change', function(){
        $('#formEnquete').submit();
    });
</script>