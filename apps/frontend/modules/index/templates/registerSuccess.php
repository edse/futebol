<?php use_helper('I18N', 'Date') ?>

<form method="post" action="<?php echo url_for('@default?module=index&action=register&code=verify') ?>" />
  <?php echo __('First Name:') ?> <input type="text" name="first_name" /><br />
  <?php echo __('Last Name:') ?> <input type="text" name="last_name" /><br />
  <?php echo __('Email:') ?> <input type="text" name="email" /><br /><br />
  <input type="submit" name="submit" value="<?php echo __('Verify Account') ?>"/>
</form>