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
    $this->forward('default', 'module');
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
    //echo var_dump($array["campeonatos"]);
    foreach($array["campeonatos"] as $a){
      echo "<pre>";
      if(!$tournament = Doctrine_Core::getTable('Tournament')->findOneByEditionSlug($a["edicao"]["slug"])){
        echo "Adding Tournament: ".$a["nome"]."...\n";
        $tournament = new Tournament();
        $tournament->setName($a["nome"]);
        $tournament->setSlug($a["slug"]);
        if(isset($a["regulamento"]))
          $tournament->setRules($a["regulamento"]);
        //echo "nome: ".$a["nome"]."\n";
        //echo "slug: ".$a["slug"]."\n";
        foreach($a as $k=>$v){
          if(is_array($v)){
            $tournament->setEditionName($v["nome"]);
            $tournament->setEditionSlug($v["slug"]);
            //echo "edicao-nome: ".$v["nome"]."\n";
            //echo "edicao-slug: ".$v["slug"]."\n";
          }
        }
        $tournament->save();


        if($tournament->getSlug()=="turco")
          $contents = file_get_contents('http://globoesporte.globo.com/dynamo/semantica/plantao/campeonato/campeonato_turco.jsonp');
        else
          $contents = file_get_contents('http://globoesporte.globo.com/dynamo/futebol/campeonato/'.$tournament->getSlug().'/'.$tournament->getEditionSlug().'/classificacao.json');
        $array2 = json_decode($contents, true);

        //TEAMS
        foreach($array2["lista_de_jogos"]["campeonato"]["edicao_campeonato"]["equipes"] as $key=>$value){
          if(!$team = Doctrine_Core::getTable('Team')->findOneBySlug($value["slug"])){
            echo "Adding Team: ".$value["nome"]."...\n";
            $team = new Team();
            $team->setTeamExtId($key);
            $team->setOfficialName($value["nome"]);
            $team->setName($value["nome_popular"]);
            $team->setNickname($value["apelido"]);
            $team->setLogo($value["escudo"]);
            $team->setInitials($value["sigla"]);
            
            #TEAM-LOGO
            #$aux = @end(explode("/",$value["escudo"]));
            #$img = @sfConfig::get('sf_upload_dir').'/assets/teams/'.$aux;
            #@file_put_contents($img, file_get_contents($value["escudo"]));

            $team->save();
            //echo var_dump($a);
          }
        }

        //STADIUMS
        foreach($array2["lista_de_jogos"]["campeonato"]["edicao_campeonato"]["sedes"] as $key=>$value){
          if(!$stadium = Doctrine_Core::getTable('Stadium')->findOneByStadiumExtId($key)){
            echo "Adding Stadium: ".$value["nome"]."...\n";
            $stadium = new Stadium();
            $stadium->setStadiumExtId($key);
            $stadium->setOfficialName($value["nome"]);
            $stadium->setName($value["nome_popular"]);
            $stadium->setGeoLocation($value["localizacao_geografica"]);
            $stadium->setLocation($value["localizacao"]);
            $stadium->setInauguration($value["inauguracao"]);
            $stadium->setCapacity($value["capacidade_maxima"]);
            $stadium->setAddress($value["endereco"]);
            $stadium->save();
            //echo var_dump($value);
          }
        }

        //GAMES
        foreach($array2["lista_de_jogos"]["campeonato"]["edicao_campeonato"]["fases"] as $key=>$value){
          if(count($value["jogos"])>0){
            foreach($value["jogos"] as $k=>$v){
              if(!$game = Doctrine_Core::getTable('Game')->findOneByGameExtId($v["jogo_id"])){
                echo "Adding Game1 : ".$v["jogo_id"]."...\n";
                $d = explode("-", $v["data_original"]);
                if(!isset($d[2]))
                  $d = explode("/", $v["data_original"]);
                $h = explode("h", $v["hora"]);
                if(!isset($h[1]))
                  $h = explode(":", $v["hora"]);
                if(!isset($h[1]))
                  $h = explode(":", "00:00");
                $game = new Game();
                $game->setGameExtId($v["jogo_id"]);
                $game->setTournamentId($tournament->getId());
                $game->setDateStart($d[2]."-".$d[1]."-".$d[0]." ".$h[0].":".$h[1]."00");
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
              }
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
                $d1 = explode(" ", $v["data"]);
                $d = explode("/", $d1[1]);
                if(!isset($d[2]))
                  $d = explode("-", $d1[1]);
                $h = explode("h", $v["hora"]);
                $game = new Game();
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
              }
            }
          }
          else{
            echo "WTF!?";
            foreach($value as $k=>$v){
              var_dump($v);
            }
          }
        }
      }else{
        echo "Skiping: ".$a["nome"]."...\n";
      }
      echo "</pre>";
    }
    die();
  }

}