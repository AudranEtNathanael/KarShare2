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


}
