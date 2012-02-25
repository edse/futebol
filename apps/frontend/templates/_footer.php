  <div data-role="footer" class="footer-docs" data-theme="c"> 
      <p>&copy; Futebol Clube Project</p> 
  </div>  
  <div data-role="footer" class="nav-glyphish-example" data-position="fixed"> 
    <div data-role="navbar" data-grid="d" data-theme="e" class="nav-glyphish-example"> 
      <ul> 
        <?php if ($sf_user->isAuthenticated()): ?>
        <li><a href="<?php echo url_for('@default?module=times&action=index')?>" id="badge" data-icon="custom" data-theme="b"><?php echo $sf_user->getName()?></a></li>
        <?php else: ?>
        <style>.ui-grid-d .ui-block-a, .ui-grid-d .ui-block-b, .ui-grid-d .ui-block-c, .ui-grid-d .ui-block-d, .ui-grid-d .ui-block-e { width: 25%; }</style>
        <?php endif; ?> 
        <li><a href="<?php echo url_for('@default?module=times&action=index') ?>" id="group" data-icon="custom" data-theme="b">Times</a></li> 
        <li><a href="<?php echo url_for('@default?module=campeonatos&action=index') ?>" id="trophy" data-icon="custom" data-theme="b">Campeonatos</a></li> 
        <li><a href="<?php echo url_for('@default?module=jogos&action=index') ?>" id="clock" data-icon="custom" data-theme="b">Jogos</a></li> 
        <li><a href="<?php echo url_for('@default?module=noticias&action=index') ?>" id="chat" data-icon="custom" data-theme="b">Notícias</a></li> 
      </ul> 
    </div> 
  </div>
