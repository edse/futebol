<?php

/**
 * noticias actions.
 *
 * @package    futebol
 * @subpackage noticias
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class noticiasActions extends sfActions
{

  /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request) {

    $this->noticias = Doctrine_Query::create()
      ->select('a.*')
      ->from('Asset a')
      ->orderBy('a.created_at')
      ->limit(60)
      ->execute();
  }
  
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeDetails(sfWebRequest $request)
  {
    if($request->getParameter('id'))
      $this->asset = Doctrine::getTable('Asset')->find($request->getParameter('id'));
    elseif($request->getParameter('slug'))
      $this->asset = Doctrine::getTable('Asset')->findOneBySlug($request->getParameter('slug'));
    
    if(!$this->asset)
      $this->forward404();

    $this->campeonatos = Doctrine_Query::create()
      ->select('t.*')
      ->from('Tournament t')
      ->orderBy('t.name')
      ->execute();
      
    $t = date("Y-m-d H:i:s", strtotime(date('Y-m-d H:i:s'))-3*60*60);

    $this->dias = Doctrine_Query::create()
      ->select('DATE_FORMAT(a.date_start,"%Y-%m-%d") as date')
      ->from('Asset a')
      ->where('a.date_start < ?', $t)
      ->groupBy('DATE_FORMAT(a.date_start,"%Y-%m-%d")') 
      ->orderBy('a.date_start desc')
      ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
      ->execute();

    foreach($this->dias as $d) {
      $assets[] = Doctrine_Query::create()
        ->select('a.*')
        ->from('Asset a')
        ->andWhere('a.date_start < ?', $t)
        ->andWhere('DATE_FORMAT(a.date_start,"%Y-%m-%d") = ?', $d['date'])
        ->orderBy('a.date_start desc')
        ->execute();
    }
    $this->assets = $assets;

  }

}