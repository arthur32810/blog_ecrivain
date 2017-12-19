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

		public function updateChapter($chapter){
			$db = DBManager::dbConnect();

			$updateChapter = $db->prepare('UPDATE chapter SET chapter = :chapter, title = :title, content = :content, update_date = NOW() WHERE id= :id');
			$updateChapter->execute(array(
								'chapter' => $chapter->getChapter(),
								'title' => $chapter->getTitle(),
								'content' => $chapter->getContent(),
								'id' => $chapter->getId()));

			return $updateChapter;
		}

		public static function deleteChapter($chapter){
			$db = DBManager::dbConnect();

			$deletePost = $db->prepare('DELETE FROM chapter WHERE id =?');
			$deletePost->execute(array($chapter->getId()));

			return $deletePost;
		}

		public static function deleteChapterModeration($chapter){
			$db = DBManager::dbConnect();

			$deletePostModeration = $db->prepare('DELETE FROM moderation WHERE chapter_id = ?');
			$deletePostModeration->execute(array($chapter->getId()));

			return $deletePostModeration;
		}
	}