<?php

function db_connection() {
  $db_env = _c('db_' . option('env'));

  if(is_null($db_env))
    $db_env = _c('db');

  $db_settings = array( 'host'      => $db_env['host'], 
    'username'  => $db_env['user'],  
    'password'  => $db_env['password'],  
    'dbname'    => $db_env['db']
  );

  $db = Zend_Db::factory($db_env['adapter'], $db_settings); 

  try {
    $db->getConnection();

    return $db;
  } catch (Zend_Db_Adapter_Exception $e) {
    return NULL;
  }
}

function code_exists($code) {
  $db_env = _c('db_' . option('env'));
  $query = db_connection()->select()->from($db_env['table'])->where('perso_code = ?', $code);
  $result = db_connection()->fetchAll($query);
  return count($result) == 1;
}

function code_available($code) {
  $db_env = _c('db_' . option('env'));
  $query = db_connection()->select()->from($db_env['table'])->where('perso_code = ?', $code)->where('perso_code_used = ?', 0);
  $result = db_connection()->fetchAll($query);
  return count($result) == 1;
}

function code_obtained($code) {
  $db_env = _c('db_' . option('env'));
  $query = db_connection()->update($db_env['table'], array('perso_code_used' => true, 'updated' => new Zend_Db_Expr("NOW()")), 'perso_code = ' . db_connection()->quote($code));
}

function get_perso_data($code) {
  $db_env = _c('db_' . option('env'));
  $query = db_connection()->select()->from($db_env['table'])->where('perso_code = ?', $code);
  $result = db_connection()->fetchAll($query);
  return $result[0];
}

/**
 * Translate the current page to chosen language
 *
 * @param lang
 *
 */
function _translate($lang) {
  # Language Fallback
  if(!isset($lang))
   $lang =  ProximityApp::$settings['multilang']['default'];

  $url_parts = explode('/', request_uri());
  $url_parts[1] = $lang;

  // last url_parts part is the slug, get the 
  // id of that slug, and then get the translated
  // slug
  $id = _get_id_for_slug(_get_other_language($lang), end($url_parts));
  $slug = _get_slug_for_id($lang, $id);

  // replace url_parts (the last part)
  // if we have more than 2 elements (/ lang / )
  if(count($url_parts) > 2) {
    array_pop($url_parts);
    array_push($url_parts, $slug);
  }
  
  return url_for(implode('/', $url_parts));
}

function _get_id_for_slug($lang, $slug) {
  foreach (_t('navigation', $lang, false) as $navitem) {
    if($navitem['slug'] === $slug)
      return $navitem['id'];
  }

  // not found in pages, maybe it's an orphan
  foreach (_t('orphans', $lang, false) as $orphan) {
    if($orphan['slug'] === $slug)
      return $orphan['id'];
  }
}

function _get_slug_for_id($lang, $id) {
  foreach (_t('navigation', $lang, false) as $navitem) {
    if($navitem['id'] === $id)
      return $navitem['slug'];
  }

  // not found in pages, maybe it's an orphan
  foreach (_t('orphans', $lang, false) as $orphan) {
    if($orphan['id'] === $id)
      return $orphan['slug'];
  }
}

function _get_other_language($lang){
	if($lang == 'nl-BE'){
		return 'fr-BE';
	}else{
		return 'nl-BE';
	}
}
