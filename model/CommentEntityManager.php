<?php
	require_once 'DBManager.php';

	class CommentEntityManager{
		public static function getAllComment($post){
			$db = DBManager::dbConnect();
			$comments = $db->prepare('SELECT id, user_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin\') 
											AS comment_date_fr FROM comments WHERE chapter_id = ? ORDER BY comment_date');
			$comments->execute(array($post->getId()));			
			
			return $comments;
		}

		public static function getComment($comment)
		{
			$db = DBManager::dbConnect();

			$getComment = $db->prepare('SELECT id, user_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin\') 
											AS comment_date_fr FROM comments WHERE id = ?');
			$getComment->execute(array($comment->getId()));

			$comment = $getComment->fetch();			
			
			return $comment;
		}

		public static function addComment($comment)
		{
			$db = DBManager::dbConnect();
			
			$comments = $db->prepare('INSERT INTO comments(chapter_id, user_id, author, comment, comment_date) VALUES (?, ?, ?, ?, NOW())');
			$affectedLines = $comments->execute(array(
												$comment->getChapterId(),
												$comment->getUserId(),
												$comment->getAuthor(),
												$comment->getComment()));
			
			return $affectedLines;
		}

		public static function updateComment($comment){
			$db = DBManager::dbConnect();

			$updateComment = $db->prepare('UPDATE comments SET comment = :comment, update_date=NOW() WHERE id =:id');
			$updateComment->execute(array('comment'=>$comment->getComment(),
											'id' => $comment->getId()));

			return $updateComment;
		}

		public static function deleteComment($comment){
			$db = DBManager::dbConnect();

			$deleteComment = $db->prepare('DELETE FROM comments WHERE id=?');
			$deleteComment->execute(array($comment->getId()));

			return $deleteComment;
		}

		public function deleteCommentChapter($chapter){
			$db = DBManager::dbConnect();

			$deleteComment = $db->prepare('DELETE FROM comments WHERE chapter_id=?');
			$deleteComment->execute(array($chapter->getId()));

			return $deleteComment;
		}

		public static function deleteCommentModeration($comment){
			$db = DBManager::dbConnect();

			$deleteCommentModeration = $db->prepare('DELETE FROM moderation WHERE id_comment = ?');
			$deleteCommentModeration->execute(array($comment->getId()));

			return $deleteCommentModeration;
		}
	}