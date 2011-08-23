<?php use_helper('I18N', 'Date') ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
    <?php if ($sf_user->isAuthenticated()): ?> 
      <?php echo __('user_id')?>: <?php echo $sf_user->getAttribute('user_id', '', 'sfGuardSecurityUser') ?> - 
      <?php echo link_to(__('logout'), '@sf_guard_signout') ?>
      <br/>
      <?php if(sfContext::getInstance()->getUser()->getAttribute('current_project')): ?>
      <?php echo __('current project_id')?>: <?php echo sfContext::getInstance()->getUser()->getAttribute('current_project') ?>
        <br/>
      <?php endif ?>
    <?php endif ?>
    <?php if ($sf_user->hasFlash('error')): ?>
      <b><?php echo $sf_user->getFlash('error') ?></b><br/>
    <?php endif ?>
    <?php if ($sf_user->hasFlash('info')): ?>
      <?php echo $sf_user->getFlash('info') ?><br/>
    <?php endif ?>
    <?php echo $sf_content ?>
    
    <br /><br />
    <?php include_component('language', 'language') ?>
    
  </body>
</html>