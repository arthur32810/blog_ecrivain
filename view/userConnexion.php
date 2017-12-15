<?php $title="Connexion" ?>
<?php ob_start(); 

	if (!empty($_GET['add']) && $_GET['add'] == 'yes'){
		?> <div class="alert alert-success" role="alert">
		 	Vous avez bien été inscrit(e)
		</div> <?php
		}
	elseif (!empty($_GET['complete']) && $_GET['complete'] == 'no'){
		?><div class="alert alert-danger" role="alert">
			pseudo ou mot de passe non présent
		</div> <?php
		}

	elseif (!empty($_GET['good']) && $_GET['good'] == 'no'){
		?><div class="alert alert-danger" role="alert">
			Mauvais identifiant ou mot de passe
		</div> <?php
	}
	elseif (!empty($_GET['updateUser']) && $_GET['updateUser'] == 'yes'){
		?> <div class="alert alert-success" role="alert">
		  Votre profil a bien été mis à jour
		</div> <?php
	}
?>

<h1> Connexion à votre compte </h1>

	<form action="" method="post">
		<div>
			<label class="col-form-label" for="pseudo">Pseudo</label>
			<input type="text" class="form-control" id="pseudo" name="pseudo"  required />
		</div> <br/>

		<div>
			<label class="col-form-label" for="password">Mot de passe :</label>
			<input type="password" class="form-control" id="pass" name="password" required />
		</div> <br/>

		<div class="text-center">
			<input class="btn" name="connect" type="submit" />
		</div>
	</form>

<?php $content = ob_get_clean(); ?>

<?php require('../view/template.php');?>

<?php require('../view/user.php'); ?>