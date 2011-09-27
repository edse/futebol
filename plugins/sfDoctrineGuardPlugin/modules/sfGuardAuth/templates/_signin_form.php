<?php use_helper('I18N') ?>
<style>
#loginMenu{
  margin-top: 1em;
}
#loginMenu a{
  color: black;
  font-size: 1.4em;
  text-decoration: none;
}
#loginMenu li{
  list-style-type: none;
  margin: 0px;
  padding: 0.45em 0 0.25em 1.25em;
  border-bottom: 1px solid white;
}
#loginMenu img{
  margin-right: 0.7em;
}
</style>
<ul id="loginMenu" data-role="listview" data-inset="true" data-theme="c" data-dividertheme="b" id="_login"> 
  <li><a href="<?php echo url_for('@default?module=webapp&action=login&service=twitter&type=oauth') ?>" rel="external" style="font-weight: lighter" title="Twitter"><img src="../images/twitter.png" alt="Twitter" class="ui-li-icon">Twitter</a></li> 
  <li><a href="<?php echo url_for('@default?module=webapp&action=login&service=facebook&type=oauth') ?>" rel="external" style="font-weight: lighter" title="Facebook"><img src="../images/facebook.png" alt="Facebook" class="ui-li-icon">Facebook</a></li>
  <li><a href="<?php echo url_for('@default?module=webapp&action=login&service=google&type=openid') ?>" rel="external" style="font-weight: lighter" title="Google"><img src="../images/google.png" alt="Google" class="ui-li-icon">Google</a></li> 
  <li><a href="<?php echo url_for('@default?module=webapp&action=login&service=yahoo&type=openid') ?>" rel="external" style="font-weight: lighter" title="Yahoo!"><img src="../images/yahoo.png" alt="Yahoo!" class="ui-li-icon">Yahoo!</a></li> 
  <li><a href="<?php echo url_for('@default?module=webapp&action=login&service=myopenid&type=openid') ?>" rel="external" style="font-weight: lighter" title="Linkedin"><img src="../images/linkedin.png" alt="Linkedin" class="ui-li-icon">Linkedin</a></li> 
  <li><a href="<?php echo url_for('@default?module=webapp&action=login&service=myopenid&type=openid') ?>" rel="external" style="font-weight: lighter" title="OpenID"><img src="../images/hotmail.png" alt="OpenID" class="ui-li-icon">OpenID</a></li> 
</ul> 
