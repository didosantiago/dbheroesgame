<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Personagens
 *
 * @author Felipe Faciroli
 */
class Personagens {
    public $id;
    public $idUsuario;
    public $planeta;
    public $idPlaneta;
    public $persona;
    public $data_cadastro;
    public $boneco;
    public $nome;
    public $raca;
    public $foto;
    public $hp;
    public $mana;
    public $ki_usado;
    public $energia;
    public $energia_usada;
    public $graduacao;
    public $graduacao_id;
    public $nivel;
    public $gold;
    public $gold_total;
    public $forca;
    public $agilidade;
    public $habilidade;
    public $resistencia;
    public $sorte;
    public $gold_guardados;
    public $vitorias_pvp;
    public $derrotas;
    public $pp_creditos;
    public $pontos;
    public $exp;
    public $tam;
    public $time_stamina;
    public $time_ki;
    public $time_hp;
    public $time_invasao;
    
    public function getList(){        
        $sql = "SELECT * FROM personagens WHERE liberado = 1";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $item = $stmt->fetchAll();
        
        $row = '';
        
        foreach ($item as $key => $value) {
            
            $row .= '<label dataFoto="'.$value->foto.'" class="item-personagem" for="per_'.$value->nome.'">
                        <input type="radio" id="per_'.$value->nome.'" name="idPersonagem" value="'.$value->id.'" required />
                        <img src="'.BASE.'assets/cards/'.$value->foto.'" alt="'.$value->nome.'" />
                        <h3>'.$value->nome.'</h3>
                        <span><strong>Raça: </strong>'.$value->raca.'</span>
                     </label>';
        }
        
        echo $row;
    }
    
    public function getPlanetas(){        
        $sql = "SELECT * FROM planetas";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $item = $stmt->fetchAll();
        
        $row = '';
        
        foreach ($item as $key => $value) {
            
            $row .= '<label class="item-planetas" for="planeta_'.$value->nome.'">
                        <input type="radio" id="planeta_'.$value->nome.'" name="idPlaneta" value="'.$value->id.'" required />
                        <img src="'.BASE.'assets/'.$value->imagem.'" alt="'.$value->nome.'" />
                        <h3>'.$value->nome.'</h3>
                     </label>';
        }
        
        echo $row;
    }
    
    public function getMeusPersonagens($idUsuario){        
        $sql = "SELECT up.id, up.nome, up.foto, p.raca  "
             . "FROM usuarios_personagens as up "
             . "INNER JOIN personagens as p ON p.id = up.idPersonagem "
             . "WHERE up.idUsuario = $idUsuario";
        
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $item = $stmt->fetchAll();
        
        $row = '';
        
        foreach ($item as $key => $value) {
            
            $foto = str_replace('cards/', '', $value->foto);
            
            $row .= '<label class="item-personagem meu-personagem" dataid="'.$value->id.'">
                        <img src="'.BASE.'assets/cards/'.$foto.'" alt="'.$value->nome.'" />
                        <h3>'.$value->nome.'</h3>
                        <span><strong>Raça: </strong>'.$value->raca.'</span>
                     </label>';
        }
        
        echo $row;
    }
    
    public function getGuerreiroInfo($id){
        
        $treino = new Treino();
        
        if($id != ''){
            $sql = "SELECT up.*, pn.nome as planeta, p.raca "
                 . "FROM usuarios_personagens as up "
                 . "INNER JOIN personagens as p ON p.id = up.idPersonagem "
                 . "INNER JOIN planetas as pn ON pn.id = up.idPlaneta "
                 . "WHERE up.id = '$id'";

            $stmt = DB::prepare($sql);
            $stmt->execute();
            $row = $stmt->fetch();
            
            $this->id = $row->id;
            $this->idUsuario = $row->idUsuario;
            $this->planeta = $row->planeta;
            $this->idPlaneta = $row->idPlaneta;
            $this->persona = $row->idPersonagem;
            $this->data_cadastro = $row->data_cadastro;
            $this->boneco = $row->idPersonagem;
            $this->nome = $row->nome;
            $this->raca = $row->raca;
            $this->foto = $row->foto;
            $this->hp = $row->hp;
            $this->mana = $row->mana;
            $this->ki_usado = $row->ki_usado;
            $this->energia = $row->energia;
            $this->energia_usada = $row->energia_usada;
            $this->graduacao = $this->getGraduacaoName($row->nivel);
            $this->graduacao_id = $row->graduacao;
            $this->nivel = $row->nivel;
            $this->gold = $row->gold;
            $this->gold_total = $row->gold_total;
            $this->forca = $row->forca;
            $this->agilidade = $row->agilidade;
            $this->habilidade = $row->habilidade;
            $this->resistencia = $row->resistencia;
            $this->sorte = $row->sorte;
            $this->gold_guardados = $row->gold_guardados;
            $this->vitorias_pvp = $row->vitorias_pvp;
            $this->derrotas = $row->derrotas;
            $this->pp_creditos = $row->pp_creditos;
            $this->pontos = $row->pontos;
            $this->exp = $row->exp;
            $this->tam = $row->tam;
            $this->time_stamina = $row->time_stamina;
            $this->time_ki = $row->time_ki;
            $this->time_hp = $row->time_hp;
            $this->time_invasao = $row->time_invasao;
        }
        
        $foto = str_replace('cards/', '', $this->foto);
        
        if($this->nivel > 1){
            $nivel_hp = 150 + ((intval($this->nivel) - 1) * 50);
        } else {
            $nivel_hp = 150;
        }

        $porcentagem_hp = $treino->getPorcentagemHP($nivel_hp, $nivel_hp - $this->hp);
        $porcentagem_ki = $treino->getPorcentagemKI($this->mana, $this->ki_usado);
        $porcentagem_energia = $treino->getPorcentagemEnergia($this->energia, $this->energia_usada);
        
        $result_ki = intval($this->mana) - intval($this->ki_usado);
        $result_energia = intval($this->energia) - intval($this->energia_usada);
        
        $rows = '<div class="foto-personagem">
                    <a href="'.BASE.'profile">
                        <img src="'.BASE.'assets/cards/'.$foto.'" alt="'.$this->nome.'" />
                    </a>
                </div>
                <div class="info">
                    <h3>'.$this->nome.'</h3>
                    <div class="atributos raca">
                        <strong>Raça: </strong>
                        '.$this->raca.'
                    </div>
                    <div class="atributos planeta">
                        <strong>Planeta: </strong>
                        '.$this->planeta.'
                    </div>
                    <div class="atributos graduacao">
                        <strong>Graduação: </strong>
                        '.$this->graduacao.'
                    </div>
                    <div class="atributos nivel">
                        <strong>Nível: </strong>
                        '.$this->nivel.'
                    </div>
                    <div class="atributos nivel">
                        <strong>Gold: </strong>
                        <i class="fas fa-coins"></i> '.$this->gold.'
                    </div>
                    <div class="atributos hp at-meter">
                    <strong>HP </strong>
                        <div class="meter animate red">
                            <em>'.$this->hp.' / <strong>'.$nivel_hp.'</strong></em>
                            <span style="width: '.$porcentagem_hp.'%"><span></span></span>
                        </div>
                    </div>
                    <div class="atributos mana at-meter">
                        <strong>KI </strong>
                        <div class="meter animate blue">
                            <em>'.$result_ki.' / <strong>'.$this->mana.'</strong></em>
                            <span style="width: '.$porcentagem_ki.'%"><span></span></span>
                        </div>
                    </div>
                    <div class="atributos energia at-meter">
                        <strong>Energia </strong>
                        <div class="meter animate">
                            <em>'.$result_energia.' / <strong>'.$this->energia.'</strong></em>
                            <span style="width: '.$porcentagem_energia.'%"><span></span></span>
                        </div>
                    </div>
                    <button class="bts-form bt-jogar" dataid="'.$this->id.'">Jogar <i class="fas fa-play"></i></button>
                </div>';
        
        echo $rows;
    }
    
    public function getGuerreiro($id){
        
        if($id != ''){
            $sql = "SELECT up.*, pn.nome as planeta, p.raca "
                 . "FROM usuarios_personagens as up "
                 . "INNER JOIN personagens as p ON p.id = up.idPersonagem "
                 . "INNER JOIN planetas as pn ON pn.id = up.idPlaneta "
                 . "WHERE up.id = '$id'";

            $stmt = DB::prepare($sql);
            $stmt->execute();
            $row = $stmt->fetch();
            
            $this->id = $row->id;
            $this->idUsuario = $row->idUsuario;
            $this->planeta = $row->planeta;
            $this->idPlaneta = $row->idPlaneta;
            $this->persona = $row->idPersonagem;
            $this->data_cadastro = $row->data_cadastro;
            $this->boneco = $row->idPersonagem;
            $this->nome = $row->nome;
            $this->raca = $row->raca;
            $this->foto = $row->foto;
            $this->hp = $row->hp;
            $this->mana = $row->mana;
            $this->ki_usado = $row->ki_usado;
            $this->energia = $row->energia;
            $this->energia_usada = $row->energia_usada;
            $this->graduacao = $this->getGraduacaoName($row->nivel);
            $this->graduacao_id = $row->graduacao;
            $this->nivel = $row->nivel;
            $this->gold = $row->gold;
            $this->gold_total = $row->gold_total;
            $this->forca = $row->forca;
            $this->agilidade = $row->agilidade;
            $this->habilidade = $row->habilidade;
            $this->resistencia = $row->resistencia;
            $this->sorte = $row->sorte;
            $this->gold_guardados = $row->gold_guardados;
            $this->vitorias_pvp = $row->vitorias_pvp;
            $this->derrotas = $row->derrotas;
            $this->pp_creditos = $row->pp_creditos;
            $this->pontos = $row->pontos;
            $this->exp = $row->exp;
            $this->tam = $row->tam;
            $this->time_stamina = $row->time_stamina;
            $this->time_ki = $row->time_ki;
            $this->time_hp = $row->time_hp;
            $this->time_invasao = $row->time_invasao;
        }
    }
    
    public function getOponente($id){
        if($id != ''){
            $sql = "SELECT up.*, pn.nome as planeta, p.raca "
                 . "FROM usuarios_personagens as up "
                 . "INNER JOIN personagens as p ON p.id = up.idPersonagem "
                 . "INNER JOIN planetas as pn ON pn.id = up.idPlaneta "
                 . "WHERE up.id = '$id'";

            $stmt = DB::prepare($sql);
            $stmt->execute();
            $row = $stmt->fetch();
            
            return $row;
        }
    }
       
    public function existsGuerreiro($idUsuario){
        if($idUsuario != ''){
            $sql = "SELECT * FROM usuarios_personagens WHERE idUsuario = '$idUsuario'";

            $stmt = DB::prepare($sql);
            $stmt->execute();
            
            if($stmt->rowCount() > 0){
                return true;
            } else {
                return false;
            }
        }
    }
    
    public function esgotado($idUsuario){
        if($idUsuario != ''){
            $sql = "SELECT * FROM usuarios_personagens WHERE idUsuario = '$idUsuario'";

            $stmt = DB::prepare($sql);
            $stmt->execute();
            
            if($stmt->rowCount() >= 3){
                return true;
            } else {
                return false;
            }
        }
    }
    
    public function getEquipamentos($idPersonagem){
        $sql = "SELECT i.* "
             . "FROM personagens_itens_equipados as pie "
             . "INNER JOIN itens as i ON i.id = pie.idItem "
             . "WHERE pie.idPersonagem = $idPersonagem "
             . "AND pie.vazio = 0";

        $stmt = DB::prepare($sql);
        $stmt->execute();
        
        $row = '';

        if($stmt->rowCount() > 0){
            $item = $stmt->fetchAll();
            
            foreach ($item as $key => $value) {
                $row .= '<li>';
                    $row .= '<img src="'.BASE.'assets/'.$value->foto.'" />';
                    $row .= '<div class="info">
                        <h3>'.$value->nome.'</h3>';
                    
                        if($value->hp > 0){
                            $row .= '<span><strong>HP: </strong> +'.$value->hp.'</span>';
                        }

                        if($value->mana > 0){
                            $row .= '<span><strong>KI: </strong> +'.$value->mana.'</span>';
                        }

                        if($value->energia > 0){
                            $row .= '<span><strong>Energia: </strong> +'.$value->energia.'</span>';
                        }

                        if($value->forca > 0){
                            $row .= '<span><strong>Força: </strong> +'.$value->forca.'</span>';
                        }

                        if($value->agilidade > 0){
                            $row .= '<span><strong>Agilidade: </strong> +'.$value->agilidade.'</span>';
                        }

                        if($value->habilidade > 0){
                            $row .= '<span><strong>Habilidade:</strong>+ '.$value->habilidade.'</span>';
                        }

                        if($value->resistencia > 0){
                            $row .= '<span><strong>Resistência: </strong> +'.$value->resistencia.'</span>';
                        }

                        if($value->sorte > 0){
                            $row .= '<span><strong>Sorte: </strong> +'.$value->sorte.'</span>';
                        }
                    $row .= '</div>';                    
                $row .= '</li>';
            }
        }
        
        return $row;
    }
    
    public function getExistsEquipamentos($idPersonagem){
        $sql = "SELECT i.* "
             . "FROM personagens_itens_equipados as pie "
             . "INNER JOIN itens as i ON i.id = pie.idItem "
             . "WHERE pie.idPersonagem = $idPersonagem "
             . "AND pie.vazio = 0";

        $stmt = DB::prepare($sql);
        $stmt->execute();
        
        $row = '';

        if($stmt->rowCount() > 0){
            return true;
        } else {
            return false;
        }
    }
    
    public function getInfoPersonagem($id){
        if($id != ''){
            $sql = "SELECT * FROM personagens WHERE id = '$id'";

            $stmt = DB::prepare($sql);
            $stmt->execute();
            $item = $stmt->fetch();
            
            return $item;
        }
    }
    
    public function nomeGuerreiroExists($nome){
        
        if($nome != ''){
            $sql = "SELECT * FROM usuarios_personagens WHERE UPPER(nome) = '$nome' && nome = '$nome'";

            $stmt = DB::prepare($sql);
            $stmt->execute();
            
            if($stmt->rowCount() > 0){
                return true;
            } else {
                return false;
            }
        }
    }
    
    public function calculaCacada($idUsuario, $dados, $idPlaneta, $idPersonagem, $vip, $exp, $nivel_exp){
        $core = new Core();
        $config = $core->getConfiguracoes();
        
        $tempo = $dados['tempo'];
        $qtd_exp = 0;
        
        $sql = "SELECT * FROM cacadas_gold";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $table_exp = $stmt->fetchAll();
        $vl_gold = 0;
        
        foreach ($table_exp as $key => $value) {
            if($exp >= $value->exp_inicial && $exp <= $value->exp_final){
                $porcentagem_tempo = $tempo * (10 / 100);
                $qtd_exp = intval($value->ganho_exp) * intval($porcentagem_tempo);

                if($tempo == 10){
                    $vl_gold = $value->time_10;
                } else if($tempo == 20){
                    $vl_gold = $value->time_20;
                } else if($tempo == 30){
                    $vl_gold = $value->time_30;
                } else if($tempo == 40){
                    $vl_gold = $value->time_40;
                } else if($tempo == 50){
                    $vl_gold = $value->time_50;
                } else if($tempo == 60){
                    $vl_gold = $value->time_60;
                }
            } 
        }
        
        if($config->teste == 1){
            $qtd_exp = 200;
            $segundos = 10;
        } else {
            if($vip == 1){
                $time_vip = (50 / 100) * intval($tempo);
            } else {
                $time_vip = intval($tempo);
            }
            
            $segundos = $time_vip * 60;
        }
        
        $tempo_atual = time();
        $tempo_final = time() + $segundos;
        
        $campos = array(
            'idPersonagem' => $idPersonagem,
            'idPlaneta' => $idPlaneta,
            'idUsuario' => $idUsuario,
            'tempo' => $tempo_atual,
            'tempo_final' => $tempo_final,
            'gold' => $vl_gold,
            'tempo' => $tempo,
            'data' => date('Y-m-d'),
            'exp' => $qtd_exp
        );
        
        $core->insert('cacadas', $campos);
        
        $sql = "SELECT * FROM cacadas WHERE idUsuario = '$idUsuario' ORDER BY id DESC LIMIT 1";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $dados_cacada = $stmt->fetch();
        
        $_SESSION['cacada'] = true;
        $_SESSION['cacada_id'] = $dados_cacada->id;        
        header('Location: '.BASE.'portal');
    }
    
    public function somaCacada($idUsuario, $idCacada){
        $core = new Core();
        $treino = new Treino();
        
        $sql = "SELECT * FROM cacadas WHERE idUsuario = '$idUsuario' AND id = $idCacada AND concluida = 0";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $cacada = $stmt->fetch();
        
        if($stmt->rowCount() > 0){
            if($cacada->tempo_final < time()){
                $campos = array(
                    'concluida' => 1
                );

                $where = 'id = "'.$cacada->id.'"';

                $core->update('cacadas', $campos, $where);

                $gold_per = $this->getPontosPersonagem($cacada->idPersonagem);
                $exp_per = $this->getExpPersonagem($cacada->idPersonagem);
                
                $sql = "SELECT * FROM usuarios_personagens WHERE id = '$cacada->idPersonagem'";
                $stmt = DB::prepare($sql);
                $stmt->execute();
                $up = $stmt->fetch();

                $campos_personagem = array(
                    'gold' => intval($up->gold) + intval($cacada->gold),
                    'gold_total' => intval($up->gold_total) + intval($cacada->gold),
                    'exp' => $cacada->exp + $exp_per
                );

                $where_personagem = 'id = "'.$cacada->idPersonagem.'"';

                $core->update('usuarios_personagens', $campos_personagem, $where_personagem);
                
                $campos_ganho = array(
                    'idPersonagem' => $cacada->idPersonagem,
                    'gold' => intval($cacada->gold),
                    'exp' => $cacada->exp
                );

                $core->insert('personagens_new_valores', $campos_ganho);
                
                $person = $core->getDados('usuarios_personagens', "WHERE id = ".$cacada->idPersonagem);
                
                $treino->viewNewLevel($person->id, $person->nivel, $person->exp);
            }
        }
    }
    
    public function cacadaEsgotada($idPersonagem, $time, $vip){
        $core = new Core();
        
        $sql = "SELECT * FROM cacadas WHERE idPersonagem = $idPersonagem AND concluida = 1 AND cancelada = 0 AND data = CURRENT_DATE()";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $cacada = $stmt->fetchAll();
        
        if($vip == 1){
            $tempo = $time / 2;
        } else {
            $tempo = $time;
        }
        
        foreach ($cacada as $key => $value) {
            $tempo += intval($value->tempo);
        }
        
        if($vip == 1){
            $tempo = $tempo / 2;
        }
        
        if($vip == 1){
            $qtd = 120;
        } else {
            $qtd = 60;
        }
        
        $config = $core->getConfiguracoes();
        
        if($config->teste == 1){
            return false;
        } else {
            if($tempo >= $qtd){
                return true;
            } else {
                return false;
            }
        }
    }
    
    public function cacadasRun($idUsuario, $idPersonagem){
        $core = new Core();
        
        $sql = "SELECT * FROM cacadas WHERE idUsuario = '$idUsuario' AND idPersonagem = $idPersonagem AND concluida = 0 AND cancelada = 0";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $cacada = $stmt->fetch();
        
        if($stmt->rowCount() > 0){
            $_SESSION['cacada'] = true;
            $_SESSION['cacada_id'] = $cacada->id;  
        }
    }
    
    public function cacadaExecuting($idUsuario, $idPersonagem){
        $core = new Core();
        
        $sql = "SELECT * FROM cacadas WHERE idUsuario = '$idUsuario' AND idPersonagem = $idPersonagem AND concluida = 0";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $dados_cacada = $stmt->fetch();
        
        if($stmt->rowCount() > 0){
            $_SESSION['cacada'] = true;
            $_SESSION['cacada_id'] = $dados_cacada->id;  
            
            return true;
        } else {
            return false;
        }
    }
    
    public function verificaCacadaCancelada($idCacada){
        $core = new Core();
        
        $sql = "SELECT * FROM cacadas WHERE id = '$idCacada' AND cancelada = 1";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        
        if($stmt->rowCount() > 0){
            return true;
        } else {
            return false;
        }
    }
    
    public function contadorCacada($idPersonagem){
        $core = new Core();
        
        $sql = "SELECT * FROM cacadas WHERE idPersonagem = $idPersonagem AND concluida = 0 AND cancelada = 0";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $cacada = $stmt->fetch();
        
        if($stmt->rowCount() > 0){
            if($cacada->tempo_final > time()){
                $restante = $cacada->tempo_final - time();
                echo $restante;
            }
        }
    }
    
    public function contadorPVP($idPersonagem){
        $core = new Core();
        
        $sql = "SELECT * FROM pvp WHERE idPersonagem = $idPersonagem AND concluido = 0";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $pvp = $stmt->fetch();
        
        if($stmt->rowCount() > 0){
            if($pvp->time_final > time()){
                $restante = $pvp->time_final - time();
                echo $restante;
            }
        }
    }
    
    public function contadorBatalha($idPersonagem){
        $core = new Core();
        
        $sql = "SELECT * FROM usuarios_personagens WHERE idPersonagem = $idPersonagem";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $pvp = $stmt->fetch();
        
        if($stmt->rowCount() > 0){
            if($pvp->time_ataque > time()){
                $restante = $pvp->time_ataque - time();
                echo $restante;
            }
        }
    }
    
    public function contadorPunicao($idAdversario){
        $core = new Core();
        
        $sql = "SELECT * FROM usuarios_personagens WHERE id = $idAdversario";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $pvp = $stmt->fetch();
        
        if($stmt->rowCount() > 0){
            if($pvp->time_defesa > time()){
                $restante = $pvp->time_defesa - time();
                echo $restante;
            }
        }
    }
    
    public function getPontosPersonagem($id){
        $sql = "SELECT * FROM usuarios_personagens WHERE id = $id";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $item = $stmt->fetch();
        
        return intval($item->gold);
    }
    
    public function getExpPersonagem($id){
        $sql = "SELECT * FROM usuarios_personagens WHERE id = $id";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $item = $stmt->fetch();
        
        return intval($item->exp);
    }
    
    public function getGraduacao($nivel, $new_lv = 0){        
        $sql = "SELECT * FROM graduacoes";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $graduacao = $stmt->fetchAll();
        
        $class = '';
        
        if($new_lv == 1){
            $class = 'pulse';
        }

        foreach ($graduacao as $key => $value) {
            if($nivel >= $value->level_inicial && $nivel <= $value->level_final){
                echo '<img class="'.$class.'" src="'.BASE.'assets/'.$value->emblema.'" alt="'.$value->graduacao.'" />';
            } 
        }
    }
    
    public function getGraduacaoNumber($nivel){        
        $sql = "SELECT * FROM graduacoes";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $graduacao = $stmt->fetchAll();

        foreach ($graduacao as $key => $value) {
            if($nivel >= $value->level_inicial && $nivel <= $value->level_final){
                return $value->id;
            } 
        }
    }
    
    public function getGraduacaoBatalha($nivel){        
        $sql = "SELECT * FROM graduacoes";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $graduacao = $stmt->fetchAll();

        foreach ($graduacao as $key => $value) {
            if($nivel >= $value->level_inicial && $nivel <= $value->level_final){
                return '<img src="'.BASE.'assets/'.$value->emblema.'" alt="'.$value->graduacao.'" />';
            } 
        }
    }
    
    public function getGraduacaoTexto($nivel){        
        $sql = "SELECT * FROM graduacoes";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $graduacao = $stmt->fetchAll();

        foreach ($graduacao as $key => $value) {
            if($nivel >= $value->level_inicial && $nivel <= $value->level_final){
                echo '<span>'.$value->graduacao.'</span>';
            } 
        }
    }
    
    public function getGraduacaoTextoBatalha($nivel){        
        $sql = "SELECT * FROM graduacoes";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $graduacao = $stmt->fetchAll();

        foreach ($graduacao as $key => $value) {
            if($nivel >= $value->level_inicial && $nivel <= $value->level_final){
                return '<span>'.$value->graduacao.'</span>';
            } 
        }
    }
    
    public function getGraduacaoTextoByID($id){        
        $sql = "SELECT * FROM graduacoes WHERE id = $id";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $graduacao = $stmt->fetch();

        return $graduacao->graduacao;
    }
    
    public function getGraduacaoName($nivel){        
        $sql = "SELECT * FROM graduacoes";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $graduacao = $stmt->fetchAll();

        foreach ($graduacao as $key => $value) {
            if($nivel >= $value->level_inicial && $nivel <= $value->level_final){
                return $value->graduacao;
            } 
        }
    }
    
    public function upaGraduacao($graduacao_anterior, $idPersonagem, $nivel, $vip){
        $core = new Core();
        $inventario = new Inventario();
        
        $sql = "SELECT * FROM graduacoes";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $graduacao = $stmt->fetchAll();

        foreach ($graduacao as $key => $value) {
            if($nivel >= $value->level_inicial && $nivel <= $value->level_final){
                $grad = $value->id;
            } 
        }
        
        if($graduacao_anterior < $grad){
            $campos = array(
                'graduacao' => $grad
            );

            $where = 'id = "'.$idPersonagem.'"';

            $core->update('usuarios_personagens', $campos, $where);
            
            $sql = "SELECT * FROM usuarios_personagens WHERE id = $idPersonagem";
            $stmt = DB::prepare($sql);
            $stmt->execute();
            $meu_personagem = $stmt->fetch();
            
            if($grad > 1 && $grad <= 3){
                $bau = 36;
            } else if($grad > 3 && $grad <= 6){
                $bau = 37;
            } else if($grad > 6 && $grad <= 9){
                $bau = 38;
            } else if($grad > 9 && $grad <= 12){
                $bau = 39;
            } else if($grad > 12 && $grad <= 15){
                $bau = 41;
            } else if($grad > 15 && $grad <= 18){
                $bau = 40;
            }
            
            $sql = "SELECT * FROM itens WHERE id = $bau";
            $stmt = DB::prepare($sql);
            $stmt->execute();
            $dados_bau = $stmt->fetch();
            
            if($vip == 1){
                if($inventario->verificaItemIgual($dados_bau->nome, $idPersonagem)){
                    $slot_1 = $inventario->verificaItemIgual($dados_bau->nome, $idPersonagem);
                }
                
                if($inventario->verificaItemIgual($dados_bau->nome, $idPersonagem)){
                    $slot_2 = $inventario->verificaItemIgual($dados_bau->nome, $idPersonagem);
                }
                
                $campos_insert_bau_1 = array(
                    'idPersonagem' => $idPersonagem,
                    'idSlot' => $slot_1,
                    'idItem' => $bau
                );

                $core->insert('personagens_inventario_itens', $campos_insert_bau_1);
                
                $campos_insert_bau_2 = array(
                    'idPersonagem' => $idPersonagem,
                    'idSlot' => $slot_2,
                    'idItem' => $bau
                );

                $core->insert('personagens_inventario_itens', $campos_insert_bau_2);
                
                $campos_insert_premio = array(
                    'idMissao' => 1,
                    'idItem' => $bau,
                    'idPersonagem' => $idPersonagem,
                    'visualizado' => 0   
                );

                $core->insert('personagens_missoes_premios', $campos_insert_premio);
                
                $core->insert('personagens_missoes_premios', $campos_insert_premio);
            } else {
                if($inventario->verificaItemIgual($dados_bau->nome, $idPersonagem)){
                    $slot_1 = $inventario->verificaItemIgual($dados_bau->nome, $idPersonagem);
                }
                
                $campos_insert_bau_1 = array(
                    'idPersonagem' => $idPersonagem,
                    'idSlot' => $slot_1,
                    'idItem' => $bau
                );

                $core->insert('personagens_inventario_itens', $campos_insert_bau_1);
                
                $campos_insert_premio = array(
                    'idMissao' => 1,
                    'idItem' => $bau,
                    'idPersonagem' => $idPersonagem,
                    'visualizado' => 0   
                );

                $core->insert('personagens_missoes_premios', $campos_insert_premio);
            }
        }
    }
    
    public function verificaFoto($foto, $idPersonagem){
        $sql = "SELECT * FROM usuarios_personagens_fotos WHERE foto = '$foto' AND idPersonagem = $idPersonagem";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        
        if($stmt->rowCount() > 0){
            return true;
        } else {
            return false;
        }
    }


    public function getNewValores($idPersonagem){
        $sql = "SELECT * FROM personagens_new_valores WHERE idPersonagem = '$idPersonagem' AND visualizado = 0";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        
        if($stmt->rowCount() > 0){
            return true;
        } else {
            return false;
        }
    }
    
    public function getListaNewValores($idPersonagem){
        $core = new Core();
        
        $sql = "SELECT * FROM personagens_new_valores WHERE idPersonagem = '$idPersonagem' AND visualizado = 0";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        
        $row = '<div class="infos">';
        
        if($stmt->rowCount() > 0){
            $item = $stmt->fetchAll();

            foreach ($item as $key => $value) {
                if($value->gold > 0){
                    $row .= '<span>Você Ganhou + <strong>'.$value->gold.'</strong> de Gold.</span>';
                }

                if($value->exp > 0){
                    $row .= '<span>Você Aumentou em <strong>'.$value->exp.'</strong> sua Experiência.</span>';
                }
            }
        }
        $row .= '</div>';
        
        $row .= '<form id="confirmarGanho" method="post">
                    <input type="submit" class="bts-form" name="confirmar_ganho" value="Confirmar" />
                </form>';
        
        echo $row;
    }
    
    public function confirmaGanho($idPersonagem, $vip){
        $core = new Core();
        
        $campos = array(
            'visualizado' => 1
        );

        $where = 'idPersonagem = "'.$idPersonagem.'"';

        $core->update('personagens_new_valores', $campos, $where);
        
        $sql = "SELECT * FROM usuarios_personagens WHERE id = $idPersonagem";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $up = $stmt->fetch();
        
        $this->upaGraduacao($up->graduacao, $idPersonagem, $up->nivel, $vip);
    }
    
    public function getListNewPhotos($idPersonagem){
        $core = new Core();
        
        $sql = "SELECT * FROM usuarios_personagens_fotos WHERE idPersonagem = $idPersonagem AND visualizado = 0";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $item = $stmt->fetchAll();
        
        $row = '';
        
        foreach ($item as $key => $value) {
            $identificador = str_replace('.', '-', $value->foto);
            
            $row .= '<div class="backdrop-game"></div>
                     <div class="nova-foto">
                        <img id="'.$identificador.'" src="'.BASE.'assets/cards/'.$value->foto.'" />
                        <span>Parabéns, o item foi adquirido com sucesso!</span>
                        <button id="confirmarFoto">OK</button>
                     </div>';
        }
        
        echo $row;
    }
    
    public function setViewFotos($idPersonagem){
        $core = new Core();
        
        $campos = array(
            'visualizado' => '1'
        );
            
        $where = "idPersonagem = ".$idPersonagem;

        $core->update('usuarios_personagens_fotos', $campos, $where);
    }
    
    public function getRanking($tipo, $planeta, $pc, $qtd_resultados){
        $user = new Usuarios();
        $core = new Core();

        //Paginando os Resultados
        $counter = $core->counterRegisters("usuarios_personagens", "WHERE nivel > 1");
        $pager = new Paginator();
        $inicio = $pager->inicio($pc, $counter, $qtd_resultados);
        $tp = $counter / $qtd_resultados;
        
        $sql_planeta = '';
        $sql_missoes = '';
        $orderBY = "ORDER BY up.nivel DESC, up.vitorias_pvp DESC, up.tam DESC, up.gold_total DESC";
        
        if($planeta != null){
            $sql_planeta = "AND up.idPlaneta = $planeta ";
        }
        
        if($tipo != ''){
            if($tipo == 2){
                $orderBY = "ORDER BY up.vitorias_pvp DESC, up.nivel DESC, up.tam DESC, up.gold_total DESC";
            } else if($tipo == 4){
                $orderBY = "ORDER BY up.tam DESC, up.vitorias_pvp DESC, up.nivel DESC, up.gold_total DESC";
            }
        }
        
        $sql = "SELECT "
            . "up.*, up.id as idP, up.foto as foto_personagem, "
            . "u.*, "
            .$sql_missoes
            . "up.nome as nome_guerreiro, "
            . "p.nome as planeta, p.imagem as img_planeta "
            . "FROM usuarios_personagens as up "
            . "INNER JOIN usuarios as u ON u.id = up.idUsuario "
            . "INNER JOIN planetas as p ON up.idPlaneta = p.id "
            . "WHERE nivel > 1 "
            . $sql_planeta
            . $orderBY." LIMIT " . $inicio . ',' . $qtd_resultados;
        
        $stmt = DB::prepare($sql);
        $stmt->execute();
        
        $row = '';
        
        if($pc == 1){
            $rank = 0;
        } else {
            $rank = $inicio;
        }
        
        if($stmt->rowCount() > 0){
            $item = $stmt->fetchAll();
            
            foreach ($item as $key => $value) {
                
                $rank++;
                
                if($rank == 1){
                    $top = 'top-player';
                } else {
                    $top = '';
                }
                
                $ft = str_replace('cards/', '', $value->foto_personagem);

                $row .= '<tr class="'.$top.'">
                            <td><strong>'.$rank.'º</strong></td>
                            <td>
                                <a href="'.BASE.'publico/'.$value->idP.'">
                                    <img src="'.BASE.'assets/cards/'.$ft.'" alt="'.$value->nome_guerreiro.'" />
                                </a>
                            </td>
                            <td width="250">
                                <a href="'.BASE.'publico/'.$value->idP.'">
                                    <strong>'.$value->nome_guerreiro.'</strong>
                                </a>
                            </td>
                            <td width="250">'.$this->verificaGraduacao($value->nivel).'</td>
                            <td>'.$value->nivel.'</td>
                            <td>'.$value->vitorias_pvp.'</td>
                            <td>'.$this->getDerrotasPVP($value->idP).'</td>
                            <td>'.$value->tam.'</td>
                            <td>'.$value->gold_total.'</td>
                            <td>'.$user->isGuerreiroOnline($value->idP).'</td>
                            <td class="planeta">
                                <img src="'.BASE.'assets/'.$value->img_planeta.'" alt="'.$value->planeta.'" />
                                <span>'.$value->planeta.'</span>
                            </td>
                         </tr>';
            }
            
            // Mostra Navegador da Paginação
            $row .= '<tr>'
                   . '<td colspan="11" style="test-align: center;">'.$pager->paginar($pc, $tp).'</td>'
                 . '</tr>'; 
            
        } else {
           $row .= '<tr>'
                   . '<td colspan="9">Ranking não encontrado com o filtro selecionado.</td>'
                 . '</tr>'; 
        }
        
        echo $row;
    }
    
    public function getDerrotasPVP($idPersonagem){
        $total = 0;
        
        $sql = "SELECT count(*) as total FROM pvp WHERE idPersonagem = $idPersonagem AND vencedor = 0";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $desafiou = $stmt->fetch();
        
        $total = $desafiou->total;
        
        $sql = "SELECT count(*) as total FROM pvp WHERE idDesafiado = $idPersonagem AND vencedor = 1";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $desafiado = $stmt->fetch();
        
        $total += $desafiado->total;
        
        return $total;
    }

    public function getRankingFront(){
        $user = new Usuarios();
        $core = new Core();
        
        $orderBY = "ORDER BY up.nivel DESC, up.vitorias_pvp DESC, up.tam DESC, up.gold_total DESC";
        
        $sql = "SELECT "
            . "up.*, up.id as idP, up.foto as foto_personagem, "
            . "u.*, "
            . "up.nome as nome_guerreiro, "
            . "p.nome as planeta, p.imagem as img_planeta "
            . "FROM usuarios_personagens as up "
            . "INNER JOIN usuarios as u ON u.id = up.idUsuario "
            . "INNER JOIN planetas as p ON up.idPlaneta = p.id "
            . $orderBY." LIMIT 10";
        
        $stmt = DB::prepare($sql);
        $stmt->execute();
        
        $row = '';

        $rank = 0;
        
        if($stmt->rowCount() > 0){
            $item = $stmt->fetchAll();
            
            foreach ($item as $key => $value) {
                
                $rank++;
                
                if($rank == 1){
                    $top = 'top-player';
                } else {
                    $top = '';
                }
                
                $ft = str_replace('cards/', '', $value->foto_personagem);

                $row .= '<tr class="'.$top.'">
                            <td class="rank"><strong>'.$rank.'º</strong></td>
                            <td>
                                <img src="'.BASE.'assets/cards/'.$ft.'" alt="'.$value->nome_guerreiro.'" />
                            </td>
                            <td width="250">
                                <strong>'.$value->nome_guerreiro.'</strong>
                            </td>
                            <td width="250">'.$this->verificaGraduacao($value->nivel).'</td>
                            <td>'.$value->nivel.'</td>
                            <td class="planeta">
                                <img src="'.BASE.'assets/'.$value->img_planeta.'" alt="'.$value->planeta.'" />
                                <span>'.$value->planeta.'</span>
                            </td>
                         </tr>';
            }
            
        } else {
           $row .= '<tr>'
                   . '<td colspan="6">Nenhum guerreiro cadastrado.</td>'
                 . '</tr>'; 
        }
        
        echo $row;
    }
    
    public function verificaGraduacao($level){
        $core = new Core();

        $sql = "SELECT * FROM graduacoes";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $graduacao = $stmt->fetchAll();
        
        $txt_graduacao = '';

        foreach ($graduacao as $key => $value) {
            if($level >= $value->level_inicial && $level <= $value->level_final){
                $txt_graduacao = $value->graduacao;
            } 
        }
        
        return $txt_graduacao;
    }
    
    public function printGoldsCacada($nivel){
        $sql = "SELECT * FROM cacadas_gold";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $table_exp = $stmt->fetchAll();

        foreach ($table_exp as $key => $value) {
            $exp = $value->ganho_exp;
            
            if($nivel >= $value->exp_inicial && $nivel <= $value->exp_final){  
                echo '<strong>10 minutos (Membros VIP 5 minutos)</strong> = Você ganha '.$value->time_10.' de Gold e '.$exp.' de Exp.';
                echo '<br>';
                echo '<strong>20 minutos (Membros VIP 10 minutos)</strong> = Você ganha '.$value->time_20.' de Gold e '.($exp * 2).' de Exp.';
                echo '<br>';
                echo '<strong>30 minutos (Membros VIP 15 minutos)</strong> = Você ganha '.$value->time_30.' de Gold e '.($exp * 3).' de Exp.';
                echo '<br>';
                echo '<strong>40 minutos (Membros VIP 20 minutos)</strong> = Você ganha '.$value->time_40.' de Gold e '.($exp * 4).' de Exp.';
                echo '<br>';
                echo '<strong>50 minutos (Membros VIP 25 minutos)</strong> = Você ganha '.$value->time_50.' de Gold e '.($exp * 5).' de Exp.';
                echo '<br>';
                echo '<strong>60 minutos (Membros VIP 30 minutos)</strong> = Você ganha '.$value->time_60.' de Gold e '.($exp * 6).' de Exp.';
            } 
        }
    }
    
    public function getAllFotosPersonagem($idPersonagem, $foto_atual, $vip, $graduacao, $boneco, $idUsuario){
        $core = new Core();
        
        $sql = "SELECT * FROM personagens_fotos WHERE idPersonagem = $boneco AND status = 1 ORDER BY free DESC, raridade ASC";
        
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $fotos_personagem = $stmt->fetchAll();
        
        $row = '';
        
        foreach ($fotos_personagem as $key => $value) {
            $class = '';
            $bloqueada = '';
            
            if($value->raridade == 1){
                $class = 'verde';
            } else if($value->raridade == 2){
                $class = 'azul';
            } else if($value->raridade == 3){
                $class = 'roxo';
            } else if($value->raridade == 4){
                $class = 'laranja';
            }
            
            if($value->free == 1){
                $identificador = str_replace('.', '-', $value->foto);
                
                $row .= '<li dataImage="'.$value->foto.'" id="'.$identificador.'-1" class="'.$class.'">';

                    if($foto_atual == $value->foto){
                        $row .= '<i class="fas fa-check-circle"></i>';
                    }
                $row .= '<img src="'.BASE.'assets/cards/'.$value->foto.'" alt="Foto" />
                         </li>';
            } else {
                $sql = "SELECT * FROM usuarios_personagens_fotos WHERE idUsuario = $idUsuario AND foto = '$value->foto'";
                $stmt = DB::prepare($sql);
                $stmt->execute();
                $encontrouVip = $stmt->fetch();
                
                if($encontrouVip == false){
                    $bloqueada = 'bloqueado';
                }
                
                $identificador = str_replace('.', '-', $value->foto);
                
                $row .= '<li dataImage="'.$value->foto.'" id="'.$identificador.'-1" class="'.$bloqueada.' '.$class.'">'; 
                
                            if($encontrouVip == false){
                                $row .= '<a href="'.BASE.'loja">
                                            <div class="imagem-bloqueada">
                                                <i class="fas fa-lock"></i>
                                                Em Breve na Loja de itens
                                                <span class="txt-graduacao">Verifique a Disponibilidade</span>
                                            </div>
                                        </a>';
                            }
                
                            if($foto_atual == $value->foto){
                                $row .= '<i class="fas fa-check-circle"></i>';
                            }
                $row .= '<img src="'.BASE.'assets/cards/'.$value->foto.'" alt="Foto" />
                         </li>';
            }
        } 
        
        echo $row;
    }
    
    public function getListCharacters($perfil){
        $core = new Core();
        
        $sql = "SELECT * FROM personagens ORDER BY nome ASC";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $item = $stmt->fetchAll();
        
        $row = '';
        
        foreach ($item as $key => $value) {
            
            $row .= '<div class="guerreiro">
                        <div class="info">
                            <h3>'.$value->titulo.' <span>Publicado em '.$core->dataTimeBR($value->data_hora).'</span></h3>
                            <p>'.$value->descricao.'</p>';
                            if($perfil == 3){
                                $row .= '<a href="'.BASE.'noticias/edit/'.$value->id.'">[Editar]</a>';
                            }
            $row .= '</div>
                        <img src="'.BASE.'assets/news.jpg" alt="DB Heroes - Notícias" />
                     </div>';
        }
        
        echo $row;
    }
    
    public function getSaldo($valor, $idPersonagem){        
        $sql = "SELECT * FROM usuarios_personagens WHERE id = $idPersonagem";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $item = $stmt->fetch();
        
        if($item->gold >= $valor){
            return true;
        } else {
            return false;
        }
    }
    
    public function getByName($nome, $planeta){
        $sql_planeta = "";
        
        if($planeta != 4){
            $sql_planeta = "AND idPlaneta = $planeta";
        }
        
        $sql = "SELECT * FROM usuarios_personagens WHERE nome = '$nome' ".$sql_planeta;
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $item = $stmt->fetch();
        
        if($stmt->rowCount() > 0){
            if($item->time_defesa < time()){
                $id = $item->id;
            } else {
                $id = 0;
            }
        } else {
            $id = 0;
        }
        
        return $id;
    }
    
    public function getAleatorio($tipo, $planeta, $nivel, $id_personagem, $idUser){
        $equipes = new Equipes();
        
        $aux = "";
        
        if($tipo == 1){
            $aux = "AND nivel = $nivel";
        } else {
            if($nivel >= 10){
                $aux = "AND nivel >= 10";
            }
        }
        
        $sql_planeta = "";
        
        if($planeta != 4){
            $sql_planeta = "AND idPlaneta = $planeta";
        }
        
        $sql = "SELECT * FROM usuarios_personagens WHERE id != $id_personagem ".$aux." AND idUsuario != $idUser ".$sql_planeta." ORDER BY RAND() LIMIT 1";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $item = $stmt->fetchAll();
        
        foreach ($item as $key => $value) {
            if(!$equipes->verificaMembrosEquipe($id_personagem, $value->id)){
                if($value->time_defesa < time()){
                    $id = $value->id;
                } else {
                    $id = 0;
                }
            } else {
                $id = 0;
            }
        }
        
        return $id;
    }
    
    public function verificaPersonagem($idPersonagem, $idUsuario){        
        $sql = "SELECT * FROM usuarios_personagens WHERE id = $idPersonagem AND idUsuario = $idUsuario";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        
        if($stmt->rowCount() > 0){
            return true;
        } else {
            return false;
        }
    }
    
    public function getAmigos($idPersonagem){
        $user = new Usuarios();
        
        $orderBY = "ORDER BY up.nivel DESC, up.vitorias_pvp DESC, up.tam DESC, up.gold_total DESC";
        
        $sql = "SELECT "
            . "up.*, up.id as idP, pa.id as idAmizade, up.foto as foto_personagem, "
            . "u.*, "
            . "up.nome as nome_guerreiro, "
            . "pa.aceitou, "
            . "p.nome as planeta, p.imagem as img_planeta "
            . "FROM personagens_amigos as pa "
            . "INNER JOIN usuarios_personagens as up ON up.id = pa.idAmigo "
            . "INNER JOIN usuarios as u ON u.id = up.idUsuario "
            . "INNER JOIN planetas as p ON up.idPlaneta = p.id "
            . "WHERE pa.idPersonagem = $idPersonagem "
            . $orderBY;
        
        $stmt = DB::prepare($sql);
        $stmt->execute();
        
        $row = '';
        
        if($stmt->rowCount() > 0){
            $item = $stmt->fetchAll();

            foreach ($item as $key => $value) {
                $ft = str_replace('cards/', '', $value->foto_personagem);

                $row .= '<tr>
                            <td>
                                <a href="'.BASE.'publico/'.$value->idP.'">
                                    <img src="'.BASE.'assets/cards/'.$ft.'" alt="'.$value->nome_guerreiro.'" />
                                </a>
                            </td>
                            <td width="250">
                                <a href="'.BASE.'publico/'.$value->idP.'">
                                    <strong>'.$value->nome_guerreiro.'</strong>
                                </a>
                            </td>
                            <td width="250">'.$this->verificaGraduacao($value->nivel).'</td>
                            <td>'.$value->nivel.'</td>
                            <td>'.$value->vitorias_pvp.'</td>
                            <td>'.$value->derrotas_pvp.'</td>
                            <td>'.$value->tam.'</td>
                            <td>'.$value->gold_total.'</td>
                            <td>'.$user->isGuerreiroOnline($value->idP).'</td>';
                            if($value->aceitou == 1){
                                $row .= '<td class="pendente" title="Desfazer Amizade">
                                            <form id="deletarAmizade" method="post">
                                                <input type="hidden" name="deletar" value="'.$value->idAmizade.'" />
                                                <button type="submit" style="border: 0; background: none;" title="Desfazer Amizade?">
                                                    <i class="fa fa-trash"></i>
                                                </button> 
                                            </form>
                                         </td>';
                            } else {
                                $row .= '<td class="pendente" title="Pendente">
                                            <i class="fas fa-exclamation"></i>
                                         </td>';
                            }
                            $row .= '</tr>';
            }
        }
        
        $sql = "SELECT "
            . "up.*, up.id as idP, pa.id as idAmizade, up.foto as foto_personagem, "
            . "u.*, "
            . "up.nome as nome_guerreiro, "
            . "pa.aceitou, "
            . "p.nome as planeta, p.imagem as img_planeta "
            . "FROM personagens_amigos as pa "
            . "INNER JOIN usuarios_personagens as up ON up.id = pa.idPersonagem "
            . "INNER JOIN usuarios as u ON u.id = up.idUsuario "
            . "INNER JOIN planetas as p ON up.idPlaneta = p.id "
            . "WHERE pa.idAmigo = $idPersonagem "
            . $orderBY;
        
        $stmt = DB::prepare($sql);
        $stmt->execute();
        
        if($stmt->rowCount() > 0){
            $item_amigos = $stmt->fetchAll();

            foreach ($item_amigos as $key => $value) {
                $ft = str_replace('cards/', '', $value->foto_personagem);

                $row .= '<tr class="'.$top.'">
                            <td>
                                <a href="'.BASE.'publico/'.$value->idP.'">
                                    <img src="'.BASE.'assets/cards/'.$ft.'" alt="'.$value->nome_guerreiro.'" />
                                </a>
                            </td>
                            <td width="250">
                                <a href="'.BASE.'publico/'.$value->idP.'">
                                    <strong>'.$value->nome_guerreiro.'</strong>
                                </a>
                            </td>
                            <td width="250">'.$this->verificaGraduacao($value->nivel).'</td>
                            <td>'.$value->nivel.'</td>
                            <td>'.$value->vitorias_pvp.'</td>
                            <td>'.$value->derrotas_pvp.'</td>
                            <td>'.$value->tam.'</td>
                            <td>'.$value->gold_total.'</td>
                            <td>'.$user->isGuerreiroOnline($value->idP).'</td>';
                            if($value->aceitou == 0){
                                $row .= '<td class="aprovado">
                                            <form id="confirmarAmizade" method="post">
                                                <input type="hidden" name="aceitar" value="'.$value->idAmizade.'" />
                                                <button type="submit" style="border: 0; background: none;" title="Confirmar Amizade?">
                                                    <i class="fas fa-check"></i>
                                                </button> 
                                             </form>
                                         </td>';
                            } else {
                                $row .= '<td class="pendente">
                                            <form id="deletarAmizade" method="post">
                                                <input type="hidden" name="deletar" value="'.$value->idAmizade.'" />
                                                <button type="submit" style="border: 0; background: none;" title="Desfazer Amizade?">
                                                    <i class="fa fa-trash"></i>
                                                </button> 
                                             </form>
                                         </td>';
                            }
                         $row .= '</tr>';
            }
        }
        
        if($row == ''){
            $row .= '<tr>'
                   . '<td colspan="10">Nenhum amigo adicionado.</td>'
                 . '</tr>'; 
        }
        
        echo $row;
    }
    
    public function getAmigosPending($idPersonagem){
        $sql = "SELECT count(*) as total FROM personagens_amigos WHERE idAmigo = $idPersonagem AND aceitou = 0";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $amigos = 0;
        
        if($stmt->rowCount() > 0){
            $am = $stmt->fetch();
            $amigos = $am->total;
        } else {
            $amigos = 0;
        }
        
        return $amigos;
    }
    
    public function getExisteAmizade($idPersonagem, $idAmigo){
        $sql = "SELECT * FROM personagens_amigos WHERE idAmigo = $idAmigo AND idPersonagem = $idPersonagem AND aceitou = 1";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        
        if($stmt->rowCount() > 0){
            return true;
        } else {
            $sql = "SELECT * FROM personagens_amigos WHERE idAmigo = $idPersonagem AND idPersonagem = $idAmigo AND aceitou = 1";
            $stmt = DB::prepare($sql);
            $stmt->execute();
            
            if($stmt->rowCount() > 0){
                return true;
            } else {
                return false;
            }
        }
    }
    
    public function getExisteSolicitacaoAmizade($idPersonagem, $idAmigo){
        $sql = "SELECT * FROM personagens_amigos WHERE idAmigo = $idAmigo AND idPersonagem = $idPersonagem AND aceitou = 0";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        
        if($stmt->rowCount() > 0){
            return true;
        } else {
            $sql = "SELECT * FROM personagens_amigos WHERE idAmigo = $idPersonagem AND idPersonagem = $idAmigo AND aceitou = 0";
            $stmt = DB::prepare($sql);
            $stmt->execute();
            
            if($stmt->rowCount() > 0){
                return true;
            } else {
                return false;
            }
        }
    }
    
    public function getListGraduacoes($pc, $qtd_resultados){
        $core = new Core();
        
        //Paginando os Resultados
        $counter = $core->counterRegisters("graduacoes");
        $pager = new Paginator();
        $inicio = $pager->inicio($pc, $counter, $qtd_resultados);
        $tp = $counter / $qtd_resultados;
        
        $sql = "SELECT * FROM graduacoes LIMIT " . $inicio . ',' . $qtd_resultados;
        
        $stmt = DB::prepare($sql);
        $stmt->execute();
        
        $row = '';
        $lida = '';
        
        if($stmt->rowCount() > 0){
            $item = $stmt->fetchAll();

            foreach ($item as $key => $value) {
                
                $row .= '<tr style="text-align: center;">
                            <td><img src="'.BASE.'assets/'.$value->emblema.'" /></td>
                            <td>'.$value->graduacao.'</td>
                            <td>'.$value->level_inicial.'</td>
                            <td style="display: inline-block; vertical-align: middle;font-size: 18px; margin-top: 35px; padding: 5px;color: #00911d;border: 1px solid #00911d;">+ '.$value->status_extra.'</td>
                         </tr>';
            }
            
            // Mostra Navegador da Paginação
            $row .= '<tr>'
                   . '<td colspan="4" style="test-align: center;">'.$pager->paginar($pc, $tp).'</td>'
                 . '</tr>'; 
            
        } else {
            $row .= '<tr>
                        <td colspan="4" class="not">Nenhuma graduação cadastrada.</td>
                     </tr>';
        }
        
        echo $row;
    }
    
    public function getListExperiencia($pc, $qtd_resultados){
        $core = new Core();
        
        //Paginando os Resultados
        $counter = $core->counterRegisters("level");
        $pager = new Paginator();
        $inicio = $pager->inicio($pc, $counter, $qtd_resultados);
        $tp = $counter / $qtd_resultados;
        
        $sql = "SELECT * FROM level LIMIT " . $inicio . ',' . $qtd_resultados;
        
        $stmt = DB::prepare($sql);
        $stmt->execute();
        
        $row = '';
        $lida = '';
        
        if($stmt->rowCount() > 0){
            $item = $stmt->fetchAll();

            foreach ($item as $key => $value) {
                $row .= '<tr>
                            <td class="level">'.$value->level.'</td>
                            <td>'.$value->exp.'</td>
                         </tr>';
            }
            
            // Mostra Navegador da Paginação
            $row .= '<tr>'
                   . '<td colspan="2" style="test-align: center;">'.$pager->paginar($pc, $tp).'</td>'
                 . '</tr>'; 
            
        } else {
            $row .= '<tr>
                        <td colspan="2" class="not">Nenhum level cadastrado.</td>
                     </tr>';
        }
        
        echo $row;
    }
    
    public function setLog($idUsuario, $idPersonagem, $idProduto, $log, $valor){
        $core = new Core();
        
        $campos = array(
            'idUsuario' => $idUsuario,
            'idPersonagem' => $idPersonagem,
            'idProduto' => $idProduto,
            'data' => date('Y-m-d H:i:s'),
            'valor' => $valor,
            'log' => $log
        );
        
        $core->insert('usuarios_personagens_log', $campos);
    }
    
    public function getTotalPvpIndividual($idPersonagem){
        $core = new Core();
        
        $sql = "SELECT sum(vitorias_pvp) as total FROM usuarios_personagens WHERE id = $idPersonagem";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $item = $stmt->fetch();
        
        return $item->total;
    }
    
    public function getCacadaRunning($idPersonagem, $idCacada){
        $core = new Core();
        
        $sql = "SELECT * FROM cacadas WHERE idPersonagem = $idPersonagem AND id = $idCacada";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $item = $stmt->fetch();
        
        $row = '';
        
        if($stmt->rowCount() > 0){
            if($item->tempo_final > time()){
                $row .= '<div class="cacada-running">
                            <span>Você está em uma caçada, aguarde o tempo terminar para iniciar missões, arena e caçadas.</span>
                            <a class="bts-form" id="cancelarCacada">Cancelar Caçada</a>
                            <input type="hidden" name="idCacada" id="idCacada" value="'.$idCacada.'" />
                            <div class="contador"></div>
                        </div>';
            } else {
                $row .= '<div class="cacada-running">
                            <span>Caçada Concluída, clique no botão para receber seu prêmio</span><form method="post"><input type="submit" name="confirmar_cacada" value="Concluir" /></form>
                         </div>';
            }
        }
        
        echo $row;
    }
    
    public function getMissaoRunning($idPersonagem, $idMissao){
        $core = new Core();
        
        $sql = "SELECT * FROM personagens_missoes WHERE idPersonagem = $idPersonagem AND id = $idMissao";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $item = $stmt->fetch();
        
        $row = '';
        
        if($stmt->rowCount() > 0){
            if($item->tempo_final > time()){
                $row .= '<div class="missao-running">
                            <span>Você está em uma missão, aguarde o tempo terminar para iniciar outras missões, arena e caçadas.</span>
                            <a class="bts-form" id="cancelarMissao">Cancelar Missão</a>
                            <input type="hidden" name="idMissao" id="idMissao" value="'.$idMissao.'" />
                            <div class="contador"></div>
                        </div>';
            } else {
                $row .= '<div class="missao-running">
                            <span>Missão Concluída, clique no botão para receber seu prêmio</span><form method="post"><input type="submit" id="confirmarMissao" name="confirmar_missao" value="Concluir" /></form>
                         </div>';
            }
        }
        
        echo $row;
    }
}
