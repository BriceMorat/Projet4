<?php $title = 'Nouveau chapitre'; ?>

<?php ob_start(); ?>

<section id="container" class="jumbotron container border border-info pt-4">
	<h2>Panneau d'administration</h2><br/>
	<div>
		<p><a class="btn btn-info" href="index.php?action=admin">Retour au menu</a></p><br/>
		<form action="index.php?action=submitChapter" method="POST">
			<div class="form-group">
			    <input type="text" name="title" placeholder="Titre du chapitre" class="form-control">
			    <textarea id="textarea" name="content" cols="160" rows="40"></textarea>
			</div>
		  	<input type="submit" value="Publier" class="btn btn-info">
		</form>
	</div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>