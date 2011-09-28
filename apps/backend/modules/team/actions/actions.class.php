<?php

require_once dirname(__FILE__).'/../lib/teamGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/teamGeneratorHelper.class.php';

/**
 * team actions.
 *
 * @package    futebol
 * @subpackage team
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class teamActions extends autoTeamActions
{
  public function executeListGames(sfWebRequest $request) {
    $this->forward('team_games', 'index');
  }
}
