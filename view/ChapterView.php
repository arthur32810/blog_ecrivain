<?php $title = "Chapitre ".$chapter['chapter']." : ".$chapter['title']; 
	$script='<script language="javascript" type="text/javascript">
			function bascule(elem)
			   {
				   etat=document.getElementById(elem).style.display;
				   if(etat=="none"){
				   document.getElementById(elem).style.display="block";
			   }
			   else{
					document.getElementById(elem).style.display="none";
				  }
			   }
		</script>
		<script src="http://code.jquery.com/jquery-2.2.1.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>'?>

<?php ob_start(); ?>
	

	<?php include('../view/conditionPost.php'); ?>

	<a href="index.php?action=allChapter"> Revenir aux chapitres </a>

	<h1> Chapitre <?= $chapter['chapter'] ?> :   <?= $chapter['title'] ?> </h1>
	<?php 
   	if(!empty($_SESSION['role']) && $_SESSION['role'] == 'admin' || !empty($_SESSION['role']) && $_SESSION['role'] == 'author'){ ?> 
		<a href="index.php?action=update_chapter&chapterId=<?= $chapter['id']?>"> Modification </a> <?php 
	}?>

	<p> <?= $chapter['content'] ?> </p>

	<p> publié le : <?= $chapter['creation_date_fr'] ?> </p>

	<h2> Commentaires </h2>

	<?php		

		if(!empty($_SESSION['pseudo'])){ ?> <!-- Formulaire de Commentaire n'apparait que si un utilisateur est connecté-->
			<form action="" method="post">
				<div>
					<label for="comment">Ajouter un Commentaire</label><br />
					<textarea id="comment" name="comment" required></textarea>
				</div>
				<div>
					<input type="submit" name="add" class="btn" />
				</div>
			</form>
	<?php	}
		
		$i =  0;

		while($comment = $comments->fetch())
		{ $i++; ?> 
			
			<div>
				<p> <strong> <?= htmlspecialchars($comment['author'])?> </strong>
					<em> le <?= $comment['comment_date_fr'] ?> </em>
				</p>					
				<p> <?= htmlspecialchars($comment['comment']) ?> </p>

				<?php 
					if(!empty($_SESSION['pseudo']) && $comment['user_id'] != $_SESSION['id']){?>  <!--Formulaire de signalement -->
						<p> 
							<button type="button" data-toggle="modal" data-target="#signaler<?=$i?>" class="btn btn-primary">Signaler</button>
							<div class="modal fade" id="signaler<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h4 class="modal-title">Signaler ce commentaire</h4>
							        <button type="button" class="close" data-dismiss="modal">x</button>
							      </div>
							      <div class="modal-body">
							       	<form method="post" action="">
									   <p>
									      <label>Raison du signalement : </label> <br/>
									      <input type="text" name="cause" required/> <br />
									   </p>

									   <input hidden name="commentId" value="<?= $comment['id']?>">

									   <button type="submit" name="addModeration" class="btn"> Signaler </button>
									</form>
							      </div>
							      <div class="modal-footer">
							        <button class="btn btn-info" data-dismiss="modal">Annuler</button>
							      </div>
							    </div>
							  </div>
							</div>
						</p> 
				<?php } ?>

				<p> <?php if (!empty($_SESSION['pseudo'])){
							if( $comment['user_id'] == $_SESSION['id'] || $_SESSION['role'] == 'admin' || $_SESSION['role'] =='moderator'){ ?> <!-- Formulaire de modification et de suppression -->
							
									<form style="display: inline;" method="POST" action="">
										<button class="btn btn-danger" name="delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre commentaire ')"> Supprimé </button>
										<input hidden name="commentId" value="<?= $comment['id']?>">
									</form>

									<button class="btn btn-primary" onclick="bascule('update<?=$i?>'); return false;"> Modifier </button>
									<div id='update<?=$i?>' style='display:none;'> <br/>
										<form action="" method="post">
											<div>
												<textarea id="comment" name="comment" required> <?= $comment['comment']?></textarea>
											</div>

											<input hidden name="commentId" value="<?= $comment['id']?>">

											<div>
												<input class="btn" name="update" type="submit" value="Modifier"/>
											</div>
										</form>
									</div>												
								<?php } 
							}?>
				</p>
			</div>
			
		<?php }	?>


		<?php $comments->closeCursor(); ?>

<?php $content = ob_get_clean(); ?>

<?php require('../view/template.php');
?>

<?php 
		require('../view/verification/comment.php');
		require('../view/verification/moderation.php');
?>
