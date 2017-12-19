<?php
	class User{

	    public static function deconnexion(){
	    	session_start();
	        // Suppression des variables de session et de la session
	        $_SESSION = array();
	        session_destroy();

	        // Suppression des cookies de connexion automatique
	        setcookie('login', '');
	        setcookie('pass_hache', '');

	        header('Location: index.php?action=allChapter&deconnected=yes');
	    }

	    public static function updateUser(){
	    
	        $pseudo = $_SESSION['pseudo']; 

	        require_once '../model/UserEntity.php';
	        $user = new UserEntity();
	        $user->setPseudo($pseudo);

	        require_once '../model/UserEntityManager.php';
	        $User = UserEntityManager::getUser($user);

	        if(!empty($User)){
	            $user->setPassword($User['password']);
	            $user->setId($User['id']);
	            $user->setRole($User['role']);
	            $passwordCrypt = UserEntityManager::Cryptage($user);
	            $user->setPassword($passwordCrypt);

	            return $user;
	        }
	        else{
	            echo '<meta http-equiv="refresh" content="0;URL=index.php?action=updateUser&pseudo=no-exist">'; 
	        }
	    }
	}