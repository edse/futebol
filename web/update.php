<?php
require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');
$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'prod', false);
sfContext::createInstance($configuration)->dispatch();

ini_set("upload_max_filesize", "1700M");
ini_set("post_max_size", "1700M");
ini_set("memory_limit", "1700M");
ini_set("max_input_time", "3600");
ini_set("max_execution_time", "3600");
set_time_limit(0);

$ts = Doctrine_Query::create()
  ->select('t.*')
  ->from('Tournament t')
  ->orderBy('t.name')
  ->execute();

foreach($ts as $t){
  echo "\n\n".$t->getSlug();
  flush();
  echo "\n".exec("wget http://futebolclube.possum-cms.com/campeonatos/import?slug=".$t->getSlug());
  die('1');
}
