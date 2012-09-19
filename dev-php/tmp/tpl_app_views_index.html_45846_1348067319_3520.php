<?php
	if (!(isset($selectedDate)))
	$selectedDate = date("d-m-Y");
?>
<!doctype html>
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<title>Logboek Sebastien</title>
	<link rel="stylesheet" href="assets/css/style.css" /> 	
	<script src="assets/js/libs/modernizr-2.5.3.min.js"></script>
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script>

	function show(){
		$("#footer").animate({ opacity: "1.0" }, 500 );
		pageScroll();
	}
	
	function save(){
		$("#footer").animate({ opacity: "0" }, 1000 );
		clearTimeout(scrolldelay);
	}

	function wijzig(){
		$("#edit").animate({ left: "15%", opacity: "1" }, 100 );
		$("#detail").animate({ opacity: "0" }, 500 );

	}

	function nextday(){
		document.forms['next'].submit();
	}

	function prevday(){
		document.forms['prev'].submit();
	}

	function pageScroll() {
    	window.scrollBy(0,50); // horizontal and vertical scroll increments
    	scrolldelay = setTimeout('pageScroll()',50); // scrolls every 100 milliseconds
    	
	}	
	</script>

</head>
<body>

	<div id="container">
		<div id="header">
			Logboek Sebastien - Proximity BBDO
		</div>
		<div id="content">
			<div id="overzicht">
				<h2>Kalender logboek</h2> 
					<?php echo printDays($selectedDate); ?>	
			</div>
			<br>
			 <?php 
			 if (isset($selectedDate) && isset($contentFile)){ 
			 	echo "<h3>Timesheet van " . $selectedDate; 
			 	if ($selectedDate == date("d-m-Y")) { echo " (Vandaag)"; }
			 	echo "<a style='float:right;' class='tabBtn' title='Sluit deze stylesheet' href='/Logboek/dev-php/'> Sluit </a>";
			 	echo "<a style='float:right;' class='tabBtn' title='Wijzig deze stylesheet' onclick='wijzig()'> Wijzig </a>";
			 	echo "<a style='float:right;' class='tabBtn' onclick='nextday()''> >> </a>";
			 	echo "<a style='float:right;' class='tabBtn' onclick='prevday()'> << </a>";
				echo '<form id="next" method="post" action="detail">';
				echo '<input type="hidden" name="bestandNaam" value="' . getNext($selectedDate) . '"/>';
				echo '</form>';
				echo '<form id="prev" method="post" action="detail">';
				echo '<input type="hidden" name="bestandNaam" value="' . getPrev($selectedDate) . '"/>';
				echo '</form>';
			 	echo "</h3>"; 
			 } 
			 ?>
			<div id="detail">
					<?php 
					if (isset($contentFile))
					echo $contentFile;
					else
					echo "Klik op een datum..."
					?>	
			</div>
			<div id='edit'>
				<form method='post' action='new'>
					 <input type="hidden" name="datum" value="<?php $selectedDate ?>" />
					<textarea name="beschrijving" id="wijzigveld" cols="100%" rows="15">
						<?php echo getTodaySheet($selectedDate); ?> 
					</textarea><BR>
					<input type="submit" value="Wijziging opslaan">

				</form>
			</div>
		</div>
		<a class='makebtn' title='Open stylesheet van vandaag' onclick='show()'> Vandaag </a>

		<br>

		<div id="footer">
			
			<h2>Vandaag - Aan logboek toevoegen</h2>
			<form method='post' action='new'>
				Datum: <input type="text" readonly="readonly" name="datum" value="<?php echo date("d-m-Y"); ?>" /> <br>
				<textarea name="beschrijving" id="wijzigveld" cols="100%" rows="15" tabindex="4">
					<?php echo getTodaySheet(date("d-m-Y")); ?> 
				</textarea><br>
				<input type="submit" value="Opslaan">
				<!--<input type="button" onclick="save()" value="Afsluiten">-->

			</form>
		</div>
		
	</div>

</body>
</html>
