<?php use_helper('I18N') ?>

      <ul data-role="listview" data-inset="true" data-theme="c" data-dividertheme="b" id="_login"> 
        <li data-role="list-divider">Entrar usando...</li>
        <li><a href="<?php echo url_for('@default?module=webapp&action=login&service=twitter&type=oauth') ?>" rel="external"><img src="../images/twitter.png" alt="Twitter" class="ui-li-icon">Twitter</a></li> 
        <li><a href="<?php echo url_for('@default?module=webapp&action=login&service=facebook&type=oauth') ?>" rel="external"><img src="../images/facebook.png" alt="Facebook" class="ui-li-icon">Facebook</a></li>
        <li><a href="<?php echo url_for('@default?module=webapp&action=login&service=google&type=openid') ?>" rel="external"><img src="../images/google.png" alt="Google" class="ui-li-icon">Google</a></li> 
        <li><a href="<?php echo url_for('@default?module=webapp&action=login&service=yahoo&type=openid') ?>" rel="external"><img src="../images/yahoo.png" alt="Yahoo!" class="ui-li-icon">Yahoo!</a></li> 
        <li><a href="<?php echo url_for('@default?module=webapp&action=login&service=myopenid&type=openid') ?>" rel="external"><img src="../images/linkedin.png" alt="Linkedin" class="ui-li-icon">Linkedin</a></li> 
        <li><a href="<?php echo url_for('@default?module=webapp&action=login&service=myopenid&type=openid') ?>" rel="external"><img src="../images/hotmail.png" alt="OpenID" class="ui-li-icon">OpenID</a></li> 
      </ul> 


<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
  <table>
    <tbody>
      <?php echo $form ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="2">
          <input type="submit" value="<?php echo __('Signin', null, 'sf_guard') ?>" />
          
          <?php $routes = $sf_context->getRouting()->getRoutes() ?>
          <?php if (isset($routes['sf_guard_forgot_password'])): ?>
            <a href="<?php echo url_for('@sf_guard_forgot_password') ?>"><?php echo __('Forgot your password?', null, 'sf_guard') ?></a>
          <?php endif; ?>

          <?php if (isset($routes['sf_guard_register'])): ?>
            &nbsp; <a href="<?php echo url_for('@sf_guard_register') ?>"><?php echo __('Want to register?', null, 'sf_guard') ?></a>
          <?php endif; ?>
        </td>
      </tr>
    </tfoot>
  </table>
</form>