<?php

require 'Controler.php';

	if(isset($_GET['action'])){
		if($_GET['action'] == 'allChapter'){
			$chapters = Chapter::allChapter();
			require '../view/ChaptersView.php';
		}
		elseif ($_GET['action'] == 'post'){ // Demande le chapitre $_GET['id'];
			if (isset($_GET['id']) && $_GET['id'] > 0) {
				$id = $_GET['id'];
				$chapter = Chapter::Chapter($id);
			}
			else {
				header('Location: index.php?action=allChapter&existPost=no');
			}
		}
	}