<?php
	require_once 'DBManager.php';

	class ModerationEntityManager{
		public function getModerationComment($moderation){
			$db = DBManager::dbConnect();

			$getModeration=$db->prepare('SELECT * FROM moderation WHERE id=?');
			$getModeration->execute(array($moderation->getId_comment()));

			$moderation = $getModeration->fetch();

			return $moderation;
		}

		public static function addModeration($moderation){
			$db = DBManager::dbConnect();

			$addModeration=$db->prepare('INSERT INTO moderation(id_comment, chapter_id, cause, moderation_date) VALUES(:id_comment, :chapterId, :cause, NOW())');
			$addModeration->execute(array(
							'id_comment' => $moderation->getId_comment(),
							'chapterId' => $moderation->getChapterId(), 
							'cause' => $moderation->getCause()));

			return $addModeration;
		}
	}