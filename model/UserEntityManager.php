<?php
	require '../model/DBManager.php';

	class UserEntityManager{
		public static function Cryptage($user){

			$Clef = 'blog_ecrivain_OC';

			$LClef = strlen($Clef);
			$LMDP = strlen($user->getPassword());
								
			if ($LClef < $LMDP){
						
				$Clef = str_pad($Clef, $LMDP, $Clef, STR_PAD_RIGHT);
			
			}
						
			elseif ($LClef > $LMDP){

				 $_Clef = substr($Clef, 0,  $LMDP - $LClef);
						
			}
					
			return $user->getPassword() ^ $Clef; // La fonction envoie le texte crypté
					
		}
	}