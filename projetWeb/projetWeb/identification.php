<?php
	//Oriente l'utilisateur en focntion de si il a été authentifié
	session_start();
	if(isset($_SESSION["login"]))
	{
		include("monCompte.php");
				
	}
	else
	{	
		include("inscriptionConnection.php");
	}
?>