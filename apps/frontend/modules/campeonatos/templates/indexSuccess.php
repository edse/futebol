<div data-role="page" class="type-interior">
  <div data-role="header" data-theme="b">
    <h1>Emerson Futebol Clube</h1>
    <a href="<?php echo url_for('@default?module=webapp&action=home') ?>" data-icon="home" data-iconpos="notext" data-direction="reverse" class="ui-btn-right jqm-home">Home</a>
  </div>
  <div data-role="content" data-theme="c">
    <div class="content-primary">
      <h2><?php echo $campeonato->getName() ?></h2>
      <p>
        Unlike other jQuery projects, such as jQuery and jQuery UI, jQuery Mobile automatically applies many markup enhancements as soon as it loads (long before <code>
          document.ready</code>
        event fires). These enhancements are applied based on jQuery Mobile's default configuration, which is designed to work with common scenarios, but may or may not match your particular needs. Fortunately, these settings are easy to configure.
      </p>
      
      <table><thead><tr><td colspan="2" class="titulo">CLASSIFICAÇÃO</td><td title="pontos">P</td><td title="jogos">J</td><td title="vitórias">V</td><td title="empates">E</td><td title="derrotas">D</td><td title="gols pró">GP</td><td title="gols contra">GC</td><td title="saldo de gols">SG</td><td title="% de aproveitamento">%</td></tr></thead><tbody>
      <?php foreach($classificacao as $c): ?>
        <tr class="linha-classificacao" rel="<?php echo $c->Team->getSlug()?>" data="/uploads/assets/teams/<?php echo $c->Team->getLogo()?>"><td class="primeira faixa1" rel="grafico-posicao"><div class=""><?php echo $c->getRank()?></div></td><td class="time "><?php echo $c->getName()?></td><td class="coluna-p" rel="jogos-pontos"><div><?php echo $c->getPoints()?></div></td><td class="coluna-j" rel="jogos-jogos"><div><?php echo $c->getGames()?></div></td><td class="coluna-v" rel="jogos-vitorias"><div><?php echo $c->getWins()?></div></td><td class="coluna-e" rel="jogos-empates"><div><?php echo $c->getDraws()?></div></td><td class="coluna-d" rel="jogos-derrotas"><div><?php echo $c->getDefeats()?></div></td><td class="coluna-gp" rel="gols-pro"><div><?php echo $c->getScoreFor()?></div></td><td class="coluna-gc" rel="gols-contra"><div><?php echo $c->getScoreAgainst()?></div></td><td class="coluna-sg" rel="grafico-saldo"><div><?php echo $c->getScoreDifference()?></div></td><td class="coluna-a" rel="grafico-aproveitamento"><div><?php echo $c->getRate()?></div></td></tr>
      <?php endforeach; ?>
      </tbody></table>
      
      <h3>The mobileinit event</h3>
      <p>
        When the jQuery Mobile starts to execute, it triggers a <code>
          mobileinit</code>
        event on the <code>
          document</code>
        object, to which you can bind to apply overrides to jQuery Mobile's defaults.
      </p>
      <pre>
        <code>
$(document).bind("mobileinit", function(){
  //apply overrides here
});
        </code>
      </pre>
      <p>
        Because the <code>
          mobileinit</code>
        event is triggered immediately upon execution, you'll need to bind your event handler before jQuery Mobile is loaded. Thus, we recommend linking to your JavaScript files in the following order:
      </p>
      <pre>
        <code>
&lt;script src=&quot;jquery.js&quot;&gt;&lt;/script&gt;
<strong>&lt;script src=&quot;custom-scripting.js&quot;&gt;&lt;/script&gt;</strong>
&lt;script src=&quot;jquery-mobile.js&quot;&gt;&lt;/script&gt;
        </code>
      </pre>
      <p>
        Within this event binding, you can configure defaults either by extending the <code>
          $.mobile</code>
        object using jQuery's <code>
          $.extend</code>
        method:
      </p>
      <pre>
        <code>
$(document).bind("mobileinit", function(){
  $.extend(  $.mobile , {
    <strong>foo: bar</strong>
  });
});
        </code>
      </pre>
      <p>
        ...or by setting them individually:
      </p>
      <pre>
        <code>
$(document).bind("mobileinit", function(){
  <strong>$.mobile.foo = bar;</strong>
});
        </code>
      </pre>
      <p>
        To quickly preview these global configuration options in action, check out the <a href="../config/index.html">config test pages</a>.
      </p>
      <h2>Configurable options</h2>
      <p>
        The following defaults are configurable via the <code>
          $.mobile</code>
        object:
      </p>
      <dl>
        <dt>
          <code>
            ns</code>
          <em>string</em>, default: ""
        </dt>
        <dd>
          The namespace used in data- attributes, for example, data-role. Can be set to anything, including a blank string which is the default. When using, it's clearest if you include a trailing dash, such as "mynamespace-" which maps to <code>
            data-mynamespace-foo="..."</code>
          .
          <p>
            <strong>NOTE:</strong> if you're using data- namespacing, you'll need to manually update/override one selector in the theme CSS. The following data selectors should incorporate the namespace you're using:             <pre><code>
.ui-mobile [data-<strong>mynamespace-</strong>role=page], .ui-mobile [data-<strong>mynamespace-</strong>role=dialog], .ui-page { ...
    </code></pre>
          </p>
        </dd>
        <dt>
          <code>
            autoInitializePage</code>
          <em>boolean</em>, default: true
        </dt>
        <dd>
          When the DOM is ready, the framework should automatically call <code>
            $.mobile.initializePage</code>
          . If false, page will not initialize, and will be visually hidden until <code>
            $.mobile.initializePage</code>
          is manually called.
        </dd>
        <dt>
          <code>
            subPageUrlKey</code>
          <em>string</em>, default: "ui-page"
        </dt>
        <dd>
          The url parameter used for referencing widget-generated sub-pages (such as those generated by nested listviews). Translates to to <em>example.html<strong>&ui-page=</strong>subpageIdentifier</em>. The hash segment before &ui-page= is used by the framework for making an Ajax request to the URL where the sub-page exists.
        </dd>
        <dt>
          <code>
            activePageClass</code>
          <em>string</em>, default: "ui-page-active"
        </dt>
        <dd>
          The class assigned to page currently in view, and during transitions
        </dd>
        <dt>
          <code>
            activeBtnClass</code>
          <em>string</em>, default: "ui-btn-active"
        </dt>
        <dd>
          The class used for "active" button state, from CSS framework.
        </dd>
        <dt>
          <code>
            ajaxEnabled</code>
          <em>boolean</em>, default: true
        </dt>
        <dd>
          jQuery Mobile will automatically handle link clicks and form submissions through Ajax, when possible. If false, url hash listening will be disabled as well, and urls will load as regular http requests.
        </dd>
        <dt>
          <code>
            linkBindingEnabled</code>
          <em>boolean</em>, default: true
        </dt>
        <dd>
          jQuery Mobile will automatically bind the clicks on anchor tags in your document. Setting this options to false will prevent all anchor click handling <em>including</em> the addition of active button state and alternate link bluring. This should only be used when attempting to delegate the click management to another library or custom code.
        </dd>
        <dt>
          <code>
            hashListeningEnabled</code>
          <em>boolean</em>, default: true
        </dt>
        <dd>
          jQuery Mobile will automatically listen and handle changes to the location.hash. Disabling this will prevent jQuery Mobile from handling hash changes, which allows you to handle them yourself, or simply to use simple deep-links within a document that scroll to a particular ID.
        </dd>
        <dt>
          <code>
            pushStateEnabled</code>
          <em>boolean</em>, default: true
        </dt>
        <dd>
          Enhancement to use <code>
            history.replaceState</code>
          in supported browsers, to convert the hash-based Ajax URL into the full document path. Note that we <a href="../pages/page-navmodel.html">recommend</a> disabling this feature if Ajax is disabled or if extensive use of external links are used.
        </dd>
        <dt>
          <code>
            defaultPageTransition</code>
          <em>string</em>, default: 'slide'
        </dt>
        <dd>
          Set the default transition for page changes that use Ajax. Set to 'none' for no transitions by default.
        </dd>
        <dt>
          <code>
            touchOverflowEnabled</code>
          <em>boolean</em>, default: false
        </dt>
        <dd>
          Enable smoother page transitions and true fixed toolbars in devices that support both the <code>
            overflow:</code>
          and <code>
            overflow-scrolling: touch; </code>
          CSS properties.
        </dd>
        <dt>
          <code>
            defaultDialogTransition</code>
          <em>string</em>, default: 'pop'
        </dt>
        <dd>
          Set the default transition for dialog changes that use Ajax. Set to 'none' for no transitions by default.
        </dd>
        <dt>
          <code>
            minScrollBack</code>
          <em>string</em>, default: 250
        </dt>
        <dd>
          Minimum scroll distance that will be remembered when returning to a page.
        </dd>
        <dt>
          <code>
            loadingMessage</code>
          <em>string</em>, default: "loading"
        </dt>
        <dd>
          Set the text that appears when a page is loading. If set to false, the message will not appear at all.
        </dd>
        <dt>
          <code>
            loadingMessageTheme</code>
          <em>string</em>, default: "a"
        </dt>
        <dd>
          Set the theme that the loading message box uses, when text is visible.
        </dd>
        <dt>
          <code>
            pageLoadErrorMessage</code>
          <em>string</em>, default: "Error Loading Page"
        </dt>
        <dd>
          Set the text that appears when a page fails to load through Ajax.
        </dd>
        <dt>
          <code>
            pageLoadErrorMessageTheme</code>
          <em>string</em>, default: "e"
        </dt>
        <dd>
          Set the theme that the error message box uses.
        </dd>
        <dt>
          <code>
            loadingMessageTextVisible</code>
          <em>string</em>, default: false
        </dt>
        <dd>
          Should the text be visible when loading message is shown. (note: currently, the text is always visible for loading errors)
        </dd>
        <dt>
          <code>
            gradeA</code>
          <em>function that returns a boolean</em>, default: a function returning the value of $.support.mediaquery
        </dt>
        <dd>
          Any support conditions that must be met in order to proceed.
        </dd>
      </dl>
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