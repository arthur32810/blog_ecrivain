<?php $title="Création d'un compte utilisateur"; ?>
<?php ob_start(); 

	if (!empty($_GET['complete']) && $_GET['complete'] == 'no'){
				?><div class="alert alert-danger" role="alert">
					Les informations ne sont pas complétes
				</div> <?php
			} 
	elseif (!empty($_GET['user']) && $_GET['user'] == 'exist'){
			?><div class="alert alert-danger" role="alert">
				Pseudo déjà utilisé
			</div> <?php
		}
	elseif (!empty($_GET['add']) && $_GET['add'] == 'no'){
			?><div class="alert alert-danger" role="alert">
				Vous n'avez pu été inscrit(e), veuillez réessayer
			</div> <?php
		}
?>

<h1> Création d'un compte utilisateur </h1>

	<form action="" method="post">
		<div>
			<label class="col-form-label" for="pseudo">Pseudo</label>
			<input type="text" class="form-control" id="pseudo" name="pseudo" required />
		</div>

		<div>
			<label class="col-form-label" for="password">Mot de passe :</label>
			<input type="password" class="form-control" id="password" name="password" required />
		</div> <br/>

		<div>
			<input class="btn" name="add" type="submit" />
		</div>
	</form>

<?php $content = ob_get_clean(); ?>

<?php require('../view/template.php');?>

<?php require('../view/user.php');?>