<div data-role="page" class="type-interior">
  <div data-role="header" data-theme="b">
    <h1>Futebol Clube - Notícias</h1>
    <a href="<?php echo url_for('@default?module=webapp&action=home') ?>" data-icon="home" data-iconpos="notext" data-direction="reverse" class="ui-btn-right jqm-home">Home</a>
    <a href="index.html" data-icon="refresh" class="ui-btn-right">Atualizar</a>
  </div>
  <div data-role="content" data-theme="c">
    <div class="content-primary">

      <h2>Notícias</h2>

      <p>Confira as últimas notícias do mundo do futebol em tempo real. Atualizadas minuto a minuto.</p>
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
        <ul data-role="listview" data-filter="true" data-filter-placeholder="Procure por times, campeonatos..." data-inset="true">
          <?php foreach($noticias as $n): ?>
          <li>
            <a href="<?php echo url_for('@default?module=noticias&action=view&id='.$n->getId()) ?>"><?php echo $n->getTitle() ?></a>
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