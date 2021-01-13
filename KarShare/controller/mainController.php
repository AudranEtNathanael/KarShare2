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

	public static function rechercherVoyage_BACK($request,$context){
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

    public static function rechercherReservation($request,$context){
    	if ($context->getSessionAttribute("User")!=null){
            $tmp=$context->getSessionAttribute("User");
    		$context->reservations=reservationTable::getReservationsByUser($tmp);
            if ($context->reservations==null){
                $context->info="Aucune réservation";
            }
            else {
                $context->info="Recherche réussi";
            }
    		return context::SUCCESS;
    	}
        else {
             $context->error="Probleme d'utilisateur";
        	return context::ERROR; 
        }
    }

    public static function reserverVoyage($request,$context){
        $tmp=voyageTable::getVoyageById($_GET['idvoyage']);
        if ((isset($tmp)) && ($tmp->nbplace>=1) ){
            if ($context->getSessionAttribute("User")!=null){
                $context->voyageReserve=$tmp;
                reservationTable::addReservation($context->getSessionAttribute("User"),$context->voyageReserve);
                voyageTable::setVoyagePlace($context->voyageReserve,-1);
                $context->info="Voyage reservé";
                return context::SUCCESS;
            }
            else{
               $context->error="Probleme d'utilisateur";
                return context::ERROR; 
            }
            
        }
        else{
            $context->error="Pas assez de place";
            return context::ERROR;
        }
    }

    public static function annulerReservation($request,$context){
        $tmp=reservationTable::getReservationById($_GET['idreservation']);
        if (isset($tmp) ){
            if ($context->getSessionAttribute("User")!=null){
                $context->voyageReserve=$tmp->voyage->id;
                //voyageTable::setVoyagePlace($context->voyageReserve,+1);
                //reservationTable::deleteReservation($tmp->id);
                $context->info="Voyage annulé";
                return context::SUCCESS;
            }
            else{
               $context->error="Probleme d'utilisateur";
                return context::ERROR; 
            }
            
        }
        else{
            $context->error="Probleme selection";
            return context::ERROR;
        }
    }
    public static function deconnexion($request,$context){
        //$_SESSION["User"]=null;
       $context->setSessionAttribute("User",null);
        return context::SUCCESS;
    }

    public static function suppression($request,$context){
        //$_SESSION["User"]=null;


        return context::SUCCESS;
    }


    public static function inscription($request,$context){
        if (!(empty($_GET['identifianti'])) && !(empty($_GET['mdpi'])) && !(empty($_GET['nom'])) && !(empty($_GET['prenom']))){
            utilisateurTable::createUser($_GET['identifianti'],$_GET['mdpi'],$_GET['nom'],$_GET['prenom']);
            //$sql= "INSERT INTO jabaianb.utilisateur (identifiant,pass,nom,prenom) VALUES ('".str_replace(' ','',$_GET['identifianti'])."','"+sha1($_GET['mdpi'])."','".str_replace(' ','',$_GET['nom'])."','".str_replace(' ','',$_GET['prenom'])."');";
           /* $sql= "INSERT INTO jabaianb.utilisateur (identifiant,pass,nom,prenom) VALUES ('" . $_GET['identifianti'] . "','". sha1($_GET['mdpi']) ."','". $_GET['nom'] ."','". $_GET['prenom'] ."');";
            $statement=$db->prepare($sql);
            $statement->execute();*/
            $context->userC = utilisateurTable::getUserByLoginAndPass($_GET['identifianti'],$_GET['mdpi']);
            if ($context->userC){
            	$context->setSessionAttribute("User",$context->userC);
            	$context->userC=null;
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
            $context->userC = utilisateurTable::getUserByLoginAndPass($_GET['identifiantc'],$_GET['mdpc']);
            if ($context->userC){
                $context->setSessionAttribute("User",$context->userC);
            	$context->userC=null;
                $context->info="Connexion réussi"; 
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
	
	
	public static function creerVoyage($request,$context){
		//echo $_GET['id'];
		if(!(empty($_GET['conducteur'])) && !(empty($_GET['villedep'])) && !(empty($_GET['villefin'])) && !(empty($_GET['tarif'])) && !(empty($_GET['place'])) && !(empty($_GET['heure'])) && !(empty($_GET['contraintes']))){
			$em = dbconnection::getInstance()->getEntityManager() ;
			$voyage = new voyage;
			
			$voyage->utilisateur = utilisateurTable::getUserById($_GET['conducteur']);
			
			if($voyage->utilisateur){
				$voyage->trajet = trajetTable::getTrajet($_GET['villedep'],$_GET['villefin']);
				if($voyage->trajet){
					$voyage->tarif = $_GET['tarif'];
					$voyage->nbplace = $_GET['place'];
					$voyage->heuredepart = $_GET['heure'];
					$voyage->contraintes = $_GET['contraintes'];
					$em->persist($voyage);
					$em->flush();
					
					$context->infoLinkedToView = "Le voyage suivant a été créé avec succes ! ";
					$context->createdVoyage = $voyage;
					return context::SUCCESS;
				}
				$context->warningLinkedToView="Aucun trajet n'existe entre ces deux villes";
				return context::ERROR;
			}
			$context->errorLinkedToView="L'utilisateur connecté n'existe plus et ne peut pas être ajouté comme conducteur";
			return context::ERROR;
		}
		$context->errorLinkedToView="Un champ est vide";
		return context::ERROR;
	}
	
	
	
	
	public static function rechercherVoyage_V2($request,$context){
		$context->trajet = trajetTable::getTrajet($_GET['depart'],$_GET['arrivee']);
		if ($context->trajet){
			
			
			$em = dbconnection::getInstance()->getEntityManager() ;
			$db = $em->getConnection();
			if(isset($_GET['correspondances'])){
				$cor = "true";
			}else{
				$cor = "false";
			}
			
			$RAW_QUERY = "SELECT * FROM getCorrCallRec(true, '".$_GET['depart']."', '".$_GET['arrivee']."');";
			
			
			$statement = $db->prepare($RAW_QUERY);
			$statement->execute();
			
			$result = $statement->fetchAll();
			//$result = pg_fetch_array($result1, NULL, PGSQL_ASSOC);
			
			$context->voyages = $result;
			
			
			//$context->voyages = voyageTable::getVoyagesCorForDepFin($_GET['depart'], $_GET['arrivee']);
			if ($context->voyages){
				
				$CorresTab= array();
				$i = 0;
				foreach ($result as &$FunctionResArray) {
					foreach ($FunctionResArray as $strIntArray) {
						$intArray = preg_split("/[,]+/", substr($strIntArray, 1, -1));
						$j = 0;
						foreach ($intArray as $currentInt) {
							$CorresTab[$i][$j] = voyageTable::getVoyageById($currentInt);
							$j = $j + 1;
						}
						$i = $i + 1;
					}
				}
				
				//echo "Version X";
				
				$context->depart = $_GET['depart'];
				$context->arrivee = $_GET['arrivee'];
				$context->voyagesAndCorresp = $CorresTab;
				
				$context->info="Recherche termine";
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
	
	
	
	public static function rechercherVoyage($request,$context){
		$context->trajet = trajetTable::getTrajet($_GET['depart'],$_GET['arrivee']);
		if ($context->trajet){
			
			
			$em = dbconnection::getInstance()->getEntityManager() ;
			$db = $em->getConnection();
			if(isset($_GET['correspondances'])){
				$cor = "true";
			}else{
				$cor = "false";
			}
			
			//echo "SELECT * FROM getCorrCallRec(".$cor.", '".$_GET['depart']."', '".$_GET['arrivee']."');";
			$RAW_QUERY = "SELECT * FROM getCorrCallRec(".$cor.", '".$_GET['depart']."', '".$_GET['arrivee']."');";
			//$RAW_QUERY = "SELECT * FROM getCorrCallRec(true, 'Angers', 'Brest');";
			
			$statement = $db->prepare($RAW_QUERY);
			$statement->execute();
			
			$result = $statement->fetchAll();
			//$result = pg_fetch_array($result1, NULL, PGSQL_ASSOC);
			
			$context->voyages = $result;
			
			//echo "Version XX";
			
			
			//$context->voyages = voyageTable::getVoyagesCorForDepFin($_GET['depart'], $_GET['arrivee']);
			if ($context->voyages){
				
				$CorresTab= array();
				$i = 0;
				foreach ($result as &$FunctionResArray) {
					foreach ($FunctionResArray as $strIntArray) {
						$intArray = preg_split("/[,]+/", substr($strIntArray, 1, -1));
						$j = 0;
						foreach ($intArray as $currentInt) {
							//echo "the in : ".$currentInt;
							$CorresTab[$i][$j] = voyageTable::getVoyageById($currentInt);
							$j = $j + 1;
						}
						$i = $i + 1;
					}
				}
				
				
				$context->depart = $_GET['depart'];
				$context->arrivee = $_GET['arrivee'];
				$context->voyagesAndCorresp = $CorresTab;
				
				$context->info="Recherche termine";
				return context::SUCCESS;
			}else {
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
