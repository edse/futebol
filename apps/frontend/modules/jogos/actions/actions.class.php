<?php

/**
 * jogos actions.
 *
 * @package    futebol
 * @subpackage jogos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class jogosActions extends sfActions
{

  /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request) {
    $t = date("Y-m-d H:i:s", strtotime(date('Y-m-d H:i:s'))-3*60*60);

    $this->dias = Doctrine_Query::create()
      ->select('DATE_FORMAT(g.date_start,"%Y-%m-%d") as date')
      ->from('Game g')
      ->Where('g.date_start > ?', $t)
      ->groupBy('DATE_FORMAT(g.date_start,"%Y-%m-%d")') 
      ->orderBy('g.date_start')
      ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
      ->execute();

    foreach($this->dias as $d) {
      $jogos[] = Doctrine_Query::create()
        ->select('g.*')
        ->from('Game g')
        ->Where('g.date_start > ?', $t)
        ->andWhere('DATE_FORMAT(g.date_start,"%Y-%m-%d") = ?', $d['date'])
        ->orderBy('g.date_start')
        ->execute();
    }
    $this->jogos = $jogos;
    
    $this->proximos_jogos = Doctrine_Query::create()
      ->select('g.*')
      ->from('Game g')
      ->where('g.date_start > ?', date('Y-m-d'))
      ->orderBy('g.date_start')
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
    if($request->getParameter('id')){
      $this->jogo = Doctrine::getTable('Game')->find($request->getParameter('id'));
      $this->jogos = Doctrine_Query::create()
        ->select('g.*')
        ->from('Game g')
        ->where('g.date_start > ?', date('Y-m-d'))
        ->orderBy('g.date_start')
        ->limit(60)
        ->execute();
    }else{
      $this->forward404();
    }

  }

}