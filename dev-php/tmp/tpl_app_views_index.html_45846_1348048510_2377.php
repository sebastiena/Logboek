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
				<h2>Dagen - Overzicht</h2> 
					<?php echo printDays(); ?>	
			</div>
			<hr>
			 <?php 
			 if (isset($selectedDate)){ 
			 	echo "<h3>Timesheet van " . $selectedDate; 
			 	if ($selectedDate == date("d-m-Y")) { echo " (Vandaag)"; }
			 	echo "<a style='float:right;' class='closebtn' href='/Logboek/dev-php/'> Sluit </a>";
			 	echo "<a style='float:right;' class='editbtn' href='/Logboek/dev-php/'> Wijzig </a>";
			 	echo "<a style='float:right;' class='closebtn' onclick='nextday()'> >> </a>";
			 	echo "<a style='float:right;' class='closebtn' onclick='prevday()'> << </a>";

			 	echo "</h3>"; 
			 } 
			 ?>
			<div id="detail">
					<?php 
					if (isset($contentFile))
					echo $contentFile;
					else
					echo "Selecteer een datum...";
					?>
			</div>
		</div>

		<input type="button" class="makebtn" onclick="show()" value="Vandaag"/> 

		<br>

		<div id="footer">
			
			<h2>Vandaag - Aan logboek toevoegen</h2>
			<form method='post' action='new'>
				Datum: <input type="text" name="datum" readonly="readonly" value="<?php echo date("d-m-Y"); ?>" /> <br>
				<textarea name="beschrijving" id="beschrijving"cols="100%" rows="15" tabindex="3"><?php echo getTodaySheet(); ?> </textarea><br>
				<input type="submit" value="Opslaan">
				<input type="button" onclick="save()" value="Afsluiten">

			</form>
		</div>
		
	</div>

</body>
</html>
