<?php
    ob_start();
    session_cache_expire(10);
    session_start();

    //Inclusão das Classes
    include_once "./core/config.php";
    // include_once "./core/DB.php";
    include_once "./core/Url.php";
    include_once "./core/Paginator.php";
    include_once "./core/Upload.php";
    // include_once "./core/Core.php";
    include_once "./core/phpmailer/SMTP.php";
    include_once "./core/phpmailer/PHPMailer.php";
    include_once "./core/Mail.php";
    include_once "./core/Usuarios.php";
    include_once "./core/Personagens.php";
    include_once "./core/Noticias.php";
    include_once "./core/Pagamentos.php";
    include_once "./core/Treino.php";
    include_once "./core/Inventario.php";
    include_once "./core/Missoes.php";
    include_once "./core/Faq.php";
    include_once "./core/Torneio.php";
    include_once "./core/Mercado.php";
    include_once "./core/Batalha.php";
    include_once "./core/Npc.php";
    include_once "./core/Equipes.php";
    include_once "./core/Administrar.php";
    include_once "./core/Forum.php";
    include_once "./core/Market.php";
    include_once "./core/Loja.php";
    include_once "./core/Invasao.php";
    include_once "./core/Sorteios.php";
    include_once "./core/Chat.php";
    
    //Instanciando Objetos
    $pager = new Paginator();
    // $core = new Core();
    $user = new Usuarios();
    $personagem = new Personagens();
    $noticias = new Noticias();
    $pay = new Pagamentos();
    $treino = new Treino();
    $inventario = new Inventario();
    $missoes = new Missoes();
    $faq = new Faq();
    $torneio = new Torneio();
    $market = new Mercado();
    $batalha = new Batalha();
    $npc = new Npc();
    $equipes = new Equipes();
    $administrar = new Administrar();
    $forum = new Forum();
    $mercado = new Market();
    $loja = new Loja();
    $invasao = new Invasao();
    $sorteios = new Sorteios();
    $chat = new Chat();
    
    unset($_SESSION['cacada']);
    unset($_SESSION['cacada_id']);
    unset($_SESSION['missao']);
    unset($_SESSION['missao_id']);
    unset($_SESSION['npc']);
    unset($_SESSION['npc_id']);
    unset($_SESSION['pvp']);
    unset($_SESSION['pvp_id']);
    
    
    
    /* Informa o nível dos erros que serão exibidos */
    error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

    /* Habilita a exibição de erros */
    ini_set("display_errors", 1);
?>
    
