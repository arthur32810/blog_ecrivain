<?php
if(isset($_POST['add'])){
	if(isset($_POST['pseudo']) && isset($_POST['password'])){
		if(!empty(trim($_POST['pseudo'])) && !empty(trim($_POST['password']))){
			extract($_POST);

			$pseudo = htmlspecialchars($_POST['pseudo']);
			$password = htmlspecialchars($_POST['password']);

			$user = new UserEntity();
			$user->setPseudo($pseudo);
			$user->setPassword($password);

			$userManager = new Arthur\WriterBlog\Model\UserEntityManager();
			$existUser = $userManager->getUser($user);

			if(!empty($existUser)){
				echo '<meta http-equiv="refresh" content="0;URL=index.php?action=inscription&user=exist">';
			}
			else{
				$mdp_crypt = $userManager->Cryptage($user); // Création du mot de pass crypter

				$user->setPassword($mdp_crypt); //Modification du mot de passe dans l'entité

				$addUser = $userManager->addUser($user); 

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

if(isset($_POST['connect'])){
	if(isset($_POST['pseudo']) && isset($_POST['password'])){
		if(!empty(trim($_POST['pseudo'])) && !empty(trim($_POST['password']))){
			extract($_POST);

			$pseudo = htmlspecialchars($_POST['pseudo']);
			$password = htmlspecialchars($_POST['password']);

			$user = new UserEntity();
			$user->setPseudo($pseudo);
			$user->setPassword($password);

			$userManager = new Arthur\WriterBlog\Model\UserEntityManager();

			$mdp_crypt = $userManager->Cryptage($user); // Création du mot de pass crypter
			$user->setPassword($mdp_crypt); //Modification du mot de passe dans l'entité

			$connexion = $userManager->connexion($user); // Connexion de l'utilisateur

			if(!empty($connexion)){
				session_start();

				$_SESSION['pseudo'] = $user->getPseudo();
				$_SESSION['pass'] = $user->getPassword();
				$_SESSION['role'] = $connexion['role'];
				$_SESSION['id'] = $connexion['id'];

				if(!empty($_POST['cookie']))
					{
						setcookie('pseudo', $_SESSION['pseudo'], time() + 30*24*3600, null, null, false, true);
						setcookie('pass', $_SESSION['pass'], time() + 30*24*3600, null, null, false, true); 
					}
				
				echo '<meta http-equiv="refresh" content="0;URL=index.php?action=listPosts&connected=ok">';	
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

if(isset($_POST['search'])){
	if(isset($_POST['pseudoSearch']) && !empty(trim($_POST['pseudoSearch']))){
		extract($_POST);

		$pseudo = $_POST['pseudoSearch'];

		$user->setPseudo($pseudo);

		$userManager = new Arthur\WriterBlog\Model\UserEntityManager();
        $existUser = $userManager->getUser($user);

        if(!empty($existUser)){
            $user->setPassword($existUser['password']);
            $user->setId($existUser['id']);
            $passwordCrypt = $userManager->Cryptage($user);
            $user->setPassword($passwordCrypt);

            $search='ok';
        }
        else{
            echo '<meta http-equiv="refresh" content="0;URL=index.php?action=updateUser&pseudo=no-exist">'; 
        }
	}
}

if(isset($_POST['update'])){
	if(isset($_POST['pseudo']) && isset($_POST['password'])){
		if(!empty(trim($_POST['pseudo'])) && !empty(trim($_POST['password']))){
			extract($_POST);

			
			
			if(!empty($_POST['new_password']) && !empty($_POST['confirmNewPassword']) && $_POST['new_password']==$_POST['confirmNewPassword']) {
				$password = htmlspecialchars($_POST['new_password']);
			}
			else{
				$password = htmlspecialchars($_POST['password']);
			}

			$pseudo = $_POST['pseudo'];
			
			$user->setPseudo($pseudo);
			$user->setPassword($password);

			$mdp_crypt = $userManager->Cryptage($user);
			$user->setPassword($mdp_crypt);

			if($_SESSION['role'] == 'admin'){
				$role = $_POST['role'];
				$user->setRole($role);
			}
			else{
				$role = $existUser['role']; 
				$user->setRole($role);
			}

			$existUser = $userManager->getUser($user);

			if(!empty($existUser)){ 
				$updateUser = $userManager->updateUser($user);

				if ($updateUser === false) {
					echo '<meta http-equiv="refresh" content="0;URL=index.php?action=updateUser&add=no">';
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
			else { 
				echo '<meta http-equiv="refresh" content="0;URL=index.php?action=updateUser&pseudo=exist">';
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

if(isset($_POST['delete'])){
	extract($_POST);

	$userId = $existUser['id'];

	$user->setId($userId);

	$userManager = new Arthur\WriterBlog\Model\UserEntityManager();

	$deleteUser = $userManager->deleteUser($user);

	if ($deleteUser === false) {
		echo '<meta http-equiv="refresh" content="0;URL=index.php?action=updateUser&deleteUser=no">';
	}
	else {
		echo '<meta http-equiv="refresh" content="0;URL=index.php?action=listPosts&deleteUser=yes">';
	}

}