<?php
require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');
$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'prod', false);
sfContext::createInstance($configuration)->dispatch();

$ts = Doctrine_Query::create()
  ->select('t.*')
  ->from('Tournament t')
  ->orderBy('t.name')
  ->execute();

foreach($ts as $t){
  echo "\n".exec("wget http://futebolclube.possum-cms.com/campeonatos/import?slug=".$t->getSlug());
}
