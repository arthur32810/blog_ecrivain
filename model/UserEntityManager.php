<?php
	require '../model/DBManager.php';

	class UserEntityManager{

		public static function getUser($user){
			$db = DBManager::dbConnect();

			$recuperation_user = $db->prepare('SELECT * FROM users WHERE pseudo = ?');
			$recuperation_user->execute(array($user->getPseudo()));

			$donnees = $recuperation_user->fetch();

			return $donnees;
		}

		public static function addUser($user){
			$db = DBManager::dbConnect();

			$addUser = $db->prepare('INSERT INTO users(pseudo, password, role) VALUES (:pseudo, :password, \'view\')');
			$addUser->execute(array('pseudo' => $user->getPseudo(),
									'password' => $user->getPassword()));

			return $addUser;
		}

		public static function connexion($user){
			$db = DBManager::dbConnect();

			$recuperation_donnees = $db->prepare('SELECT * FROM users WHERE pseudo= :pseudo AND password= :password');
			$recuperation_donnees ->execute(array(
				'pseudo' => $user->getPseudo(),
				'password' => $user->getPassword()));

			$donnees = $recuperation_donnees->fetch();

			return $donnees;
		}

		public static function updateUser($user){
			$db = DBManager::dbConnect();

			$updateUser = $db->prepare('UPDATE users SET pseudo =:pseudo, password=:password, role=:role WHERE id=:id');
			$updateUser->execute(array(
								'pseudo' => $user->getPseudo(),
								'password' => $user->getPassword(),
								'role'=> $user->getRole(),
								'id' => $user->getId()));

			return $updateUser;
		}

		public static function deleteUser($user){
			$db = DBManager::dbConnect();

			$deleteUser = $db->prepare('DELETE FROM users WHERE id =?');
			$deleteUser->execute(array($user->getId()));

			// Suppression des variables de session et de la session
			$_SESSION = array();
			session_destroy();

			// Suppression des cookies de connexion automatique
			setcookie('login', '');
			setcookie('pass_hache', '');

			return $deleteUser;
		}

		public static function Cryptage($user){

			$Clef = DBManager::Clef();

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