<?php
	
class mainController{
    
    public static function undefinedViewError($request,$context){
        $context->error="Une grave erreur s'est produite, il est probable que l'action ".$_GET['action']." n'existe pas...";
        return context::SUCCESS;
    }  // penser à changer le type de context ...
    
    
    public static function index($request,$context){
        
        return context::SUCCESS;
    }
    
    
    public static function testMenu(){
        return context::SUCCESS;
    }
    

	public static function helloWorld($request,$context){
		$context->mavariable="hello world";
		return context::SUCCESS;
	}


    public static function superTest($request,$context){
        if (isset($_GET["param1"]) and isset($_GET["param2"])){
            $context->param1=$_GET["param1"];
            $context->param2=$_GET["param2"];
            return context::SUCCESS;
        }
        return context::ERROR;
    }


	public static function testUserIdPass($request,$context){
		$context->user = utilisateurTable::getUserByLoginAndPass($_GET['login'],$_GET['pass']);
		return context::SUCCESS;
	}


	public static function testUserId($request,$context){
		$context->user = utilisateurTable::getUserById($_GET['id']);
		return context::SUCCESS;
	}


	public static function testTrajet($request,$context){
		$context->trajet = trajetTable::getTrajet($_GET['depart'],$_GET['arrivee']);
		return context::SUCCESS;
	}


	public static function testVoyage($request,$context){
		$context->voyages = voyageTable::getVoyageByTrajet($_GET['trajet']);
		return context::SUCCESS;
	}


	public static function testReservation($request,$context){
		$context->reservations = reservationTable::getReservationsByVoyage($_GET['voyage']);
		return context::SUCCESS;
	}

	public static function rechercherVoyage($request,$context){
        $context->trajet = trajetTable::getTrajet($_GET['depart'],$_GET['arrivee']);
        if ($context->trajet){
            $context->voyages = voyageTable::getVoyageByTrajet($context->trajet->id);
            if ($context->voyages){
                $context->info="Recherche terminee";
                return context::SUCCESS;
            }
            else {
                $context->info="Aucun voyage pour ce trajet";
                return context::ERROR;
            }
        }
        else {
            $context->error="Votre trajet n existe pas";
            return context::ERROR;
        }
	}

    public static function inscription($request,$context){
        if (!(empty($_GET['identifianti'])) && !(empty($_GET['mdpi'])) && !(empty($_GET['nom'])) && !(empty($_GET['prenom']))){
            $em = dbconnection::getInstance()->getEntityManager() ;
            $db = $em->getConnection(); 
            //$sql= "INSERT INTO jabaianb.utilisateur (identifiant,pass,nom,prenom) VALUES ('".str_replace(' ','',$_GET['identifianti'])."','"+sha1($_GET['mdpi'])."','".str_replace(' ','',$_GET['nom'])."','".str_replace(' ','',$_GET['prenom'])."');";
            $sql= "INSERT INTO jabaianb.utilisateur (identifiant,pass,nom,prenom) VALUES ('" . $_GET['identifianti'] . "','". sha1($_GET['mdpi']) ."','". $_GET['nom'] ."','". $_GET['prenom'] ."');";
            $statement=$db->prepare($sql);
            $statement->execute();
            session_start();
            $context->user = utilisateurTable::getUserByLoginAndPass($_GET['identifianti'],$_GET['mdpi']);
            if ($context->user){
                $_SESSION["User"]=$context->user;
                $context->info="Création réussi";
                return context::SUCCESS;
            }
            else{
                $context->error="Creation échoué";
                return context::ERROR; 
            }
        }
        else{
            $context->error="Un champ est vide";
            return context::ERROR;   
        }
    }

    public static function connexion($request,$context){
        if (!(empty($_GET['identifiantc'])) && !(empty($_GET['mdpc']))){
            $context->user = utilisateurTable::getUserByLoginAndPass($_GET['identifiantc'],$_GET['mdpc']);
            if ($context->user){
                //session_start();
                //session["user"]=$context->user;
                $context->info="Connexion reussi";
                $_SESSION["User"]=$context->user;
                return context::SUCCESS;  
            } 
            else{
                $context->error="Mdp ou login inexact";
                return context::ERROR;             
            }
        }
        else {
            $context->error="Un champ est vide";
            return context::ERROR;   
        }
    }
}
