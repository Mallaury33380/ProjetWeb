<?php
    session_start();
    //Si le panier n'a pas encore été créé on le crée.
    if(!isset($_SESSION["Panier"]))
    {
        $_SESSION["Panier"]=array();
    }
    if(!isset($_SESSION["Panier"]["ID"]))
    {
        $_SESSION["Panier"]["ID"]=array();
    }
    if(!isset($_SESSION["Panier"]["Nombre"]))
    {
        $_SESSION["Panier"]["Nombre"]=array();
    }

    //Si le nombre d'article n'est pas nul on l'ajoute dans le panier avec sa quantité
    if($_GET["Nombre"]!=0)
    {
        $_SESSION["Panier"]["ID"][]=$_GET["ID"];
        $_SESSION["Panier"]["Nombre"][]=$_GET["Nombre"];
    }
    //On retoure sur la page du jeu en question
    include "jeu.php";
?>