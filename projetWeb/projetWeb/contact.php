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
			<img id="contact" src="images/outils/contact.jpg" >
			<div id="contactez">
				<h1 >Contactez-moi</h1>
			</div>
			<div id="text">
				<p >Vous avez une question sur mon offre. Je vous apporterai une réponse rapide.</p>
			</div>
                
            
            <div>
                <form id="questionnaire" method="post" action="contacter.php">
				    <div>
					    <input class="champquestionnaire" type="text" name="Nom" placeholder="Votre nom" />
				    </div>
				    <div>
					    <input class="champquestionnaire" type="text" name="Mail" placeholder="dupont@dupont.fr"/>
				    </div>
                    <div>
						<textarea class="message" type="textarea" name="Commentaire" placeholder="Message:"></textarea>
				    </div>
				    <div>
					    <input id="submit" type="submit" value="Envoyer" />
				    </div>				
			    </form>
            </div>
		</div>
		
		
	</div>
		
	</div>

    <?php include("footer.php"); ?>
    
    </body>
</html>