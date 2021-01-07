<?php
	// Inclusion de la classe reservation
	require_once "reservation.class.php";
	
	class reservationTable {
		
		public static function getReservationsByVoyage($voyage){
			$em = dbconnection::getInstance()->getEntityManager() ;
			
			$reservationRepository = $em->getRepository('reservation');
			$reservations = $reservationRepository->findBy(array('voyage' => $voyage));
			/*
			if ($reservations == false){
				echo 'Erreur sql';
			}*/
			return $reservations;
		}

		public static function addReservation($user,$voyage){
			$em = dbconnection::getInstance()->getEntityManager() ;
			$r =new reservation;
			$r->voyage=$voyage->id;
			$r->voyageur=$user->id;
			$em->persist($r);	
			$em->flush();
		}		
		
	}
?>
