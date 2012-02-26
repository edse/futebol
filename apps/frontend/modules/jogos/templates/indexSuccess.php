<?php use_helper('I18N', 'Date') ?>
<?php $sf_user->setCulture('pt_BR') ?>
<div data-role="page" class="type-interior">
  
  <?php include_partial('global/header', array('title'=>'Jogos')) ?>

  <div data-role="header" data-theme="b">
    <h1>Futebol Clube - Jogos</h1>
    <a href="<?php echo url_for('@default?module=webapp&action=home') ?>" data-icon="home" data-iconpos="notext" data-direction="reverse" class="ui-btn-right jqm-home">Home</a>
    <a href="index.html" data-icon="refresh" class="ui-btn-right">Atualizar</a>
  </div>

  <div data-role="content" data-theme="c">
    <div class="content-primary">

      <h2>Próximos jogos</h2>

      <br />

      <ul data-role="listview">
      <?php $now = ""; $i=0; ?>
      <?php foreach($jogos as $d): ?>
      <?php 
      $now = format_date(strtotime(date('Y-m-d',strtotime($dias[$i]["date"]))), 'D');
      ?>
      <li data-role="list-divider"><?php echo $now ?> <span class="ui-li-count"><?php echo count($d)?></span></li>
        <?php foreach($d as $c): ?>
      
      <li><a title="Confira todos os detalhes desse jogo" href="<?php echo url_for('@default?module=jogos&action=details&id='.$c->getId()) ?>" style="padding-left: 65px; padding: .7em 110px .7em 60px;">
        <table><tr><td>
        <?php if($c->HomeTeam->getLogo() != ""):?>
        <img src="/uploads/assets/teams/<?php echo $c->HomeTeam->getLogo()?>" alt="<?php echo $c->HomeTeam->getName()?>" />
        <?php else:?>
        <?php echo $c->HomeTeam->getName()?>
        <?php endif; ?>
        </td><td>
        <?php echo $c->getHomeTeamScore()?>
        </td><td>x</td><td>
        <?php echo $c->getAwayTeamScore()?>
        </td><td>
        <?php if($c->AwayTeam->getLogo() != ""):?>
        <img src="/uploads/assets/teams/<?php echo $c->AwayTeam->getLogo()?>" alt="<?php echo $c->AwayTeam->getName()?>" />
        <?php else:?>
        <?php echo $c->AwayTeam->getName()?>
        <?php endif; ?>
        </td></tr></table>
        <h3><?php echo $c->HomeTeam->getName()?> <?php echo $c->getHomeTeamScore()?> x <?php echo $c->getAwayTeamScore()?> <?php echo $c->AwayTeam->getName()?></h3>
        <p>Estádio: <strong><?php echo $c->Stadium->getName()?></strong></p>
        <!-- <p>Confira todos os detalhes desse jogo</p> -->
        <?php if($c->HomeTeam->getLogo() != "" && $c->AwayTeam->getLogo()):?>
        <p class="ui-li-aside" style="width: 215px;">
          <span><?php echo format_date(strtotime($c->getDateStart()), 'D') ?> - <strong><?php if(format_date(strtotime($c->getDateStart()), 't') != "00:00") echo format_date(strtotime($c->getDateStart()), 't') ?></strong></span>
          <br />
          <!--
          <span>Estádio: <strong><?php echo $c->Stadium->getName()?></strong></span>
          <br />
          <span><img src="/uploads/assets/teams/<?php echo $c->HomeTeam->getLogo()?>" alt="<?php echo $c->HomeTeam->getName()?>" style="opacity: 0.2; height: 105px;" /></span>
          <span><img src="/uploads/assets/teams/<?php echo $c->AwayTeam->getLogo()?>" alt="<?php echo $c->HomeTeam->getName()?>" style="opacity: 0.2; height: 105px;" /></span>
          -->
        </p>
        <?php endif; ?>
        <span class="ui-li-count"><?php echo $c->HomeTeam->getName()?> <?php echo $c->getHomeTeamScore()?> x <?php echo $c->getAwayTeamScore()?> <?php echo $c->AwayTeam->getName()?></span>
      </a>

      </li>
      <?php endforeach; ?>
      <?php $now++; $i++; endforeach; ?>
      </ul>
      
    </div><!--/content-secondary -->
    <div class="content-secondary">
      <div data-role="collapsible" data-collapsed="true" data-theme="b" data-content-theme="d">
        <h3>Campeonatos em andamento</h3>
        <style>
          .ui-listview-filter-inset{
            margin: auto;
          }
          .ui-listview-filter{
            margin: auto;
            overflow: visible;
          }
        </style>
        <ul data-role="listview" data-filter="true" data-filter-placeholder="Entre com o nome do time..." data-inset="true">
          <?php foreach($proximos_jogos as $c): ?>
          <li>
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