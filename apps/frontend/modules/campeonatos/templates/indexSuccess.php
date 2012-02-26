<div data-role="page" class="type-interior">
  
  <?php include_partial('global/header', array('title'=>$campeonato->getName().' - Classificação')) ?>

  <div data-role="content" data-theme="c">
    <div class="content-primary">

      <h2><?php echo $campeonato->getName() ?></h2>

      <div data-role="navbar" data-theme="c">
        <ul>
          <li><a href="<?php echo url_for('@default?module=campeonatos&action=index&slug='.$campeonato->getSlug()) ?>" class="ui-btn-active">Classificação</a></li>
          <li><a href="<?php echo url_for('@default?module=campeonatos&action=jogos&slug='.$campeonato->getSlug()) ?>">Jogos</a></li>
          <li><a href="<?php echo url_for('@default?module=campeonatos&action=noticias&slug='.$campeonato->getSlug()) ?>">Notícias</a></li>
        </ul>
      </div><!-- /navbar -->

      <p>Confira a classificação do <strong><?php echo $campeonato->getName() ?></strong> em tempo real. Atualizada minuto a minuto.</p>
      <hr />
      <ul data-role="listview">
      <?php foreach($classificacao as $c): ?>
      <li><a href="<?php echo url_for('@default?module=times&action=index&slug='.$c->Team->getSlug()) ?>" style="padding-left: 65px; padding: .7em 110px .7em 60px;">
        <?php if($c->Team->getLogo() != ""):?>
        <img src="/uploads/assets/teams/<?php echo $c->Team->getLogo()?>" alt="<?php echo $c->Team->getName()?>" class="ui-li-icon">
        <?php endif; ?>
        <h3><?php echo $c->Team->getName()?></h3>
        <table style="width: 75%;"><thead>
          <tr><td colspan="2" class="titulo">CLASSIFICAÇÃO</td><td title="pontos">P</td><td title="jogos">J</td><td title="vitórias">V</td><td title="empates">E</td><td title="derrotas">D</td><td title="gols pró">GP</td><td title="gols contra">GC</td><td title="saldo de gols">SG</td><td title="% de aproveitamento">%</td></tr></thead><tbody>
          <tr><td class="primeira faixa1"><div class=""><?php echo intval($c->getRank())?></div></td><td class="time "><?php echo $c->Team->getName()?></td><td class="coluna-p" rel="jogos-pontos"><div><?php echo intval($c->getPoints())?></div></td><td class="coluna-j" rel="jogos-jogos"><div><?php echo $c->getGames()?></div></td><td class="coluna-v" rel="jogos-vitorias"><div><?php echo $c->getWins()?></div></td><td class="coluna-e" rel="jogos-empates"><div><?php echo $c->getDraws()?></div></td><td class="coluna-d" rel="jogos-derrotas"><div><?php echo $c->getDefeats()?></div></td><td class="coluna-gp" rel="gols-pro"><div><?php echo $c->getScoreFor()?></div></td><td class="coluna-gc" rel="gols-contra"><div><?php echo $c->getScoreAgainst()?></div></td><td class="coluna-sg" rel="grafico-saldo"><div><?php echo $c->getScoreDifference()?></div></td><td class="coluna-a" rel="grafico-aproveitamento"><div><?php echo $c->getRate()?></div></td></tr>
        </tbody></table>
        <br />
        <p><strong>Confira todas as notícias do <?php echo $c->Team->getName()?></strong></p>
        <p>Hey Stephen, if you're available at 10am tomorrow, we've got a meeting with the jQuery team.</p>
        <p class="ui-li-aside" style="width: 105px;">
          <?php if($c->Team->getLogo() != ""):?>
          <img src="/uploads/assets/teams/<?php echo $c->Team->getLogo()?>" alt="<?php echo $c->Team->getName()?>" style="opacity: 0.2; height: 105px;" />
          <?php endif; ?>
          <span class="ui-li-count"><?php echo intval($c->getRank())?>&deg; lugar</span></p>
      </a></li>
      <?php endforeach; ?>
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
        <ul data-role="listview" data-filter="true" data-filter-placeholder="Search ticker or firm name..." data-inset="true">
          <?php foreach($campeonatos as $c): ?>
          <li<?php if($campeonato->getId() == $c->getId()): ?> data-theme="a"<?php endif; ?>>
            <a href="<?php echo url_for('@default?module=campeonatos&action=index&slug='.$c->getSlug()) ?>"><?php echo $c->getName() ?></a>
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