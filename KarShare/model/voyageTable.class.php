<?php
	// Inclusion de la classe voyage
	require_once "voyage.class.php";
	
	class voyageTable {
		
		public static function getVoyageByTrajet($trajet){
			$em = dbconnection::getInstance()->getEntityManager() ;
			
			$voyageRepository = $em->getRepository('voyage');
			$journey = $voyageRepository->findBy(array('trajet' => $trajet));
			/*
			if ($journey == false){
				echo 'Erreur sql';
			}*/
			return $journey;
		}
		
		public static function getVoyageById($id){
			$em = dbconnection::getInstance()->getEntityManager() ;
			
			$voyageRepository = $em->getRepository('voyage');
			$journey = $voyageRepository->findOneBy(array('id' => $id));
			/*
			if ($journey == false){
				echo 'Erreur sql';
			}*/
			return $journey;
		}

		public static function setVoyagePlace($id,$nb){
			$em = dbconnection::getInstance()->getEntityManager() ;
			$voyageRepository = $em->getRepository('voyage');
			$journey = $voyageRepository->findOneBy(array('id' => $id));
			$journey->nbplace=($journey->nbplace)+$nb;
			$em->merge($journey);	
			$em->flush();
		}
	}
?>

