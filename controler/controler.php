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