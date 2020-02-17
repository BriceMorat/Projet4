<?php $title = htmlspecialchars($chapter['title']); ?>

<?php ob_start(); ?>

<div class="text-center">
	<a class="btn btn-info" href="index.php">Retour à la liste des chapitres</a>
</div><br/>

<div id="container" class="jumbotron container border border-info">
	<div class="text-center">
		<h3>
			<?= htmlspecialchars($chapter['title']) ?>
		</h3>
	</div><br/>

	<p class="text-justify">
		<?= html_entity_decode(nl2br(htmlspecialchars($chapter['content']))) ?>
	</p>

	<p class="text-md-right text-info">
		<em>le <?= $chapter['date_fr'] ?></em>
	</p>

	<?php 
	if ($chapter['date_fr'] < $chapter['date_update_fr']) {
		echo '<p class="text-md-right text-info"><em>modifié le ' . $chapter['date_update_fr'] . '</em></p>';
	}
	?>

</div>

<div id="container" class="jumbotron container border border-info">
	<h2>Commentaires</h2></br>

	<?php
	if (isset($_GET['report']) && $_GET['report'] === 'success') {
		echo "<div class='text-center d-flex justify-content-center'><p id='success' class='bg-success rounded-lg text-white pl-2 pr-2 pt-2 pb-2'>Le commentaire a bien été signalé</p></div>";
	}

		while ($comment = $comments->fetch()) {
	?>

			<div class="shadow p-3 bg-white rounded-lg mb-4">
				<p class="pl-3"><strong><?= htmlspecialchars($comment['author']); ?></strong> le <?= $comment['date_fra']; ?></p>
				<p class="pl-3 comment"><?= nl2br(htmlspecialchars($comment['content'])); ?></p>

				<?php 
				if (!empty($_SESSION)) {
					if (in_array($comment['id'], $idComment) && $comment['author'] !== $_SESSION['pseudo']) {
						echo "<p class='text-md-right text-danger font-italic'>Ce commentaire a été signalé</p>";
					}
				}
				?>

				<?php
				if (!empty($_SESSION)) {
					if (!in_array($comment['id'], $idComment) && $comment['author'] !== $_SESSION['pseudo']) {
						echo '<div class="text-right text-danger font-italic alert-btn"><a class="btn btn-danger text-right reportButton" href="index.php?action=report&id=' . $comment['chapter_id'] . '&comment-id=' . $comment['id'] . '"><i class="fas fa-exclamation-triangle mr-2"></i>Signaler</a></div>';
					}
					
				}
				?>

			</div>

	<?php
		}
	?>

</div>
		
<?php
	if (!empty($_SESSION)) {
?>
		<div id="container" class="jumbotron container border border-info">
			<h3>Laisser un commentaire</h3></br>
			<form action="index.php?action=addComment&id=<?= $chapter['id'] ?>" method="POST">
				<div class="form-group">
		    		<label for="comment">Votre commentaire :</label>
		    		<textarea id="comment" name="content" class="form-control"></textarea>
		    	</div><br />
		    	<input type="submit" value="Envoyer" class="btn btn-info send-btn">
			</form>
	  	</div>
<?php 
    } else {
    	echo '<div class="text-center d-flex justify-content-center"><p class="bg-danger rounded-lg text-white p-2">Pour laisser un commentaire, veuillez vous <a class="text-info" href="index.php?action=login">connecter</a></p></div>';
    }
?>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
