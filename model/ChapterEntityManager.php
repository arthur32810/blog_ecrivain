<?php
	require_once 'DBManager.php';

	class ChapterEntityManager{
		public static function getAllChapter(){
			$db = DBManager::dbConnect();
			$req = $db->query('SELECT * FROM chapter ORDER BY chapter');
			return $req;
		}

		public static function getChapter($chapter){
			$db = DBManager::dbConnect();
			$req = $db->prepare('SELECT id, chapter, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y\') 
								 AS creation_date_fr FROM chapter WHERE id = ? OR chapter = ?');
			$req->execute(array($chapter->getId(), $chapter->getChapter()));
			$chapter = $req->fetch();
			return $chapter;
		}

		public static function createChapter($chapter){
			$db = DBManager::dbConnect();

			$addPost = $db->prepare('INSERT INTO chapter (chapter, title, content, creation_date) VALUES (:chapter, :title, :content, NOW())');
			$addPost->execute(array(
							'chapter' => $chapter->getChapter(),
							'title' => $chapter->getTitle(),
							'content' => $chapter->getContent()));
			return $addPost;
		}
	}