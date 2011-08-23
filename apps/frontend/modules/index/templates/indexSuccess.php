<?php use_helper('I18N', 'Date') ?>

<?php if ($sf_user->isAuthenticated()): ?>
  <?php echo __('Service connected:') ?>
  <?php foreach($oauths as $oauth): ?>
    <?php echo $oauth->name; ?>.com, 
  <?php endforeach; ?>
  <?php foreach($openid as $openid): ?>
    <?php echo $openid->name; ?>, 
  <?php endforeach; ?>
  <br/>
  <?php echo __('Add another login service:') ?>
  <br/>
<?php else: ?> 
  <?php echo __('Login or sign up using:') ?>
  <br/>
<?php endif; ?>

<?php echo link_to('Facebook', '@default?module=index&action=login&service=facebook&type=oauth', array('class' => 'oauth')) ?> | 
<?php echo link_to('Twitter', '@default?module=index&action=login&service=twitter&type=oauth', array('class' => 'oauth')) ?> | 
<?php echo link_to('OpenId', '@homepage', array('id' => 'openid')) ?>

<div id="openidform" style="display:none;">
  <form method="post" action="<?php echo url_for('@default?module=index&action=login&service=identity&type=openid') ?>" />
    <input type="text" name="identity" placeholder="<?php echo __('Login using OpenID') ?>"/>
    <input type="submit" name="submit" value="<?php echo __('Login') ?>"/>
  </form>
</div>

<script>
  $(document).ready(function(){
    $("#openid").click(function(event){
      $("#openidform").toggle();
      event.preventDefault();
    });
    $(".oauth").click(function(event){
      $("#openidform").hide();
    });
  });
</script>