<?php
    require_once "../core/config.php";
    
    require_once "../core/Core.php";
    require_once "../core/Treino.php";
    require_once "../core/Personagens.php";
    require_once "../core/Usuarios.php";
    
    $core = new Core();
    $personagem = new Personagens();
    $treino = new Treino();
    $user = new Usuarios();
    
    $treino->recoveryEnergia(addslashes($_POST['id']), $user->vip);
    $treino->recoveryKI(addslashes($_POST['id']), $user->vip);
    $treino->recoveryHP(addslashes($_POST['id']), $user->vip);
    
    $personagem->getGuerreiro(addslashes($_POST['id']));
    $personagem->getGuerreiroInfo(addslashes($_POST['id']));
?>