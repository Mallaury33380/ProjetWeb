<?php

	//Si le formulaire a bien été rempli
	if(!isset($_POST["Nom"])||!isset($_POST["Prenom"])||!isset($_POST["Adresse"])||!isset($_POST["CP"])||
		!isset($_POST["Ville"])||!isset($_POST["DDN"])||!isset($_POST["Password"]))
	{
		include("inscriptionConnection.php");
		?>
		<script>alert("<?php echo htmlspecialchars('Formulaire incomplet', ENT_QUOTES); ?>")</script>
		<?php
	}
	//et le mot de passe est assez long
	else if(strlen($_POST["Password"])<10)
	{
		include("inscriptionConnection.php");
		?>
		<script>alert("<?php echo htmlspecialchars('Mot de passe trop court', ENT_QUOTES); ?>")</script>
		<?php
	}
	else
	{
		//Tentative de connection à la BDD
		try
		{
			$bdd = new PDO(
			'mysql:host=localhost;dbname=perezlacoste;charset=utf8',
			'root',
			'',
			array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
			);
		}
		catch (Exception $e)
		{
			die($e->getMessage());
		}
		
		//On teste si le pseudo est déjà utilisé
		$req=$bdd->prepare("SELECT * FROM Clients WHERE Login_Client=:login");
		$req->execute(array("login" => $_POST["Login"]));

	
		$donnees = $req->fetch();
		if($donnees)
		{
			include("inscriptionConnection.php");
			?>
			<script>alert("<?php echo htmlspecialchars('Ce Pseudo est déjà utilisé', ENT_QUOTES); ?>")</script>
			<?php
		}
		//Sinon on crée le profil
		else
		{
			$sel = '';
 			$listeCar = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 			$max = strlen($listeCar);
			for ($i = 0; $i < 10; ++$i)
			{
				$sel .= $listeCar[random_int(0, $max)];
 			}
			$empreinte = hash("sha256", $_POST["Password"].$sel);
		
			$result=$bdd->prepare("INSERT INTO clients(ID_Client,Nom_Client,Prenom_Client,Adresse_Client,CP_Client,Ville_Client,DDN_Client,Login_Client,Empreinte_Client,Sel_Client)
			VALUES (NULL,:nom,:prenom,:adresse,:cp,:ville,:ddn,:login,:empreinte,:sel)");
		
			$result->execute(array(
			"nom" => $_POST["Nom"],
			"prenom" => $_POST["Prenom"],
			"adresse" => $_POST["Adresse"],
			"cp" => $_POST["CP"],
			"ville" => $_POST["Ville"],
			"ddn" => $_POST["DDN"],
			"login" => $_POST["Login"],
			"empreinte" => $empreinte,
			"sel" => $sel
			));

			session_start();
			$_SESSION["login"]=$_POST["Login"];
			include("monCompte.php");
		}
	}
?>