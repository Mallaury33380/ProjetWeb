<?php
    //Si le formulaire a été correctement rempli
    if(!isset($_POST["adresse"])||!isset($_POST["codePostal"])||!isset($_POST["ville"]))
    {
        ?>
            <script>alert("<?php echo htmlspecialchars("Adresse de livraison est incorrecte", ENT_QUOTES); ?>")</script>;
        <?php
        include "paiement.php";
    } 
    
    if(!isset($_POST["titulaire"])||!isset($_POST["numeroCarte"])||!isset($_POST["moisExpiration"])||!isset($_POST["anneeExpiration"])||!isset($_POST["cryptogramme"]))
    {
        ?>
            <script>alert("<?php echo htmlspecialchars("Mode de paiement incorrect", ENT_QUOTES); ?>")</script>;
        <?php
        include "paiement.php";
    }


    session_start();
    if(isset($_SESSION["Panier"]["ID"]))
    {
        //On se connecte à la BDD
        $bdd = new PDO(
		    'mysql:host=localhost;dbname=perezlacoste;charset=utf8',
		    'root',
		    '',
		    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
		    );
        //On récupère l'ID du client
        $req=$bdd->prepare("SELECT ID_Client FROM Clients WHERE Login_Client=:login");
        $req->execute(array("login" => $_SESSION["login"]));
        $donnees = $req->fetch();

        $id_client=$donnees["ID_Client"];

    

        //On créé la commande
        $date = new DateTime();
        $req = $bdd->prepare("INSERT INTO Commandes(ID_Commande, ID_Client,
        Date_Commande) VALUES (NULL, :id_client, :creation)");
        $req->execute(array(
        "id_client" => $id_client,
        "creation" => $date->getTimestamp()
        ));

        //On récupère l'ID de la dernière commande créée
        $req = $bdd->prepare("SELECT ID_Commande FROM
        Commandes WHERE ID_Client=:id_client OrDER BY Date_Commande DESC LIMIT 1");
        $req->execute(array("id_client" => $id_client));
        $donnees = $req->fetch();
        $id_commande = $donnees["ID_Commande"];



        //On procède à l'insertion de tous les articles du panier
        for($i=0;$i<sizeof($_SESSION["Panier"]["ID"]);$i++)
        {
            for($j=0;$j<$_SESSION["Panier"]["Nombre"][$i];$j++)
            {
                $req = $bdd->prepare("INSERT INTO DetailsCommandes(ID_DetailCommande,
                ID_Commande, ID_Produit) VALUES (NULL, :id_commande,
                :id_produit)");

                $req->execute(array(
                "id_commande" => $id_commande,
                "id_produit" => $_SESSION["Panier"]["ID"][$i]
                ));
            }
        }
        //On supprime le panier
        unset($_SESSION["Panier"]["ID"]);
        unset($_SESSION["Panier"]["Nombre"]);

        $_SESSION["Panier"]=array_values($_SESSION["Panier"]);

    }
    include "index.php";
    
?>