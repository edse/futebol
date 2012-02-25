<div data-role="page" class="type-interior">
  <div data-role="header" data-theme="b">
    <h1><?php echo $jogo->HomeTeam->getName() ?> x <?php echo $jogo->AwayTeam->getName() ?> - <?php echo $jogo->Tournament->getName() ?></h1>
    <a href="<?php echo url_for('@default?module=webapp&action=home') ?>" data-icon="home" data-iconpos="notext" data-direction="reverse" class="ui-btn-right jqm-home">Home</a>
    <a href="#" data-icon="refresh" class="ui-btn-right">Atualizar</a>
  </div>
  <div data-role="content" data-theme="c">
    <div class="content-primary">

      <h2><?php echo $jogo->Tournament->getName() ?></h2>

      <h3><?php echo $jogo->HomeTeam->getName() ?> x <?php echo $jogo->AwayTeam->getName() ?></h2>

      <hr />
      
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
          <?php foreach($jogos as $c): ?>
          <li<?php if($jogo->getId() == $c->getId()): ?> data-theme="a"<?php endif; ?>>
            <a href="<?php echo url_for('@default?module=jogos&action=details&id='.$c->getId()) ?>"><?php echo $c->HomeTeam->getName() ?> x <?php echo $c->AwayTeam->getName() ?></a>
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