<?php
	class Chapter{
		public static function allChapter() {
			require_once '../model/ChapterEntityManager.php';
			$chapters = ChapterEntityManager::getAllChapter();
			return $chapters;
		}

		public  function chapter($id){
			require_once '../model/ChapterEntity.php';

			$post = new ChapterEntity();
			$post->setId($id);

			require_once '../model/ChapterEntityManager.php';
			$chapter = ChapterEntityManager::getChapter($post);

			if(!empty($chapter)){
				require_once '../model/CommentEntityManager.php';

				$comments = CommentEntityManager::getAllComment($post);

				return array($chapter, $comments);

			}
			else{ 
				header('Location: index.php?action=allChapter&existPost=no');
			}
		}

		public static function updateWrite($chapterId){

			require '../model/ChapterEntity.php';
		    $chapter = new ChapterEntity();
		    $chapter->setId($chapterId);

		  	require '../model/ChapterEntityManager.php';
		    $Chapter = ChapterEntityManager::getChapter($chapter);

		    if(!empty($Chapter))
		    {
		        return $Chapter;
		    }
		    else{
		    	header('Location: index.php?action=allChapter&existPost=no');
		    }
		}
	}

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

	class Moderation{
		public function Moderation(){		
			require_once '../model/ModerationEntityManager.php';
		    $moderations = ModerationEntityManager::getModerations();

		    return $moderations;
		}
			
	}