<?php

/**
 * campeonatos actions.
 *
 * @package    futebol
 * @subpackage campeonatos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class campeonatosActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->campeonatos = Doctrine_Query::create()
      ->select('t.*')
      ->from('Tournament t')
      ->orderBy('t.name')
      ->execute();
    if($request->getParameter('slug'))
      $this->campeonato = Doctrine::getTable('Tournament')->findOneBySlug($request->getParameter('slug'));
    else
      $this->campeonato = $this->campeonatos[0];

    $this->classificacao = Doctrine_Query::create()
      ->select('t.*')
      ->from('TournamentStandings t')
      ->Where('t.tournament_id = ?', $this->campeonato->getId())
      ->orderBy('t.rank')
      ->execute();
  }
  
 /**
  * Executes jogos action
  *
  * @param sfRequest $request A request object
  */
  public function executeJogos(sfWebRequest $request)
  {
    $this->campeonatos = Doctrine_Query::create()
      ->select('t.*')
      ->from('Tournament t')
      ->orderBy('t.name')
      ->execute();
    if($request->getParameter('slug'))
      $this->campeonato = Doctrine::getTable('Tournament')->findOneBySlug($request->getParameter('slug'));
    else
      $this->campeonato = $this->campeonatos[0];

    $t = date("Y-m-d H:i:s", strtotime(date('Y-m-d H:i:s'))-1.7*60*60);

    $this->dias = Doctrine_Query::create()
      ->select('DATE_FORMAT(g.date_start,"%Y-%m-%d") as date')
      ->from('Game g')
      ->Where('g.tournament_id = ?', $this->campeonato->getId())
      ->andWhere('g.date_start > ?', $t)
      ->groupBy('DATE_FORMAT(g.date_start,"%Y-%m-%d")') 
      ->orderBy('g.date_start')
      ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
      ->execute();

    foreach($this->dias as $d) {
      $jogos[] = Doctrine_Query::create()
        ->select('g.*')
        ->from('Game g')
        ->Where('g.tournament_id = ?', $this->campeonato->getId())
        ->andWhere('g.date_start > ?', $t)
        ->andWhere('DATE_FORMAT(g.date_start,"%Y-%m-%d") = ?', $d['date'])
        ->orderBy('g.date_start')
        ->execute();
    }
    $this->jogos = $jogos;
    /*
    $this->jogos = Doctrine_Query::create()
      ->select('g.*')
      ->from('Game g')
      ->Where('g.tournament_id = ?', $this->campeonato->getId())
      ->andWhere('g.date_start > ?', date('Y-m-d'))
      ->orderBy('g.date_start')
      ->execute();
    */
  }
  
 /**
  * Executes jogosanteriores action
  *
  * @param sfRequest $request A request object
  */
  public function executeJogosanteriores(sfWebRequest $request)
  {
    $this->campeonatos = Doctrine_Query::create()
      ->select('t.*')
      ->from('Tournament t')
      ->orderBy('t.name')
      ->execute();
    if($request->getParameter('slug'))
      $this->campeonato = Doctrine::getTable('Tournament')->findOneBySlug($request->getParameter('slug'));
    else
      $this->campeonato = $this->campeonatos[0];

    $this->jogos = Doctrine_Query::create()
      ->select('g.*')
      ->from('Game g')
      ->Where('g.tournament_id = ?', $this->campeonato->getId())
      ->andWhere('g.date_start < ?', date('Y-m-d'))
      ->orderBy('g.date_start desc')
      ->execute();
  }
  
 /**
  * Executes noticias action
  *
  * @param sfRequest $request A request object
  */
  public function executeNoticias(sfWebRequest $request)
  {
    $this->campeonatos = Doctrine_Query::create()
      ->select('t.*')
      ->from('Tournament t')
      ->orderBy('t.name')
      ->execute();
    if($request->getParameter('slug'))
      $this->campeonato = Doctrine::getTable('Tournament')->findOneBySlug($request->getParameter('slug'));
    else
      $this->campeonato = $this->campeonatos[0];

    $this->classificacao = Doctrine_Query::create()
      ->select('t.*')
      ->from('TournamentStandings t')
      ->Where('t.tournament_id = ?', $this->campeonato->getId())
      ->orderBy('t.rank')
      ->execute();
  }

  public function executeUpdate(sfWebRequest $request)
  {
    ini_set("memory_limit", "1700M");
    ini_set("max_input_time", "3600");
    ini_set("max_execution_time", "3600");
    set_time_limit(0);
    $contents = json_decode(file_get_contents('http://globoesporte.globo.com/temporeal/futebol/central.json'), true);
    echo "<h3>Jogos em andamento:</h3>";
    foreach($contents["jogos"] as $key => $value) {
      if($value["status"]=="Em Andamento"){
        $game = Doctrine::getTable('Game')->findOneByGameExtId($value["id"]);
        if($game){
          $update = false;
          if($game->getHomeTeamScore() != $value["time_casa"]["placar"]){
            $game->setHomeTeamScore($value["time_casa"]["placar"]);
            $update = true;
          }
          if($game->getAwayTeamScore() != $value["time_visitante"]["placar"]){
            $update = true;
            $game->setAwayTeamScore($value["time_visitante"]["placar"]);
          }
          if($update){
            echo "Updated!<br />";
            $game->save();
          }
          echo $game->HomeTeam->getName()." ".$game->getHomeTeamScore()." x ".$game->getAwayTeamScore()." ".$game->AwayTeam->getName();
          echo "<hr />";
        }
      }
      //echo "<hr />";
    }
    die();
  }

  public function executeImport(sfWebRequest $request)
  {
    ini_set("memory_limit", "1700M");
    ini_set("max_input_time", "3600");
    ini_set("max_execution_time", "3600");
    set_time_limit(0);

    $contents = file_get_contents('http://globoesporte.globo.com/dynamo/futebol/campeonato/todos.json');
    $contents = str_replace('populateCampeonatos(', "", $contents);
    //$contents = str_replace('populateCampeonatos({"campeonatos":[', "", $contents);
    $contents = str_replace(');', "", $contents);
    //echo $contents;
    $array = json_decode($contents, true);
    unset($contents);
    //echo var_dump($array["campeonatos"]);
    
    if(($request->getParameter("slug"))&&($array["campeonatos"])){
      
      foreach($array["campeonatos"] as $a){
        if($a["slug"] == $request->getParameter("slug")){
    
          echo "<pre>";
    
          if(!$tournament = Doctrine_Core::getTable('Tournament')->findOneBySlug($a["slug"])){
            echo "Adding Tournament: ".$a["nome"]."...\n";
            $tournament = new Tournament();
          }else{
            echo "Updating Tournament: ".$a["nome"]."...\n";
          }
          $tournament->setName($a["nome"]);
          $tournament->setSlug($a["slug"]);
          if(isset($a["regulamento"]))
            $tournament->setRules($a["regulamento"]);

          $tournament->save();
          //echo "nome: ".$a["nome"]."\n";
          //echo "slug: ".$a["slug"]."\n";
    
          foreach($a as $k=>$v){
            if(is_array($v)){
              if(!$tournamentEdition = Doctrine_Core::getTable('TournamentEdition')->findOneBySlug($v["slug"]))
                $tournamentEdition = new TournamentEdition();
              $tournamentEdition->setTournamentId($tournament->getId());
              $tournamentEdition->setName($v["nome"]);
              $tournamentEdition->setSlug($v["slug"]);
              $tournamentEdition->save();
              //echo "edicao-nome: ".$v["nome"]."\n";
              //echo "edicao-slug: ".$v["slug"]."\n";
            }
          }
    
          if($tournament->getSlug()=="turco")
            $contents = file_get_contents('http://globoesporte.globo.com/dynamo/futebol/campeonato/turco/campeonatoturco2011/classificacao.json ');
          else
            $contents = file_get_contents('http://globoesporte.globo.com/dynamo/futebol/campeonato/'.$tournament->getSlug().'/'.$tournamentEdition->getSlug().'/classificacao.json');
          
          $array2 = json_decode($contents, true);
          unset($contents);
          unset($tournamentEdition);
    
          //TEAMS
          foreach($array2["lista_de_jogos"]["campeonato"]["edicao_campeonato"]["equipes"] as $key=>$value){
            if(!$team = Doctrine_Core::getTable('Team')->findOneByOfficialName($value["nome"])){
              echo "Adding Team: ".$value["nome"]."...\n";
              $team = new Team();
            }
            else{
              echo "Updating Team: ".$value["nome"]."...\n";
            }
            //$team = new Team();
            $team->setTeamExtId($key);
            $team->setOfficialName($value["nome"]);
            $team->setName($value["nome_popular"]);
            $team->setNickname($value["apelido"]);
            $team->setInitials($value["sigla"]);
            #TEAM-LOGO
            // 30x30 + 65x65
            $aux = @end(explode("/",$value["escudo"]));
            $aux1 = $aux;
            $aux2 = str_replace("30", "65", $aux);
            $img1 = @sfConfig::get('sf_upload_dir').'/assets/teams/'.$aux1;
            $img2 = @sfConfig::get('sf_upload_dir').'/assets/teams/'.$aux2;

            $img_url1 = $value["escudo"];
            $img_url2 = str_replace("30", "65", $value["escudo"]);
            @file_put_contents($img1, file_get_contents($img_url1));
            @file_put_contents($img2, file_get_contents($img_url2));
            $team->setLogo($aux2);
            $team->save();
            unset($team);
            //echo var_dump($a);
          }
    
          //STADIUMS
          foreach($array2["lista_de_jogos"]["campeonato"]["edicao_campeonato"]["sedes"] as $key=>$value){
            if(!$stadium = Doctrine_Core::getTable('Stadium')->findOneByStadiumExtId($key)){
              echo "Adding Stadium: ".$value["nome"]."...\n";
              $stadium = new Stadium();
            }
            else{
              echo "Updating Stadium: ".$value["nome"]."...\n";
            }
            $stadium->setStadiumExtId($key);
            $stadium->setOfficialName($value["nome"]);
            $stadium->setName($value["nome_popular"]);
            $stadium->setGeoLocation($value["localizacao_geografica"]);
            $stadium->setLocation($value["localizacao"]);
            $stadium->setInauguration($value["inauguracao"]);
            $stadium->setCapacity($value["capacidade_maxima"]);
            $stadium->setAddress($value["endereco"]);
            $stadium->save();
            unset($stadium);
            //echo var_dump($value);
          }

          //Standings
          foreach($array2["edicao_campeonato"]["fases"] as $key1=>$value1){
            if(isset($value1["pontos_corridos_simples"])){
              if(count($value1["pontos_corridos_simples"])>0){
                $stand = end($value1["pontos_corridos_simples"]);
                $last = end($stand["classificacoes"]);
                //foreach($stand["classificacoes"] as $key=>$value){
                foreach($last as $key2=>$value2){
                  if(is_array($value2)){
                    foreach($value2 as $key3=>$value3){
                      $t = Doctrine_Core::getTable('Team')->findOneBySlug($value3["slug"]);
                      if($t){
                        if(!$standings = Doctrine_Core::getTable('TournamentStandings')->findOneByTournamentIdAndTeamId($tournament->getId(), $t->getId())){
                          echo "Adding Standings: ".$value3["slug"]."...\n";
                          $standings = new TournamentStandings();
                        }
                        else{
                          echo "Updating Standings: ".$value3["slug"]."...\n";
                        }
                        $standings->setTeamId($t->getId());
                        $standings->setTournamentId($tournament->getId());
                        $standings->setRank($value3["ordem"]);
                        $standings->setDefeats($value3["derrotas"]);
                        $standings->setDraws($value3["empates"]);
                        $standings->setWins($value3["vitorias"]);
                        $standings->setPoints($value3["pontos"]);
                        $standings->setScoreFor($value3["gols_pro"]);
                        $standings->setScoreAgainst($value3["gols_contra"]);
                        $standings->setScoreDifference($value3["saldo_gols"]);
                        $standings->setGames($value3["jogos"]);
                        $standings->setVariation($value3["variacao"]);
                        $standings->setRate($value3["aproveitamento"]);
                        $standings->save();
                      }
                    }
                  }
                }
              }
            }
          }

          //GAMES
          foreach($array2["lista_de_jogos"]["campeonato"]["edicao_campeonato"]["fases"] as $key=>$value){
            if(count($value["jogos"])>0){
              foreach($value["jogos"] as $k=>$v){
                if(!$game = Doctrine_Core::getTable('Game')->findOneByGameExtId($v["jogo_id"])){
                  echo "Adding Game1 : ".$v["jogo_id"]."...\n";
                  $game = new Game();
                }
                else{
                  echo "Updating Game1 : ".$v["jogo_id"]."...\n";
                }
                $d = explode("-", $v["data_original"]);
                if(!isset($d[2]))
                  $d = explode("/", $v["data_original"]);
                $h = explode("h", $v["hora"]);
                if(!isset($h[1]))
                  $h = explode(":", $v["hora"]);
                if(!isset($h[1]))
                  $h = explode(":", "00:00");
                if($d[1] < 10)
                  $d[1] = "0".$d[1];
                if($d[0] < 10)
                  $d[0] = "0".$d[0];
                //echo "\tdate: ".$v["data_original"]." ".$v["data_original"]."\n";
                //echo "\tdate: ".$d[2]."-".$d[1]."-".$d[0]." ".$h[0].":".$h[1].":"."00"."\n";
                $game->setGameExtId($v["jogo_id"]);
                $game->setTournamentId($tournament->getId());
                $game->setDateStart($d[2]."-".$d[1]."-".$d[0]." ".$h[0].":".$h[1].":"."00");
                $game->setDate($v["data"]);
                $game->setTime($v["hora"]);
                $game->setRound($v["rodada"]);
                if($t = Doctrine_Core::getTable('Team')->findOneByTeamExtId($v["equipe_mandante"]))
                  $game->setHomeTeamId($t->getId());
                if($t = Doctrine_Core::getTable('Team')->findOneByTeamExtId($v["equipe_visitante"]))
                  $game->setAwayTeamId($t->getId());
                $game->setHomeTeamExtId($v["equipe_mandante"]);
                $game->setAwayTeamExtId($v["equipe_visitante"]);
                $game->setHomeTeamLogo($v["escudo_mandante"]);
                $game->setAwayTeamLogo($v["escudo_visitante"]);
                $game->setHomeTeamName($v["nome_popular_mandante"]);
                $game->setAwayTeamName($v["nome_popular_visitante"]);
                $game->setHomeTeamInitials($v["sigla_mandante"]);
                $game->setAwayTeamInitials($v["sigla_visitante"]);
                $game->setHomeTeamSlug($v["slug_mandante"]);
                $game->setAwayTeamSlug($v["slug_visitante"]);
                $game->setHomeTeamScore($v["placar_mandante"]);
                $game->setAwayTeamScore($v["placar_visitante"]);
                $game->setHomeTeamPenaltyScore($v["placar_penalti_mandante"]);
                $game->setAwayTeamPenaltyScore($v["placar_penalti_visitante"]);
                if($v["sede"]>0){
                  if($s = Doctrine_Core::getTable('Stadium')->findOneByStadiumExtId($v["sede"]))
                    $game->setStadiumId($s->getId());
                }
                $game->setStadiumExtId($v["sede"]);
                $game->setStadiumName($v["local_jogo"]);
                $game->setUrl($v["url_confronto"]);
                $game->save();
                unset($game);
              }
            }
            elseif(count($value["chaves"])>0){
              foreach($value["chaves"] as $k=>$v){
                if($v["ida_jogo"]["jogo_id"]>0)
                  $data[] = $v["ida_jogo"];
                if($v["volta_jogo"]["jogo_id"]>0)
                  $data[] = $v["volta_jogo"];
              }
              if(isset($data)){
                foreach($data as $k=>$v){
                  if(!$game = Doctrine_Core::getTable('Game')->findOneByGameExtId($v["jogo_id"])){
                    echo "Adding Game2 : ".$v["jogo_id"]."...\n";
                    $game = new Game();
                  }
                  else{
                    echo "Updating Game2 : ".$v["jogo_id"]."...\n";
                  }
                  $d1 = explode(" ", $v["data"]);
                  $d = explode("/", $d1[1]);
                  if(!isset($d[2]))
                    $d = explode("-", $d1[1]);
                  $h = explode("h", $v["hora"]);
                  $game->setGameExtId($v["jogo_id"]);
                  $game->setTournamentId($tournament->getId());
                  $game->setDateStart($d[2]."-".$d[1]."-".$d[0]." ".$h[0].":".$h[1]."00");
                  $game->setDate($v["data"]);
                  $game->setTime($v["hora"]);
                  $game->setRound($v["rodada"]);
                  if($t = Doctrine_Core::getTable('Team')->findOneByTeamExtId($v["equipe_mandante_id"]))
                    $game->setHomeTeamId($t->getId());
                  if($t = Doctrine_Core::getTable('Team')->findOneByTeamExtId($v["equipe_visitante_id"]))
                    $game->setAwayTeamId($t->getId());
                  $game->setHomeTeamExtId($v["equipe_mandante_id"]);
                  $game->setAwayTeamExtId($v["equipe_visitante_id"]);
                  $game->setHomeTeamScore($v["placar_mandante"]);
                  $game->setAwayTeamScore($v["placar_visitante"]);
                  $game->setHomeTeamPenaltyScore($v["placar_penalti_mandante"]);
                  $game->setAwayTeamPenaltyScore($v["placar_penalti_visitante"]);
                  if($v["sede"]>0){
                    if($s = Doctrine_Core::getTable('Stadium')->findOneByStadiumExtId($v["sede"]))
                      $game->setStadiumId($s->getId());
                  }
                  $game->setStadiumExtId($v["sede"]);
                  $game->setUrl($v["url_confronto"]);
                  $game->save();
                  unset($game);
                }
              }
            }
            else{
              echo "WTF!?";
              foreach($value as $k=>$v){
                var_dump($v);
              }
            }
            //unset($tournament);
          }
          echo "</pre>";

        }
      }

    }
    else{
      
      foreach($array["campeonatos"] as $a){
        echo "<br /><a href='".$this->getController()->genUrl("/campeonatos/import?slug=".$a["slug"])."'>".$a["slug"]."</a>";
      }
      
    }
    die();
  }

}




#{"edicao_campeonato":{"data_fim":"2012-05-13","data_inicio":"2012-01-20","edicaocampeonato_id":1193,"fases":[{"atual":true,"disclaimer":"","faixas":[{"cor":"#f1fDeD","id":240,"nome":"Classificados","ordem":1},{"cor":"#FFE4E1","id":241,"nome":"Rebaixados","ordem":2}],"fase_id":2921,"formato":0,"nome":"Primeira fase","ordem":1,"pontos_corridos_simples":[{"classificacoes":[{"classificacao":[{"aproveitamento":83.299999999999997,"derrotas":0,"empates":2,"equipe_id":275,"equipe_label":null,"equipe_sigla":"PAL","escudo":"http://s.glbimg.com/es/ge/f/original/2010/11/19/palmeiras_30x30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/palmeiras_65x65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/palmeiras_45x45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/palmeiras_30x30.png","faixa_ordem":1,"gols_contra":8,"gols_pro":17,"jogos":8,"nome_popular":"Palmeiras","ordem":1,"pontos":20,"saldo_gols":9,"slug":"palmeiras","variacao":0,"vitorias":6},{"aproveitamento":83.299999999999997,"derrotas":0,"empates":2,"equipe_id":264,"equipe_label":null,"equipe_sigla":"COR","escudo":"http://s.glbimg.com/es/ge/f/original/2010/11/19/corinthians_30x30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/corinthians_65x65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/corinthians_45x45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/corinthians_30x30.png","faixa_ordem":1,"gols_contra":3,"gols_pro":10,"jogos":8,"nome_popular":"Corinthians","ordem":2,"pontos":20,"saldo_gols":7,"slug":"corinthians","variacao":0,"vitorias":6},{"aproveitamento":79.200000000000003,"derrotas":1,"empates":1,"equipe_id":279,"equipe_label":null,"equipe_sigla":"GUA","escudo":"http://s.glbimg.com/es/ge/f/original/2010/11/19/guarani_30x30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/guarani_65x65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/guarani_45x45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/guarani_30x30.png","faixa_ordem":1,"gols_contra":6,"gols_pro":11,"jogos":8,"nome_popular":"Guarani","ordem":3,"pontos":19,"saldo_gols":5,"slug":"guarani","variacao":0,"vitorias":6},{"aproveitamento":70.799999999999997,"derrotas":1,"empates":2,"equipe_id":276,"equipe_label":null,"equipe_sigla":"SPO","escudo":"http://s.glbimg.com/es/ge/f/original/2010/11/19/sao_paulo_30x30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/sao_paulo_65x65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/sao_paulo_45x45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/sao_paulo_30x30.png","faixa_ordem":1,"gols_contra":8,"gols_pro":17,"jogos":8,"nome_popular":"S\u00e3o Paulo","ordem":4,"pontos":17,"saldo_gols":9,"slug":"sao-paulo","variacao":0,"vitorias":5},{"aproveitamento":62.5,"derrotas":1,"empates":3,"equipe_id":277,"equipe_label":null,"equipe_sigla":"SAN","escudo":"http://s.glbimg.com/es/ge/f/original/2011/05/19/Santos_Futebol_Clube_30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/santos_65x65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/santos_45x45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/santos_30x30.png","faixa_ordem":1,"gols_contra":9,"gols_pro":17,"jogos":8,"nome_popular":"Santos","ordem":5,"pontos":15,"saldo_gols":8,"slug":"santos","variacao":1,"vitorias":4},{"aproveitamento":54.200000000000003,"derrotas":3,"empates":1,"equipe_id":1360,"equipe_label":null,"equipe_sigla":"PTA","escudo":"http://s.glbimg.com/es/ge/f/original/2011/01/04/paulista30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/paulista65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/paulista45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/paulista30.png","faixa_ordem":1,"gols_contra":10,"gols_pro":14,"jogos":8,"nome_popular":"Paulista","ordem":6,"pontos":13,"saldo_gols":4,"slug":"paulista","variacao":-1,"vitorias":4},{"aproveitamento":54.200000000000003,"derrotas":3,"empates":1,"equipe_id":2182,"equipe_label":null,"equipe_sigla":"MOG","escudo":"http://s.glbimg.com/es/ge/f/original/2011/12/20/mogimirim_30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/mogimirim-sp65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/mogimirim-sp45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/mogimirim-sp30.png","faixa_ordem":1,"gols_contra":9,"gols_pro":11,"jogos":8,"nome_popular":"Mogi Mirim","ordem":7,"pontos":13,"saldo_gols":2,"slug":"mogi-mirim","variacao":3,"vitorias":4},{"aproveitamento":50.0,"derrotas":2,"empates":3,"equipe_id":303,"equipe_label":null,"equipe_sigla":"PON","escudo":"http://s.glbimg.com/es/ge/f/original/2011/01/04/ponte_preta_30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2011/06/20/__ponte-65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2011/06/20/__ponte-45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2011/06/20/__ponte-30.png","faixa_ordem":1,"gols_contra":13,"gols_pro":17,"jogos":8,"nome_popular":"Ponte Preta","ordem":8,"pontos":12,"saldo_gols":4,"slug":"ponte-preta","variacao":-1,"vitorias":3},{"aproveitamento":50.0,"derrotas":2,"empates":3,"equipe_id":278,"equipe_label":null,"equipe_sigla":"POR","escudo":"http://s.glbimg.com/es/ge/f/original/2011/01/04/portuguesa_sp30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/portuguesa_sp65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/portuguesa_sp45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/portuguesa_sp30.png","faixa_ordem":null,"gols_contra":7,"gols_pro":9,"jogos":8,"nome_popular":"Portuguesa","ordem":9,"pontos":12,"saldo_gols":2,"slug":"portuguesa","variacao":3,"vitorias":3},{"aproveitamento":45.799999999999997,"derrotas":3,"empates":2,"equipe_id":386,"equipe_label":null,"equipe_sigla":"SCA","escudo":"http://s.glbimg.com/es/ge/f/original/2011/01/04/sao_caetano_30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2011/07/21/_esc65-saocaetano.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2011/07/21/_esc45-saocaetano.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2011/07/21/_esc30-saocaetano.png","faixa_ordem":null,"gols_contra":9,"gols_pro":10,"jogos":8,"nome_popular":"S\u00e3o Caetano","ordem":10,"pontos":11,"saldo_gols":1,"slug":"sao-caetano","variacao":-2,"vitorias":3},{"aproveitamento":45.799999999999997,"derrotas":3,"empates":2,"equipe_id":280,"equipe_label":null,"equipe_sigla":"BRA","escudo":"http://s.glbimg.com/es/ge/f/original/2011/01/12/Bragantino_30x30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/12/Bragantino_65x65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/12/Bragantino_45x45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/12/Bragantino_30x30.png","faixa_ordem":null,"gols_contra":14,"gols_pro":14,"jogos":8,"nome_popular":"Bragantino","ordem":11,"pontos":11,"saldo_gols":0,"slug":"bragantino","variacao":-2,"vitorias":3},{"aproveitamento":45.799999999999997,"derrotas":3,"empates":2,"equipe_id":2213,"equipe_label":null,"equipe_sigla":"LIN","escudo":"http://s.glbimg.com/es/ge/f/original/2012/01/27/linense-30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2011/03/05/linense-65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2011/03/05/linense-45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2011/03/05/linense30.png","faixa_ordem":null,"gols_contra":17,"gols_pro":16,"jogos":8,"nome_popular":"Linense","ordem":12,"pontos":11,"saldo_gols":-1,"slug":"linense","variacao":1,"vitorias":3},{"aproveitamento":37.5,"derrotas":3,"empates":3,"equipe_id":2305,"equipe_label":null,"equipe_sigla":"MIR","escudo":"http://s.glbimg.com/es/ge/f/original/2011/12/20/_30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2012/02/10/mirassol_65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2012/02/10/mirassol_45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2012/02/10/mirassol_30.png","faixa_ordem":null,"gols_contra":11,"gols_pro":14,"jogos":8,"nome_popular":"Mirassol","ordem":13,"pontos":9,"saldo_gols":3,"slug":"mirassol","variacao":-2,"vitorias":2},{"aproveitamento":29.199999999999999,"derrotas":5,"empates":1,"equipe_id":297,"equipe_label":null,"equipe_sigla":"COM","escudo":"http://s.glbimg.com/es/ge/f/original/2011/11/08/comercial_sp_30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2012/01/05/comercial_sp_65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2012/01/05/comercial_sp_45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2012/01/05/comercial_sp_30.png","faixa_ordem":null,"gols_contra":17,"gols_pro":9,"jogos":8,"nome_popular":"Comercial-SP","ordem":14,"pontos":7,"saldo_gols":-8,"slug":"comercial-sp","variacao":0,"vitorias":2},{"aproveitamento":29.199999999999999,"derrotas":3,"empates":4,"equipe_id":2190,"equipe_label":null,"equipe_sigla":"OES","escudo":"http://s.glbimg.com/es/ge/f/original/2011/01/12/Oeste_30x30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/12/Oeste_65x65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/12/Oeste_45x45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/12/Oeste_30x30.png","faixa_ordem":null,"gols_contra":12,"gols_pro":10,"jogos":8,"nome_popular":"Oeste","ordem":15,"pontos":7,"saldo_gols":-2,"slug":"oeste","variacao":0,"vitorias":1},{"aproveitamento":29.199999999999999,"derrotas":3,"empates":4,"equipe_id":2194,"equipe_label":null,"equipe_sigla":"CAT","escudo":"http://s.glbimg.com/es/ge/f/original/2011/11/08/catanduvense_30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2012/01/05/catanduvense_65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2012/01/05/catanduvense_45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2012/01/05/catanduvense_30.png","faixa_ordem":null,"gols_contra":11,"gols_pro":8,"jogos":8,"nome_popular":"Catanduvense","ordem":16,"pontos":7,"saldo_gols":-3,"slug":"catanduvense","variacao":0,"vitorias":1},{"aproveitamento":20.800000000000001,"derrotas":5,"empates":2,"equipe_id":305,"equipe_label":null,"equipe_sigla":"PIR","escudo":"http://s.glbimg.com/es/ge/f/original/2012/01/20/XV_de_Piracicaba-SP30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/escudo_XV_65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/escudo_XV_45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/escudo_XV_30.png","faixa_ordem":2,"gols_contra":14,"gols_pro":9,"jogos":8,"nome_popular":"XV de Piracicaba","ordem":17,"pontos":5,"saldo_gols":-5,"slug":"xv-de-piracicaba","variacao":0,"vitorias":1},{"aproveitamento":20.800000000000001,"derrotas":5,"empates":2,"equipe_id":1325,"equipe_label":null,"equipe_sigla":"ITU","escudo":"http://s.glbimg.com/es/ge/f/original/2011/01/12/ituano_30x30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/12/ituano_65x65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/12/ituano_45x45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/12/ituano_30x30.png","faixa_ordem":2,"gols_contra":14,"gols_pro":7,"jogos":8,"nome_popular":"Ituano","ordem":18,"pontos":5,"saldo_gols":-7,"slug":"ituano","variacao":0,"vitorias":1},{"aproveitamento":12.5,"derrotas":7,"empates":0,"equipe_id":3322,"equipe_label":null,"equipe_sigla":"GTA","escudo":"http://s.glbimg.com/es/ge/f/original/2011/12/07/Guaratingueta_30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2012/01/09/Guaratingueta_65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2012/01/09/Guaratingueta_45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2012/01/09/Guaratingueta_30.png","faixa_ordem":2,"gols_contra":21,"gols_pro":8,"jogos":8,"nome_popular":"Guaratinguet\u00e1","ordem":19,"pontos":3,"saldo_gols":-13,"slug":"guaratingueta","variacao":0,"vitorias":1},{"aproveitamento":12.5,"derrotas":7,"empates":0,"equipe_id":296,"equipe_label":null,"equipe_sigla":"BOT","escudo":"http://s.glbimg.com/es/ge/f/original/2011/01/04/Botafogo-SP30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/Botafogo-SP65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/Botafogo-SP45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/Botafogo-SP30.png","faixa_ordem":2,"gols_contra":20,"gols_pro":5,"jogos":8,"nome_popular":"Botafogo-SP","ordem":20,"pontos":3,"saldo_gols":-15,"slug":"botafogo-sp","variacao":0,"vitorias":1}],"classificacao_id":2000,"data_atualizacao":"2012-02-18 20:56:55","data_criacao":"2011-11-08 14:03:41","rodada":""}]},{"classificacoes":[{"classificacao":[{"aproveitamento":100.0,"derrotas":0,"empates":0,"equipe_id":276,"equipe_label":null,"equipe_sigla":"SPO","escudo":"http://s.glbimg.com/es/ge/f/original/2010/11/19/sao_paulo_30x30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/sao_paulo_65x65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/sao_paulo_45x45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/sao_paulo_30x30.png","faixa_ordem":1,"gols_contra":0,"gols_pro":4,"jogos":1,"nome_popular":"S\u00e3o Paulo","ordem":1,"pontos":3,"saldo_gols":4,"slug":"sao-paulo","variacao":0,"vitorias":1},{"aproveitamento":100.0,"derrotas":0,"empates":0,"equipe_id":1325,"equipe_label":null,"equipe_sigla":"ITU","escudo":"http://s.glbimg.com/es/ge/f/original/2011/01/12/ituano_30x30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/12/ituano_65x65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/12/ituano_45x45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/12/ituano_30x30.png","faixa_ordem":1,"gols_contra":0,"gols_pro":3,"jogos":1,"nome_popular":"Ituano","ordem":2,"pontos":3,"saldo_gols":3,"slug":"ituano","variacao":0,"vitorias":1},{"aproveitamento":100.0,"derrotas":0,"empates":0,"equipe_id":2182,"equipe_label":null,"equipe_sigla":"MOG","escudo":"http://s.glbimg.com/es/ge/f/original/2011/12/20/mogimirim_30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/mogimirim-sp65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/mogimirim-sp45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/mogimirim-sp30.png","faixa_ordem":1,"gols_contra":0,"gols_pro":2,"jogos":1,"nome_popular":"Mogi Mirim","ordem":3,"pontos":3,"saldo_gols":2,"slug":"mogi-mirim","variacao":0,"vitorias":1},{"aproveitamento":100.0,"derrotas":0,"empates":0,"equipe_id":1360,"equipe_label":null,"equipe_sigla":"PTA","escudo":"http://s.glbimg.com/es/ge/f/original/2011/01/04/paulista30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/paulista65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/paulista45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/paulista30.png","faixa_ordem":1,"gols_contra":0,"gols_pro":2,"jogos":1,"nome_popular":"Paulista","ordem":3,"pontos":3,"saldo_gols":2,"slug":"paulista","variacao":0,"vitorias":1},{"aproveitamento":100.0,"derrotas":0,"empates":0,"equipe_id":2213,"equipe_label":null,"equipe_sigla":"LIN","escudo":"http://s.glbimg.com/es/ge/f/original/2012/01/27/linense-30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2011/03/05/linense-65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2011/03/05/linense-45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2011/03/05/linense30.png","faixa_ordem":1,"gols_contra":3,"gols_pro":4,"jogos":1,"nome_popular":"Linense","ordem":5,"pontos":3,"saldo_gols":1,"slug":"linense","variacao":0,"vitorias":1},{"aproveitamento":100.0,"derrotas":0,"empates":0,"equipe_id":264,"equipe_label":null,"equipe_sigla":"COR","escudo":"http://s.glbimg.com/es/ge/f/original/2010/11/19/corinthians_30x30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/corinthians_65x65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/corinthians_45x45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/corinthians_30x30.png","faixa_ordem":1,"gols_contra":1,"gols_pro":2,"jogos":1,"nome_popular":"Corinthians","ordem":6,"pontos":3,"saldo_gols":1,"slug":"corinthians","variacao":0,"vitorias":1},{"aproveitamento":100.0,"derrotas":0,"empates":0,"equipe_id":279,"equipe_label":null,"equipe_sigla":"GUA","escudo":"http://s.glbimg.com/es/ge/f/original/2010/11/19/guarani_30x30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/guarani_65x65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/guarani_45x45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/guarani_30x30.png","faixa_ordem":1,"gols_contra":1,"gols_pro":2,"jogos":1,"nome_popular":"Guarani","ordem":6,"pontos":3,"saldo_gols":1,"slug":"guarani","variacao":0,"vitorias":1},{"aproveitamento":100.0,"derrotas":0,"empates":0,"equipe_id":275,"equipe_label":null,"equipe_sigla":"PAL","escudo":"http://s.glbimg.com/es/ge/f/original/2010/11/19/palmeiras_30x30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/palmeiras_65x65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/palmeiras_45x45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/palmeiras_30x30.png","faixa_ordem":1,"gols_contra":1,"gols_pro":2,"jogos":1,"nome_popular":"Palmeiras","ordem":6,"pontos":3,"saldo_gols":1,"slug":"palmeiras","variacao":0,"vitorias":1},{"aproveitamento":100.0,"derrotas":0,"empates":0,"equipe_id":386,"equipe_label":null,"equipe_sigla":"SCA","escudo":"http://s.glbimg.com/es/ge/f/original/2011/01/04/sao_caetano_30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2011/07/21/_esc65-saocaetano.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2011/07/21/_esc45-saocaetano.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2011/07/21/_esc30-saocaetano.png","faixa_ordem":null,"gols_contra":0,"gols_pro":1,"jogos":1,"nome_popular":"S\u00e3o Caetano","ordem":9,"pontos":3,"saldo_gols":1,"slug":"sao-caetano","variacao":0,"vitorias":1},{"aproveitamento":33.299999999999997,"derrotas":0,"empates":1,"equipe_id":277,"equipe_label":null,"equipe_sigla":"SAN","escudo":"http://s.glbimg.com/es/ge/f/original/2011/05/19/Santos_Futebol_Clube_30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/santos_65x65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/santos_45x45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/santos_30x30.png","faixa_ordem":null,"gols_contra":1,"gols_pro":1,"jogos":1,"nome_popular":"Santos","ordem":10,"pontos":1,"saldo_gols":0,"slug":"santos","variacao":0,"vitorias":0},{"aproveitamento":33.299999999999997,"derrotas":0,"empates":1,"equipe_id":305,"equipe_label":null,"equipe_sigla":"PIR","escudo":"http://s.glbimg.com/es/ge/f/original/2012/01/20/XV_de_Piracicaba-SP30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/escudo_XV_65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/escudo_XV_45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/escudo_XV_30.png","faixa_ordem":null,"gols_contra":1,"gols_pro":1,"jogos":1,"nome_popular":"XV de Piracicaba","ordem":10,"pontos":1,"saldo_gols":0,"slug":"xv-de-piracicaba","variacao":0,"vitorias":0},{"aproveitamento":0.0,"derrotas":1,"empates":0,"equipe_id":297,"equipe_label":null,"equipe_sigla":"COM","escudo":"http://s.glbimg.com/es/ge/f/original/2011/11/08/comercial_sp_30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2012/01/05/comercial_sp_65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2012/01/05/comercial_sp_45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2012/01/05/comercial_sp_30.png","faixa_ordem":null,"gols_contra":4,"gols_pro":3,"jogos":1,"nome_popular":"Comercial-SP","ordem":12,"pontos":0,"saldo_gols":-1,"slug":"comercial-sp","variacao":0,"vitorias":0},{"aproveitamento":0.0,"derrotas":1,"empates":0,"equipe_id":280,"equipe_label":null,"equipe_sigla":"BRA","escudo":"http://s.glbimg.com/es/ge/f/original/2011/01/12/Bragantino_30x30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/12/Bragantino_65x65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/12/Bragantino_45x45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/12/Bragantino_30x30.png","faixa_ordem":null,"gols_contra":2,"gols_pro":1,"jogos":1,"nome_popular":"Bragantino","ordem":13,"pontos":0,"saldo_gols":-1,"slug":"bragantino","variacao":0,"vitorias":0},{"aproveitamento":0.0,"derrotas":1,"empates":0,"equipe_id":2305,"equipe_label":null,"equipe_sigla":"MIR","escudo":"http://s.glbimg.com/es/ge/f/original/2011/12/20/_30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2012/02/10/mirassol_65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2012/02/10/mirassol_45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2012/02/10/mirassol_30.png","faixa_ordem":null,"gols_contra":2,"gols_pro":1,"jogos":1,"nome_popular":"Mirassol","ordem":13,"pontos":0,"saldo_gols":-1,"slug":"mirassol","variacao":0,"vitorias":0},{"aproveitamento":0.0,"derrotas":1,"empates":0,"equipe_id":2190,"equipe_label":null,"equipe_sigla":"OES","escudo":"http://s.glbimg.com/es/ge/f/original/2011/01/12/Oeste_30x30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/12/Oeste_65x65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/12/Oeste_45x45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/12/Oeste_30x30.png","faixa_ordem":null,"gols_contra":2,"gols_pro":1,"jogos":1,"nome_popular":"Oeste","ordem":13,"pontos":0,"saldo_gols":-1,"slug":"oeste","variacao":0,"vitorias":0},{"aproveitamento":0.0,"derrotas":1,"empates":0,"equipe_id":303,"equipe_label":null,"equipe_sigla":"PON","escudo":"http://s.glbimg.com/es/ge/f/original/2011/01/04/ponte_preta_30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2011/06/20/__ponte-65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2011/06/20/__ponte-45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2011/06/20/__ponte-30.png","faixa_ordem":null,"gols_contra":1,"gols_pro":0,"jogos":1,"nome_popular":"Ponte Preta","ordem":16,"pontos":0,"saldo_gols":-1,"slug":"ponte-preta","variacao":0,"vitorias":0},{"aproveitamento":0.0,"derrotas":1,"empates":0,"equipe_id":2194,"equipe_label":null,"equipe_sigla":"CAT","escudo":"http://s.glbimg.com/es/ge/f/original/2011/11/08/catanduvense_30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2012/01/05/catanduvense_65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2012/01/05/catanduvense_45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2012/01/05/catanduvense_30.png","faixa_ordem":2,"gols_contra":2,"gols_pro":0,"jogos":1,"nome_popular":"Catanduvense","ordem":17,"pontos":0,"saldo_gols":-2,"slug":"catanduvense","variacao":0,"vitorias":0},{"aproveitamento":0.0,"derrotas":1,"empates":0,"equipe_id":278,"equipe_label":null,"equipe_sigla":"POR","escudo":"http://s.glbimg.com/es/ge/f/original/2011/01/04/portuguesa_sp30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/portuguesa_sp65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/portuguesa_sp45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/portuguesa_sp30.png","faixa_ordem":2,"gols_contra":2,"gols_pro":0,"jogos":1,"nome_popular":"Portuguesa","ordem":17,"pontos":0,"saldo_gols":-2,"slug":"portuguesa","variacao":0,"vitorias":0},{"aproveitamento":0.0,"derrotas":1,"empates":0,"equipe_id":3322,"equipe_label":null,"equipe_sigla":"GTA","escudo":"http://s.glbimg.com/es/ge/f/original/2011/12/07/Guaratingueta_30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2012/01/09/Guaratingueta_65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2012/01/09/Guaratingueta_45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2012/01/09/Guaratingueta_30.png","faixa_ordem":2,"gols_contra":3,"gols_pro":0,"jogos":1,"nome_popular":"Guaratinguet\u00e1","ordem":19,"pontos":0,"saldo_gols":-3,"slug":"guaratingueta","variacao":0,"vitorias":0},{"aproveitamento":0.0,"derrotas":1,"empates":0,"equipe_id":296,"equipe_label":null,"equipe_sigla":"BOT","escudo":"http://s.glbimg.com/es/ge/f/original/2011/01/04/Botafogo-SP30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/Botafogo-SP65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/Botafogo-SP45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/Botafogo-SP30.png","faixa_ordem":2,"gols_contra":4,"gols_pro":0,"jogos":1,"nome_popular":"Botafogo-SP","ordem":20,"pontos":0,"saldo_gols":-4,"slug":"botafogo-sp","variacao":0,"vitorias":0}],"classificacao_id":2739,"data_atualizacao":"2012-01-22 21:30:47","data_criacao":"2012-01-21 17:31:36","rodada":1}]},{"classificacoes":[{"classificacao":[{"aproveitamento":100.0,"derrotas":0,"empates":0,"equipe_id":276,"equipe_label":null,"equipe_sigla":"SPO","escudo":"http://s.glbimg.com/es/ge/f/original/2010/11/19/sao_paulo_30x30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/sao_paulo_65x65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/sao_paulo_45x45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/sao_paulo_30x30.png","faixa_ordem":1,"gols_contra":2,"gols_pro":7,"jogos":2,"nome_popular":"S\u00e3o Paulo","ordem":1,"pontos":6,"saldo_gols":5,"slug":"sao-paulo","variacao":0,"vitorias":2},{"aproveitamento":100.0,"derrotas":0,"empates":0,"equipe_id":2182,"equipe_label":null,"equipe_sigla":"MOG","escudo":"http://s.glbimg.com/es/ge/f/original/2011/12/20/mogimirim_30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/mogimirim-sp65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/mogimirim-sp45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/mogimirim-sp30.png","faixa_ordem":1,"gols_contra":0,"gols_pro":5,"jogos":2,"nome_popular":"Mogi Mirim","ordem":2,"pontos":6,"saldo_gols":5,"slug":"mogi-mirim","variacao":1,"vitorias":2},{"aproveitamento":100.0,"derrotas":0,"empates":0,"equipe_id":1360,"equipe_label":null,"equipe_sigla":"PTA","escudo":"http://s.glbimg.com/es/ge/f/original/2011/01/04/paulista30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/paulista65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/paulista45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/paulista30.png","faixa_ordem":1,"gols_contra":0,"gols_pro":5,"jogos":2,"nome_popular":"Paulista","ordem":2,"pontos":6,"saldo_gols":5,"slug":"paulista","variacao":1,"vitorias":2},{"aproveitamento":100.0,"derrotas":0,"empates":0,"equipe_id":264,"equipe_label":null,"equipe_sigla":"COR","escudo":"http://s.glbimg.com/es/ge/f/original/2010/11/19/corinthians_30x30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/corinthians_65x65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/corinthians_45x45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/corinthians_30x30.png","faixa_ordem":1,"gols_contra":1,"gols_pro":4,"jogos":2,"nome_popular":"Corinthians","ordem":4,"pontos":6,"saldo_gols":3,"slug":"corinthians","variacao":2,"vitorias":2},{"aproveitamento":66.700000000000003,"derrotas":0,"empates":1,"equipe_id":2213,"equipe_label":null,"equipe_sigla":"LIN","escudo":"http://s.glbimg.com/es/ge/f/original/2012/01/27/linense-30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2011/03/05/linense-65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2011/03/05/linense-45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2011/03/05/linense30.png","faixa_ordem":1,"gols_contra":6,"gols_pro":7,"jogos":2,"nome_popular":"Linense","ordem":5,"pontos":4,"saldo_gols":1,"slug":"linense","variacao":0,"vitorias":1},{"aproveitamento":66.700000000000003,"derrotas":0,"empates":1,"equipe_id":386,"equipe_label":null,"equipe_sigla":"SCA","escudo":"http://s.glbimg.com/es/ge/f/original/2011/01/04/sao_caetano_30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2011/07/21/_esc65-saocaetano.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2011/07/21/_esc45-saocaetano.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2011/07/21/_esc30-saocaetano.png","faixa_ordem":1,"gols_contra":3,"gols_pro":4,"jogos":2,"nome_popular":"S\u00e3o Caetano","ordem":6,"pontos":4,"saldo_gols":1,"slug":"sao-caetano","variacao":3,"vitorias":1},{"aproveitamento":66.700000000000003,"derrotas":0,"empates":1,"equipe_id":275,"equipe_label":null,"equipe_sigla":"PAL","escudo":"http://s.glbimg.com/es/ge/f/original/2010/11/19/palmeiras_30x30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/palmeiras_65x65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/palmeiras_45x45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/palmeiras_30x30.png","faixa_ordem":1,"gols_contra":2,"gols_pro":3,"jogos":2,"nome_popular":"Palmeiras","ordem":7,"pontos":4,"saldo_gols":1,"slug":"palmeiras","variacao":-1,"vitorias":1},{"aproveitamento":66.700000000000003,"derrotas":0,"empates":1,"equipe_id":277,"equipe_label":null,"equipe_sigla":"SAN","escudo":"http://s.glbimg.com/es/ge/f/original/2011/05/19/Santos_Futebol_Clube_30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/santos_65x65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/santos_45x45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/santos_30x30.png","faixa_ordem":1,"gols_contra":2,"gols_pro":3,"jogos":2,"nome_popular":"Santos","ordem":7,"pontos":4,"saldo_gols":1,"slug":"santos","variacao":3,"vitorias":1},{"aproveitamento":50.0,"derrotas":1,"empates":0,"equipe_id":303,"equipe_label":null,"equipe_sigla":"PON","escudo":"http://s.glbimg.com/es/ge/f/original/2011/01/04/ponte_preta_30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2011/06/20/__ponte-65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2011/06/20/__ponte-45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2011/06/20/__ponte-30.png","faixa_ordem":null,"gols_contra":2,"gols_pro":5,"jogos":2,"nome_popular":"Ponte Preta","ordem":9,"pontos":3,"saldo_gols":3,"slug":"ponte-preta","variacao":7,"vitorias":1},{"aproveitamento":50.0,"derrotas":1,"empates":0,"equipe_id":1325,"equipe_label":null,"equipe_sigla":"ITU","escudo":"http://s.glbimg.com/es/ge/f/original/2011/01/12/ituano_30x30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/12/ituano_65x65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/12/ituano_45x45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/12/ituano_30x30.png","faixa_ordem":null,"gols_contra":2,"gols_pro":4,"jogos":2,"nome_popular":"Ituano","ordem":10,"pontos":3,"saldo_gols":2,"slug":"ituano","variacao":-8,"vitorias":1},{"aproveitamento":50.0,"derrotas":1,"empates":0,"equipe_id":279,"equipe_label":null,"equipe_sigla":"GUA","escudo":"http://s.glbimg.com/es/ge/f/original/2010/11/19/guarani_30x30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/guarani_65x65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/guarani_45x45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2010/11/19/guarani_30x30.png","faixa_ordem":null,"gols_contra":4,"gols_pro":2,"jogos":2,"nome_popular":"Guarani","ordem":11,"pontos":3,"saldo_gols":-2,"slug":"guarani","variacao":-5,"vitorias":1},{"aproveitamento":50.0,"derrotas":1,"empates":0,"equipe_id":296,"equipe_label":null,"equipe_sigla":"BOT","escudo":"http://s.glbimg.com/es/ge/f/original/2011/01/04/Botafogo-SP30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/Botafogo-SP65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/Botafogo-SP45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/Botafogo-SP30.png","faixa_ordem":null,"gols_contra":5,"gols_pro":2,"jogos":2,"nome_popular":"Botafogo-SP","ordem":12,"pontos":3,"saldo_gols":-3,"slug":"botafogo-sp","variacao":8,"vitorias":1},{"aproveitamento":16.699999999999999,"derrotas":1,"empates":1,"equipe_id":2305,"equipe_label":null,"equipe_sigla":"MIR","escudo":"http://s.glbimg.com/es/ge/f/original/2011/12/20/_30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2012/02/10/mirassol_65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2012/02/10/mirassol_45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2012/02/10/mirassol_30.png","faixa_ordem":null,"gols_contra":3,"gols_pro":2,"jogos":2,"nome_popular":"Mirassol","ordem":13,"pontos":1,"saldo_gols":-1,"slug":"mirassol","variacao":0,"vitorias":0},{"aproveitamento":16.699999999999999,"derrotas":1,"empates":1,"equipe_id":305,"equipe_label":null,"equipe_sigla":"PIR","escudo":"http://s.glbimg.com/es/ge/f/original/2012/01/20/XV_de_Piracicaba-SP30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/escudo_XV_65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/escudo_XV_45.png","escudo_pequeno":"http://s.glbimg.com/es/sde/f/organizacoes/2011/01/04/escudo_XV_30.png","faixa_ordem":null,"gols_contra":3,"gols_pro":2,"jogos":2,"nome_popular":"XV de Piracicaba","ordem":13,"pontos":1,"saldo_gols":-1,"slug":"xv-de-piracicaba","variacao":-3,"vitorias":0},{"aproveitamento":16.699999999999999,"derrotas":1,"empates":1,"equipe_id":2194,"equipe_label":null,"equipe_sigla":"CAT","escudo":"http://s.glbimg.com/es/ge/f/original/2011/11/08/catanduvense_30.png","escudo_grande":"http://s.glbimg.com/es/sde/f/organizacoes/2012/01/05/catanduvense_65.png","escudo_medio":"http://s.glbimg.com/es/sde/f/organizacoes/2012/01/05/catanduvense_45.png","escudo_pe


