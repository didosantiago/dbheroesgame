<?php
    session_start();
    
    require_once "../core/config.php";
    
    require_once "../core/Core.php";
    require_once "../core/Usuarios.php";
    
    $core = new Core();
    $user = new Usuarios();
    
    $id = addslashes($_POST['id']);
    $_SESSION["PERSONAGEMID"] = $id;
    
    if(isset($_SESSION['username'])){
        $user->getUserInfo($_SESSION['username']);
    }
    
    $campos_volta = array(
        'online' => 0
    );

    $where_volta = 'idUsuario = "'.$user->id.'"';

    $core->update('usuarios_personagens', $campos_volta, $where_volta);
    
    $campos = array(
        'online' => 1
    );

    $where = 'id = "'.$id.'"';

    $core->update('usuarios_personagens', $campos, $where);
?>