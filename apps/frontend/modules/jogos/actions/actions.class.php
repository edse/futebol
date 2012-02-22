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