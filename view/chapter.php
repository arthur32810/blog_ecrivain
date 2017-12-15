<?php
if(isset($_POST['add'])){
	if(isset($_POST['chapter']) && isset($_POST['title']) && isset($_POST['content'])){
		if(!empty(trim($_POST['chapter'])) && !empty(trim($_POST['title'])) && !empty(trim($_POST['content']))){
			extract($_POST);

			$nChapter = htmlspecialchars($_POST['chapter']);
			$title = htmlspecialchars($_POST['title']);
			$content = htmlspecialchars($_POST['content']);

			require_once '../model/ChapterEntity.php';
			$chapter = new ChapterEntity(); // Instance de la classe PostEntity
			$chapter->setChapter($nChapter);
			$chapter->setTitle($title);
			$chapter->setContent($content);

			require_once '../model/ChapterEntityManager.php';
			$Chapter = ChapterEntityManager::getChapter($chapter); //Test si le chapitre existe

			if(!empty($Chapter)){ //Chapitre existe, on redirige 
				echo '<meta http-equiv="refresh" content="0;URL=index.php?action=update_chapter&postId='.$Chapter['id'].'&chapter=exist">';
		    }

		    else{ //il n'existe pas, on continue
		    	$createPost = ChapterEntityManager::createChapter($chapter);

			    if ($createPost === false) {
			    	echo '<meta http-equiv="refresh" content="0;URL=index.php?action=write_chapter&create=no">';
			    }
			    else {
			    	echo '<meta http-equiv="refresh" content="0;URL=index.php?action=allChapter&create=yes">';
				}

			}
		}
		else{
			echo '<meta http-equiv="refresh" content="0;URL=index.php?action=write_post&complete=no">';
		}
	}
	else{
		echo '<meta http-equiv="refresh" content="0;URL=index.php?action=write_post&complete=no">';
	}
}

elseif(isset($_POST['update'])){
	if(isset($_POST['chapter']) && isset($_POST['title']) && isset($_POST['content'])){
		if(!empty(trim($_POST['chapter'])) && !empty(trim($_POST['title'])) && !empty(trim($_POST['content']))){
			extract($_POST);

			$chapter = $_POST['chapter'];
			$title = $_POST['title'];
			$content = $_POST['content'];
			$postId = $post['id'];

			$post = new PostEntity();
			$post->setId($postId);
			$post->setChapter($chapter);
			$post->setTitle($title);
			$post->setContent($content);

			$postManager = new Arthur\WriterBlog\Model\PostEntityManager();
			$existPost = $postManager->getPost($post);

			if(!empty($existPost)){ 
				$updatePost = $postManager->updatePost($post);
				if ($updatePost === false) {
					echo '<meta http-equiv="refresh" content="0;URL=index.php?action=listPosts&update=no">'; 
				}
				else {
					echo '<meta http-equiv="refresh" content="0;URL=index.php?action=post&id='.$postId.'&update=yes">'; 
				}

			}
			else{
				echo '<meta http-equiv="refresh" content="0;URL=index.php?action=listPosts&existPost=no">'; 
			}
		}
		else{ 
			echo '<meta http-equiv="refresh" content="0;URL=index.php?action=update_post&complete=no">'; 
		}
	}
	else{ 
		echo '<meta http-equiv="refresh" content="0;URL=index.php?action=update_post&complete=no">'; 
	}
}

elseif(isset($_POST['delete'])){
	if(isset($_POST['chapter']) && isset($_POST['title']) && isset($_POST['content'])){
		if(!empty(trim($_POST['chapter'])) && !empty(trim($_POST['title'])) && !empty(trim($_POST['content']))){
			extract($_POST);

			$postId = $post['id'];

			$post = new PostEntity();
			$post->setId($postId);

			$postManager = new Arthur\WriterBlog\Model\PostEntityManager();
			$existPost = $postManager->getPost($post);

			if(!empty($existPost)){ 

				$deletePost = $postManager->deletePost($post);
				if ($deletePost === false) {
					echo '<meta http-equiv="refresh" content="0;URL=index.php?action=listPosts&delete=no">';
				}
				else {
					$commentManager = new Arthur\WriterBlog\Model\CommentEntityManager();

					$deleteComment = $commentManager->deleteCommentChapter($post);
					$deletePostModeration = $postManager->deletePostModeration($post);
				    
				    if ($deleteComment === false) {
				    	echo '<meta http-equiv="refresh" content="0;URL=index.php?action=listPosts&delete=no">';
					}
					else{
						echo '<meta http-equiv="refresh" content="0;URL=index.php?action=listPosts&delete=yes">';
					}
				}
			}
			else{
				echo '<meta http-equiv="refresh" content="0;URL=index.php?action=listPosts&existPost=no">'; 
			}
		}
		else{ 
			echo '<meta http-equiv="refresh" content="0;URL=index.php?action=update_post&complete=no">'; 
		}
	}
	else{ 
		echo '<meta http-equiv="refresh" content="0;URL=index.php?action=update_post&complete=no">'; 
	}
}