<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="styles/style.css"/>
        <title>Mon super site</title>
    </head>
 
    <body class="body">
 
	<?php 
	include("fonctions.php");
	include("header.php"); 
	?>
    
	<div class="page">
		<div>
			<?php menu(); ?>
		</div>
		
		<div id="affichageJeux">
			<?php
				
				articlesAlea();
			?>
		</div>
	</div>
		
	</div>

    <?php include("footer.php"); ?>
    
    </body>
</html>