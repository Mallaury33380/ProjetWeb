<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="styles/style.css"/>
    </head>
 
    <body class="body">
 
	<?php include("header.php"); ?>
		
    
	<div class="page">
		<form id="inscription" method="post" action="authentification.php">
			<table id=identifiants>
				<tr>
					<th><label>Pseudo</label> : </th><th><input type="text" name="Login"placeholder="Votre pseudo" /></th>
				</tr>
				<tr>
					<th><label>Mot de passe</label> :</th><th> <input type="password" name="Password"/></th>
				</tr>
				<tr>
					<th></th><th id=bouttonConnexion><input  type="submit" value="Se connecter" /></th>
				</tr>			
			</table>	
		</form>
		
	</div>
		
	</div>

    <?php include("footer.php"); ?>
    
    </body>
</html>