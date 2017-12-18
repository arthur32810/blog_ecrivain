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
			echo '<meta http-equiv="refresh" content="0;URL=index.php?action=write_chapter&complete=no">';
		}
	}
	else{
		echo '<meta http-equiv="refresh" content="0;URL=index.php?action=write_chapter&complete=no">';
	}
}

elseif(isset($_POST['update'])){
	if(isset($_POST['chapter']) && isset($_POST['title']) && isset($_POST['content'])){
		if(!empty(trim($_POST['chapter'])) && !empty(trim($_POST['title'])) && !empty(trim($_POST['content']))){
			extract($_POST);

			$nChapter = $_POST['chapter'];
			$title = $_POST['title'];
			$content = $_POST['content'];

			require_once '../model/ChapterEntity.php';
			$chapter = new ChapterEntity();
			$chapter->setId($chapterId);
			$chapter->setChapter($nChapter);
			$chapter->setTitle($title);
			$chapter->setContent($content);

			require_once '../model/ChapterEntityManager.php';
			$existChapter = ChapterEntityManager::getChapter($chapter);

			if(!empty($existChapter)){ 
				echo "ok";
				$updateChapter = ChapterEntityManager::updateChapter($chapter);
				if ($updateChapter === false) {
					echo '<meta http-equiv="refresh" content="0;URL=index.php?action=allChapter&update=no">'; 
				}
				else {
					echo '<meta http-equiv="refresh" content="0;URL=index.php?action=chapter&id='.$chapterId.'&update=yes">'; 
				}

			}
			else{
				echo '<meta http-equiv="refresh" content="0;URL=index.php?action=allChapter&existPost=no">'; 
			}
		}
		else{ 
			echo '<meta http-equiv="refresh" content="0;URL=index.php?action=update_chapter&complete=no">'; 
		}
	}
	else{ 
		echo '<meta http-equiv="refresh" content="0;URL=index.php?action=update_chapter&complete=no">'; 
	}
}

elseif(isset($_POST['delete'])){
	if(isset($_POST['chapter']) && isset($_POST['title']) && isset($_POST['content'])){
		if(!empty(trim($_POST['chapter'])) && !empty(trim($_POST['title'])) && !empty(trim($_POST['content']))){
			extract($_POST);

			require_once '../model/ChapterEntity.php';
			$chapter = new ChapterEntity();
			$chapter->setId($chapterId);

			require_once '../model/ChapterEntityManager.php';
			$existChapter = ChapterEntityManager::getChapter($chapter);

			if(!empty($existChapter)){ 
				$deleteChapter = ChapterEntityManager::deleteChapter($chapter);
				if ($deleteChapter === false) {
					echo '<meta http-equiv="refresh" content="0;URL=index.php?action=allChapter&delete=no">';
				}
				else {
					require_once '../model/CommentEntityManager.php';

					$deleteComment = CommentEntityManager::deleteCommentChapter($chapter);
					$deletePostModeration = $PostEntityManager::deletePostModeration($chapter);
				    
				    /*if ($deleteComment === false) {
				    	echo '<meta http-equiv="refresh" content="0;URL=index.php?action=allChapter&delete=no">';
					}
					else{
						echo '<meta http-equiv="refresh" content="0;URL=index.php?action=allChapter&delete=yes">';
					}*/
				}
			}
			else{
				echo '<meta http-equiv="refresh" content="0;URL=index.php?action=allChapter&existPost=no">'; 
			}
		}
		else{ 
			echo '<meta http-equiv="refresh" content="0;URL=index.php?action=update_chapter&complete=no">'; 
		}
	}
	else{ 
		echo '<meta http-equiv="refresh" content="0;URL=index.php?action=update_chapter&complete=no">'; 
	}
}