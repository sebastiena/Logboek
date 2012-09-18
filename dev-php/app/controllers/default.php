<?php

function langchoice() {
	// check for cookie
	if(isset($_COOKIE['lang'])){
		// redirect to lang
		return redirect($_COOKIE['lang'] . '/');
	}
	
	// … OR show choice page
	set('title', 'Kies uw taal | Choissisez votre langue - SD Worx');

  return render('language_choice.html.php', null);
}

function index() {
	// write language cookie
	setcookie('lang', params('lang'), time() + 3600*24*30);	// expires in a month

  $page = "index";

  set('page', $page);
  set('content', _t($page, false)->_t('content', false));

  return html('index.html.php');
}

function pages() {
	// write language cookie
	setcookie('lang', params('lang'), time() + 3600*24*30);	// expires in a month

  $page = params('page');
  $page_id = _get_id_for_slug(Multilang::getInstance()->getLang(), $page);
  
  if($page_id === null) {
    halt(403);
  }

  set('page', $page);
  set('content',	convertURLS( _t($page_id, false)->_t('content', false)));

  return html('index.html.php');
}

function convertURLS($content) {
  $content = str_replace("<LANG>",Multilang::getInstance()->getLang(),$content);
  return $content;
}

function personal_code() {
  $valid = true;

  $code = isset($_POST['code']) ? $_POST['code'] : '';

  if(strlen($code) < 2) { // validate format
    return _t('code', false)->t('error_format');
  } elseif(!code_exists($code)) { // check if code exists
    return _t('code', false)->t('error_format');
  } elseif(!code_available($code)) { // check if code is available and not already used
    return _t('code', false)->t('error_available');
  }

  // we got here, code is valid and unused, mark it
  code_obtained($code);

  // send out email notification to sdworx
  if(option('env') === 'DEVELOPMENT') {
    $config = array(
      'ssl' => 'tls',
      'port' => 587,
      'auth' => 'login',
      'username' => 'ga@proximity.bbdo.be',
      'password' => 'ddt4ever'
    );
    $transport = new Zend_Mail_Transport_Smtp('smtp.gmail.com', $config);
    Zend_Mail::setDefaultTransport($transport);
  }

  // get perso data
  $perso = get_perso_data($code);

  // prepare dynamic values
  $subject = _t('code_mail', false)->t('subject');
  $subject = str_replace('$PERSO$', $perso['perso_naam'], $subject);

  $body_text = _t('code_mail', false)->t('text');
  $body_text = str_replace('$PERSO$', $perso['perso_naam'], $body_text);

  $body_html = _t('code_mail', false)->t('html');
  $body_html = str_replace('$PERSO$', $perso['perso_naam'], $body_html);
  $body_html = str_replace('$PERSO_ADDRESS$', $perso['perso_adres'], $body_html);
  $body_html = str_replace('$PERSO_CITY$', $perso['perso_gemeente'], $body_html);
  $body_html = str_replace('$VAT$', $perso['VAT_number'], $body_html);
  $body_html = str_replace('$ACCOUNT_CONTACT_ID$', $perso['account_contact_ID'], $body_html);

  $mail = new Zend_Mail();
  $mail->setBodyText($body_text);
  $mail->setBodyHtml($body_html);
  $mail->setFrom(_c('mail_from_mail'), _c('mail_from_name'));
  $mail->setReplyTo(_c('mail_reply_mail'), _c('mail_reply_name'));
  $mail->addTo(_c('mail_to_mail'), _c('mail_to_name'));
  $mail->addBcc('jeroen.bourgois@proximity.bbdo.be', 'Jeroen Bourgois');
  $mail->setSubject($subject);
  $mail->send();

	$_SESSION['IS_USED'] = true;

  return;
} 

/**
 * Generic Orphan Pages
 */
function orphanpages() {
  return html('index.html.php', 'layout.html.php');
}

function index_catchall() {
  return html('index.html.php');
}
