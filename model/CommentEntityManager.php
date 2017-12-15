<?php
	require_once 'DBManager.php';

	class CommentEntityManager{
		public static function getAllComment($post){
			$db = DBManager::dbConnect();
			$comments = $db->prepare('SELECT id, user_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin\') 
											AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date');
			$comments->execute(array($post->getId()));			
			
			return $comments;
		}
	}