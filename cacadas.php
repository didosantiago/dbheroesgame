<?php     
    if(isset($_POST['cacar'])){
        if($personagem->cacadaEsgotada($_SESSION['PERSONAGEMID'], addslashes($_POST['tempo']), $user->vip)){
            $core->msg('error', 'Tempo de Caçada diário Esgotado.');
        } else {
            if(!isset($_SESSION['cacada']) || !isset($_SESSION['missao'])){           
                if(isset($_SESSION['PERSONAGEMID'])){
                    if(!isset($_SESSION['cacada'])){
                        $personagem->getGuerreiro($_SESSION['PERSONAGEMID']);
                        $personagem->calculaCacada($user->id, $_POST, $personagem->idPlaneta, $_SESSION['PERSONAGEMID'], $user->vip, $personagem->nivel, $personagem->exp);
                    }
                }
            } 
        }
    }
    
    if(isset($_SESSION['cacada']) || isset($_SESSION['missao'])){ 
        header('Location: '.BASE.'portal');
    }
?>

<h2 class="title">Iniciar uma Caçada</h2>

<p class="informativo h-mobile">
    Começe agora mesmo sua caçada. você recebe golds, e ainda pode ganhar caixas com itens para equipar seu guerreiro.
    <br><br>
    Aumente também sua Experiência
    <br><br>
    Procure Fazer suas caçadas sempre para que tenha uma boa recompensa diaria.
    <br><br>
    <strong>10 minutos (Membros VIP 5 minutos)</strong> = Você ganha 1 de Gold e 1 de Exp.
    <br>
    <strong>20 minutos (Membros VIP 5 minutos)</strong> = Você ganha 1 de Gold e 1 de Exp.
    <br>
    <strong>30 minutos (Membros VIP 5 minutos)</strong> = Você ganha 1 de Gold e 1 de Exp.
    <br>
    <strong>40 minutos (Membros VIP 5 minutos)</strong> = Você ganha 1 de Gold e 1 de Exp.
    <br>
    <strong>50 minutos (Membros VIP 5 minutos)</strong> = Você ganha 1 de Gold e 1 de Exp.
    <br>
    <strong>60 minutos (Membros VIP 5 minutos)</strong> = Você ganha 1 de Gold e 1 de Exp.
    <br>
    <br><br>
    - Tempo de Caçada Diário <strong>1 Hora</strong>
    <br>
    - Tempo de Caçada Diário (Membros VIP) <strong>2 Horas</strong>
</p>

<div class="forms-cacadas">
    <form id="formCacada" class="forms" action="" method="post">
        <div class="campos" style="width: 150px;">
            <input type="hidden" name="tempo" value="10" />
            <input type="hidden" name="gold" value="120" />
            <?php
                if($user->vip == 1){
                    $tempo_10 = 5;
                } else {
                    $tempo_10 = 10;
                }
            ?>
            <span class="tempo-cacada"><?php echo $tempo_10; ?> Minutos</span>
        </div>
        <div class="campos" style="width: 300px;">
            <input type="submit" id="cacar" class="bts-form" name="cacar" value="Iniciar Caçada" />
        </div>
    </form>

    <form id="formCacada" class="forms alter" action="" method="post">
        <div class="campos" style="width: 150px;">
            <input type="hidden" name="tempo" value="20" />
            <input type="hidden" name="gold" value="240" />
            <?php 
                if($user->vip == 1){
                    $tempo_20 = 10;
                } else {
                    $tempo_20 = 20;
                }
            ?>
            <span class="tempo-cacada"><?php echo $tempo_20; ?> Minutos</span>
        </div>
        <div class="campos" style="width: 300px;">
            <input type="submit" id="cacar" class="bts-form" name="cacar" value="Iniciar Caçada" />
        </div>
    </form>

    <form id="formCacada" class="forms" action="" method="post">
        <div class="campos" style="width: 150px;">
            <input type="hidden" name="tempo" value="30" />
            <input type="hidden" name="gold" value="360" />
            <?php 
                if($user->vip == 1){
                    $tempo_30 = 15;
                } else {
                    $tempo_30 = 30;
                }
            ?>
            <span class="tempo-cacada"><?php echo $tempo_30; ?> Minutos</span>
        </div>
        <div class="campos" style="width: 300px;">
            <input type="submit" id="cacar" class="bts-form" name="cacar" value="Iniciar Caçada" />
        </div>
    </form>

    <form id="formCacada" class="forms alter" action="" method="post">
        <div class="campos" style="width: 150px;">
            <input type="hidden" name="tempo" value="40" />
            <input type="hidden" name="gold" value="480" />
            <?php 
                if($user->vip == 1){
                    $tempo_40 = 20;
                } else {
                    $tempo_40 = 40;
                }
            ?>
            <span class="tempo-cacada"><?php echo $tempo_40; ?> Minutos</span>
        </div>
        <div class="campos" style="width: 300px;">
            <input type="submit" id="cacar" class="bts-form" name="cacar" value="Iniciar Caçada" />
        </div>
    </form>

    <form id="formCacada" class="forms" action="" method="post">
        <div class="campos" style="width: 150px;">
            <input type="hidden" name="tempo" value="50" />
            <input type="hidden" name="gold" value="600" />
            <?php 
                if($user->vip == 1){
                    $tempo_50 = 25;
                } else {
                    $tempo_50 = 50;
                }
            ?>
            <span class="tempo-cacada"><?php echo $tempo_50; ?> Minutos</span>
        </div>
        <div class="campos" style="width: 300px;">
            <input type="submit" id="cacar" class="bts-form" name="cacar" value="Iniciar Caçada" />
        </div>
    </form>
    
    <form id="formCacada" class="forms" action="" method="post">
        <div class="campos" style="width: 150px;">
            <input type="hidden" name="tempo" value="60" />
            <input type="hidden" name="gold" value="600" />
            <?php 
                if($user->vip == 1){
                    $tempo_60 = 30;
                } else {
                    $tempo_60 = 60;
                }
            ?>
            <span class="tempo-cacada"><?php echo $tempo_60; ?> Minutos</span>
        </div>
        <div class="campos" style="width: 300px;">
            <input type="submit" id="cacar" class="bts-form" name="cacar" value="Iniciar Caçada" />
        </div>
    </form>
</div>
