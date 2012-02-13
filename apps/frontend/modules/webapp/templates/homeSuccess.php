  <div data-role="page" id="jqm-home" class="type-home">

    <div data-role="header" data-theme="b">
      <h1>Emerson Futebol Clube</h1>
      <a href="<?php echo url_for('@default?module=webapp&action=home') ?>" data-icon="home" data-iconpos="notext" data-direction="reverse" class="ui-btn-right jqm-home">Home</a>
    </div>

    <div data-role="content">

      <div class="content-secondary">

        <ul data-role="listview" data-inset="true" data-theme="c" data-dividertheme="b"> 
          <li data-role="list-divider">Meu time</li>
          <li id="_my_team"><a href="<?php echo url_for('@default?module=webapp&action=time&time=sao-paulo') ?>"><img src="/uploads/assets/teams/sao_paulo_30x30.png" alt="Twitter" class="ui-li-icon">São Paulo FC</a></li> 
          <li><a href="#">Torcedor</a></li> 
          <li data-role="list-divider">Em tempo real</li>
          <li><a href="#">Jogos de hoje <span class="ui-li-count">3</span></a></li> 
          <li><a href="#">Notícias</a></li> 
          <li data-role="list-divider">Outros</li>
          <li><a href="<?php echo url_for('@default?module=campeonatos&action=index') ?>">Campeonatos <span class="ui-li-count"><?php echo count($campeonatos) ?></span></a></li> 
          <li><a href="<?php echo url_for('@default?module=times&action=index') ?>">Times <span class="ui-li-count"><?php echo count($times) ?></span></a></li> 
          <li><a href="<?php echo url_for('@default?module=estadios&action=index') ?>">Estádios <span class="ui-li-count"><?php echo count($estadios) ?></span></a></li> 
          <li><a href="#">Ranking da FIFA</a></li> 
          <li><a href="#">Regras do jogo</a></li> 
        </ul> 
      </div> 

      <div class="content-primary">
        
        <h2>Page Theming</h2>
        <p>jQuery Mobile has a rich <a href="../api/themes.html">theming system</a> that gives you full control of how pages are styled. There is detailed theming documentation within each page widget, but let's look at a few high-level examples of how theming is applied.</p>
        <p>The <code> data-theme</code> attribute can be applied to the header and footer containers to apply any of the lettered theme color swatches. While the <code> data-theme</code> attribute could be added to the content container, we recommend adding it instead to <code>div</code> or container that has been assigned the <code> data-role="page"</code> attribute to ensure that the background color is applied to the full page.</p>
        <p>The default Theme mixes styles from multiple swatches to create visual texture and present the various elements in optimal contrast to one another:</p>
      
        <h2>Swatch B</h2>
        
        <div data-role="header" data-theme="b">
          <h1>Header B</h1>
        </div>
        <div class="ui-body ui-body-b">
          <h3>Header</h3>
          <p>This is content color swatch "B" and a preview of a <a href="#" class="ui-link">link</a>.</p>
          <label for="slider1">Input slider:</label>
          <input type="range" name="slider1" id="slider1" value="50" min="0" max="100" data-theme="b" />
          <fieldset data-role="controlgroup"  data-type="horizontal" data-role="fieldcontain">
            <legend>Cache settings:</legend>
            <input type="radio" name="radio-choice-a2" id="radio-choice-a2" value="on" checked="checked" />
            <label for="radio-choice-a2">On</label>
            <input type="radio" name="radio-choice-a2" id="radio-choice-b2" value="off"  />
            <label for="radio-choice-b2">Off</label>
          </fieldset>
          <a href="#" data-role="button" data-inline="true">Button</a>
        </div>
        
        <div class="ui-bar ui-bar-b">
          <div data-role="controlgroup" data-type="horizontal">
            <a href="#" data-inline="true" data-role="button">Button</a><a href="#" data-inline="true" data-role="button">Button</a><a href="#" data-inline="true" data-role="button">Button</a>
          </div>
        </div>
      
      </div>
      
    </div><!-- /content -->
    
  <?php include_partial('global/footer') ?>

  </div><!-- /page -->

</body>
</html>