<?php
    require_once "../core/config.php";
    
    require_once "../core/Core.php";
    require_once "../core/Personagens.php";
    
    $core = new Core();
    $personagem = new Personagens();
    
    $campos = array(
        'cancelada' => 1
    );

    $where = 'id = "'.addslashes($_POST['id']).'"';

    $core->update('cacadas', $campos, $where);
?>