<?php
		if (!empty($_GET['complete']) && $_GET['complete'] == 'no'){ // Formualire non complet
			?><div class="alert alert-danger" role="alert">
				Tous les champs non pas été rempli
			</div> <?php
	}
	elseif (!empty($_GET['update']) && $_GET['update'] == 'yes'){ // Chapitre mis à jour
			?> <div class="alert alert-success" role="alert">
			  Le Chapitre à été modifié
			</div> <?php
		}
	elseif (!empty($_GET['addComment']) &&$_GET['addComment'] == 'no'){  // Commentaire non ajouté
		?><div class="alert alert-danger" role="alert">
				Le commentaire n'a pas pu être ajouté
			</div> <?php
		}
	elseif (!empty($_GET['addComment']) &&$_GET['addComment'] == 'yes'){ // Commentaire ajouté
			?> <div class="alert alert-success" role="alert">
			 Le commentaire a été ajouté
			</div> <?php
		}
	elseif (!empty($_GET['idComment']) && $_GET['idComment'] == 'no'){ // Commentaire n'existe pas
		?><div class="alert alert-danger" role="alert">
				L'id du commentaire n'existe pas
			</div> <?php
		}
	elseif (!empty($_GET['moderation']) && $_GET['moderation'] == 'exist'){ // Commentaire déjà signalé
		?><div class="alert alert-danger" role="alert">
				Le commentaire à déjà été signalé
			</div> <?php
		}

	elseif (!empty($_GET['updateComment'])){ 
		if($_GET['updateComment'] == 'no'){ // Le commentaire n'a pas pu être mis à jour
			?><div class="alert alert-danger" role="alert">
				Le Commentaire n'a pas pu être  modifié
			</div> <?php
		}
		elseif($_GET['updateComment'] == 'yes'){ // Commentaire mis à jour
			?> <div class="alert alert-success" role="alert">
			  Le Commentaire a été modifié
			</div> <?php
		}	
	}
	
	elseif (!empty($_GET['deleteComment'])){
		if($_GET['deleteComment'] == 'no'){  // Commentaire non supprimé
			?><div class="alert alert-danger" role="alert">
				Le Commentaire n'a pas pu être supprimé
			</div> <?php
		}
		elseif($_GET['deleteComment'] == 'yes'){ // Commentaire supprimé
			?> <div class="alert alert-success" role="alert">
			 Le Commentaire a été supprimé
			</div> <?php
		}	
	}
	elseif(!empty($_GET['addModeration'])){
			if($_GET['addModeration'] == 'yes'){ // Billet de modération ajouté
				?> <div class="alert alert-success" role="alert">
					Le commentaire a bien été signalé
				</div> <?php
			}
			
			elseif($_GET['delete'] == 'no'){ // Commentaire non signalé
				?><div class="alert alert-danger" role="alert">
					Le commentaire n'a pas pu être signalé
				</div> <?php
			}
		}
