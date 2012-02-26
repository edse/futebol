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

    $t = date("Y-m-d H:i:s", strtotime(date('Y-m-d H:i:s'))-3*60*60);

    $this->dias = Doctrine_Query::create()
      ->select('DATE_FORMAT(a.date_start,"%Y-%m-%d") as date')
      ->from('Asset a')
      ->Where('a.tournament_id = ?', $this->campeonato->getId())
      ->andWhere('g.date_start < ?', $t)
      ->groupBy('DATE_FORMAT(g.date_start,"%Y-%m-%d")') 
      ->orderBy('g.date_start desc')
      ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
      ->execute();

    foreach($this->dias as $d) {
      $assets[] = Doctrine_Query::create()
        ->select('a.*')
        ->from('Asset a')
        ->Where('a.tournament_id = ?', $this->campeonato->getId())
        ->andWhere('a.date_start < ?', $t)
        ->andWhere('DATE_FORMAT(a.date_start,"%Y-%m-%d") = ?', $d['date'])
        ->orderBy('a.date_start desc')
        ->execute();
    }
    $this->assets = $assets;
  }

  public function executeUpdate(sfWebRequest $request)
  {
    ini_set("memory_limit", "1700M");
    ini_set("max_input_time", "3600");
    ini_set("max_execution_time", "3600");
    ini_set('user_agent', 'Mozilla/5.0 (iPad; U; CPU OS 3_2_1 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Mobile/7B405');
    
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
    ini_set('user_agent', 'Mozilla/5.0 (iPad; U; CPU OS 3_2_1 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Mobile/7B405');
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
      try{
        $xml = new SimpleXMLElement(file_get_contents($f->getUrl()));      
        foreach($xml->channel as $key => $value) {
          //echo "<br>".$key." = ".count($value);
          //echo "<br>".$value["data"]." - ".count($value["materias"]);
          //echo "<pre>";
          foreach($value->item as $k => $v) {
            //var_dump($v);
  
            $asset = Doctrine::getTable('Asset')->findOneByTitle($v->title);
  
            if(!$asset){
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
            }
            echo "<hr />";
          }
        }
      }catch(exception $e){
        echo "erro!";
      }
      //$contents = json_decode($c, true);
      echo $f->getUrl()."<br>";
    }
  }

  public function executeImport(sfWebRequest $request)
  {
    ini_set("memory_limit", "1700M");
    ini_set("max_input_time", "3600");
    ini_set("max_execution_time", "3600");
    set_time_limit(0);

    //$contents = file_get_contents('http://globoesporte.globo.com/dynamo/futebol/campeonato/todos.json');
    
    $contents = 'populateCampeonatos({"campeonatos":[{"campeonato_id":113,"edicao":{"id":1233,"nome":"Campeonato Acreano 2012","slug":"acreano-2012"},"nome":"Campeonato Acreano","slug":"campeonato-acreano"},{"campeonato_id":99,"edicao":{"id":1217,"nome":"Campeonato Alagoano 2012","slug":"alagoano-2012"},"nome":"Campeonato Alagoano","slug":"alagoano"},{"campeonato_id":86,"edicao":{"id":1169,"nome":"Campeonato Alem\u00e3o 2011/12","slug":"campeonato-alemao-2011-12"},"nome":"Campeonato Alem\u00e3o","slug":"campeonatoalemao"},{"campeonato_id":104,"edicao":{"id":1215,"nome":"Campeonato Amazonense 2012","slug":"amazonense-2012"},"nome":"Campeonato Amazonense","slug":"campeonato-amazonense"},{"campeonato_id":92,"edicao":{"id":1171,"nome":"Campeonato Argentino 2011/12","slug":"campeonato-argentino-2011-12"},"nome":"Campeonato Argentino","slug":"campeonatoargentino"},{"campeonato_id":76,"edicao":{"id":1203,"nome":"Campeonato Baiano 2012","slug":"baiano-2012"},"nome":"Campeonato Baiano","slug":"baiano"},{"campeonato_id":98,"edicao":{"id":1216,"nome":"Campeonato Brasiliense 2012","slug":"brasiliense-2012"},"nome":"Campeonato Brasiliense","slug":"campeonato-brasiliense"},{"campeonato_id":102,"edicao":{"id":1202,"nome":"Campeonato Capixaba 2012","slug":"capixaba-2012"},"nome":"Campeonato Capixaba","slug":"campeonato-capixaba"},{"campeonato_id":156,"edicao":{"id":1232,"nome":"Campeonato Capixaba S\u00e9rie B 2012","slug":"capixaba-serieb-2012"},"nome":"Campeonato Capixaba S\u00e9rie B","slug":"campeonato-capixaba-serieb"},{"campeonato_id":64,"edicao":{"id":1199,"nome":"Campeonato Carioca 2012","slug":"carioca-2012"},"nome":"Campeonato Carioca","slug":"campeonato-carioca"},{"campeonato_id":149,"edicao":{"id":1223,"nome":"Campeonato Carioca S\u00e9rie B 2012","slug":"carioca-serieb-2012"},"nome":"Campeonato Carioca S\u00e9rie B","slug":"campeonato-carioca-b"},{"campeonato_id":75,"edicao":{"id":1198,"nome":"Campeonato Catarinense 2012","slug":"catarinense-2012"},"nome":"Campeonato Catarinense","slug":"catarinense"},{"campeonato_id":77,"edicao":{"id":1192,"nome":"Campeonato Cearense 2012","slug":"campeonato-cearense-2012"},"nome":"Campeonato Cearense","slug":"campeonato-cearense"},{"campeonato_id":87,"edicao":{"id":1175,"nome":"Campeonato Espanhol 2011/12","slug":"campeonato-espanhol-2011-12"},"nome":"Campeonato Espanhol","slug":"campeonatoespanhol"},{"campeonato_id":85,"edicao":{"id":1172,"nome":"Campeonato Franc\u00eas 2011/12","slug":"campeonato-frances-2011-12"},"nome":"Campeonato Franc\u00eas","slug":"campeonatofrances2011"},{"campeonato_id":72,"edicao":{"id":1200,"nome":"Campeonato Ga\u00facho 2012","slug":"gaucho-2012"},"nome":"Campeonato Ga\u00facho","slug":"gaucho"},{"campeonato_id":148,"edicao":{"id":1222,"nome":"Campeonato Ga\u00facho Segunda Divis\u00e3o 2012","slug":"gaucho-segunda-divisao-2012"},"nome":"Campeonato Ga\u00facho Segunda Divis\u00e3o","slug":"gaucho-segunda-divisao"},{"campeonato_id":73,"edicao":{"id":1204,"nome":"Campeonato Goiano 2012","slug":"goiano-2012"},"nome":"Campeonato Goiano","slug":"goiano"},{"campeonato_id":84,"edicao":{"id":1168,"nome":"Campeonato Ingl\u00eas 2011/12","slug":"campeonato-ingles-2011-12"},"nome":"Campeonato Ingl\u00eas","slug":"campeonatoingles2011"},{"campeonato_id":82,"edicao":{"id":1176,"nome":"Campeonato Italiano 2011/12","slug":"campeonato-italiano-2011-12"},"nome":"Campeonato Italiano","slug":"campeonatoitaliano"},{"campeonato_id":112,"edicao":{"id":1060,"nome":"Campeonato Maranhense 2011","slug":"maranhense-2011"},"nome":"Campeonato Maranhense","slug":"campeonato-maranhense"},{"campeonato_id":112,"edicao":{"id":1219,"nome":"Campeonato Maranhense 2012","slug":"maranhense-2012"},"nome":"Campeonato Maranhense","slug":"campeonato-maranhense"},{"campeonato_id":108,"edicao":{"id":1205,"nome":"Campeonato Mato-Grossense 2012","slug":"mato-grossense-2012"},"nome":"Campeonato Mato-Grossense","slug":"campeonato-mato-grossense"},{"campeonato_id":71,"edicao":{"id":1209,"nome":"Campeonato Mineiro 2012","slug":"mineiro-2012"},"nome":"Campeonato Mineiro","slug":"mineiro"},{"campeonato_id":147,"edicao":{"id":1220,"nome":"Campeonato Mineiro M\u00f3dulo 2 2012","slug":"mineiro-modulo2-2012"},"nome":"Campeonato Mineiro M\u00f3dulo 2","slug":"mineiro-modulo2"},{"campeonato_id":101,"edicao":{"id":1194,"nome":"Campeonato Paraense 2012","slug":"paraense-2012"},"nome":"Campeonato Paraense","slug":"campeonato-paraense"},{"campeonato_id":106,"edicao":{"id":1213,"nome":"Campeonato Paraibano 2012","slug":"paraibano-2012"},"nome":"Campeonato Paraibano","slug":"campeonato-paraibano"},{"campeonato_id":74,"edicao":{"id":1201,"nome":"Campeonato Paranaense 2012","slug":"paranaense-2012"},"nome":"Campeonato Paranaense","slug":"paranaense"},{"campeonato_id":63,"edicao":{"id":1193,"nome":"Campeonato Paulista 2012","slug":"paulista-2012"},"nome":"Campeonato Paulista","slug":"campeonato-paulista"},{"campeonato_id":142,"edicao":{"id":1206,"nome":"Campeonato Paulista S\u00e9rie A2 2012","slug":"paulista-a2-2012"},"nome":"Campeonato Paulista S\u00e9rie A2","slug":"campeonato-paulista-a2"},{"campeonato_id":146,"edicao":{"id":1212,"nome":"Campeonato Paulista S\u00e9rie A3 2012","slug":"paulista-serie-a3-2012"},"nome":"Campeonato Paulista S\u00e9rie A3","slug":"campeonato-paulista-a3"},{"campeonato_id":97,"edicao":{"id":1197,"nome":"Campeonato Pernambucano 2012","slug":"pernambucano-2012"},"nome":"Campeonato Pernambucano","slug":"pernambucano"},{"campeonato_id":114,"edicao":{"id":1064,"nome":"Campeonato Piauiense 2011","slug":"piauiense-2011"},"nome":"Campeonato Piauiense","slug":"campeonato-piauiense"},{"campeonato_id":6,"edicao":{"id":1174,"nome":"Campeonato Portugu\u00eas 2011/12","slug":"campeonato-portugues-2011-12"},"nome":"Campeonato Portugu\u00eas","slug":"campeonato-portugues"},{"campeonato_id":100,"edicao":{"id":1224,"nome":"Campeonato Potiguar 2012","slug":"potiguar-2012"},"nome":"Campeonato Potiguar","slug":"campeonato-potiguar"},{"campeonato_id":116,"edicao":{"id":1066,"nome":"Campeonato Roraimense 2011","slug":"roraimense-2011"},"nome":"Campeonato Roraimense","slug":"campeonato-roraimense"},{"campeonato_id":107,"edicao":{"id":1218,"nome":"Campeonato Sergipano 2012","slug":"sergipano-2012"},"nome":"Campeonato Sergipano","slug":"campeonato-sergipano"},{"campeonato_id":109,"edicao":{"id":1210,"nome":"Campeonato Sul-Mato-Grossense 2012","slug":"sul-mato-grossense-2012"},"nome":"Campeonato Sul-Mato-Grossense","slug":"campeonato-sul-mato-grossense"},{"campeonato_id":103,"edicao":{"id":1048,"nome":"Campeonato Tocantinense 2011","slug":"tocantinense-2011"},"nome":"Campeonato Tocantinense","slug":"campeonato-tocantinense"},{"campeonato_id":103,"edicao":{"id":1225,"nome":"Campeonato Tocantinense 2012","slug":"tocantinense-2012"},"nome":"Campeonato Tocantinense","slug":"campeonato-tocantinense"},{"campeonato_id":5,"edicao":{"id":1173,"nome":"Campeonato Turco 2011/12","slug":"campeonato-turco-2011-12"},"nome":"Campeonato Turco","slug":"turco"},{"campeonato_id":151,"edicao":{"id":1226,"nome":"Copa Africana de Na\u00e7\u00f5es 2012","slug":"copa-africana-nacoes-2012"},"nome":"Copa Africana de Na\u00e7\u00f5es","slug":"copa-africana-nacoes"},{"campeonato_id":155,"edicao":{"id":1231,"nome":"Copa da Inglaterra 2012","slug":"copa-inglaterra-2012"},"nome":"Copa da Inglaterra","slug":"copa-inglaterra"},{"campeonato_id":31,"edicao":{"id":1221,"nome":"Copa do Brasil 2012","slug":"copa-do-brasil-2012"},"nome":"Copa do Brasil","slug":"copa-do-brasil"},{"campeonato_id":120,"edicao":{"id":1229,"nome":"Copa do Rei 2012","slug":"copa-do-rei-2012"},"nome":"Copa do Rei","slug":"copa-do-rei"},{"campeonato_id":136,"edicao":{"id":1185,"nome":"Eliminat\u00f3rias da Copa 2014 - \u00c1frica","slug":"eliminatorias-copa-africa-2014"},"nome":"Eliminat\u00f3rias da Copa - \u00c1frica","slug":"eliminatorias-copa-africa"},{"campeonato_id":133,"edicao":{"id":1183,"nome":"Eliminat\u00f3rias da Copa 2014 - Am\u00e9rica do Norte e Central","slug":"eliminatorias-copa-americadonorte-2014"},"nome":"Eliminat\u00f3rias da Copa - Am\u00e9rica do Norte e Central","slug":"eliminatorias-copa-americadonorte"},{"campeonato_id":131,"edicao":{"id":1180,"nome":"Eliminat\u00f3rias da Copa 2014 - Am\u00e9rica do Sul","slug":"eliminatorias-copa-americadosul-2014"},"nome":"Eliminat\u00f3rias da Copa - Am\u00e9rica do Sul","slug":"eliminatorias-copa-americadosul"},{"campeonato_id":135,"edicao":{"id":1184,"nome":"Eliminat\u00f3rias da Copa 2014 - \u00c1sia","slug":"eliminatorias-copa-asia-2014"},"nome":"Eliminat\u00f3rias da Copa - \u00c1sia","slug":"eliminatorias-copa-asia"},{"campeonato_id":137,"edicao":{"id":1186,"nome":"Eliminat\u00f3rias da Copa 2014 - Oceania","slug":"eliminatorias-copa-oceania-2014"},"nome":"Eliminat\u00f3rias da Copa - Oceania","slug":"eliminatorias-copa-oceania"},{"campeonato_id":78,"edicao":{"id":1178,"nome":"Liga dos Campe\u00f5es da Europa 2011/12","slug":"liga-dos-campeoes-2011-12"},"nome":"Liga dos Campe\u00f5es da Europa","slug":"ligadoscampeoes"},{"campeonato_id":95,"edicao":{"id":1179,"nome":"Liga Europa 2011/12","slug":"liga-europa-2011-12"},"nome":"Liga Europa","slug":"ligaeuropa"},{"campeonato_id":66,"edicao":{"id":1207,"nome":"Ta\u00e7a Libertadores 2012","slug":"libertadores-2012"},"nome":"Ta\u00e7a Libertadores","slug":"taca-libertadores"}]});';
    
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
