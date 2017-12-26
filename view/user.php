<?php
if(isset($_POST['add'])){
	if(isset($_POST['pseudo']) && isset($_POST['password'])){
		if(!empty(trim($_POST['pseudo'])) && !empty(trim($_POST['password']))){
			extract($_POST);

			$pseudo = htmlspecialchars($_POST['pseudo']);
			$password = htmlspecialchars($_POST['password']);

			require_once '../model/UserEntity.php';
			$user = new UserEntity();
			$user->setPseudo($pseudo);
			$user->setPassword($password);

			require_once '../model/UserEntityManager.php';
			$existUser = UserEntityManager::getUser($user);

			if(!empty($existUser)){
				echo '<meta http-equiv="refresh" content="0;URL=index.php?action=inscription&user=exist">';
			}
			else{
				$mdp_crypt = UserEntityManager::Cryptage($user); // Création du mot de pass crypter

				$user->setPassword($mdp_crypt); //Modification du mot de passe dans l'entité

				$addUser = UserEntityManager::addUser($user); 

				if ($addUser === false) {
					echo '<meta http-equiv="refresh" content="0;URL=index.php?action=inscription&add=no">';
				}
				else {
					echo '<meta http-equiv="refresh" content="0;URL=index.php?action=connect&add=yes">';
				}
			}
		}
		else{
			echo '<meta http-equiv="refresh" content="0;URL=index.php?action=inscription&complete=no">';
		}
	}
	else{
		echo '<meta http-equiv="refresh" content="0;URL=index.php?action=inscription&complete=no">';
	}
}

elseif(isset($_POST['connect'])){
	if(isset($_POST['pseudo']) && isset($_POST['password'])){
		if(!empty(trim($_POST['pseudo'])) && !empty(trim($_POST['password']))){
			extract($_POST);

			$pseudo = htmlspecialchars($_POST['pseudo']);
			$password = htmlspecialchars($_POST['password']);

			require '../model/UserEntity.php';

			$user = new UserEntity();
			$user->setPseudo($pseudo);
			$user->setPassword($password);

			require '../model/UserEntityManager.php';

			$mdp_crypt = UserEntityManager::Cryptage($user); // Création du mot de pass crypter
			$user->setPassword($mdp_crypt); //Modification du mot de passe dans l'entité

			$connexion = UserEntityManager::connexion($user); // Connexion de l'utilisateur

			if(!empty($connexion)){

				session_start();

				$_SESSION['pseudo'] = $user->getPseudo();
				$_SESSION['pass'] = $user->getPassword();
				$_SESSION['role'] = $connexion['role'];
				$_SESSION['id'] = $connexion['id'];
				
				echo '<meta http-equiv="refresh" content="0;URL=index.php?action=allChapter&connected=ok">';	
			}
			else{ 
				echo '<meta http-equiv="refresh" content="0;URL=index.php?action=connect&good=no">';	
			}	
		}
		else{
			echo '<meta http-equiv="refresh" content="0;URL=index.php?action=connect&complete=no">';
		}		
	}
	else{
		echo '<meta http-equiv="refresh" content="0;URL=index.php?action=connect&complete=no">';
	}	
}

elseif(isset($_POST['search'])){
	if(isset($_POST['pseudoSearch']) && !empty(trim($_POST['pseudoSearch']))){
		extract($_POST);

		$pseudo = $_POST['pseudoSearch'];

		$user->setPseudo($pseudo);

		$User = UserEntityManager::getUser($user);

        if(!empty($User)){
            $user->setPassword($User['password']);
            $user->setId($User['id']);
            $passwordCrypt = UserEntityManager::Cryptage($user);
            $user->setPassword($passwordCrypt);

            $search='ok';
        }
        else{
            echo '<meta http-equiv="refresh" content="0;URL=index.php?action=updateUser&pseudo=no-exist">'; 
        }
	}
}

elseif(isset($_POST['update'])){
	if(isset($_POST['pseudo']) && isset($_POST['password'])){
		if(!empty(trim($_POST['pseudo'])) && !empty(trim($_POST['password']))){
			extract($_POST);
			
			if(!empty($_POST['new_password']) && !empty($_POST['confirmNewPassword']) && $_POST['new_password']!=$_POST['confirmNewPassword']) {
				echo '<meta http-equiv="refresh" content="0;URL=index.php?action=updateUser&mdp=notegal">';
			}
			else{
				if(!empty($_POST['new_password']) && !empty($_POST['confirmNewPassword']) && $_POST['new_password']==$_POST['confirmNewPassword']) {
				$password = htmlspecialchars($_POST['new_password']);
				$ok='ok';
				}			
			
				else{
					$password = htmlspecialchars($_POST['password']);
					$ok = 'ok';
				}

				$pseudo = $_POST['pseudo'];
			
				$getUser = new UserEntity();
				$getUser->setPseudo($pseudo);

				$User = UserEntityManager::getUser($getUser);
				
				
				if(empty($User) || (trim($User['pseudo']) == $user->getPseudo())){ 
					$user->setPseudo($pseudo);
					$user->setPassword($password);

					$mdp_crypt = UserEntityManager::Cryptage($user);
					$user->setPassword($mdp_crypt);


					if($_SESSION['role'] == 'admin'){
						$role = $_POST['role'];
						$user->setRole($role);
					}

					$updateUser = UserEntityManager::updateUser($user);
					if ($updateUser === false) {
						echo '<meta http-equiv="refresh" content="0;URL=index.php?action=updateUser&add=no">';
					}
					else {
						if($_SESSION['role'] == 'admin' && $_SESSION['pseudo'] != $user->getPseudo()){
							echo '<meta http-equiv="refresh" content="0;URL=index.php?action=updateUser&updateUser=yes">';
						}
						else { 
							// Suppression des variables de session et de la session
							$_SESSION = array();
							session_destroy();
							// Suppression des cookies de connexion automatique
							setcookie('login', '');
							setcookie('pass_hache', '');
							echo '<meta http-equiv="refresh" content="0;URL=index.php?action=connect&updateUser=yes">';
						}					
					}
				}
				else { 
					echo '<meta http-equiv="refresh" content="0;URL=index.php?action=updateUser&pseudo=exist">';
				}
			}
		}
		else{
			echo '<meta http-equiv="refresh" content="0;URL=index.php?action=updateUser&complete=no">';
		}
	}
	else{
		echo '<meta http-equiv="refresh" content="0;URL=index.php?action=updateUser&complete=no">';
	}	
}

elseif(isset($_POST['delete'])){
	extract($_POST);

	$pseudo = $_POST['pseudo'];
			
	$user->setPseudo($pseudo);

	$User = UserEntityManager::getUser($user);
	$user->setId($User['id']);

	$deleteUser = UserEntityManager::deleteUser($user);

	if ($deleteUser === false) {
		echo '<meta http-equiv="refresh" content="0;URL=index.php?action=updateUser&deleteUser=no">';
	}
	else {
		echo '<meta http-equiv="refresh" content="0;URL=index.php?action=allChapter&deleteUser=yes">';
	}

}