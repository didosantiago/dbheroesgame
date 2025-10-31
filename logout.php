<?php
    ob_start();

    session_destroy();

    $user->deleteMonitoramento($_SERVER['REMOTE_ADDR']);
    
    header('Location: home');
    ob_end_flush();
?>

