<?php use_helper('I18N', 'Date') ?>
<div data-role="page" class="type-interior">
  
  <?php include_partial('global/header', array('title'=>$campeonato->getName().' - Notícias')) ?>

  <div data-role="content" data-theme="c">
    <div class="content-primary">

      <h2><?php echo $campeonato->getName() ?></h2>

      <div data-role="navbar" data-theme="c">
        <ul>
          <li><a href="<?php echo url_for('@default?module=campeonatos&action=index&slug='.$campeonato->getSlug()) ?>">Classificação</a></li>
          <li><a href="<?php echo url_for('@default?module=campeonatos&action=jogos&slug='.$campeonato->getSlug()) ?>">Jogos</a></li>
          <li><a href="<?php echo url_for('@default?module=campeonatos&action=noticias&slug='.$campeonato->getSlug()) ?>" class="ui-btn-active">Notícias</a></li>
        </ul>
      </div><!-- /navbar -->

      <p>Confira as últimas notícias do <strong><?php echo $campeonato->getName() ?></strong> em tempo real. Atualizadas minuto a minuto.</p>
      <hr />

    <ul data-role="listview">

      <?php $now = ""; $i=0; ?>
      <?php foreach($assets as $d): ?>
      <?php 
      $now = format_date(strtotime(date('Y-m-d',strtotime($dias[$i]["date"]))), 'D');
      ?>
      <li data-role="list-divider"><?php echo $now ?> <span class="ui-li-count"><?php echo count($d)?></span></li>
        <?php foreach($d as $c): ?>
          <li><a href="<?php echo url_for('@default?module=noticias&action=details&id='.$c->getId()) ?>">
          <h3><?php echo $c->getTitle() ?></h3>
          <p><?php echo strip_tags(html_entity_decode($c->getDescription())) ?></p>
          <p class="ui-li-aside" style="width: 50px;"><strong><?php echo format_date(strtotime($c->getDateStart()), 't') ?></strong></p>
      </a></li>
      <?php endforeach; ?>
      <?php $now++; $i++; endforeach; ?>
      </ul>
      
    </div><!--/content-secondary -->
    <div class="content-secondary">
      <div data-role="collapsible" data-collapsed="true" data-theme="b" data-content-theme="d">
        <h3>Últimas Notícias</h3>
        <style>
          .ui-listview-filter-inset{
            margin: auto;
          }
          .ui-listview-filter{
            margin: auto;
            overflow: visible;
          }
        </style>
        <ul data-role="listview" data-filter="true" data-filter-placeholder="Search ticker or firm name..." data-inset="true">
          <?php foreach($campeonatos as $c): ?>
          <li<?php if($campeonato->getId() == $c->getId()): ?> data-theme="a"<?php endif; ?>>
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