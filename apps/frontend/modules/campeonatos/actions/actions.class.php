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
      $this->campeonato = $campeonatos[0];
  }

  public function executeUpdate(sfWebRequest $request)
  {
    ini_set("memory_limit", "1700M");
    ini_set("max_input_time", "3600");
    ini_set("max_execution_time", "3600");
    set_time_limit(0);
    die("1");
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
            $contents = file_get_contents('http://globoesporte.globo.com/dynamo/futebol/campeonato/turco/campeonatoturco2011/classificacao.json');
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