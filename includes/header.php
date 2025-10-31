<header>
    <div class="topo">
        <img class="desktop" src="<?php echo BASE; ?>assets/header.jpg" alt="" />
        <img class="mobile" src="<?php echo BASE; ?>assets/header-mobile.jpg" alt="" />
        <h1 class="logo">
            <a href="<?php echo BASE; ?>">
                <?php require_once 'front/svg.php'; ?>
            </a>
        </h1>
    </div>
    
    <ul class="menu-superior desktop">
        <div class="container">
            <li>
                <a href="<?php echo BASE; ?>portal">Inicio</a>
            </li>
            
            <li>
                <a href="#"><i class="fas fa-question"></i> Suporte</a>
                <ul class="submenu">
                    <li>
                        <a href="https://discord.gg/zbSWtcs" target="_blank"><i class="fab fa-discord"></i> Chat da Comunidade</a>
                    </li>
                    <li>
                        <a href="<?php echo BASE; ?>forum"><i class="fas fa-user-tie"></i> Fórum</a>
                    </li>
                    <li>
                        <a href="<?php echo BASE; ?>faq"><i class="fas fa-question"></i> Faq</a>
                    </li>
                </ul>
            </li>
            
                    <li>
                        <a href="<?php echo BASE; ?>criar-personagem"><i class="fa fa-plus"></i> Novo Guerreiro</a>
                    </li>
                    <li>
                        <a href="<?php echo BASE; ?>meus-personagens"><i class="fas fa-users"></i> Meus Guerreiros</a>
                    </li>
                    
            <li>
                <a href="#"><i class="far fa-user"></i> Usuário</a>
                <ul class="submenu">
                        <li>
                            <a href="<?php echo BASE; ?>criar-personagem"><i class="fa fa-plus"></i> Novo Guerreiro</a>
                        </li>
                    <li>
                        <a href="<?php echo BASE; ?>meus-personagens"><i class="fas fa-users"></i> Meus Guerreiros</a>
                    </li>
                    <li>
                        <a href="<?php echo BASE; ?>amigos"><i class="fas fa-users"></i> Lista de Amigos</a>
                    </li>
                    <li>
                        <a href="<?php echo BASE; ?>perfil"><i class="fas fa-edit"></i> Editar Perfil</a>
                    </li>
                    <li>
                        <a href="<?php echo BASE; ?>trocar-senha"><i class="fas fa-key"></i> Trocar Senha</a>
                    </li>
                    <li>
                        <a href="<?php echo BASE; ?>transacoes"><i class="far fa-credit-card"></i> Transações</a>
                    </li>
                </ul>
            </li>
                    
                <li>
                    <a href="#"><i class="far fa-play-circle"></i> Jogar</a>
                    <ul class="submenu">
                        <li>
                            <a href="<?php echo BASE; ?>profile"><i class="fas fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="<?php echo BASE; ?>publico"><i class="fas fa-user-shield"></i> Perfil Público</a>
                        </li>
                        <li>
                            <a href="<?php echo BASE; ?>golpes"><i class="fas fa-chart-line"></i> Treinar Golpes</a>
                        </li>
                        <?php if(!isset($_SESSION['missao']) && !isset($_SESSION['cacada'])){ ?>
                            <li>
                                <a href="<?php echo BASE; ?>missoes"><i class="far fa-clock"></i> Iniciar uma Missão</a>
                            </li>
                            <li>
                                <a href="<?php echo BASE; ?>cacadas"><i class="fas fa-search-location"></i> Iniciar uma Caçada</a>
                            </li>
                            <li>
                                <a href="<?php echo BASE; ?>torneio"><i class="fas fa-award"></i> TAM (Ganhe EXP)</a>
                            </li>
                        <?php } ?>
                        <li>
                            <a href="<?php echo BASE; ?>historico"><i class="fas fa-archive"></i> Histórico PVP</a>
                        </li>
                        <li>
                            <a href="<?php echo BASE; ?>inventario"><i class="fas fa-archive"></i> Inventário</a>
                        </li>
                        <li>
                            <a href="<?php echo BASE; ?>equipes"><i class="fas fa-users"></i> Equipes</a>
                        </li>
                    </ul>
                </li>
                
                <li>
                    <a href="<?php echo BASE; ?>hospital"><i class="fas fa-calendar-plus"></i> Hospital</a>
                </li>
                
                    <li>
                        <a href="<?php echo BASE; ?>torneio"><i class="fas fa-award"></i> TAM (Ganhe EXP)</a>
                    </li>
                    <li>
                        <a href="<?php echo BASE; ?>pvp"><i class="fas fa-globe-americas"></i> PVP Global</a>
                    </li>
                    
                <li>
                    <a href="#">Ranking</a>
                    <ul class="submenu">
                        <li>
                            <a href="<?php echo BASE; ?>ranking"><i class="far fa-chart-bar"></i> Jogadores</a>
                        </li>
                        <li>
                            <a href="<?php echo BASE; ?>equipes/ranking"><i class="far fa-chart-bar"></i> Equipes</a>
                        </li>
                    </ul>
                </li>
                
            <li class="sair">
                <a href="<?php echo BASE; ?>logout">Sair</a>
            </li>
            
            <div class="radar">
                <span>100</span>
                <strong>Coins</strong>
            </div>
        </div>
    </ul>
    

        <div class="user-logado-mobile v-mobile">
            <div class="bloco">
                Usuário Logado: <strong><?php echo $user->username; ?></strong>
            </div>

            <div class="bloco">
                    <span><strong style="color: #fff600; font-size: 14px;"><i class="fas fa-coins"></i> 500 golds</strong></span>
            </div>

            <div class="bloco">
                    <span>Guerreiro: <strong style="color: #41BCD1; font-size: 12px;">nome personagem</strong></span>
            </div>

            <div class="bloco">
                    <span>Raça: <strong style="color: #41BCD1; font-size: 12px;">sayajin</strong></span>
            </div>

            <div class="bloco">
                    <span>Planeta: <strong style="color: #41BCD1; font-size: 12px;">Terra</strong></span>
            </div>

            <div class="bloco">
                    <span>Jogador Free</span>
                    <a href="<?php echo BASE; ?>vantagens" class="tornar-vip">(Clique Aqui para ser VIP)</a>
            </div>
            
            <div class="coins-mobile v-mobile">
                <img src="<?php echo BASE; ?>assets/icones/coin.png" /> 500 Coins
            </div>
        </div>
        <div class="user-status">
            <div class="container">
                <ul>
                    <li class="amigos-box">
                        <a href="<?php echo BASE; ?>amigos">
                            <i class="fas fa-user-friends"></i>
                            <span class="cont">1</span>
                        </a>
                    </li>
                    
                        <li class="equipes-notify">
                            <a href="<?php echo BASE; ?>equipes/convites">
                                <i class="fas fa-shield-alt"></i>
                                <span>Convite Equipes</span>
                                <span class="cont">1</span>
                            </a>
                        </li>
                    
                    <li class="loja-itens">
                        <a href="<?php echo BASE; ?>loja">
                            <i class="fas fa-star"></i>
                            <span>Loja de Itens</span>
                        </a>
                    </li>
                    <div class="atributos-g">
                        <li class="hp">
                            <strong>HP </strong>
                            <div class="meter animate red">
                                <em>35 / <strong>150</strong></em>
                                <span style="width: 35%"><span></span></span>
                            </div>
                        </li>
                        <li class="ki">
                            <strong>KI </strong>
                            <div class="meter animate blue">
                                <em>10 / <strong>150</strong></em>
                                <span style="width: 20%"><span></span></span>
                            </div>
                        </li>
                        <li class="energia">
                            <strong>Energia </strong>
                            <div class="meter animate">
                                <em>25 / <strong>150</strong></em>
                                <span style="width: 15%"><span></span></span>
                            </div>
                        </li>
                    </div>
                </ul>
            </div>
        </div>
    
    <div class="user-logado h-mobile">
        <div class="bloco">
            Usuário Logado: <strong>felipefaciroli</strong>
        </div>
        
        <div class="bloco">
            <span><strong style="color: #fff600; font-size: 14px;"><i class="fas fa-coins"></i> 500 golds</strong></span>
        </div>
        
        <div class="bloco">
                <span>Guerreiro: <strong style="color: #41BCD1; font-size: 12px;">axel</strong></span>
        </div>
        
        <div class="bloco">
                <span>Raça: <strong style="color: #41BCD1; font-size: 12px;">sayajin</strong></span>
        </div>
        
        <div class="bloco">
                <span>Planeta: <strong style="color: #41BCD1; font-size: 12px;">terra</strong></span>
        </div>
        
        <div class="bloco">
                <span>Jogador Free</span>
                <a href="<?php echo BASE; ?>vantagens" class="tornar-vip">(Clique Aqui para ser VIP)</a>
        </div>
    </div>
</header>

<div class="modal-game">
    <div class="modal-header">
        <button class="close-modal"></button>
    </div>
    <div class="modal-body">
        <div class="anuncio">
            <a href="<?php echo BASE; ?>doacao">
                <img src="<?php echo BASE; ?>assets/banner-vip.jpg" alt="" />
            </a>
        </div>
    </div>
</div>


            <script type="text/javascript">
                if(!$.cookie('modal_vip_ad')){
                    $('body').prepend('<div class="backdrop-game"></div>');
                    var date = new Date();
                    var minutes = 30;
                    date.setTime(date.getTime() + (minutes * 60 * 1000));
                    $.cookie('modal_vip_ad', 'value', { expires: date });
                    $('.modal-game').show();
                }
                
                $('.close-modal').on('click', function(){
                    $('.modal-game').hide();
                    $('.backdrop-game').remove();
                });
            </script>