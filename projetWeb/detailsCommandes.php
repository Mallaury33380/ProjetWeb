<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="styles/style.css"/>
        <title>Mon super site</title>
    </head>
 
    <body class="body">
 
    <?php 
		include("header.php");
		include("fonctions.php");
	?>
    
	<div class="page">
        <div id="detailsCommandes">
    
            <div>
                <h1>Détails de la commande <?php echo $_GET["ID"] ?></h1>
            </div>		
            <div>
                <?php
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
    
                    $req=$bdd->prepare("SELECT ID_Produit,COUNT(ID_Produit) as nb FROM detailscommandes WHERE ID_Commande=:id GROUP BY ID_Produit");
                    $req->execute(array("id" => $_GET["ID"]));


                    while($donnees = $req->fetch())
                    {
                        $req2=$bdd->prepare("SELECT Image_Produit FROM produits WHERE ID_Produit=:id");
                        $req2->execute(array("id" => $donnees["ID_Produit"]));
                        $produit = $req2->fetch();

                        echo "<div class=jeux>";
                            echo "<img width=250px heigh=374px src=".$produit["Image_Produit"].">";
                            echo "<p>Nombre: ".$donnees["nb"];
                        echo "</div>";  
                        
                    }
                    ?>
            </div>
        </div>
		
	</div>

    <?php include("footer.php"); ?>
    
    </body>
</html>


