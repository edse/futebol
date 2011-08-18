<!DOCTYPE html> 
<html> 
<head> 
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <title>jQuery Mobile: Demos and Documentation</title> 
  <link rel="stylesheet"  href="/js/jquery.mobile/jquery.mobile-1.0b2.min.css" /> 
  <link rel="stylesheet" href="/css/webapp.css" /> 
  <script src="/js/jquery-1.6.2.min.js"></script> 
  <script src="/js/webapp.js"></script> 
  <script src="/js/jquery.mobile/jquery.mobile-1.0b2.min.js"></script>
</head> 
<body> 
  
<div data-role="page" id="jqm-home" class="type-home"> 
  <div data-role="content"> 
    <div class="content-secondary">
      <div id="jqm-homeheader"> 
        <h1 id="jqm-logo"><img src="docs/_assets/images/jquery-logo.png" alt="jQuery Mobile Framework" /></h1> 
        <p>A Touch-Optimized Web Framework for Smartphones &amp; Tablets</p> 
        <p id="jqm-version">Beta Release</p> 
      </div> 
  
      <p class="intro"><strong>Welcome.</strong> Browse the jQuery Mobile components and learn how to make rich, accessible, touch-friendly websites and apps.</p> 
      
      <ul data-role="listview" data-inset="true" data-theme="c" data-dividertheme="f"> 
        <li data-role="list-divider">Overview</li> 
        <li><a href="docs/about/intro.html">Intro to jQuery Mobile</a></li> 
        <li><a href="docs/about/features.html">Features</a></li> 
        <li><a href="docs/about/accessibility.html">Accessibility</a></li> 
        <li><a href="docs/about/platforms.html">Supported platforms</a></li> 
      </ul> 
      
    <div class="ui-body ui-body-b"> 
 
      <div data-role="fieldcontain"> 
           <label for="name-b">Text Input:</label> 
           <input type="text" name="name" id="name-b" value=""  /> 
      </div> 
 
      <div data-role="fieldcontain"> 
        <label for="switch-b">Flip switch:</label> 
        <select name="switch-b" id="switch-b" data-role="slider"> 
          <option value="off">Off</option> 
          <option value="on">On</option> 
        </select> 
      </div> 
 
      <div data-role="fieldcontain"> 
        <label for="slider-b">Slider:</label> 
        <input type="range" name="slider" id="slider-b" value="0" min="0" max="100"  /> 
      </div> 
 
 
      <div data-role="fieldcontain"> 
      <fieldset data-role="controlgroup" data-type="horizontal"> 
          <legend>Font styling:</legend> 
          <input type="checkbox" name="checkbox-6b" id="checkbox-6b" class="custom" /> 
        <label for="checkbox-6b">b</label> 
 
        <input type="checkbox" name="checkbox-7b" id="checkbox-7b" class="custom" /> 
        <label for="checkbox-7b"><em>i</em></label> 
 
        <input type="checkbox" name="checkbox-8b" id="checkbox-8b" class="custom" /> 
        <label for="checkbox-8b">u</label>    
        </fieldset> 
      </div> 
 
      <div data-role="fieldcontain"> 
          <fieldset data-role="controlgroup"> 
            <legend>Choose a pet:</legend> 
                <input type="radio" name="radio-choice-1" id="radio-choice-1b" value="choice-1" /> 
                <label for="radio-choice-1b">Cat</label> 
 
                <input type="radio" name="radio-choice-1" id="radio-choice-2b" value="choice-2"  /> 
                <label for="radio-choice-2b">Dog</label> 
 
                <input type="radio" name="radio-choice-1" id="radio-choice-3b" value="choice-3"  /> 
                <label for="radio-choice-3b">Hamster</label> 
 
                <input type="radio" name="radio-choice-1" id="radio-choice-4b" value="choice-4"  /> 
                <label for="radio-choice-4b">Lizard</label> 
          </fieldset> 
      </div> 
 
      <div data-role="fieldcontain"> 
        <label for="select-choice-b" class="select">Choose shipping method:</label> 
        <select name="select-choice-b" id="select-choice-b"> 
          <option value="standard">Standard: 7 day</option> 
          <option value="rush">Rush: 3 days</option> 
          <option value="express">Express: next day</option> 
          <option value="overnight">Overnight</option> 
        </select> 
      </div> 
 
      
      </div><!-- /body-b --> 
 

      
    </div><!--/content-primary--> 
    
    <div class="content-primary"> 
      <nav> 
        
        <ul data-role="listview" data-inset="true" data-theme="c" data-dividertheme="b"> 
          <li data-role="list-divider">Components</li> 
          <li><a href="docs/pages/index.html">Pages &amp; dialogs</a></li> 
          <li><a href="docs/toolbars/index.html">Toolbars</a></li> 
          <li><a href="docs/buttons/index.html">Buttons</a></li> 
          <li><a href="docs/content/index.html">Content formatting</a></li> 
          <li><a href="docs/forms/index.html">Form elements</a></li> 
          <li><a href="docs/lists/index.html">List views</a></li> 
          
          <li data-role="list-divider">API</li> 
          <li><a href="docs/api/globalconfig.html">Configuring defaults</a></li> 
          <li><a href="docs/api/events.html">Events</a></li> 
          <li><a href="docs/api/methods.html">Methods &amp; Utilities</a></li> 
          <li><a href="docs/api/mediahelpers.html">Responsive Layout</a></li> 
          <li><a href="docs/api/themes.html">Theme framework</a></li> 
    
        
        </ul> 
      </nav> 
    </div> 
 
    
 
  </div> 
  
  <div data-role="footer" class="nav-glyphish-example"> 
    <div data-role="navbar" data-grid="d" data-theme="e" class="nav-glyphish-example"> 
      <ul> 
        <li><a href="#" id="chat" data-icon="custom" data-theme="b">Chat</a></li> 
        <li><a href="#" id="email" data-icon="custom" data-theme="b">Email</a></li> 
        <li><a href="#" id="skull" data-icon="custom" data-theme="b">Danger</a></li> 
        <li><a href="#" id="beer" data-icon="custom" data-theme="b">Beer</a></li> 
        <li><a href="#" id="coffee" data-icon="custom" data-theme="b">Coffee</a></li> 
      </ul> 
    </div> 
  </div> 

  <div data-role="footer" class="footer-docs" data-theme="c"> 
      <p>&copy; 2011 The jQuery Project</p> 
  </div>  
  
</div> 
</body> 
</html> 