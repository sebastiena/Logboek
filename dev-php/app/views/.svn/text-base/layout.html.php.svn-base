<!doctype html>
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title><?php echo _t('common', false)->t('title'); ?></title>
  <meta name="description" content="SD Worx - Result driven HR" />
  <meta name="author" content="SD Worx - Result driven HR" />

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1" />

  <link rel="shortcut icon" href="<?php echo $base_path; ?>assets/img/favicon.png" />
  <link rel="apple-touch-icon" href="<?php echo $base_path; ?>assets/img/apple-touch-icon.png" />

  <link rel="stylesheet" href="<?php echo $base_path; ?>assets/css/style.css" /> 	

  <script src="<?php echo $base_path; ?>assets/js/libs/modernizr-2.5.3.min.js"></script>
</head>
<body>
  <div id="leftcolumn">

    <nav class="desktop">
      <a id="logo" href="<?php echo url_for($lang); ?>"><img src="<?php echo $base_path; ?>assets/img/logo.jpg"/></a>
      <ul>
        <?php foreach($navigation as $nav_item) : ?>
          <li><a href="<?php echo url_for($lang . '/'. $nav_item['slug']); ?>" class="<?php echo _get_active($nav_item['slug']); ?>"><?php echo $nav_item['name']; ?></a></li>
        <?php endforeach; ?>
      </ul>
      <a class="btncode" href="#personal-code"><?php echo $code["aanvraag"] ?></a>
    </nav>

    <nav class="mobile">
      <a id="logo" href="<?php echo url_for($lang); ?>"><img src="<?php echo $base_path; ?>assets/img/logo.jpg"/></a>
      <form action="<?php echo(url_for('/navigate_to/')); ?>" method="post">
        <select name="url" id="mobile_navigation_select" class="mobile_navigation_select">
        <?php foreach($navigation as $nav_item) : ?>
          <option <?php if(_get_active($nav_item['slug'])) { echo('selected'); }; ?> value="<?php echo url_for($lang . '/'. $nav_item['slug']); ?>"><?php echo $nav_item['name']; ?></option>
        <?php endforeach; ?>
        </select>
      </form>
      <a class="btncode" href="#personal-code"><?php echo $code["aanvraag"] ?></a>
    </nav>

    <footer class="desktop">
      <?php echo partial('_footer.html.php'); ?>
    </footer>
  </div>

  <div id="rightcolumn">
    <div id="content-wrapper">
      <article id="content">
        <header>
          <h1>HR On Site</h1>
        </header>
      <?php echo($content); ?>
      </article>
      <aside id="personal-code">
        <section>
          <h1><?php echo $code["title"] ?></h1>
          <img class="visual" src="<?php echo _asset("assets/img/visual_box_".$lang.".png"); ?>"/>
          <p><?php echo $code["copy"] ?></p>
          
          <?php if(!isset($_SESSION['IS_USED'])) : ?>
          <div class="form-collapse">
            <h2><?php echo $code["subtitle"] ?></h2>
            <p id="loader"><img src="<?php echo $base_path; ?>assets/img/ajax-loader.gif" alt="Loading" /></p>
            <p id="error"><?php if(isset($error)) echo $error; ?></p>
            <form method="POST" action="<?php echo url_for($lang . "/personal-code"); ?>">
              <input name="code" type="text" value="<?php if(isset($personal_code)) echo $personal_code; ?>" placeholder="<?php echo $code["placeholder"] ?>"/>
              <input type="submit" value="<?php echo $code["btn"] ?>"/>
            </form>
            <p class="small"><?php echo $code["small"] ?></p>
          </div>
          <?php endif; ?>
          <div id="thanks" <?php if(isset($_SESSION['IS_USED'])) echo('class="show"'); ?>>
          	<h1><?php echo $code["thanks"] ?></h1>
            <p><?php echo $code["thanksCopy"] ?></p>
          </div>
        </section>
        <footer class="mobile">
          <?php echo partial('_footer.html.php'); ?>
        </footer>
      </aside>
    </div>
  </div>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="<?php echo $base_path; ?>assets/js/libs/jquery-1.7.2.min.js"><\/script>')</script>

  <!--[if (gte IE 6)&(lte IE 8)]><script src="<?php echo $base_path; ?>assets/js/libs/selectivizr.js"></script><![endif]-->	
  <script src="<?php echo $base_path; ?>assets/js/libs/jquery.columnizer.min.js"></script>
  <script src="<?php echo $base_path; ?>assets/js/libs/jquery.scrollTo-1.4.2-min.js"></script>
  <script src="<?php echo $base_path; ?>assets/js/libs/jquery.localscroll-1.2.7-min.js"></script>
  <script src="<?php echo $base_path; ?>assets/js/libs/jquery.easing.1.3.js"></script>
	<script src="<?php echo $base_path; ?>assets/js/tracking.js"></script>
	<script src="<?php echo $base_path; ?>assets/js/base.js"></script>

  <script>
  var _gaq=[['_setAccount','UA-8065822-9'], ['_trackPageview']];
  (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
  g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
  s.parentNode.insertBefore(g,s)}(document,'script'));
  </script>
  <noscript>Your browser does not support JavaScript!</noscript> 
</body>
</html>
