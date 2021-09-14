<?php
    //On oriente le client en fonction de si il a été authentifié ou non pour passer au paiement
    if($_GET["Total"]!=0)
    {
        session_start();
        if(!isset($_SESSION["login"]))
        {
            include "inscriptionConnection.php";
        }
        else
        {
            include "paiement.php";
        }
    }
    else
    {
        include "panier.php";
    }
?>