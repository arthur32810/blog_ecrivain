<?php

require 'Controler.php';

	if(isset($_GET['action'])){
		if($_GET['action'] == 'allChapter'){ // Demande tous les chapitres
			$chapters = Chapter::allChapter();
			require '../view/ChaptersView.php';
		}
		elseif ($_GET['action'] == 'chapter'){ // Demande le chapitre $_GET['id'];
			if (isset($_GET['id']) && $_GET['id'] > 0) {
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

		// Espace Membres 

		elseif ($_GET['action'] == 'connect'){ // Demande de connexion

			require '../view/userConnexion.php';
		}
		elseif ($_GET['action'] == 'deconnexion'){ // Demande de deconnexion
			User::deconnexion();
		}
		elseif ($_GET['action'] == 'inscription'){
			require('../view/userInscription.php');
		}
		elseif($_GET['action'] == 'updateUser'){ // Modification d'un utilisateur
			session_start();

			if (!isset($_SESSION['pseudo']))
			{
				//On n'est pas connecté
				header('Location: index.php?action=allChapter&connected=no');
				exit();
			}
			else{ 
				$user = User::updateUser();
				require('../view/userUpdate.php');
			}
		}

		//Ecriture d'un chapitre 
		elseif($_GET['action'] == 'write_post'){
			session_start();

			if (!isset($_SESSION['pseudo']))
			{
				//On n'est pas connecté
				header('Location: index.php?action=connect');
				exit();
			}
			elseif($_SESSION['role'] == 'author'){ 
        		require('../view/writePost.php');
			}
			else { 
				header('Location: index.php?action=allChapter&right=no');
			}

		}
	}
	else{
		$chapters = Chapter::allChapter();
		require '../view/ChaptersView.php';
	}