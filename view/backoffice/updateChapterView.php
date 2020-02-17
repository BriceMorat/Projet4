<?php $title = 'Panneau d\'administration'; ?>

<?php ob_start(); ?>

<section id="container" class="jumbotron container border border-info pt-4">
	<h2>Panneau d'administration</h2><br/>
	<div>

		<?php  
			if (isset($_GET['updateChapter']) && $_GET['updateChapter'] === 'success') {
				echo '<div class="text-center d-flex justify-content-center"><p id="success" class="bg-success rounded-lg text-white pl-2 pr-2 pt-2 pb-2">Le chapitre a bien été modifié !<p></div>';
			}
		?>

		<p><a class="btn btn-info" href="index.php?action=admin">Retour au menu</a></p><br/>
		<form action="index.php?action=submitUpdateChapter&id=<?= $chapter['id']; ?>" method="POST">
			<div class="form-group">
			    <input type="text" name="title" placeholder="Titre du chapitre" class="form-control" value="<?= $chapter['title']; ?>">
			    <textarea id="textarea" name="content" cols="160" rows="40"><?= $chapter['content']; ?></textarea>
			</div>
		  	<input type="submit" value="Publier" class="btn btn-info">
		</form>
	</div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>