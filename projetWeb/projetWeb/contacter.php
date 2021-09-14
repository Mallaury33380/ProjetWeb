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

	//Si il y a un message on l'ajoute dans la table des messages pour l'administrateur
    if(strlen($_POST["Commentaire"])!=0)
    {
       $req = $bdd->prepare("INSERT INTO commentaires(ID_Commentaire,
		Nom_Commentaire, Mail_Commentaire,Commentaire_Commentaire) VALUES (NULL, :nomCommentaire,
		:mailCommentaire,:commentaire)");

		$req->execute(array(
		"nomCommentaire" => $_POST["Nom"],
		"mailCommentaire" => $_POST["Mail"],
		"commentaire" => $_POST["Commentaire"]
        ));
    }
    else
    {
        ?>
		<script>alert("<?php echo htmlspecialchars('Pour nous contacter veuillez laisser un message', ENT_QUOTES); ?>")</script>
		<?php
    }

    include "contact.php";
    
?>