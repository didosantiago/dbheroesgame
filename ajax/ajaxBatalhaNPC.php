<?php
    require_once "../core/config.php";
    
    require_once "../core/Core.php";
    require_once "../core/Personagens.php";
    require_once "../core/Npc.php";
    
    $core = new Core();
    $personagem = new Personagens();
    $npc = new Npc();
    
    $npc->contadorBatalhaNPC(addslashes($_POST['id']));
?>