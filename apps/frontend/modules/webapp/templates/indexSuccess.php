<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
    <title>Tabs 2</title>
  <link rel="stylesheet" href="/js/sencha-touch-1.1.0/resources/css/sencha-touch.css" type="text/css">
  <script type="text/javascript" src="/js/sencha-touch-1.1.0/sencha-touch-debug.js"></script>    

  <script type="text/javascript">
  Ext.setup({
      icon: 'icon.png',
      tabletStartupScreen: 'tablet_startup.png',
      phoneStartupScreen: 'phone_startup.png',
      glossOnIcon: false,
      onReady: function() {
          var tabpanel = new Ext.TabPanel({
              tabBar: {
                  dock: 'bottom',
                  layout: {
                      pack: 'center'
                  }
              },
              fullscreen: true,
              ui: 'light',
              cardSwitchAnimation: {
                  type: 'slide',
                  cover: true
              },
              
              defaults: {
                  scroll: 'vertical'
              },
              items: [{
                  title: 'About',
                  html: '<h1>Bottom Tabs</h1><p>Docking tabs to the bottom will automatically change their style. The tabs below are type="light", though the standard type is dark. Badges (like the 4 &amp; Long title below) can be added by setting <code>badgeText</code> when creating a tab/card or by using <code>setBadge()</code> on the tab later.</p>',
                  iconCls: 'info',
                  cls: 'card1'
              }, {
                  title: 'Favorites',
                  html: '<h1>Favorites Card</h1>',
                  iconCls: 'favorites',
                  cls: 'card2',
                  badgeText: '4'
              }, {
                  title: 'Downloads',
                  id: 'tab3',
                  html: '<h1>Downloads Card</h1>',
                  badgeText: 'Text can go here too, but it will be cut off if it is too long.',
                  cls: 'card3',
                  iconCls: 'download'
              }, {
                  title: 'Settings',
                  html: '<h1>Settings Card</h1>',
                  cls: 'card4',
                  iconCls: 'settings'
              }, {
                  title: 'User',
                  html: '<h1>User Card</h1>',
                  cls: 'card5',
                  iconCls: 'user'
              }]
          });
      }
  });
  </script>
  <style type="text/css" media="screen">
     body {
         background-color: #333;
     }
     .x-tabpanel > .x-panel-body .x-panel-body {
         padding: 100px 0;
         text-align: center;
         font-size: 72px;
         font-weight: bold;
         color: rgba(0,0,0,.2);
         text-shadow: rgba(255,255,255,.2) 0 1px 0;
         padding: 100px 15%;
     }
     .x-phone .x-tabpanel > .x-panel-body .x-panel-body {
         padding: 30px 20px;
         font-size: 36px;
     }
     .x-phone p {
         font-size: 16px;
         line-height: 18px;
     }
     h1 {
         font-weight: bold;
     }
     p {
         font-size: 24px;
         line-height: 30px;
     }
     .card1 .x-panel-body {
         background-color: #ccc;
     }
     .card2 .x-panel-body {
         background-color: #5E99CC;
     }
     .card3 .x-panel-body {
         background-color: #759E60;
     }
     .card4 .x-panel-body {
         background-color: #9C744F;
     }
     .card5 .x-panel-body {
         background-color: #926D9C;
     }

  </style>
</head>
<body></body>
</html>