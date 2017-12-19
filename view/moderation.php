<?php
if(isset($_POST['addModeration'])){
	if(isset($_POST['cause'])){
		if(!empty(trim($_POST['cause']))){
			extract($_POST);

			$cause = htmlspecialchars($_POST['cause']);
			$commentId = htmlspecialchars($_POST['commentId']);
			$chapterId = $_GET['id'];

			require_once '../Model/ModerationEntity.php';
			$moderation = new ModerationEntity(); 
			$moderation->setId_comment($commentId);
			$moderation->setChapterId($chapterId);
			$moderation->setCause($cause);

			require '../model/ModerationEntityManager.php';
			$existModeration = ModerationEntityManager::getModerationComment($moderation);

			if(!empty($existModeration)){
				echo '<meta http-equiv="refresh" content="0;URL=index.php?action=chapter&id='.$chapterId.'&moderation=exist">';			
			}
			else{
				$addModeration = ModerationEntityManager::addModeration($moderation);
				if ($addModeration === false) {
					echo '<meta http-equiv="refresh" content="0;URL=index.php?action=chapter&id='.$chapterId.'&addModeration=no">';
		        }
		        else {
		        	echo '<meta http-equiv="refresh" content="0;URL=index.php?action=chapter&id='.$chapterId.'&addModeration=yes">';
		        }
				
		    }
		}
	}
}

if(isset($_POST['ignoreModeration'])){
	if(isset($_POST['moderationId']) && !empty(trim($_POST['moderationId']))){
		extract($_POST);

		$moderationId = $_POST['moderationId'];

		require_once '../model/ModerationEntity.php';
		$moderation = new ModerationEntity();
		$moderation->setId($moderationId);

		require_once '../model/ModerationEntityManager.php';
		$existModeration = ModerationEntityManager::getModeration($moderation);

		if(!empty($existModeration)){
			$deleteModeration = ModerationEntityManager::deleteModeration($moderation);

			if ($deleteModeration === false) {
	    		echo '<meta http-equiv="refresh" content="0;URL=index.php?action=moderation&deleteModeration=no">';  
	        }
	        else {
	        	echo '<meta http-equiv="refresh" content="0;URL=index.php?action=moderation&ignoreModeration=yes">';
	        }
		}
		else{
			echo '<meta http-equiv="refresh" content="0;URL=index.php?moderation&existModeration=no">';  
		}
	}
	
}

if(isset($_POST['updateModeration'])){
	if(isset($_POST['comment']) && !empty(trim($_POST['comment']))){
		extract($_POST);

		$chapterId = $chapter['id'];
		$commentId = $_POST['commentId'];
		$moderationId = $_POST['moderationId'];
		$comment = htmlspecialchars($_POST['comment']);


		require_once '../model/CommentEntity.php';
		$setComment = new CommentEntity();
		$setComment->setId($commentId);
		$setComment->setComment($comment);

		require_once '../model/CommentEntityManager.php';
		$existComment = CommentEntityManager::getComment($setComment);

		if(!empty($existComment)){
			require_once '../model/ModerationEntity.php';
			$moderation = new ModerationEntity();
			$moderation->setId($moderationId);

			require_once '../model/ModerationEntityManager.php';
			$existModeration = ModerationEntityManager::getModeration($moderation);

			if(!empty($existModeration)){

				require_once '../model/CommentEntityManager.php';
				$updateComment = CommentEntityManager::updateComment($setComment);

				if ($updateComment === false) {
					echo '<meta http-equiv="refresh" content="0;URL=index.php?action=chapter&id='.$chapterId.'&updateComment=no">';  
			    }
			    else {
			    	$deleteModeration = ModerationEntityManager::deleteModeration($moderation); //Suppression du billet de modération
			    	if ($deleteModeration === false) {
			    		echo '<meta http-equiv="refresh" content="0;URL=index.php?action=moderation&deleteModeration=no">';  
			        }
			        else {
			        	echo '<meta http-equiv="refresh" content="0;URL=index.php?action=moderation&deleteModeration=yes&updateComment=yes">';
			        }
			    }
			}
           	else{
           		echo '<meta http-equiv="refresh" content="0;URL=index.php?moderation&existModeration=no">';  
           	}
			
		}
        else{
        	echo '<meta http-equiv="refresh" content="0;URL=index.php?action=chapter&id='.$chapterId.'&idComment=no">';  
        }

		
	}
	else{
		
	}
}

if(isset($_POST['deleteModeration'])){
	extract($_POST);

	$postId = $post['id'];
	$commentId = htmlspecialchars($_POST['commentId']);
	$moderationId = htmlspecialchars($_POST['moderationId']);

	$post = new PostEntity();
	$post->setId($postId);

	$postManager = new Arthur\WriterBlog\Model\PostEntityManager(); // test si le post existe
	$existPost = $postManager->getPost($post);

	if(!empty($existPost)){
		$comment = new CommentEntity();
		$comment->setId($commentId);

		$commentManager = new  Arthur\WriterBlog\Model\CommentEntityManager(); // Test si le commentaire existe
		$existComment = $commentManager->getComment($comment);

		if(!empty($existComment)){
			$moderation = new ModerationEntity();
			$moderation->setId($moderationId);

			$moderationManager = new Arthur\WriterBlog\Model\ModerationEntityManager(); // Test si le billet de moderation existe
			$existModeration = $moderationManager->getModeration($moderation);

			if(!empty($existModeration)){
				$deleteComment = $commentManager->deleteComment($comment); // Suppression du commentaire
				if ($deleteComment === false) {
					echo '<meta http-equiv="refresh" content="0;URL=index.php?action=post&id='.$postId.'&deleteComment=no">';
		        }
		        else{
		        	$deleteModeration = $moderationManager->deleteModeration($moderation); // Suppression du billet de modération
		        	if ($updateComment === false) {
		        		echo '<meta http-equiv="refresh" content="0;URL=index.php?action=moderation&deleteModeration=no">';
	                }
	                else {
	                	echo '<meta http-equiv="refresh" content="0;URL=index.php?action=moderation&deleteModeration=yes&deleteComment=yes">';
	                }
				}
			}
           	else{
           		echo '<meta http-equiv="refresh" content="0;URL=index.php?action=moderation&existModeration=no">';
           	} 
		}
        else{
        	echo '<meta http-equiv="refresh" content="0;URL=index.php?action=post&id='.$postId.'&idComment=no">';
        }
	}
	else{
		echo '<meta http-equiv="refresh" content="0;URL=index.php?action=listPosts&existPost=no">'; 
	}
	
}