<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="styles/style.css"/>
    </head>
 
    <body class="body">
 
    <?php 
    include("fonctions.php");
    include("header.php"); ?>
    
	<div class="page">
		<div>
			<?php menu(); ?>
        </div>

        <div>
            <div id="filtre">
                <?php
                    
                    filtre();
		        ?>
            </div>

            <div>
                <?php
                    tri();
		        ?>
            </div>

            <div id="pageCategorie">
                <?php
                    afficherCategorie();
		        ?>
            </div>  
            
        </div>
        
		
		
	</div>
		
	</div>

    <?php include("footer.php"); ?>
    
    </body>
</html>