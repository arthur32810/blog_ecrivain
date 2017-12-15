<?php

require 'Controler.php';

	if(isset($_GET['action'])){
		if($_GET['action'] == 'allChapter'){ // Demande tous les chapitres
			session_start();
			$chapters = Chapter::allChapter();
			require '../view/ChaptersView.php';
		}
		elseif ($_GET['action'] == 'chapter'){ // Demande le chapitre $_GET['id'];
			if (isset($_GET['id']) && $_GET['id'] > 0) {
				session_start();
				$id = $_GET['id'];
				$Chapter = new Chapter($id);
				$chapter = $Chapter->chapter($id);
				list($chapter, $comments) = $chapter;
				require '../view/ChapterView.php';
			}
			else {
				header('Location: index.php?action=allChapter&existPost=no');
			}
		}
		elseif ($_GET['action'] == 'connect'){ // Demande de connection

			$connexion = User::connect();
			list($pseudo, $password) = $connexion;
			require '../view/userConnexion.php';
		}
	}
	else{
		$chapters = Chapter::allChapter();
		require '../view/ChaptersView.php';
	}