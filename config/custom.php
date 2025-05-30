<?php
// custom.php file return default configuration setting of layouts
return [
  'custom' => [
    'mainLayoutType' => 'vertical-menu-boxicons', //Options:vertical-menu,horizontal-menu,vertical-menu-boxicons, default(vertical-menu)
    'theme' => 'light',  //light(default),dark,semi-dark (note: Horizontal-menu not applicable for semi-dark)
    'isContentSidebar' => false,  // Options: True and false(default) (There are two page layout with content-sidebar and without sidebar)
    'pageHeader' => false, //options:Boolean: false(default), true (Page Header for Breadcrumbs) Warning:if page header true need to define a breadcrumbs in controller
    'bodyCustomClass' => '', //any custom class can be pass
    'navbarBgColor' => 'bg-white', //Options:bg-white(default for vertical-menu),bg-primary(default horizontal-menu), bg-success,bg-danger,bg-info,bg-warning,bg-dark.(Note:color only visible when you scroll down)
    'navbarType' => 'fixed', // options:fixed,static,hidden (note: Horizontal-menu template only support fixed and static)
    'isMenuCollapsed' => false, // options:true or false(default)  Warning:this option is not applicable for horizontal-menu template
    'footerType' => 'static', //options:fixed,static,hidden
    'templateTitle' => 'PEA', //template Title can be changed, default(Frest)
    'isCustomizer' => true, //If True customizer available or false its not available
    'isCardShadow' => true, // Option: true(default) and false ( remove card shadow)
    'isScrollTop' => true, // Option: true and false (Hide Scroll To Top)
    'defaultLanguage' => 'th', //set your default language Options: en(default),pt,th,de
    'direction' => env('MIX_CONTENT_DIRECTION', 'ltr'), // Page direction
  ]
];
