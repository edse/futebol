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
      
  <table><thead><tr><td colspan="2" class="titulo">CLASSIFICAÇÃO</td><td title="pontos">P</td><td title="jogos">J</td><td title="vitórias">V</td><td title="empates">E</td><td title="derrotas">D</td><td title="gols pró">GP</td><td title="gols contra">GC</td><td title="saldo de gols">SG</td><td title="% de aproveitamento">%</td></tr></thead><tbody><tr class="linha-classificacao" rel="palmeiras" data="http://s.glbimg.com/es/ge/f/original/2010/11/19/palmeiras_30x30.png"><td class="primeira faixa1" rel="grafico-posicao"><div class="">1</div></td><td class="time ">Palmeiras</td><td class="coluna-p" rel="jogos-pontos"><div>20</div></td><td class="coluna-j" rel="jogos-jogos"><div>8</div></td><td class="coluna-v" rel="jogos-vitorias"><div>6</div></td><td class="coluna-e" rel="jogos-empates"><div>2</div></td><td class="coluna-d" rel="jogos-derrotas"><div>0</div></td><td class="coluna-gp" rel="gols-pro"><div>17</div></td><td class="coluna-gc" rel="gols-contra"><div>8</div></td><td class="coluna-sg" rel="grafico-saldo"><div>9</div></td><td class="coluna-a" rel="grafico-aproveitamento"><div>83.3</div></td></tr><tr class="linha-classificacao" rel="corinthians" data="http://s.glbimg.com/es/ge/f/original/2010/11/19/corinthians_30x30.png"><td class="primeira faixa1" rel="grafico-posicao"><div class="">2</div></td><td class="time ">Corinthians</td><td class="coluna-p" rel="jogos-pontos"><div>20</div></td><td class="coluna-j" rel="jogos-jogos"><div>8</div></td><td class="coluna-v" rel="jogos-vitorias"><div>6</div></td><td class="coluna-e" rel="jogos-empates"><div>2</div></td><td class="coluna-d" rel="jogos-derrotas"><div class="">0</div></td><td class="coluna-gp" rel="gols-pro"><div class="">10</div></td><td class="coluna-gc" rel="gols-contra"><div>3</div></td><td class="coluna-sg" rel="grafico-saldo"><div>7</div></td><td class="coluna-a" rel="grafico-aproveitamento"><div>83.3</div></td></tr><tr class="linha-classificacao" rel="guarani" data="http://s.glbimg.com/es/ge/f/original/2010/11/19/guarani_30x30.png"><td class="primeira faixa1" rel="grafico-posicao"><div class="">3</div></td><td class="time ">Guarani</td><td class="coluna-p" rel="jogos-pontos"><div>19</div></td><td class="coluna-j" rel="jogos-jogos"><div>8</div></td><td class="coluna-v" rel="jogos-vitorias"><div>6</div></td><td class="coluna-e" rel="jogos-empates"><div class="">1</div></td><td class="coluna-d" rel="jogos-derrotas"><div>1</div></td><td class="coluna-gp" rel="gols-pro"><div>11</div></td><td class="coluna-gc" rel="gols-contra"><div>6</div></td><td class="coluna-sg" rel="grafico-saldo"><div>5</div></td><td class="coluna-a" rel="grafico-aproveitamento"><div>79.2</div></td></tr><tr class="linha-classificacao" rel="sao-paulo" data="http://s.glbimg.com/es/ge/f/original/2010/11/19/sao_paulo_30x30.png"><td class="primeira faixa1" rel="grafico-posicao"><div class="">4</div></td><td class="time ">São Paulo</td><td class="coluna-p" rel="jogos-pontos"><div>17</div></td><td class="coluna-j" rel="jogos-jogos"><div>8</div></td><td class="coluna-v" rel="jogos-vitorias"><div class="">5</div></td><td class="coluna-e" rel="jogos-empates"><div>2</div></td><td class="coluna-d" rel="jogos-derrotas"><div>1</div></td><td class="coluna-gp" rel="gols-pro"><div>17</div></td><td class="coluna-gc" rel="gols-contra"><div>8</div></td><td class="coluna-sg" rel="grafico-saldo"><div>9</div></td><td class="coluna-a" rel="grafico-aproveitamento"><div>70.8</div></td></tr><tr class="linha-classificacao" rel="santos" data="http://s.glbimg.com/es/ge/f/original/2011/05/19/Santos_Futebol_Clube_30.png"><td class="primeira faixa1" rel="grafico-posicao"><div class="">5</div></td><td class="time ">Santos</td><td class="coluna-p" rel="jogos-pontos"><div>15</div></td><td class="coluna-j" rel="jogos-jogos"><div>8</div></td><td class="coluna-v" rel="jogos-vitorias"><div class="">4</div></td><td class="coluna-e" rel="jogos-empates"><div>3</div></td><td class="coluna-d" rel="jogos-derrotas"><div>1</div></td><td class="coluna-gp" rel="gols-pro"><div>17</div></td><td class="coluna-gc" rel="gols-contra"><div>9</div></td><td class="coluna-sg" rel="grafico-saldo"><div>8</div></td><td class="coluna-a" rel="grafico-aproveitamento"><div>62.5</div></td></tr><tr class="linha-classificacao" rel="paulista" data="http://s.glbimg.com/es/ge/f/original/2011/01/04/paulista30.png"><td class="primeira faixa1" rel="grafico-posicao"><div class="">6</div></td><td class="time ">Paulista</td><td class="coluna-p" rel="jogos-pontos"><div>13</div></td><td class="coluna-j" rel="jogos-jogos"><div>8</div></td><td class="coluna-v" rel="jogos-vitorias"><div>4</div></td><td class="coluna-e" rel="jogos-empates"><div>1</div></td><td class="coluna-d" rel="jogos-derrotas"><div>3</div></td><td class="coluna-gp" rel="gols-pro"><div>14</div></td><td class="coluna-gc" rel="gols-contra"><div>10</div></td><td class="coluna-sg" rel="grafico-saldo"><div>4</div></td><td class="coluna-a" rel="grafico-aproveitamento"><div>54.2</div></td></tr><tr class="linha-classificacao" rel="mogi-mirim" data="http://s.glbimg.com/es/ge/f/original/2011/12/20/mogimirim_30.png"><td class="primeira faixa1" rel="grafico-posicao"><div class="">7</div></td><td class="time ">Mogi Mirim</td><td class="coluna-p" rel="jogos-pontos"><div>13</div></td><td class="coluna-j" rel="jogos-jogos"><div>8</div></td><td class="coluna-v" rel="jogos-vitorias"><div class="aprofundamento-div">4</div></td><td class="coluna-e" rel="jogos-empates"><div>1</div></td><td class="coluna-d" rel="jogos-derrotas"><div>3</div></td><td class="coluna-gp" rel="gols-pro"><div>11</div></td><td class="coluna-gc" rel="gols-contra"><div>9</div></td><td class="coluna-sg" rel="grafico-saldo"><div>2</div></td><td class="coluna-a" rel="grafico-aproveitamento"><div>54.2</div></td></tr><tr class="linha-classificacao" rel="ponte-preta" data="http://s.glbimg.com/es/ge/f/original/2011/01/04/ponte_preta_30.png"><td class="primeira faixa1" rel="grafico-posicao"><div class="">8</div></td><td class="time ">Ponte Preta</td><td class="coluna-p" rel="jogos-pontos"><div>12</div></td><td class="coluna-j" rel="jogos-jogos"><div>8</div></td><td class="coluna-v" rel="jogos-vitorias"><div>3</div></td><td class="coluna-e" rel="jogos-empates"><div>3</div></td><td class="coluna-d" rel="jogos-derrotas"><div>2</div></td><td class="coluna-gp" rel="gols-pro"><div>17</div></td><td class="coluna-gc" rel="gols-contra"><div>13</div></td><td class="coluna-sg" rel="grafico-saldo"><div>4</div></td><td class="coluna-a" rel="grafico-aproveitamento"><div>50</div></td></tr><tr class="linha-classificacao" rel="portuguesa" data="http://s.glbimg.com/es/ge/f/original/2011/01/04/portuguesa_sp30.png"><td class="primeira faixanull" rel="grafico-posicao"><div class="">9</div></td><td class="time ">Portuguesa</td><td class="coluna-p" rel="jogos-pontos"><div>12</div></td><td class="coluna-j" rel="jogos-jogos"><div>8</div></td><td class="coluna-v" rel="jogos-vitorias"><div>3</div></td><td class="coluna-e" rel="jogos-empates"><div>3</div></td><td class="coluna-d" rel="jogos-derrotas"><div>2</div></td><td class="coluna-gp" rel="gols-pro"><div>9</div></td><td class="coluna-gc" rel="gols-contra"><div>7</div></td><td class="coluna-sg" rel="grafico-saldo"><div>2</div></td><td class="coluna-a" rel="grafico-aproveitamento"><div>50</div></td></tr><tr class="linha-classificacao" rel="sao-caetano" data="http://s.glbimg.com/es/ge/f/original/2011/01/04/sao_caetano_30.png"><td class="primeira faixanull" rel="grafico-posicao"><div class="">10</div></td><td class="time ">São Caetano</td><td class="coluna-p" rel="jogos-pontos"><div>11</div></td><td class="coluna-j" rel="jogos-jogos"><div>8</div></td><td class="coluna-v" rel="jogos-vitorias"><div>3</div></td><td class="coluna-e" rel="jogos-empates"><div>2</div></td><td class="coluna-d" rel="jogos-derrotas"><div>3</div></td><td class="coluna-gp" rel="gols-pro"><div>10</div></td><td class="coluna-gc" rel="gols-contra"><div>9</div></td><td class="coluna-sg" rel="grafico-saldo"><div>1</div></td><td class="coluna-a" rel="grafico-aproveitamento"><div>45.8</div></td></tr><tr class="linha-classificacao" rel="bragantino" data="http://s.glbimg.com/es/ge/f/original/2011/01/12/Bragantino_30x30.png"><td class="primeira faixanull" rel="grafico-posicao"><div class="">11</div></td><td class="time ">Bragantino</td><td class="coluna-p" rel="jogos-pontos"><div>11</div></td><td class="coluna-j" rel="jogos-jogos"><div>8</div></td><td class="coluna-v" rel="jogos-vitorias"><div>3</div></td><td class="coluna-e" rel="jogos-empates"><div>2</div></td><td class="coluna-d" rel="jogos-derrotas"><div>3</div></td><td class="coluna-gp" rel="gols-pro"><div>14</div></td><td class="coluna-gc" rel="gols-contra"><div>14</div></td><td class="coluna-sg" rel="grafico-saldo"><div>0</div></td><td class="coluna-a" rel="grafico-aproveitamento"><div>45.8</div></td></tr><tr class="linha-classificacao" rel="linense" data="http://s.glbimg.com/es/ge/f/original/2012/01/27/linense-30.png"><td class="primeira faixanull" rel="grafico-posicao"><div class="">12</div></td><td class="time ">Linense</td><td class="coluna-p" rel="jogos-pontos"><div>11</div></td><td class="coluna-j" rel="jogos-jogos"><div>8</div></td><td class="coluna-v" rel="jogos-vitorias"><div>3</div></td><td class="coluna-e" rel="jogos-empates"><div>2</div></td><td class="coluna-d" rel="jogos-derrotas"><div>3</div></td><td class="coluna-gp" rel="gols-pro"><div>16</div></td><td class="coluna-gc" rel="gols-contra"><div>17</div></td><td class="coluna-sg" rel="grafico-saldo"><div>-1</div></td><td class="coluna-a" rel="grafico-aproveitamento"><div>45.8</div></td></tr><tr class="linha-classificacao" rel="mirassol" data="http://s.glbimg.com/es/ge/f/original/2011/12/20/_30.png"><td class="primeira faixanull" rel="grafico-posicao"><div class="">13</div></td><td class="time ">Mirassol</td><td class="coluna-p" rel="jogos-pontos"><div>9</div></td><td class="coluna-j" rel="jogos-jogos"><div>8</div></td><td class="coluna-v" rel="jogos-vitorias"><div>2</div></td><td class="coluna-e" rel="jogos-empates"><div>3</div></td><td class="coluna-d" rel="jogos-derrotas"><div>3</div></td><td class="coluna-gp" rel="gols-pro"><div>14</div></td><td class="coluna-gc" rel="gols-contra"><div>11</div></td><td class="coluna-sg" rel="grafico-saldo"><div>3</div></td><td class="coluna-a" rel="grafico-aproveitamento"><div>37.5</div></td></tr><tr class="linha-classificacao" rel="comercial-sp" data="http://s.glbimg.com/es/ge/f/original/2011/11/08/comercial_sp_30.png"><td class="primeira faixanull" rel="grafico-posicao"><div class="">14</div></td><td class="time ">Comercial-SP</td><td class="coluna-p" rel="jogos-pontos"><div>7</div></td><td class="coluna-j" rel="jogos-jogos"><div>8</div></td><td class="coluna-v" rel="jogos-vitorias"><div>2</div></td><td class="coluna-e" rel="jogos-empates"><div>1</div></td><td class="coluna-d" rel="jogos-derrotas"><div>5</div></td><td class="coluna-gp" rel="gols-pro"><div>9</div></td><td class="coluna-gc" rel="gols-contra"><div>17</div></td><td class="coluna-sg" rel="grafico-saldo"><div>-8</div></td><td class="coluna-a" rel="grafico-aproveitamento"><div>29.2</div></td></tr><tr class="linha-classificacao" rel="oeste" data="http://s.glbimg.com/es/ge/f/original/2011/01/12/Oeste_30x30.png"><td class="primeira faixanull" rel="grafico-posicao"><div class="">15</div></td><td class="time ">Oeste</td><td class="coluna-p" rel="jogos-pontos"><div>7</div></td><td class="coluna-j" rel="jogos-jogos"><div>8</div></td><td class="coluna-v" rel="jogos-vitorias"><div>1</div></td><td class="coluna-e" rel="jogos-empates"><div>4</div></td><td class="coluna-d" rel="jogos-derrotas"><div>3</div></td><td class="coluna-gp" rel="gols-pro"><div>10</div></td><td class="coluna-gc" rel="gols-contra"><div>12</div></td><td class="coluna-sg" rel="grafico-saldo"><div>-2</div></td><td class="coluna-a" rel="grafico-aproveitamento"><div>29.2</div></td></tr><tr class="linha-classificacao" rel="catanduvense" data="http://s.glbimg.com/es/ge/f/original/2011/11/08/catanduvense_30.png"><td class="primeira faixanull" rel="grafico-posicao"><div class="">16</div></td><td class="time ">Catanduvense</td><td class="coluna-p" rel="jogos-pontos"><div>7</div></td><td class="coluna-j" rel="jogos-jogos"><div>8</div></td><td class="coluna-v" rel="jogos-vitorias"><div>1</div></td><td class="coluna-e" rel="jogos-empates"><div>4</div></td><td class="coluna-d" rel="jogos-derrotas"><div>3</div></td><td class="coluna-gp" rel="gols-pro"><div>8</div></td><td class="coluna-gc" rel="gols-contra"><div>11</div></td><td class="coluna-sg" rel="grafico-saldo"><div>-3</div></td><td class="coluna-a" rel="grafico-aproveitamento"><div>29.2</div></td></tr><tr class="linha-classificacao" rel="xv-de-piracicaba" data="http://s.glbimg.com/es/ge/f/original/2012/01/20/XV_de_Piracicaba-SP30.png"><td class="primeira faixaultima" rel="grafico-posicao"><div class="">17</div></td><td class="time ">XV de Piracicaba</td><td class="coluna-p" rel="jogos-pontos"><div>5</div></td><td class="coluna-j" rel="jogos-jogos"><div>8</div></td><td class="coluna-v" rel="jogos-vitorias"><div>1</div></td><td class="coluna-e" rel="jogos-empates"><div>2</div></td><td class="coluna-d" rel="jogos-derrotas"><div>5</div></td><td class="coluna-gp" rel="gols-pro"><div>9</div></td><td class="coluna-gc" rel="gols-contra"><div>14</div></td><td class="coluna-sg" rel="grafico-saldo"><div>-5</div></td><td class="coluna-a" rel="grafico-aproveitamento"><div>20.8</div></td></tr><tr class="linha-classificacao" rel="ituano" data="http://s.glbimg.com/es/ge/f/original/2011/01/12/ituano_30x30.png"><td class="primeira faixaultima" rel="grafico-posicao"><div class="">18</div></td><td class="time ">Ituano</td><td class="coluna-p" rel="jogos-pontos"><div>5</div></td><td class="coluna-j" rel="jogos-jogos"><div>8</div></td><td class="coluna-v" rel="jogos-vitorias"><div>1</div></td><td class="coluna-e" rel="jogos-empates"><div>2</div></td><td class="coluna-d" rel="jogos-derrotas"><div>5</div></td><td class="coluna-gp" rel="gols-pro"><div>7</div></td><td class="coluna-gc" rel="gols-contra"><div>14</div></td><td class="coluna-sg" rel="grafico-saldo"><div>-7</div></td><td class="coluna-a" rel="grafico-aproveitamento"><div>20.8</div></td></tr><tr class="linha-classificacao" rel="guaratingueta" data="http://s.glbimg.com/es/ge/f/original/2011/12/07/Guaratingueta_30.png"><td class="primeira faixaultima" rel="grafico-posicao"><div class="">19</div></td><td class="time ">Guaratinguetá</td><td class="coluna-p" rel="jogos-pontos"><div>3</div></td><td class="coluna-j" rel="jogos-jogos"><div>8</div></td><td class="coluna-v" rel="jogos-vitorias"><div>1</div></td><td class="coluna-e" rel="jogos-empates"><div>0</div></td><td class="coluna-d" rel="jogos-derrotas"><div>7</div></td><td class="coluna-gp" rel="gols-pro"><div>8</div></td><td class="coluna-gc" rel="gols-contra"><div>21</div></td><td class="coluna-sg" rel="grafico-saldo"><div>-13</div></td><td class="coluna-a" rel="grafico-aproveitamento"><div>12.5</div></td></tr><tr class="linha-classificacao" rel="botafogo-sp" data="http://s.glbimg.com/es/ge/f/original/2011/01/04/Botafogo-SP30.png"><td class="primeira faixaultima" rel="grafico-posicao"><div class="">20</div></td><td class="time ">Botafogo-SP</td><td class="coluna-p" rel="jogos-pontos"><div>3</div></td><td class="coluna-j" rel="jogos-jogos"><div>8</div></td><td class="coluna-v" rel="jogos-vitorias"><div>1</div></td><td class="coluna-e" rel="jogos-empates"><div>0</div></td><td class="coluna-d" rel="jogos-derrotas"><div>7</div></td><td class="coluna-gp" rel="gols-pro"><div>5</div></td><td class="coluna-gc" rel="gols-contra"><div>20</div></td><td class="coluna-sg" rel="grafico-saldo"><div>-15</div></td><td class="coluna-a" rel="grafico-aproveitamento"><div>12.5</div></td></tr></tbody></table>
      
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