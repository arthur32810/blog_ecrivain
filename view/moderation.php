<?php
if(isset($_POST['addModeration'])){
	if(isset($_POST['cause'])){
		if(!empty(trim($_POST['cause']))){
			extract($_POST);

			$cause = htmlspecialchars($_POST['cause']);
			$commentId = htmlspecialchars($_POST['commentId']);
			$postId = $_GET['id'];

			$moderation = new ModerationEntity(); 
			$moderation->setId_comment($commentId);
			$moderation->setPost_id($postId);
			$moderation->setCause($cause);

			$moderationManager = new Arthur\WriterBlog\Model\ModerationEntityManager();

			$existModeration = $moderationManager->getModerationComment($moderation);

			if(!empty($existModeration)){
				$addModeration = $moderationManager->addModeration($moderation);
				if ($addModeration === false) {
					echo '<meta http-equiv="refresh" content="0;URL=index.php?action=post&id='.$postId.'&addModeration=no">';
		        }
		        else {
		        	echo '<meta http-equiv="refresh" content="0;URL=index.php?action=post&id='.$postId.'&addModeration=yes">';
		        }
				
				
			}
			else{
				echo '<meta http-equiv="refresh" content="0;URL=index.php?action=post&id='.$postId.'&moderation=exist">';
		    }
		}
	}
}

if(isset($_POST['ignoreModeration'])){
	if(isset($_POST['moderationId']) && !empty(trim($_POST['moderationId']))){
		extract($_POST);

		$moderationId = $_POST['moderationId'];

		$moderation = new ModerationEntity();
		$moderation->setId($moderationId);

		$moderationManager = new Arthur\WriterBlog\Model\ModerationEntityManager(); //Test si billet de modération existe
		$existModeration = $moderationManager->getModeration($moderation);

		if(!empty($existModeration)){
			$deleteModeration = $moderationManager->deleteModeration($moderation);

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

		$postId = $post['id'];
		$commentId = $_POST['commentId'];
		$moderationId = $_POST['moderationId'];
		$comment = htmlspecialchars($_POST['comment']);



		$setComment = new CommentEntity();
		$setComment->setId($commentId);
		$setComment->setComment($comment);

		$commentManager = new Arthur\WriterBlog\Model\CommentEntityManager(); // Test si commentaire existe
		$existComment = $commentManager->getComment($setComment);

		if(!empty($existComment)){
			$moderation = new ModerationEntity();
			$moderation->setId($moderationId);

			$moderationManager = new Arthur\WriterBlog\Model\ModerationEntityManager(); //Test si billet de modération existe
			$existModeration = $moderationManager->getModeration($moderation);

			if(!empty($existModeration)){
				$commentManager = new Arthur\WriterBlog\Model\CommentEntityManager(); // Mise à jour du commentaire
				$updateComment = $commentManager->updateComment($setComment);

				if ($updateComment === false) {
					echo '<meta http-equiv="refresh" content="0;URL=index.php?action=post&id='.$postId.'&updateComment=no">';  
			    }
			    else {
			    	$deleteModeration = $moderationManager->deleteModeration($moderation); //Suppression du billet de modération
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
        	echo '<meta http-equiv="refresh" content="0;URL=index.php?action=post&id='.$postId.'&idComment=no">';  
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