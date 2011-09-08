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
  <script src="/js/jquery-validation/jquery.validate.min.js"></script>
  <script type="text/javascript">
  $(document).ready(function(){
    // validate signup form on keyup and submit
    var validator = $("#signup").validate({
      rules:{
        nickname:{
          required: true,
          minlength: 2
        },
        firstname:{
          required: true,
          minlength: 2
        },
        lastname:{
          required: true,
          minlength: 2
        },
        email:{
          required: true,
          email: true,
        },
        phone:{
          required: true
        },
        team:{
          required: true
        }
      }
    });
  });
  </script>
  <style>
  .portrait label.error, .landscape label.error {
      color: red;
      font-size: 16px;
      font-weight: normal;
      line-height: 1.4;
      margin-top: 0.5em;
      width: 100%;
      float: none;
  }
  
  .landscape label.error { 
      display: inline-block; 
      margin-left: 22%; 
  }
  
  .portrait label.error { 
      margin-left: 0; 
      display: block; 
  }
  
  em { 
      color: red; 
      font-weight: bold; 
      padding-right: .25em; 
  }
  </style>
</head> 
<body> 
  

<div data-role="page" class="type-interior">

  <div data-role="header" data-theme="b">
    <h1>Futebol Clube - Home</h1>
    <a href="<?php echo url_for("/webapp/index")?>" data-icon="home" data-iconpos="notext" data-direction="reverse" class="ui-btn-right jqm-home">Home</a>
  </div>

<!-- <div data-role="page" id="jqm-home" class="type-home"> -->
  
  <div data-role="content">
    
    <div class="ui-body ui-body-b">

      <form method="post" action="<?php echo url_for('@default?module=webapp&action=register&code=verify') ?>" name="signup" id="signup" />

      <h2>Form elements</h2>
      <p>This page contains various progressive-enhancement driven form controls. Native elements are sometimes hidden from view, but their values are maintained so the form can be submitted normally. </p>
      <p>Browsers that don't support the custom controls will still deliver a usable experience, because all are based on native form elements.</p>
      <br />
      <div data-role="fieldcontain">
        <label for="nickname"><em>*</em> Nickname:</label>
        <input type="text" name="nickname" id="nickname" value="" style="width: 25%;" />
      </div>
      <div data-role="fieldcontain">
        <label for="firstname"><em>*</em> First Name:</label>
        <input type="text" name="firstname" id="firstname" value="" />
      </div>
      <div data-role="fieldcontain">
        <label for="lastname"><em>*</em> Last Name:</label>
        <input type="text" name="lastname" id="lastname" value="" />
      </div>
      <div data-role="fieldcontain">
        <label for="email"><em>*</em> Email:</label>
        <input type="text" name="email" id="email" value="" class="required email" />
      </div>
      <div data-role="fieldcontain">
        <label for="phone"><em>*</em> Phone:</label>
        <input type="text" name="phone" id="phone" value="" />
      </div>

      <div data-role="fieldcontain">
        <label for="team" class="select"><em>*</em> Favorite team:</label>
        <select name="team" id="team">
          <option value="">Choose one</option>
          <option value="1">Alabama</option>
          <option value="1">Alaska</option>
          <option value="1">Arizona</option>
          <option value="1">Arkansas</option>
          <option value="1">California</option>
     
          <option value="CO">Colorado</option>
          <option value="CT">Connecticut</option>
          <option value="DE">Delaware</option>
          <option value="FL">Florida</option>
          <option value="GA">Georgia</option>
          <option value="HI">Hawaii</option>
      
          <option value="ID">Idaho</option>
          <option value="IL">Illinois</option>
          <option value="IN">Indiana</option>
          <option value="IA">Iowa</option>
          <option value="KS">Kansas</option>
          <option value="KY">Kentucky</option>
      
          <option value="LA">Louisiana</option>
          <option value="ME">Maine</option>
          <option value="MD">Maryland</option>
          <option value="MA">Massachusetts</option>
          <option value="MI">Michigan</option>
          <option value="MN">Minnesota</option>
      
          <option value="MS">Mississippi</option>
          <option value="MO">Missouri</option>
          <option value="MT">Montana</option>
          <option value="NE">Nebraska</option>
          <option value="NV">Nevada</option>
          <option value="NH">New Hampshire</option>
      
          <option value="NJ">New Jersey</option>
          <option value="NM">New Mexico</option>
          <option value="NY">New York</option>
          <option value="NC">North Carolina</option>
          <option value="ND">North Dakota</option>
          <option value="OH">Ohio</option>
      
          <option value="OK">Oklahoma</option>
          <option value="OR">Oregon</option>
          <option value="PA">Pennsylvania</option>
          <option value="RI">Rhode Island</option>
          <option value="SC">South Carolina</option>
          <option value="SD">South Dakota</option>
      
          <option value="TN">Tennessee</option>
          <option value="TX">Texas</option>
          <option value="UT">Utah</option>
          <option value="VT">Vermont</option>
          <option value="VA">Virginia</option>
          <option value="WA">Washington</option>
      
          <option value="WV">West Virginia</option>
          <option value="WI">Wisconsin</option>
          <option value="WY">Wyoming</option>
        </select>
      </div>

      <div data-role="fieldcontain">
        <label for="slider2">Notifications:</label>
        <select name="slider2" id="slider2" data-role="slider">
          <option value="on">On</option>
          <option value="off">Off</option>
        </select>
      </div>

      <fieldset class="ui-grid-a" style="margin-bottom: 45px; margin-top: 35px;">
        <div class="ui-block-a"><a href="<?php echo url_for("/webapp/index")?>" data-role="button" data-theme="a">Cancel</a></div>
        <div class="ui-block-b"><button type="submit" data-theme="b">Submit</button></div>
      </div>
      
    </form>

    <div data-role="footer" class="footer-docs" data-theme="c">
        <p>&copy; 2011 The jQuery Project</p> 
    </div>  
      
    </div>
    
  </div>

</div> 
</body> 
</html>