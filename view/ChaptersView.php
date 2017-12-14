<?php $title = 'Billet simple pour l\'Alaska '; ?>

<?php ob_start(); ?>
	
	<?php		
	include('conditionChapters.php');

	while($data = $chapters->fetch())
	{ ?> 
		<div class="post-preview">
			<a href="index.php?action=post&id=<?= $data['id']?>"> 
	            <h2 class="post-title ">
	                <?= htmlspecialchars($data['title']) ?>
	            </h2>

	            <h4 class="post-subtitle d-none d-sm-block">
	            	<?php echo substr( $data['content'], 0, 550).'...'; ?>
	            </h4>

	            <h4 class="post-subtitle d-block d-sm-none">
	            	<?php echo substr( $data['content'], 0, 300).'...'; ?>
	            </h4>

	        </a>
	            <p class="post-meta">
	               Chapitre n° <?= $data['chapter']?>
	               <?php 
	               if(!empty($_SESSION['role']) && $_SESSION['role'] == 'admin' || !empty($_SESSION['role']) && $_SESSION['role'] == 'author'){ ?> 
	           			<a href="index.php?action=update_post&postId=<?= $data['id']?>"> Modification </a> <?php 
	           		}?>
	       		</p>     	
		</div>
		<hr>

	<?php } 
	$chapters->closeCursor();	?>

<?php $content = ob_get_clean(); ?>

<?php require '../view/template.php'; ?>