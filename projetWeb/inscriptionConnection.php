<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="styles/style.css"/>
        <title>Mon super site</title>
    </head>
 
    <body class="body">
 
    <?php include("header.php"); ?>
	
	<div style="background:rgb(250,250,250)">
		<div>
			<img id="inscriptionImage" src="images/outils/inscription.png" >
		</div>
		<div>
			
			<form id="inscription" method="post" action="inscription.php">
			<table>	
				<tr>
					<th><label>Nom</label>:</th> <th><input type="text" name="Nom"placeholder="Votre nom" /></th>
				</tr>
				<tr>
					<th><label>Prénom</label> : </th><th><input type="text" name="Prenom"placeholder="Votre prénom" /></th>
				</tr>
				<tr>
					<th><label>Adresse</label> :</th><th> <input type="text" name="Adresse"placeholder="Votre adresse" /></th>
				</tr>
				<tr>
					<th><label>Code postal</label> :</th><th> <input type="text" name="CP"placeholder="Votre code postal" /></th>
				</tr>
				<tr>
					<th><label>Ville</label> :</th><th> <input type="text" name="Ville"placeholder="Votre ville" /></th>
				</tr>
				<tr>
					<th><label>Date de naissance</label> :</th><th> <input type="date" name="DDN"placeholder="Votre date de naissance" min="1900-04-01" max="2019-12-31"/></th>
				</tr>
				<tr>
					<th><label>Pseudo</label> :</th><th> <input type="text" name="Login"placeholder="Votre pseudo" /></th>
				</tr>
				<tr>
					<th><label>Mot de passe</label> :</th><th> <input type="password" name="Password"/></th>
				</tr>
				<tr>
					<th></th><th id=bouttonConnexion><input  type="submit" value="S'inscire" /></th><th></th>
				</tr>	
			</table>			
			</form>
		</div>
		<div id="connexion">
			<a href="connexion.php">Vous avez déjà un compte: Connexion</a>
		</div>
	</div>
	

	</div>

    <?php include("footer.php"); ?>
    
    </body>
</html>