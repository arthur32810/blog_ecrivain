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
	}

	class User{
		public static function connect(){
	        session_start();

	        if(!empty($_COOKIE['pseudo'])){
	             $pseudo = $_COOKIE['pseudo'];} 
	        else {$pseudo='';} 
	                    
	        if(!empty($_COOKIE['pass'])){ 
	            $password = $_COOKIE['pass'];} 
	        else{$password='';} 

	        return array($pseudo, $password);
	    }
	}