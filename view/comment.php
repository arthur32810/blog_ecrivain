<?php
if(isset($_POST['add'])){
	if(isset($_POST['comment'])){
		if(!empty(trim($_POST['comment']))){
			extract($_POST);

			$comment = $_POST['comment'];
			$chapterId = htmlspecialchars($_GET['id']);

			require_once '../model/CommentEntity.php';
			$addComment = new CommentEntity();
			$addComment->setChapterId($chapterId);
			$addComment->setUserId($_SESSION['id']);
			$addComment->setAuthor($_SESSION['pseudo']);
			$addComment->setComment($comment);

			require_once '../model/CommentEntityManager.php';
			$addComment = CommentEntityManager::addComment($addComment);

			 if ($addComment === false) {
	            echo '<meta http-equiv="refresh" content="0;URL=index.php?action=chapter&id='.$_GET['id'].'&addComment=no">';
	        }
	        else {
	        	echo '<meta http-equiv="refresh" content="0;URL=index.php?action=chapter&id='.$_GET['id'].'&addComment=yes">';
	        }	
		}
		else{ 
			echo '<meta http-equiv="refresh" content="0;URL=index.php?action=chapter&id='.$_GET['id'].'&complete=no">';
		}
	}
}

elseif(isset($_POST['update'])){
	if(isset($_POST['comment'])){
		if(!empty(trim($_POST['comment']))){
			extract($_POST);

			$commentId = $_POST['commentId'];
			$comment = htmlspecialchars($_POST['comment']);
			$chapterId = htmlspecialchars($_GET['id']);

			require_once '../model/CommentEntity.php';
			$setComment = new CommentEntity();
			$setComment->setId($commentId);
			$setComment->setComment($comment);

			require_once '../model/CommentEntityManager.php';
			$existComment = CommentEntityManager::getComment($setComment);

			if(!empty($existComment)){
				 
				$updateComment = CommentEntityManager::updateComment($setComment); //Mise à jour du commentaire
				
				if ($updateComment === false) {
					echo '<meta http-equiv="refresh" content="0;URL=index.php?action=chapter&id='.$chapterId.'&updateComment=no">';
			    }
			    else {
			    	echo '<meta http-equiv="refresh" content="0;URL=index.php?action=chapter&id='.$chapterId.'&updateComment=yes">';
			    }
			
			}
			else{
	        	echo '<meta http-equiv="refresh" content="0;URL=index.php?action=chapter&id='.$chapterId.'&idComment=no">';
	        }
			
		}
	}
}

elseif(isset($_POST['delete'])){
		extract($_POST);

		$commentId = htmlspecialchars($_POST['commentId']);
		$postId = htmlspecialchars($_GET['id']);

		$comment = new CommentEntity();
		$comment->setId($commentId);

		$commentManager = new Arthur\WriterBlog\Model\CommentEntityManager(); // Test si commentaire existe
		$existComment = $commentManager->getComment($comment);

		$deleteComment = $commentManager->deleteComment($comment);
		$deleteModeration = $commentManager->deleteCommentModeration($comment);

		if(!empty($existComment)){
			if ($deleteComment === false) {
			 	echo '<meta http-equiv="refresh" content="0;URL=index.php?action=post&id='.$postId.'&deleteComment=no">';
		    }
		    else {
		    	echo '<meta http-equiv="refresh" content="0;URL=index.php?action=post&id='.$postId.'&deleteComment=yes">';
		    }
		}
		else{
        	echo '<meta http-equiv="refresh" content="0;URL=index.php?action=post&id='.$postId.'&idComment=no">';
        }
}