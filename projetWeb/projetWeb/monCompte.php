<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="styles/style.css"/>
        <title>Mon compte</title>
    </head>
 
    <body class="body">
 
    <?php 
		include("header.php");
		include("fonctions.php");
	?>
    
	<div class="page">
		
		
		<div style="width:100%">
			<div>
				<?php
					pageCompte();
				?>
			</div>
			<form id="inscription" method="post" action="deconnection.php">
				<div id="deconnecter">
					<input  type="submit" value="Se déconnecter" />
				</div>				
			</form>
		</div>
		
		
		
		
	</div>
		
	</div>

    <?php include("footer.php"); ?>
    
    </body>
</html>