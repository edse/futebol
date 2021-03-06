<?php

require_once dirname(__FILE__).'/../lib/tournament_gamesGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/tournament_gamesGeneratorHelper.class.php';

/**
 * tournament_games actions.
 *
 * @package    futebol
 * @subpackage tournament_games
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tournament_gamesActions extends autoTournament_gamesActions
{
  
  public function executeIndex(sfWebRequest $request)
  {
    if($this->tournament = $this->getRoute()->getObject()){
      $this->query = Doctrine_Core::getTable('Game')->createQuery()->addWhere('tournament_id = ?', (int)$this->tournament->getId());
    }    
    // sorting
    if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort')))
    {
      $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
    }
    // pager
    if ($request->getParameter('page'))
    {
      $this->setPage($request->getParameter('page'));
    }
    $this->pager = $this->getPager();
    $this->sort = $this->getSort();
  }

  protected function buildQuery()
  {
    $query = $this->query;
    $this->addSortQuery($query);
    $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
    $query = $event->getReturnValue();
    return $query;
  }

}
