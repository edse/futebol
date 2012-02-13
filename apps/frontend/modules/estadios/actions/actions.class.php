<?php

/**
 * estadios actions.
 *
 * @package    futebol
 * @subpackage estadios
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class estadiosActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->estadios = Doctrine_Query::create()
      ->select('s.*')
      ->from('Stadium s')
      ->orderBy('s.name')
      ->execute();
    if($request->getParameter('slug'))
      $this->estadio = Doctrine::getTable('Stadium')->findOneBySlug($request->getParameter('slug'));
    else
      $this->estadio = $this->estadios[0];
  }

}