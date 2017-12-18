<?php $title ='Modification d\'un chapitre' ;
	$script = ' <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=vhnlap27hf8ot2ip6dmzfw56ndq9anxv230bkh8i9oxmua2q"></script>
  		<script>tinymce.init({ selector:\'textarea\' });</script>'?>

<?php ob_start();
		if (!empty($_GET['complete']) && $_GET['complete'] == 'no'){
				?><div class="alert alert-danger" role="alert">
					Les informations ne sont pas complétes
				</div> <?php
			}
		elseif(!empty($_GET['chapter']) && $_GET['chapter'] == 'exist'){
				?><div class="alert alert-danger" role="alert">
					Le chapitre existe déjà !
				</div> <?php
		}
		else{}
?>
		
		
		
	
	<h1> Modification du chapitre <?= $chapter['chapter'] ?> : <h1> 
	<h3 class="text-center">   <?= $chapter['title']?>  </h3> <br/>

	<form action="" method="post">
		<div>
			<label class="col-form-label" for="title">Titre</label>
			<input class="form-control" type="text" id="title" name="title" value="<?= $chapter['title']?>" required /> <br/>
		</div> <br/>

		<div>
			<label class="col-form-label" for="chapter">Chapitre n°</label>
			<input class="form-control" type="number" id="chapter" name="chapter" value="<?= $chapter['chapter']?>" required />
		</div> <br/>

		<div>
			<label class="col-form-label" for="content">Texte</label><br />
			<textarea class="form-control" id="content" name="content" required > <?= $chapter['content']?></textarea>
		</div> <br/>

		

		<div>
			<input class="btn btn-primary" type="submit" value="Modifier" name="update" onclick="return confirm('Êtes-vous sûr de vouloir modifer ce chapitre ?')"/>
			<input class="btn btn-danger" type="submit" value="Supprimer" name="delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce chapitre ?')"/>
			
		</div>

		<?php $chapterId = $chapter['id']; ?>
	</form>

<?php $content = ob_get_clean(); ?>

<?php require('../view/template.php');?>

<?php require('../view/chapter.php');?>