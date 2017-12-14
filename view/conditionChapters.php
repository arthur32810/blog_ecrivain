
<?php if (!empty($_GET['create']) && $_GET['create'] == 'yes'){
			?> <div class="alert alert-success" role="alert">
			  Le Chapitre à été ajouté
			</div> <?php
			}
		if (!empty($_GET['right']) && $_GET['right'] == 'no'){
			?><div class="alert alert-danger" role="alert">
				Vous n'avez pas le droit de voir cette page
			</div> <?php
				
			}
		elseif (!empty($_GET['existPost']) &&$_GET['existPost'] == 'no'){
			?><div class="alert alert-danger" role="alert">
				Le chapitre n'existe pas
			</div> <?php	
		}

		elseif (!empty($_GET['update']) &&$_GET['create'] == 'no'){
			?><div class="alert alert-danger" role="alert">
				Le chapitre n'a pas pu être modifié
			</div> <?php
		}
		elseif(!empty($_GET['delete'])){
			if($_GET['delete'] == 'yes'){
				?> <div class="alert alert-success" role="alert">
				  Le Chapitre et les commentaires associé ont été supprimé
				</div> <?php
			}
			elseif($_GET['delete'] == 'no'){
				?><div class="alert alert-danger" role="alert">
					Le chapitre ou les commentaires associé n'ont pas pu être supprimé
				</div> <?php
			}
		}

		
		elseif (!empty($_GET['deleteUser']) && $_GET['deleteUser'] == 'yes'){
			?> <div class="alert alert-success" role="alert">
			 Votre profil a bien été supprimé
			</div> <?php

		}
		elseif (!empty($_GET['connected']) && $_GET['connected'] == 'no'){
			?><div class="alert alert-danger" role="alert">
				Vous n'avez pas le droit d'accéder à cette page
			</div> <?php
		}

		elseif(!empty($_GET['connected']) && $_GET['connected'] == 'ok'){
			?> <div class="alert alert-success" role="alert">
			 	Vous êtes connecté
			</div> <?php
		}
		elseif(!empty($_GET['deconnected']) && $_GET['deconnected'] == 'yes'){
			?> <div class="alert alert-success" role="alert">
			 	Vous êtes déconnecté
			</div> <?php
		}