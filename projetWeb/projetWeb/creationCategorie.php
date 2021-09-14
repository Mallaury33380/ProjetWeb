<?php
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
    
    //Si session a déjà commencer
    if(!isset($_SESSION["login"]))
    {
        session_start();
    }

    //On cherche si la catégorie existe
    $existe=0;
    if(isset($_POST["Nom"]) && $_POST["Nom"]!=NULL)
    {
        $req=$bdd->prepare("SELECT COUNT(*) AS nb FROM categories WHERE Nom_Categorie=:Nom");
        $req->execute(array("Nom" => $_POST["Nom"]));
        $ID = $req->fetch();
        $existe=($ID["nb"]+1)%2;
    }

    //Si elle n'existe pas
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
                
                //Si elle respectent les condiions on insère la nouvelle catégorie dans la table catégorie
                if (in_array($extension_upload, $extensions_autorisees) && strpos($nom,$espace)==FALSE)
                {
                    move_uploaded_file($_FILES['monfichier']['tmp_name'], 'images/categories/' . basename($_FILES['monfichier']['name']));

                    $req = $bdd->prepare("INSERT INTO categories(ID_Categorie,
		            Nom_Categorie, Logo_Categorie) VALUES (NULL, :nomCategorie,
		            :logo)");

		            $req->execute(array(
		            "nomCategorie" => $_POST["Nom"],
		            "logo" => 'images/categories/' . basename($_FILES['monfichier']['name'])
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
		    <script>alert("<?php echo htmlspecialchars('Cette catégorie existe ou vous ne l avez pas défini', ENT_QUOTES); ?>")</script>
		<?php
    }

    
    include "monCompte.php";
?>