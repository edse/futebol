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

    $t = date("Y-m-d H:i:s", strtotime(date('Y-m-d H:i:s'))-3*60*60);

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

    $t = date("Y-m-d H:i:s", strtotime(date('Y-m-d H:i:s'))-3*60*60);

    $this->dias = Doctrine_Query::create()
      ->select('DATE_FORMAT(g.date_start,"%Y-%m-%d") as date')
      ->from('Game g')
      ->Where('g.tournament_id = ?', $this->campeonato->getId())
      ->andWhere('g.date_start < ?', $t)
      ->groupBy('DATE_FORMAT(g.date_start,"%Y-%m-%d")') 
      ->orderBy('g.date_start desc')
      ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
      ->execute();

    foreach($this->dias as $d) {
      $jogos[] = Doctrine_Query::create()
        ->select('g.*')
        ->from('Game g')
        ->Where('g.tournament_id = ?', $this->campeonato->getId())
        ->andWhere('g.date_start < ?', $t)
        ->andWhere('DATE_FORMAT(g.date_start,"%Y-%m-%d") = ?', $d['date'])
        ->orderBy('g.date_start desc')
        ->execute();
    }
    $this->jogos = $jogos;
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

  public function executeNewsupdate(sfWebRequest $request)
  {
    ini_set("memory_limit", "1700M");
    ini_set("max_input_time", "3600");
    ini_set("max_execution_time", "3600");
    //ini_set('user_agent', 'My-Application/2.5');
    set_time_limit(0);

    // they will check user_agent header...
    ini_set('user_agent', 'My-Application/2.5');
    include_once(sfConfig::get('sf_lib_dir').'/vendor/simple-html-dom/simple_html_dom.php');
    
    $feeds = Doctrine_Query::create()
      ->select('f.*')
      ->from('Feed f')
      ->orderBy('f.name')
      ->execute();

    foreach($feeds as $f){
      $xml = new SimpleXMLElement(file_get_contents($f->getUrl()));      
      //$contents = json_decode($c, true);
      echo $f->getUrl()."<br>";
      if($xml){
        foreach($xml->channel as $key => $value) {
          //echo "<br>".$key." = ".count($value);
          //echo "<br>".$value["data"]." - ".count($value["materias"]);
          //echo "<pre>";
          foreach($value->item as $k => $v) {
            //var_dump($v);
  
            $asset = Doctrine::getTable('Asset')->findOneByTitle($v->title);
  
            if(!$asset)
              $asset = new Asset();
  
            $asset->setAssetTypeId(1);
            $asset->setTitle($v->title);
            $asset->setDescription($v->description);
            $asset->setTournaments($f->Tournaments);
            $asset->setTeams($f->Teams);
            $asset->setGames($f->Games);
            $asset->setDateStart(date("Y-m-d H:i:s", strtotime($v->pubDate)));
            $asset->setUserId(1);
            $asset->setIsActive(true);
            $asset->save();
            
            echo "<pre>";
            var_dump($v);
            echo "</pre>";
            
            // create HTML DOM
            $html = file_get_html($v->link);
            if($html){
              // get news block
              foreach($html->find('div#materia-letra') as $article) {
                // get title
                //$item['title'] = trim($article->find('h3', 0)->plaintext);
                // get details
                $item = trim($article);
                if(!$asset->AssetContent)
                  $asset->AssetContent = new AssetContent();
                $asset->AssetContent->setContent($item);
                $asset->AssetContent->setSource($f->getSiteName());
                $asset->AssetContent->save();
              }
              // clean up memory
              $html->clear();
              unset($html);
            }
            echo "<hr />";
          }
        }
      }
    }
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
