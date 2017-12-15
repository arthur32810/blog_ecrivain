<?php $title ='Création d\'un chapitre' ;
	$script = ' <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=vhnlap27hf8ot2ip6dmzfw56ndq9anxv230bkh8i9oxmua2q"></script>
  		<script>tinymce.init({ selector:\'textarea\' });</script>'?>

<?php ob_start();
		
		if (!empty($_GET['create']) && $_GET['create'] == 'no'){
			?><div class="alert alert-danger" role="alert">
				Le chapitre n'a pas pu être ajouté
			</div> <?php
			}
		elseif(!empty($_GET['chapter']) && $_GET['chapter'] == 'exist'){
				?> <div class="alert alert-success" role="alert">
				 	Le chapitre existe déjà !
				</div> <?php
		}
		elseif (!empty($_GET['complete']) && $_GET['complete'] == 'no'){
				?><div class="alert alert-danger" role="alert">
					Les informations ne sont pas complétes
				</div> <?php
			}
		else{}
			?>
	
	<h1> Ecriture d'un chapitre </h1>

	<form action="" method="post">
		<div>
			<label class="col-form-label" for="title">Titre</label><br />
			<input class="form-control" type="text" id="title" name="title" required />
		</div> <br/>

		<div>
			<label class="col-form-label" for="chapter">Chapitre n°</label>
			<input class="form-control" type="number" id="chapter" name="chapter" required />
		</div> <br/>

		<div>
			<label class="col-form-label" for="content">Texte</label><br />
			<textarea class="form-control" id="content" name="content"></textarea>
		</div> <br/>
		<div>
			<input class="btn" name="add" type="submit" />
		</div>
	</form>

<?php $content = ob_get_clean(); ?>

<?php require('../view/template.php');?>

<?php require('../view/chapter.php');?>