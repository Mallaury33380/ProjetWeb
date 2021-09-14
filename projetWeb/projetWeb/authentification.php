<?php
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
	
	//On récupère les données associées à un compte
	$req = $bdd->prepare("SELECT * FROM Clients WHERE Login_Client=:pseudo");
	$req->execute(array("pseudo" => $_POST["Login"]));

	//On réalise l'authentification de l'utilisateur
	if ($donnees = $req->fetch()){
	$sel = $donnees["Sel_Client"];
	$empreinte = hash("sha256", $_POST["Password"].$sel);
	
		if ($donnees["Empreinte_Client"]==$empreinte)
		{
			session_start();
			$_SESSION["login"]=$_POST["Login"];
			include("monCompte.php");
			?>
			<script>alert("<?php echo htmlspecialchars('Authentification réussie !', ENT_QUOTES); ?>")</script>;
			<?php
		}
		else
		{
			include("connection.php");
			?>
			<script>alert("<?php echo htmlspecialchars('Mauvais mot de passe !', ENT_QUOTES); ?>")</script>;
			<?php
		}
	}
	else
	{
		include("connection.php");
		?>
		<script>alert("<?php echo htmlspecialchars('Utilisateur inconnu !', ENT_QUOTES); ?>")</script>;
		<?php
	}
?>