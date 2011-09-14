<!DOCTYPE html> 
<html> 
<head> 
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <title>Futebol Clube: Times, Jogos, Campeonatos, Notícias e Iteratividade em tempo real</title> 
  <link rel="stylesheet"  href="/js/jquery.mobile/jquery.mobile-1.0b2.min.css" /> 
  <link rel="stylesheet" href="/css/webapp.css" /> 
  <script src="/js/jquery-1.6.2.min.js"></script> 
  <script src="/js/webapp.js"></script> 
  <script src="/js/jquery.mobile/jquery.mobile-1.0b2.min.js"></script>
</head> 
<body> 

  <div data-role="page" class="type-index ui-body-b">

    <?php include_partial('global/flashes') ?>

    <div data-role="header" data-theme="f">
      <h1>Futebol Clube - Time - São Paulo FC</h1>
      <a href="<?php echo url_for('@default?module=webapp&action=home') ?>" data-icon="home" data-iconpos="notext" data-direction="reverse" class="ui-btn-right jqm-home">Home</a>
    </div>

    <div data-role="content">

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
      
      
    </div><!-- /content -->

    <div class="ui-bar ui-bar-b">
      <div data-role="controlgroup" data-type="horizontal">
        <a href="#" data-inline="true" data-role="button">Jogos</a><a href="#" data-inline="true" data-role="button">Button</a><a href="#" data-inline="true" data-role="button">Button</a>
      </div>
    </div>

    <div data-role="footer" class="footer-docs" data-theme="c">
      <p>&copy; 2011 The jQuery Project</p>
    </div>

  </div><!-- /page -->

</body>
</html>