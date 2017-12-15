<?php
	class Chapter{
		public static function allChapter() {
			session_start();
			require_once '../model/ChapterEntityManager.php';
			$chapters = ChapterEntityManager::getAllChapter();
			return $chapters;
		}

		public  function chapter($id){
			session_start();
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
	}