<?php $title="Modification d'un profil"; ?>
<?php ob_start(); 

	if (!empty($_GET['complete']) && $_GET['complete'] == 'no'){
				?><div class="alert alert-danger" role="alert">
					Les informations ne sont pas complétes
				</div> <?php
			} 
	elseif (!empty($_GET['add']) && $_GET['add'] == 'no'){
				?><div class="alert alert-danger" role="alert">
					Votre profil n'a pas pu être mis à jour
				</div> <?php
		}
	elseif (!empty($_GET['deleteUser']) && $_GET['deleteUser'] == 'no'){
				?><div class="alert alert-danger" role="alert">
					Votre profil n'a pas pu être supprimé
				</div> <?php
		}
	elseif (!empty($_GET['pseudo']) && $_GET['pseudo'] == 'exist'){
			?><div class="alert alert-danger" role="alert">
					Le pseudo choisi existe déjà
				</div> <?php
	}
	elseif($_SESSION['role'] == 'admin' && !empty($_GET['pseudo']) && $_GET['pseudo'] == 'no-exist') {
			?><div class="alert alert-danger" role="alert">
					Le pseudo choisi n'existe pas
			</div> <?php
	}
	elseif (!empty($_GET['updateUser']) && $_GET['updateUser'] == 'yes'){ // Utilisateur bien mis à jour
		?> <div class="alert alert-success" role="alert">
		  Le profil utilisateur a été mis à jour
		</div> <?php
	}
	elseif (!empty($_GET['mdp']) && $_GET['mdp'] == 'notegal'){ // Utilisateur bien mis à jour
		?> <div class="alert alert-danger" role="alert">
		 	Les nouveaux mots de passe ne sont pas identiques
		</div> <?php
	}

?>

<h1> Modification de votre profil utilisateur </h1>

<?php 	if($_SESSION['role'] == 'admin' && !isset($_GET['require_admin'])){ ?>  <!-- Recherche d'un utilisateur en mode Admin -->

			<form action="" method="post">
				<div>
					<label class="col-form-label" for="pseudo">Pseudo</label>
					<input class="form-control" type="text" id="pseudo" name="pseudoSearch" required />
				</div> <br>
				<div>
					<input class="btn btn-primary" name="search" type="submit" value="Modifier mon compte utilisateur" />
				</div>
			</form> <br>
		<?php }
		require('../view/user.php');

	if((isset($search) && $search == 'ok' ) || $_SESSION['role']!='admin'){
?>
	<form action="" method="post">
		<div>
			<label class="col-form-label" for="pseudo">Pseudo* </label>
			<input type="text" class="form-control" id="pseudo" name="pseudo" value="<?php echo $user->getPseudo(); ?>" required />
		</div>

		<div>
			<label class="col-form-label" for="password">Mot de passe Actuel* </label>
			<input type="password" class="form-control" id="password" name="password" value="<?php echo $user->getPassword(); ?>" required/>
		</div>

		<div>
			<label class="col-form-label" for="newPassword">Nouveau mot de passe </label>
			<input type="password" class="form-control" id="newPassword" name="new_password" />
		</div>

		<div>
			<label class="col-form-label" for="confirmNewPassword">Confirmer le nouveau mot de passe </label>
			<input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword" />
		</div> 
<?php
		if($_SESSION['role'] == 'admin'){ ?> <!--Modification d'un rôle -->
			<br/>
			<div>
				<label for="role">Role de l'utilisateur </label>
			       	<select class="form-control" name="role" id="role" required >
			       		<option value="view" <?php if($User['role'] == 'view') {?> selected <?php } ?> >Lecteur</option>
			            <option value="admin" <?php if($User['role'] == 'admin') {?> selected <?php } ?> >Administrateur</option>
			            <option value="author" <?php if($User['role'] == 'author') {?> selected <?php } ?> >Auteur</option>
			            <option value="moderator" <?php if($User['role'] == 'moderator') {?> selected <?php } ?>> Moderateur </option>
			       </select>
			</div>
	<?php } ?> <br/>


		<div>
			<input class="btn btn-primary" type="submit" value="Modifier mon compte utilisateur" name="update" />
			<input class="btn btn-danger" type="submit" value="Supprimer mon compte utilisateur" name="delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre profil, vous ne pourrez plus modifier vos commentaires !')" />
		</div>
	</form>
<?php } ?>

<?php $content = ob_get_clean(); ?>

<?php require('../view/template.php');?>

<?php require('../view/user.php'); ?>