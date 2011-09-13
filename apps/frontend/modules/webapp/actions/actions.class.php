<?php

/**
 * webapp actions.
 *
 * @package    futebol
 * @subpackage webapp
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class webappActions extends sfActions
{
  
  /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request) {
    if($this->getUser()->isAuthenticated() == true){
      $this->oauths = TokenTable::getInstance()
        ->createQuery('t')
        ->where('user_id = ?', $this->getUser()->getAttribute('user_id', '', 'sfGuardSecurityUser'))
        ->execute();
      $this->openid = IdentityTable::getInstance()
        ->createQuery('t')
        ->where('user_id = ?', $this->getUser()->getAttribute('user_id', '', 'sfGuardSecurityUser'))
        ->execute();
    }
  }

  public function executeFinish(sfWebRequest $request) {
    $this->redirect('@default?module=webapp&action=home');
  }

  public function executeRegister(sfWebRequest $request) {
    $this->user = $this->getUser()->getGuardUser();
    $this->forward404Unless($this->user);
    if($this->user->getIsActive() == true){
      $this->redirect('@default?module=webapp&action=home');
    }
    $this->getUser()->setFlash('info', 'User not activate please confirm');
    if ($request->isMethod('post')) {
      $this->redirectUnless($request->getParameter('nickname'), '@default?module=webapp&action=register');
      $this->redirectUnless($request->getParameter('firstname'), '@default?module=webapp&action=register');
      $this->redirectUnless($request->getParameter('lastname'), '@default?module=webapp&action=register');
      $this->redirectUnless($request->getParameter('email'), '@default?module=webapp&action=register');
      $this->redirectUnless($request->getParameter('team'), '@default?module=webapp&action=register');

      $this->user->setNickname($request->getParameter('nickname'));
      $this->user->setFirstName($request->getParameter('firstname'));
      $this->user->setLastName($request->getParameter('lastname'));
      $this->user->setUsername($request->getParameter('email'));
      $this->user->setEmailAddress($request->getParameter('email'));
      $this->user->setTeamId($request->getParameter('team'));
      $this->user->setPhone($request->getParameter('phone'));
      $this->user->setIsActive(true);
      $this->user->save();
      $this->getUser()->setFlash('info', 'User activate');
      $this->redirect('@default?module=webapp&action=home');
    }
  }

  public function executeLogin(sfWebRequest $request) {
    $logintype = $request->getParameter('type');
    $service = $request->getParameter('service');
    $this->forward404Unless($logintype);
    $this->forward404Unless($service);
    if($logintype == 'oauth' && ($service == 'twitter' or $service == 'facebook')){
      $this->getUser()->connect($service);
    } else if ($logintype == 'openid' && ($service == 'google' or $service == 'yahoo' or $service == 'myopenid')) {
      $openidurl = null;
      switch($service){
        case 'google':
          $openidurl = 'https://www.google.com/accounts/o8/id';
        break;
        case 'yahoo':
          $openidurl = 'http://me.yahoo.com/';
        break;
        case 'myopenid':
          $openidurl = 'http://myopenid.com/';
        break;
      }
      $this->forward404Unless($openidurl);
      $this->getUser()->setAttribute('openidurl', $openidurl);
      $this->forward('openid', 'verifylink');
    } else if ($logintype == 'openid') {
      $identity = $request->getParameter('identity');
      $this->forward404Unless($identity);
      $this->forward('openid', 'verify');
    }

  }

  /////////////

  public function executeHome(sfWebRequest $request)
  {
    if($this->getUser()->isAuthenticated() != true){
      $this->redirect('@homepage');
    }
  }

  public function executeTime(sfWebRequest $request)
  {
    if($this->getUser()->isAuthenticated() != true){
      $this->getUser()->setFlash('error', 'You must be logged in to access this content');
      $this->redirect('@homepage');
    }elseif(!$request->getParameter('time')){
      $this->getUser()->setFlash('error', 'Team not found');
      $this->redirect('webapp/home');
    }
    elseif(!$this->team = Doctrine_Core::getTable('Team')->findOneBySlug($request->getParameter('time'))){
      $this->getUser()->setFlash('error', 'Team not found');
      $this->redirect('webapp/home');
    }
  }

  public function executeScroll(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
  }
  
}
