<?php
	require 'DBManager.php';

	class ChapterEntityManager{
		public static function getAllChapter(){
			$db = DBManager::dbConnect();
			$req = $db->query('SELECT * FROM chapter');
			return $req;
		}
	}