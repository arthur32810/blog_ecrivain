<?php
	class Moderation{
		public function moderation(){		
			require_once '../model/ModerationEntityManager.php';
		    $moderations = ModerationEntityManager::getModerations();

		    return $moderations;
		}
			
	}