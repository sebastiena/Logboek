<nav>
 	<?php  if((Multilang::getInstance()->getLang()) === "nl-BE") : ?>
 	© SD Worx 2012 - <a href="http://www.sdworx.be/nl-BE/Corporate/Footer/Disclaimer">Legal disclaimer</a> - <a href="http://www.sdworx.be/nl-BE/Corporate/Footer/Privacy">Privacy statement</a> - 
  <?php else: ?>
  © SD Worx 2012 - <a href="http://www.sdworx.be/fr-BE/Corporate/Footer/Clause-de-non-responsabilite">Legal disclaimer</a> - <a href="http://www.sdworx.be/fr-BE/Corporate/Footer/Vie-privee">Privacy statement</a> - 
	<?php endif ?>
  <div id="language-switch">
    <?php 
    foreach($languages as $language) {
      if($language['iso'] !== (Multilang::getInstance()->getLang()))
        echo '<a href="' . _translate($language['iso']) . '">' . $language['lang'] . '</a>';
    } 
    ?>
  </div>
</nav>
