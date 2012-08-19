<?php

/**
 * times actions.
 *
 * @package    futebol
 * @subpackage times
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class timesActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->times = Doctrine_Query::create()
      ->select('t.*')
      ->from('Team t')
      ->orderBy('t.name')
      ->execute();
    if($request->getParameter('slug'))
      $this->time = Doctrine::getTable('Team')->findOneBySlug($request->getParameter('slug'));
    else
      $this->time = $this->times[0];
  }

  public function executeJSON(sfWebRequest $request)
  {
    $times = Doctrine_Query::create()
      ->select('t.*')
      ->from('Team t')
      ->orderBy('t.name')
      ->execute();
    $this->times = NULL;
    foreach($times as $t){
      $this->times[] = array("initials"=>$t->getInitials(), "name"=>$t->getName(), "logo"=>$t->getLogo());
    }
    die(json_encode($this->times));
  }

}