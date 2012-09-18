<?php

dispatch('/', 'langchoice');
dispatch('/:lang', 'index');
dispatch_post('/:lang/personal-code', 'personal_code');
dispatch('/:lang/:page', 'pages'); // dispatch all other pages to pages controller. Easy for templating.

dispatch('/**', 'index_catchall'); 

/**
 * Function is called before every route is sent to his handler.
 */
function before_route($route) {
  set('navigation', _t('navigation', false));
  set('code', _t('code',false));
  set('languages', ProximityApp::$settings['multilang']['langs']);
}

/**
 * Function is called before output is sent to browser.
 */
function after_route($output) { return $output; }
