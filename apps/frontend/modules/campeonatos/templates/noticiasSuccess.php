<div data-role="page" class="type-interior">
  <div data-role="header" data-theme="b">
    <h1>Futebol Clube - <?php echo $campeonato->getName() ?> - Notícias</h1>
    <a href="<?php echo url_for('@default?module=webapp&action=home') ?>" data-icon="home" data-iconpos="notext" data-direction="reverse" class="ui-btn-right jqm-home">Home</a>
    <a href="index.html" data-icon="refresh" class="ui-btn-right">Atualizar</a>
  </div>
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
        
    <ul data-role="listview">
      <li data-role="list-divider">Friday, October 8, 2010 <span class="ui-li-count">2</span></li>
      <li><a href="index.html">
        
          <h3>Stephen Weber</h3>
          <p><strong>You've been invited to a meeting at Filament Group in Boston, MA</strong></p>
          <p>Hey Stephen, if you're available at 10am tomorrow, we've got a meeting with the jQuery team.</p>
          <p class="ui-li-aside"><strong>6:24</strong>PM</p>
        
      </a></li>
      <li><a href="index.html">
        
        <h3>jQuery Team</h3>
        <p><strong>Boston Conference Planning</strong></p>
        <p>In preparation for the upcoming conference in Boston, we need to start gathering a list of sponsors and speakers.</p>
        <p class="ui-li-aside"><strong>9:18</strong>AM</p>
        
      </a></li>
      <li data-role="list-divider">Thursday, October 7, 2010 <span class="ui-li-count">1</span></li>
      <li><a href="index.html">
        <h3>Avery Walker</h3>
        <p><strong>Re: Dinner Tonight</strong></p>
        <p>Sure, let's plan on meeting at Highland Kitchen at 8:00 tonight. Can't wait! </p>
        <p class="ui-li-aside"><strong>4:48</strong>PM</p>
      </a></li>
      <li data-role="list-divider">Wednesday, October 6, 2010 <span class="ui-li-count">3</span></li>
      <li><a href="index.html">
        <h3>Amazon.com</h3>
        <p><strong>4-for-3 Books for Kids</strong></p>
        <p>As someone who has purchased children's books from our 4-for-3 Store, you may be interested in these featured books.</p>
        <p class="ui-li-aside"><strong>12:47</strong>PM</p>
      </a></li>
      <li><a href="index.html">
        <h3>Mike Taylor</h3>
        <p><strong>Re: This weekend in Maine</strong></p>
        <p>Hey little buddy, sorry but I can't make it up to vacationland this weekend. Maybe next weekend?</p>
        <p class="ui-li-aside"><strong>6:24</strong>AM</p>
      </a></li>
      <li><a href="index.html">
        <h3>Redfin</h3>
        <p><strong>Redfin listing updates for today</strong></p>
        <p>There are 3 updates for the home on your watchlist: 1 updated MLS listing and 2 homes under contract.</p>
        <p class="ui-li-aside"><strong>5:52</strong>AM</p>
      </a></li>

      <?php /* foreach($classificacao as $c): 
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
      <?php endforeach; */ ?>
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