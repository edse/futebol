<div data-role="page" class="type-interior">
  
  <?php include_partial('global/header', array('title'=>'Notícias')) ?>

  <div data-role="content" data-theme="c">
    <div class="content-primary">

      <h2><?php echo $asset->getTitle() ?></h2>

      <h3><?php echo strip_tags(urldecode($asset->getDescription())) ?></h2>

      <hr />

      <div>
        <?php echo urldecode($asset->AssetContent->getContent()) ?>
      </div>
      
    </div><!--/content-secondary -->
    <div class="content-secondary">
      <div data-role="collapsible" data-collapsed="true" data-theme="b" data-content-theme="d">
        <h3>Próximos jogos</h3>
        <style>
          .ui-listview-filter-inset{
            margin: auto;
          }
          .ui-listview-filter{
            margin: auto;
            overflow: visible;
          }
        </style>
        <ul data-role="listview" data-filter="true" data-filter-placeholder="nome do time ou data do jogo..." data-inset="true">
          <?php foreach($campeonatos as $c): ?>
          <li>
            <a href="<?php echo url_for('@default?module=campeonatos&action=noticias&slug='.$c->getSlug()) ?>"><?php echo $c->getName() ?></a>
          </li>
          <?php endforeach; ?>
        </ul>

      </div>
    </div>
  </div><!-- /content -->

  <?php include_partial('global/footer') ?>

</div><!-- /page -->
</body>
</html> 