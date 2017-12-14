<?php
	class Chapter{
		public static function allChapter() {
			require '../model/ChapterEntityManager.php';
			$chapters = ChapterEntityManager::getAllChapter();
			return $chapters;
		}
	}