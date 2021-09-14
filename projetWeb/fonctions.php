<?php

function afficherArticle()
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

	//On sélectionne toutes les données en rapport avec le produit
	$req=$bdd->prepare("SELECT * FROM Produits WHERE ID_Produit=:id");
	$req->execute(array("id" => $_GET["ID"]));
	$donnees = $req->fetch();
	
	//On affiche le produit
	echo "<div id=jeu>";

	echo "<div id=ajoutPanier>";
	echo "<img  src=".$donnees["Image_Produit"].">";
	echo "</div>";
	echo "<div id=nombreProduits>";
		nombrePanier();
	echo "</div>";

	echo "<div>";
	echo "<p>".$donnees["Description_Produit"]."</p>";
	echo "</div>";

	echo "<div>";
	echo "<p>".$donnees["Prix_Produit"]." €</p>";
	echo "</div>";


	echo "</div>";
}

function afficherCategorie()
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

	//Requete en fonctions des filtres et tri
	$req=0;
	if(isset($_GET["PRIX"]))
	{
		if($_GET["PRIX"])
		{
			$req=$bdd->prepare("SELECT * FROM Produits WHERE ID_Categorie=:id ORDER BY Prix_Produit DESC");
			$req->execute(array("id" => $_GET["ID"]));
		}
		else
		{
			$req=$bdd->prepare("SELECT * FROM Produits WHERE ID_Categorie=:id ORDER BY Prix_Produit");
			$req->execute(array("id" => $_GET["ID"]));
		}
	}
	else if(isset($_GET["NOM"]))
	{
		if($_GET["NOM"])
		{
			$req=$bdd->prepare("SELECT * FROM Produits WHERE ID_Categorie=:id ORDER BY Nom_Produit DESC");
			$req->execute(array("id" => $_GET["ID"]));
		}
		else
		{
			$req=$bdd->prepare("SELECT * FROM Produits WHERE ID_Categorie=:id ORDER BY Nom_Produit");
			$req->execute(array("id" => $_GET["ID"]));
		}
	}
	else if(isset($_GET["DATE"]))
	{
		if($_GET["DATE"])
		{
			$req=$bdd->prepare("SELECT * FROM Produits WHERE ID_Categorie=:id ORDER BY Prix_Produit DESC");
			$req->execute(array("id" => $_GET["ID"]));
		}
		else
		{
			$req=$bdd->prepare("SELECT * FROM Produits WHERE ID_Categorie=:id ORDER BY Prix_Produit");
			$req->execute(array("id" => $_GET["ID"]));
		}
	}
	else if(isset($_GET["NOTE"]))
	{
		if($_GET["NOTE"])
		{
			$req=$bdd->prepare("SELECT p.* FROM produits as p JOIN notes as n ON n.ID_Note=p.ID_Produit GROUP BY p.ID_Produit ORDER BY sum(n.Valeur_Note)/COUNT(n.ID_Produit)");
			$req->execute(array("id" => $_GET["ID"]));
		}
		else
		{
			$req=$bdd->prepare("SELECT p.* FROM produits as p JOIN notes as n ON n.ID_Note=p.ID_Produit GROUP BY p.ID_Produit ORDER BY sum(n.Valeur_Note)/COUNT(n.ID_Produit) DESC");
			$req->execute(array("id" => $_GET["ID"]));
		}
	}
	else
	{
		$req=$bdd->prepare("SELECT * FROM Produits WHERE ID_Categorie=:id");
		$req->execute(array("id" => $_GET["ID"]));
	}



	//Affichage des produits
	//Nombre de produit selon categorie fltre et ordre
	$nombre=$req->rowCount();
	

	//Calclul page actuel
    $numPage=1;
    if(isset($_GET["valeur"]) && isset($_GET["page"]))
    {
		if($_GET["page"]=="suivante" )
		{
			$numPage=$_GET["valeur"]+1;
		}
		if($_GET["page"]=="precedente")
		{
			$numPage=$_GET["valeur"]-1;
		}
		
    }

	//Determine le nombre d'articles à afficher par page
	$nombreParPage=5;
	if(isset($_GET["nombreParPage"]))
	{
		$nombreParPage=$_GET["nombreParPage"];
	}
	
	

	$numero =1;
	//Affichage des produits
	if(!isset($_GET["grille"]))
	{
		while($produit=$req->fetch())
		{
			if($numero>($numPage-1)*$nombreParPage && $numero<=$numPage*$nombreParPage)
			{
				if(applicationFiltres($produit))
				{
					echo "<div class=jeux >";
						echo "<a href=jeu.php?ID=".$produit["ID_Produit"].">";
							echo "<img width=250px heigh=374px src=".$produit["Image_Produit"].">";
						echo "</a>";
				echo "</div>";
				}
			}
			$numero++;		
		}
	}
	else
	{
		//Lit toutes des lignes disponibles et affiche  les articles
		while($produit=$req->fetch())
		{
			echo "<div style=display:flex>";
			if($numero>($numPage-1)*$nombreParPage && $numero<=$numPage*$nombreParPage)
			{
				if(applicationFiltres($produit))
				{
					echo "<div class=jeuxGrille >";
						echo "<a href=jeu.php?ID=".$produit["ID_Produit"].">";
							echo "<img width=250px heigh=374px src=".$produit["Image_Produit"].">";
						echo "</a>";
				echo "</div>";
				}
			}
			$numero++;

			if($produit=$req->fetch())
			{
				if(applicationFiltres($produit))
				{
					echo "<div class=jeuxGrille >";
						echo "<a href=jeu.php?ID=".$produit["ID_Produit"].">";
							echo "<img width=250px heigh=374px src=".$produit["Image_Produit"].">";
						echo "</a>";
				echo "</div>";
				}
				$numero++;
			}

			echo "</div>";
		}
	}
	



	//Gestion des pages et du nombre d'articles par page
	echo "<form id=gestionPage  method=get action=categorie.php?ID=".$_GET["ID"]." enctype=multipart/form-data >";
		echo "<div >";
		echo "<div>";
			echo "<input type=number style=display:none  name=ID value=".$_GET["ID"]." />";
		echo "</div>";
		if($numPage!=1)
		{
			echo "<div>";
				echo "<input type=submit name=page value=precedente >";
			echo "</div>";
		}
		else
		{
			echo "<div>";
				echo "<input type=submit value=precedente disabled=disabled >";
			echo "</div>";
		}	
		echo "<div>";
			echo "<input type=number name=valeur value=".$numPage." min=".$numPage." max=".$numPage." />";
		echo "</div>";
		if(($nombre-$numPage*$nombreParPage)>0)
		{
			echo "<div>";
				echo "<input type=submit name=page value=suivante >";
			echo "</div>";
		}
		else
		{
			echo "<div>";
				echo "<input type=submit value=suivante disabled=disabled >";
			echo "</div>";
		}
		echo "</div>";
		echo "<div>";
		if(isset($_GET["nombreParPage"]))
		{
			echo "<div>";
				echo "<input type=number name=nombreParPage value=".$_GET["nombreParPage"]." min=1 max=50 />";
			echo "</div>";
		}
		else
		{
			echo "<div>";
				echo "<label>Nombre: </label> <input type=number name=nombreParPage value=".$nombreParPage." min=1 max=50 />";
			echo "</div>";
		}
		echo "<div>";
			echo "<input type=submit value=Afficher>";
		echo "</div>";
		echo "</div>";
	echo "</form>";


}

function affichagePanier()
{
	if(isset($_SESSION["Panier"]))
    {
        if(isset($_SESSION["Panier"]["ID"]))
        {
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
                    
            $req=$bdd->prepare("SELECT * FROM Produits WHERE ID_Produit=:id");
            echo "<div id=articlePanier>";
                    
            //Supprimer éléments
            if(isset($_GET["ID"]))
            {
                unset($_SESSION["Panier"]["ID"][$_GET["ID"]]);
                unset($_SESSION["Panier"]["Nombre"][$_GET["ID"]]);

                $_SESSION["Panier"]["ID"]=array_values($_SESSION["Panier"]["ID"]);
                $_SESSION["Panier"]["Nombre"]=array_values($_SESSION["Panier"]["Nombre"]);

            }
						
			$i=0;
			while($i<sizeof($_SESSION["Panier"]["ID"]))
			{
				echo "<div style=display:flex>";
					$req->execute(array("id" => $_SESSION["Panier"]["ID"][$i]));
                	$donnees = $req->fetch();
                    	echo "<div class=article>";
                        	echo "<img src=".$donnees["Image_Produit"].">";
                        	echo "<div style=display:flex>";
                            	echo "<p>Nombre:".$_SESSION["Panier"]["Nombre"][$i]."</p>";

                            	echo "<form method=get action=panier.php>";
                                	echo "<input style=display:none  type=number name=ID value=".$i.">";
                                	echo "<input type=submit value=Supprimer du panier />";
                            	echo "</form>";
                                    

                        	echo "</div>";
						echo "</div>";
					$i++;
					if($i<sizeof($_SESSION["Panier"]["ID"]))
					{
						$req->execute(array("id" => $_SESSION["Panier"]["ID"][$i]));
                    	$donnees = $req->fetch();
                		echo "<div class=article>";
                        	echo "<img src=".$donnees["Image_Produit"].">";
                       		echo "<div style=display:flex>";
                            	echo "<p>Nombre:".$_SESSION["Panier"]["Nombre"][$i]."</p>";

                            	echo "<form id=supprimer method=get action=panier.php>";
                                	echo "<input style=display:none  type=number name=ID value=".$i.">";
                                	echo "<input type=submit value=Supprimer du panier />";
                            	echo "</form>";
                        	echo "</div>";
						echo "</div>";
					}
					$i++;
				echo "</div>";
			}
			echo "</div>";
						
        }
	}
	$total=0;
	if(isset($_SESSION["Panier"]["ID"]))
    {
        $total=0;
        $req=$bdd->prepare("SELECT Prix_Produit FROM Produits WHERE ID_Produit=:id");                   
        for($i=0;$i<sizeof($_SESSION["Panier"]["ID"]);$i++)
        {
            $req->execute(array("id" => $_SESSION["Panier"]["ID"][$i]));
            $donnees = $req->fetch();
            $total=$total+$donnees["Prix_Produit"]*$_SESSION["Panier"]["Nombre"][$i];
        }
	}
	echo "<div id=validationPanier>";
		echo "<form style=display:flex method=get action=validationPanier.php>";
			echo "<input type=number name=Total value=".$total." min=".$total." max=".$total." />";
			echo "€";
            echo "<input type=submit value=Valider le panier />";
        echo "</form>";
    echo "</div>";
}

function applicationFiltres($article)
{
	//Si les caractéristiques du filtre ne s'accorde pas avec l'article passé en paramètre
	// on renvoie 0 et l'article ne sera pas affiché
	if($_POST["PrixMin"]>$article["Prix_Produit"])
	{
		return 0;
	}
	if($_POST["PrixMax"]!=0 && $_POST["PrixMax"]<$article["Prix_Produit"])
	{
		return 0;
	}
	if($_POST["AnneeMin"]>$article["Date_Produit"])
	{
		return 0;
	}
	if($_POST["AnneeMax"]!=0 && $_POST["AnneeMax"]<$article["Date_Produit"])
	{
		return 0;
	}

	//On essaie de se connecter à la BDD
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
	//On récupère les notes liées au produit
	$req=$bdd->prepare("SELECT Valeur_Note FROM `Notes` WHERE ID_Produit=:id");
	$req->execute(array("id" => $article["ID_Produit"]));
	//On calcule sa moyenne et on réalise le filtre sur les notes
	$valeur=0;
	$nbNote=0;
	while($donnees = $req->fetch())
	{
		$valeur=$valeur+$donnees["Valeur_Note"];
		$nbNote=$nbNote+1;
	}
	if($nbNote!=0)
	{
		$valeur=$valeur/$nbNote;
	}
	
	if($_POST["NoteMin"]>$valeur)
	{
		return 0;
	}
	
	//Sinon on renvoie 1 l'article est affiché
	return 1;
}

function articlesAlea()
{
	//Affichge du tritre de la page
	echo "<div id=contactez>";
		echo" <h1 >Nous vous proposons:</h1>";
	echo "</div>";
	
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

	//On récupère le nombre d'articles
	$req=$bdd->prepare("SELECT COUNT(*) AS nb FROM produits");
	$req->execute();
	$nb = $req->fetchColumn();

	//On tire 1 par 1 5 articles différents et on les affiche
	$tableau=array();
	for($i=0;$i<5;$i++)
	{
		$idProduit= rand(1,$nb);

		if(!in_array($idProduit,$tableau))
		{
			$tableau[]=$idProduit;
		
			$req=$bdd->prepare("SELECT * FROM Produits WHERE ID_Produit=:idProduit");
			$req->execute(array("idProduit" => $idProduit));
			$donnees = $req->fetch();
				
			echo "<div class=jeux>";
			echo "<a href=jeu.php?ID=".$donnees["ID_Produit"].">";
			echo "<img  src=".$donnees["Image_Produit"].">";
			echo "</a>";
			echo "</div>";
	
		}		
	}

}

function commentaires()
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
	
	

	//Affichage de la note et des commentaires
	echo "<div id=commentaire>";
	//Note
	$moyenne=0;

	$req=$bdd->prepare("SELECT SUM(Valeur_Note) AS somme FROM notes WHERE ID_Produit=:id");
	$req->execute(array("id" => $_GET["ID"]));
	$somme = $req->fetch();

	$nombre=0;
	if($somme["somme"])
	{
		$req=$bdd->prepare("SELECT COUNT(Valeur_Note) AS nombre FROM notes WHERE ID_Produit=:id");
		$req->execute(array("id" => $_GET["ID"]));
		$nombre = $req->fetch();
		$moyenne=round($somme["somme"]/$nombre["nombre"],1);
	}

	if($nombre["nombre"]==0)
	{
		echo "<div>";
			echo "<p>Note: Aucune note n'a encore été donnée pour ce produit";
		echo "</div>";
	}
	else
	{
		echo "<div>";
			echo "<p>Note: ".$moyenne;
		echo "</div>";
	}
	
	

	//Commentaires
	$req=$bdd->prepare("SELECT n.Commentaire_Note, c.Nom_Client FROM notes AS n JOIN clients AS C ON c.ID_Client=n.ID_Client WHERE n.ID_Produit=:id");
	$req->execute(array("id" => $_GET["ID"]));
	
	echo "<div>";
	while($commentaire = $req->fetch())
	{
		echo "<p>".$commentaire["Nom_Client"].": ".$commentaire["Commentaire_Note"]."</p>";
	}
	echo "</div>";


	//Ajouter un commentaire
	//Si la page n'a pas servi a ajouté un article
	if(!isset($_GET["Nombre"]))
	{
		if(!isset($_GET["notation"]) || !isset($_GET["commentaire"]))
		{
			session_start();
		}
	}
	
	$achete=0;
	echo "<div>";
	if(!isset($_SESSION["login"]))
	{
		echo "<p>Connectez-vous pour pouvoir laisser un commentaire</p>";
	}
	else
	{
		//A t'il acheté le jeu
		$req=$bdd->prepare("SELECT COUNT(*) AS achete FROM clients AS c JOIN commandes AS co ON co.ID_Client=c.ID_Client 
		JOIN detailscommandes AS d ON d.ID_Commande=co.ID_Commande WHERE d.ID_Produit=:ID_Produit AND c.Login_Client=:Login_Client");
		$req->execute(array("ID_Produit" => $_GET["ID"],
							"Login_Client" => $_SESSION["login"]
							));
		$achete = $req->fetch();
		


		if(!$achete["achete"])
		{
			echo "<p>Vous n'avez pas acheté le jeu, vous ne pouvez pas le commenter</p>";
		}
		else
		{
		//A t-il déjà laissé un commentaire
		$req=$bdd->prepare("SELECT COUNT(n.ID_Note) AS commentaire FROM notes AS n JOIN clients AS C ON n.ID_Client=c.ID_Client 
							WHERE c.Login_Client=:ID_Client AND n.ID_Produit=:ID_Produit");
		$req->execute(array("ID_Produit" => $_GET["ID"],"ID_Client" => $_SESSION["login"]));
	
		$commentaire=$req->fetch();
		
		if($commentaire["commentaire"]!=0)
		{
			echo "<p>Vous avez déjà donné votre avis pour ce produit</p>";
		}
		else
		{
			echo "<p>Votre avis nous intéresse</p>";
			echo "<form id=donnerappreciation method=get action=noter.php>";
				echo "<label>Note:</label><input type=number name=notation min=0 max=10>";
				echo "<label>Commentaire:</label><textarea  name=commentaire rows=1 cols=20></textarea>";
				echo "<input style=display:none type=integer name=ID value=".$_GET["ID"].">";
				echo "<input type=submit value=Evaluer>";
			echo "</form>";
		}
	
	}

	}
	
	echo "</div>";
	echo "</div>";	
}

function connectionBDD()
{
	//Tentaive de connection à la BDD
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
 return $bdd;
}

function filtre()
{
	//Code html relatif à l'affichage des filtres
	?>			
	<form style="display:flex;" method="post">
                    <div id="valeurfiltre" style="display:flex;">
                        <p>Prix min: </p>
                        <?php
                        if(!isset($_POST["PrixMin"]))
                        {
                            $_POST["PrixMin"]=0;
                        }
                        echo "<input type=number name=PrixMin value=".$_POST["PrixMin"].">"
                        ?>
                    </div>
                    <div id="valeurfiltre" style="display:flex;">
                        <p>Prix max: </p>
                        <?php
                        if(!isset($_POST["PrixMax"]))
                        {
                            $_POST["PrixMax"]=0;
                        }
                        echo "<input type=number name=PrixMax value=".$_POST["PrixMax"].">"
                        ?>
                    </div>
                    <div id="datefiltre"style="display:flex;">
                        <p>Année min: </p>
                        <?php
                        if(!isset($_POST["AnneeMin"]))
                        {
                            $_POST["AnneeMin"]=0;
                        }
                        echo "<input type=date name=AnneeMin value=".$_POST["AnneeMin"].">"
                        ?>
                    </div>  
                    <div id="datefiltre" style="display:flex;">
                        <p>Année max: </p>
                        <?php
                        if(!isset($_POST["AnneeMax"]))
                        {
                            $_POST["AnneeMax"]=0;
                        }
                        echo "<input type=date name=AnneeMax value=".$_POST["AnneeMax"].">"
                        ?>
                    </div>  
                    <div id="valeurfiltre" style="display:flex;">
                        <p>Note min: </p>
                        <?php
                        if(!isset($_POST["NoteMin"]))
                        {
                            $_POST["NoteMin"]=0;
                        }
                        echo "<input type=number name=NoteMin value=".$_POST["NoteMin"].">"
                        ?>
                    </div>
                    <div>
                        <input id="submitfiltre" type="submit" value="Filtrer" />
                    </div>  
				</form>
		<?php
}

function genererChaineAleatoire($longueur)
{
 	$chaine = '';
 	$listeCar = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 	$max = strlen($listeCar);
	for ($i = 0; $i < $longueur; ++$i)
	{
 		$chaine .= $listeCar[random_int(0, $max)];
 	}
 	return $chaine;
}

function informationsCompte()
{
	echo "<div id=mon_compte>";
		echo "<h1>Mon compte</h1>";
	echo "</div>";

	//Include depuis une autre page
	if(!isset($_SESSION["login"]))
	{
		session_start();
	}

	//Acces données produit
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
	
	//On récupère les données du compte de l'utilisateur
	$req=$bdd->prepare("SELECT * FROM Clients WHERE Login_Client=:login");
	$req->execute(array("login" => $_SESSION["login"]));
	$donnees = $req->fetch();
	?>
	<div id="profil">
		<h2>Mon profil</h2>
		<table>
			<tr>
				<th>
					<p>Nom:</p>
				</th>
				<th>
					<p><?php echo $donnees["Nom_Client"]; ?></p>
				</th>
			</tr>

			<tr>
				<th>
					<p>Prenom:</p>
				</th>
				<th>
					<p><?php echo $donnees["Prenom_Client"] ?></p>
				</th>
			</tr>

			<tr>
				<th>
					<p>Pseudo:</p>
				</th>
				<th>
					<p><?php echo $donnees["Login_Client"] ?></p>
				</th>
			</tr>
			
			<tr>
				<th>
					<p>Adresse:</p>
				</th>
				<th>
					<p><?php echo $donnees["Adresse_Client"] ?></p>
				</th>
			</tr>

			<tr>
				<th>
					<p>Code postal:</p>
				</th>
				<th>
					<p><?php echo $donnees["CP_Client"] ?></p>
				</th>
			</tr>
			<tr>
				<th>
					<p>Ville:</p>
				</th>
				<th>
					<p><?php echo $donnees["Ville_Client"] ?></p>
				</th>
			</tr>
		</table>
	</div>
	<?php

	//On récupère les commandes de l'utilisateur
	$req=$bdd->prepare("SELECT * FROM Commandes WHERE ID_Client=:id ORDER BY ID_Commande");
	$req->execute(array("id" => $donnees["ID_Client"]));
	
	$nbCommandes=1;
	echo "<div id=commandes>";
	echo "<h2>Mes commandes</h2>";
	//On affiche les commandes passées
	while($commandes = $req->fetch())
	{
		echo "<div>";
			echo "<a href=detailsCommandes.php?ID=".$commandes["ID_Commande"].">";
				echo "Commandes n°".$nbCommandes." le numéro de suivi: ".$commandes["ID_Commande"];
			echo "</a>";
		echo "</div>";
		$nbCommandes++;
	}
	echo "</div>";

	//On affiche les articles qui peuvent être notés
	$req=$bdd->prepare("SELECT DISTINCT(d.ID_Produit) FROM detailscommandes AS d JOIN commandes AS c ON d.ID_Commande=c.ID_Commande 
						WHERE c.ID_Client=:id AND d.ID_Produit NOT IN (SELECT ID_Produit FROM notes WHERE ID_Client=:id)");
	$req->execute(array("id" => $donnees["ID_Client"]));

	echo "<div id=articleANoter>";
	echo "<h2>Les articles que je peux noter et commenter</h2>";
	while($commandes = $req->fetch())
	{
		$req2=$bdd->prepare("SELECT * FROM produits WHERE ID_Produit=:id");
		$req2->execute(array("id" => $commandes["ID_Produit"]));
		$produit = $req2->fetch();

		echo "<div class=jeux>";
			echo "<a href=jeu.php?ID=".$produit["ID_Produit"].">";
				echo "<img width=250px heigh=374px src=".$produit["Image_Produit"].">";
			echo "</a>";
		echo "</div>";

	}
	echo "</div>";
	
}

function menu()
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
	
	//On récupère toutes les catégories et on les affiche
	$req=$bdd->prepare("SELECT * FROM categories");
	$req->execute(array());
	
	$numCategorie=1;
	echo "<div id=menus>";

	echo "<nav id=menu>";
	echo "<div class=menu_categorie>";
	while($categorie = $req->fetch())
	{
		echo "<div class=item>";
			echo "<a href=categorie.php?ID=".$numCategorie."&nombreParPage=5 id=".$categorie["Nom_Categorie"].">";
				echo "<img src=".$categorie["Logo_Categorie"]." />";
			echo $categorie["Nom_Categorie"]."</a>";

		echo "</div>";
		$numCategorie++;
	}

	echo "</div>";
	echo "</nav>";

	//Nouveautés
	//On affiche les 5 jeux les plus récents
	$req=$bdd->prepare("SELECT * FROM produits ORDER BY Date_Produit DESC LIMIT 5");
	$req->execute(array());
	

	echo "<div id=menu>";
		echo "<h3>Nouveautés: </h3>";
		while($nouveaute = $req->fetch())
		{
			echo "<div class=item>";
				echo "<a href=jeu.php?ID=".$nouveaute["ID_Produit"].">";
					echo "<img src=".$nouveaute["Image_Produit"]." />";
				echo $nouveaute["Nom_Produit"]."</a>";
			echo "</div>";
		}
	echo "</div>";
	echo "</div>";

}

function nombrePanier()
{
	//Formulaire du nombre d'article
	?>
    <form style="display:flex;" method="get" action="ajoutPanier.php">
        <div style="display:flex;">
		<?php
			echo "<label>Nombre :</label><input style=display:none  type=number name=ID value=".$_GET["ID"].">";
            echo "<input id=nombre type=number min=0 name=Nombre value=0>";
        ?>

    		<div>
                <input id="ajout" type="submit" value="Ajouter au panier" />
            </div>
        </div>
    </form>
	<?php
}

function pageAdministration()
{	
	//Tentative de connection à la base de données
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
   
   //Créer une nouvelle catégorie
	echo "<div id=nouvelleCategorie>";
		echo "<h2>Nouvelle catégorie :</h2>";
    	echo "<div>";
        	echo "<form style=display:flex method=post action=creationCategorie.php enctype=multipart/form-data >";
            	echo "<div>";
                	echo "<label>Categorie </label> : <input type=text name=Nom placeholder=Nom />";
            	echo "</div>";
            	echo "<div>";
                	echo "<input type=file name=monfichier />";
            	echo "</div>";
            	echo "<div>";
                	echo "<input type=submit value=Ajouter >";
            	echo "</div>";
        	echo "</form>";
    	echo "</div>";
	echo "</div>";
    


    //Créer un nouveau jeu
    //Categorie max
    $req=$bdd->prepare("SELECT ID_Categorie FROM Categories ORDER BY ID_Categorie DESC LIMIT 1");
    $req->execute(array());
    $ID = $req->fetch();
	
	echo "<div id=nouvelleJeu>";
		echo "<h2>Nouveau jeu</h2>";
    	echo "<div>";
        	echo "<form method=post action=creationJeu.php enctype=multipart/form-data >";
				echo "<div id=nouveauLigne  >";
					echo "<div>";
                		echo "<label>Nom: </label> : <input type=text name=Nom placeholder=Nouveau jeu />";
            		echo "</div>";
            		echo "<div>";
                		echo "<label>Prix: </label> : <input type=number name=Prix placeholder=15 min=0 max=999 />";
            		echo "</div>";
            		echo "<div>";
                		echo "<label>ID Categorie: </label> : <input type=number name=Categorie min=1 max=".$ID["ID_Categorie"]." />";
            		echo "</div>";
            		echo "<div>";
                		echo "<input type=file name=monfichier />";
					echo "</div>";
				echo "</div>";
				echo "<div style=display:flex>";
					echo "<div>";
                		echo "<label>Description: </label> : <input type=text name=Description placeholder=Description />";
            		echo "</div>";
            		echo "<div>";
                		echo "<label>Date: </label> : <input type=date name=Date min=1980-01-01 max=".date('Y-m-d')." />";
            		echo "</div>";
            		echo "<div>";
                		echo "<input type=submit value=Ajouter >";
					echo "</div>";
				echo "</div>";
        	echo "</form>";
    	echo "</div>";
	echo "</div>";
    

	$req=$bdd->prepare("SELECT count(*) AS nombre FROM commentaires ");
    $req->execute(array());

    $nombre = $req->fetch();

    //Affichage des messages par pages
    $numPage=1;
    if(isset($_GET["valeur"]) && isset($_GET["page"]))
    {
		if($_GET["page"]=="suivante" )
		{
			$numPage=$_GET["valeur"]+1;
		}
		if($_GET["page"]=="precedente")
		{
			$numPage=$_GET["valeur"]-1;
		}
		
    }

    //Affichage des messages
    $req=$bdd->prepare("SELECT * FROM commentaires ORDER BY ID_Commentaire DESC LIMIT 5 OFFSET ". 5*($numPage-1));
    $req->execute(array());

    echo "<div id=afficherMessage >";
        echo "<table>";
            echo "<tr>";
                echo "<th>Nom</th>";
                echo "<th>Mail</th>";
                echo "<th>Message</th>";
            echo "</tr>";
    	while($commentaire = $req->fetch())
    	{
            echo "<tr>";
                echo "<th>".$commentaire["Nom_Commentaire"]."</th>";
                echo "<th>".$commentaire["Mail_Commentaire"]."</th>";
                echo "<th><textarea name=message rows=3 cols=40>".$commentaire["Commentaire_Commentaire"]."</textarea></th>";
            echo "</tr>";
    	}
    	echo "</table>";
   
	
    

        //Outils de navigation entre les pages
        echo "<form style=display:flex method=get action=identification.php enctype=multipart/form-data >";
            if($numPage!=1)
            {
                echo "<div>";
                    echo "<input type=submit name=page value=precedente >";
                echo "</div>";
            }
            else
            {
                echo "<div>";
                    echo "<input type=submit  value=précédente disabled=disabled >";
                echo "</div>";
            }
            echo "<div>";
                echo "<input type=number name= valeur value=".$numPage." min=".$numPage." max=".$numPage." />";
			echo "</div>";
			if(($nombre["nombre"]-$numPage*5)>0)
			{
                echo "<div>";
                    echo "<input type=submit name=page value=suivante >";
                echo "</div>";
            }
            else
            {
                echo "<div>";
                    echo "<input type=submit value=suivante disabled=disabled >";
                echo "</div>";
            }
        echo "</form>";

    echo "</div>";
}

function pageCompte()
{
	//Tentative de connection à la base de données
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

	//Si session n'a pas commencé
	if(!isset($_SESSION["login"]))
	{
		session_start();
	}
	
	//On oriente l'utilisateur en fonction de régime d'accès
	$req=$bdd->prepare("SELECT ID_Client FROM clients WHERE Login_Client=:Nom");
	$req->execute(array("Nom" => $_SESSION["login"]));
	$ID = $req->fetch();
	

	if($ID["ID_Client"]<1) //Administrateur
	{
		pageAdministration();
	}
	else	//Client
	{
		informationsCompte();
	}
	

}

function paiement()
{
	//Formulaire pour le paiement
	?>
	<div>
		<h2>Paiement sécurisé</p>
        <img  src="images/outils/cartesPaiement.jpg">
    </div>
	<form method=post action=validationPaiement.php>
        <table>
			<tr>
				<th>
					<p>Adresse de livraison:</p>
				</th>	
				<th>
					<input type=text name=adresse placeholder="2 impasse du pain perdu"/>
				</th>	
			</tr>
			<tr>
				<th>
					<p>Code postal:</p>
				</th>	
				<th>
					<input type=text name=codePostal placeholder="99666"/>
				</th>	
			</tr>
			<tr>
				<th>
					<p>Ville:</p>
				</th>	
				<th>
					<input type=text name=ville placeholder="Paris"/>
				</th>	
			</tr>
			<tr>
				<th>
					<p>Titulaire de la carte:</p>
				</th>	
				<th>
					</label><input type=text name=titulaire />
				</th>	
			</tr>
			<tr>
				<th>
					<p>Numéro de la carte:</p>
				</th>	
				<th>
					</label><input type=number name=numeroCarte min="0" max="9999999999999999" placeholder="0000000000000000"/>
				</th>	
			</tr>
			<tr>
				<th>
					<p>Date d'expiration (MM/AAAA):</p>
				</th>	
				<th>
					<input type=number name=moisExpiration min="1" max="12" placeholder="1"/>
            		<input type=number name=anneeExpiration min="2020" max="3000" placeholder="2020"/>
				</th>	
			</tr>
			<tr>
				<th>
					<p>Cryptogramme:</p>
				</th>	
				<th>
					</label><input type=number name=cryptogramme min="0" max="999" placeholder="0"/>
				</th>	
			</tr>
			<tr>
				<th>
					
				</th>	
				<th>
					<input type="submit" placeholder="Valider" />
				</th>	
			</tr>
		</table>      
    </form>
	<?php
}

function tri()
{
	//Formulaire pur les fonctionnaltés de tri
	?>
	<div id="tri">
        <div style="display:flex">
            <p>Tri par prix:</p>
            <div>
                <?php
                echo "<div>";
                    echo "<a href=categorie.php?ID=".$_GET["ID"]."&PRIX=0>";
                    echo "<img width=10vw heigh=10vw src=images/outils/fleche-vers-haut.jpg>";
                    echo "</a>";
                echo "</div>";
                echo "<div>";
                    echo "<a href=categorie.php?ID=".$_GET["ID"]."&PRIX=1>";
                    echo "<img width=10vw heigh=10vw src=images/outils/fleche-vers-bas.jpg>";
                    echo "</a>";
                echo "</div>";
                ?>
            </div>  
        </div>  
        <div style="display:flex">
            <p>Tri par nom:</p>
            <div>
                <?php
                    echo "<div>";
                        echo "<a href=categorie.php?ID=".$_GET["ID"]."&NOM=0>";
                        echo "<img width=10vw heigh=10vw src=images/outils/fleche-vers-haut.jpg>";
                        echo "</a>";
                    echo "</div>";
                    echo "<div>";
                        echo "<a href=categorie.php?ID=".$_GET["ID"]."&NOM=1>";
                        echo "<img width=10vw heigh=10vw src=images/outils/fleche-vers-bas.jpg>";
                        echo "</a>";
                    echo "</div>";
                ?>
            </div>
                        
        </div>
        <div style="display:flex">
            <p>Tri par date:</p>
            <div>
                <?php
                echo "<div>";
                    echo "<a href=categorie.php?ID=".$_GET["ID"]."&DATE=0>";
                    echo "<img width=10vw heigh=10vw src=images/outils/fleche-vers-haut.jpg>";
                    echo "</a>";
                echo "</div>";
                echo "<div>";
                    echo "<a href=categorie.php?ID=".$_GET["ID"]."&DATE=1>";
                    echo "<img width=10vw heigh=10vw src=images/outils/fleche-vers-bas.jpg>";
                    echo "</a>";
                echo "</div>";
                ?>
            </div>
                        
		</div>
		<div style="display:flex">
            <p>Tri par note:</p>
            <div>
            	<?php
                echo "<div>";
                    echo "<a href=categorie.php?ID=".$_GET["ID"]."&NOTE=0>";
                    echo "<img width=10vw heigh=10vw src=images/outils/fleche-vers-haut.jpg>";
                    echo "</a>";
                echo "</div>";
                echo "<div>";
                    echo "<a href=categorie.php?ID=".$_GET["ID"]."&NOTE=1>";
                    echo "<img width=10vw heigh=10vw src=images/outils/fleche-vers-bas.jpg>";
                    echo "</a>";
                echo "</div>";
            	?>
            </div>
                        
		</div>
		<div style="display:flex">
			<?php
			if(isset($_GET["grille"]))
			{
				echo "<p>";
					echo "Affichage:";
				echo "</p>";
				echo "<div id=affichageTri>";
					echo "<a href=categorie.php?ID=".$_GET["ID"]."&ligne=0>";
							echo "<img  src=images/outils/ligne.png>";
					echo "</a>";
				echo "</div>";
			}
			else
			{
				echo "<p>";
					echo "Affichage:";
				echo "</p>";
				echo "<div id=affichageTri>";
					echo "<a href=categorie.php?ID=".$_GET["ID"]."&grille=0>";
						echo "<img  src=images/outils/grille.png>";
					echo "</a>";
				echo "</div>";
			}
			?>                        
        </div>
 

    </div>
	<?php
}

?>