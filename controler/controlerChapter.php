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