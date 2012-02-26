  <div data-role="header" data-position="fixed" data-theme="b">
    <h1>Futebol Clube - <?php echo $title ?></h1>
    <a href="<?php echo url_for('@default?module=webapp&action=home') ?>" data-icon="home" data-iconpos="notext" data-direction="reverse" class="ui-btn-right jqm-home">Home</a>
    <?php if(isset($refresh)):?>
    <a href="index.html" data-icon="refresh" class="ui-btn-right">Atualizar</a>
    <?php elseif($sf_user->isAuthenticated()): ?> 
    <a href="<?php echo url_for('@default?module=webapp&action=register') ?>" data-icon="gear" class="ui-btn-right">Opções</a>
    <?php endif;?>
  </div>
