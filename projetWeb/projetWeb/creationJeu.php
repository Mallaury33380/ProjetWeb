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
    
    //Si session a déjà commencer
    if(!isset($_SESSION["login"]))
    {
        session_start();
    }
    //Cherche si le jeu existe
    $existe=0;

    if($_POST["Nom"]!=NULL && $_POST["Prix"]!=NULL && $_POST["Categorie"]!=NULL && $_POST["Description"]!=NULL && $_POST["Date"]!=NULL)
    {
        $req=$bdd->prepare("SELECT COUNT(*) AS nb FROM Produits WHERE Nom_Produit=:Nom");
        $req->execute(array("Nom" => $_POST["Nom"]));
        $ID = $req->fetch();
        $existe=($ID["nb"]+1)%2;
    }

    //Si le jeu n'existe pas on l'ajoute
    if($existe)
    {
        //Si le fichier a bien été envoyé
        if (isset($_FILES['monfichier']) AND $_FILES['monfichier']['error'] == 0)
        {
            //Si bonne taille
            if ($_FILES['monfichier']['size'] <= 1000000)
            {
                //Si png ou jpg
                $infosfichier = pathinfo($_FILES['monfichier']['name']);
                $extension_upload = $infosfichier['extension'];
                $extensions_autorisees = array('jpg','png');
                $espace=" ";
                $nom=basename($_FILES['monfichier']['name']);

                if (in_array($extension_upload, $extensions_autorisees) && strpos($nom,$espace)==FALSE)
                {
                    //get categorie nom categorie
                    $req=$bdd->prepare("SELECT Nom_Categorie  FROM categories WHERE ID_Categorie=:ID");
                    $req->execute(array("ID" => $_POST["Categorie"]));
                    $Nom = $req->fetch();


                    move_uploaded_file($_FILES['monfichier']['tmp_name'], 'images/jeux/'.$Nom["Nom_Categorie"]."/". basename($_FILES['monfichier']['name']));

                    $req = $bdd->prepare("INSERT INTO produits(ID_Produit,
		            Nom_Produit,Prix_Produit,ID_Categorie,Image_Produit,Description_Produit,Date_Produit) VALUES (NULL,
		            :Nom_Produit,:Prix_Produit,:ID_Categorie,:Image_Produit,:Description_Produit,:Date_Produit)");

		            $req->execute(array(
                    "Nom_Produit" => $_POST["Nom"],
                    "Prix_Produit" => $_POST["Prix"],
                    "ID_Categorie" => $_POST["Categorie"],
                    "Image_Produit" => 'images/jeux/'.$Nom["Nom_Categorie"]."/". basename($_FILES['monfichier']['name']),
                    "Description_Produit" => $_POST["Description"],
                    "Date_Produit" => $_POST["Date"]
                    ));

                }
                else
                {
                    ?>
		                <script>alert("<?php echo htmlspecialchars('Erreur extension ou espace dans le nom', ENT_QUOTES); ?>")</script>
		            <?php
                }
 
            }
            else
            {
                ?>
		            <script>alert("<?php echo htmlspecialchars('Fichier trop volumineux', ENT_QUOTES); ?>")</script>
		        <?php
            }
        }
        else
        {
            ?>
		        <script>alert("<?php echo htmlspecialchars('Erreur envoi fichier', ENT_QUOTES); ?>")</script>
		    <?php
        }
    }
    else
    {
        ?>
		    <script>alert("<?php echo htmlspecialchars('Formulaire incomplet', ENT_QUOTES); ?>")</script>
		<?php
    }

    
    include "monCompte.php";
?>