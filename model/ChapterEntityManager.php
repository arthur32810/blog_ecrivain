<?php
	require_once 'DBManager.php';

	class ChapterEntityManager{
		public static function getAllChapter(){
			$db = DBManager::dbConnect();
			$req = $db->query('SELECT * FROM chapter ORDER BY chapter');
			return $req;
		}

		public static function getChapter($post){
			$db = DBManager::dbConnect();
			$req = $db->prepare('SELECT id, chapter, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y\') 
								 AS creation_date_fr FROM chapter WHERE id = ? OR chapter = ?');
			$req->execute(array($post->getId(), $post->getChapter()));
			$post = $req->fetch();
			return $post;
		}
	}