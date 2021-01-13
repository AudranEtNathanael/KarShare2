<?php
	// Inclusion de la classe reservation
	require_once "reservation.class.php";
	
	class reservationTable {
		
		public static function getReservationsByUser($voyageur){
			$em = dbconnection::getInstance()->getEntityManager() ;
			
			$reservationRepository = $em->getRepository('reservation');
			$reservations = $reservationRepository->findBy(array('voyageur' => $voyageur));
			/*
			if ($reservations == false){
				echo 'Erreur sql';
			}*/
			return $reservations;
		}

		public static function getReservationById($id){
			$em = dbconnection::getInstance()->getEntityManager() ;
			
			$reservationRepository = $em->getRepository('reservation');
			$reservation = $reservationRepository->findOneBy(array('id' => $id));
			/*
			if ($reservations == false){
				echo 'Erreur sql';
			}*/
			return $reservation;
		}
		public static function addReservation($user,$voyage){
			$em = dbconnection::getInstance()->getEntityManager() ;
			$reservationRepository = $em->getRepository('reservation');
			$r =new reservation;
			$r->voyage=$voyage;
			$r->voyageur=$user;
			$em->merge($r);	
			$em->flush();
		}	

		public static function deleteReservation($id){
			$em = dbconnection::getInstance()->getEntityManager() ;
			$reservationRepository = $em->getRepository('reservation');
			$reservation = $reservationRepository->findOneBy(array('id' => $id));
			$em->remove($reservation);
			$em->flush();
		}		
	}
?>
