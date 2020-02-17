<?php $title = 'Connexion'; ?>

<?php ob_start(); ?>

<?php 
	if (isset($_GET['account-status']) && $_GET['account-status'] === 'unsuccess-login') {
		echo '<div class="text-center d-flex justify-content-center"><p id="error" class="bg-danger rounded-lg text-white pl-2 pr-2 pt-2 pb-2">Mauvais identifiant ou mot de passe !<p></div>';
	}
?>

<section>
	<div id="container" class="jumbotron container border border-info">
		<h2>Connexion</h2><br/><br/>
		<form action="index.php?action=loginSubmit" method="POST">
			<div class="form-group">
			    <label class="font-weight-bold" for="pseudo">Pseudo</label>
			    <input type="text" name="pseudo" class="form-control" id="pseudo" required-pattern="^[a-zA-Z]+[0-9_-]*{5,}$" maxlength="15">
			    <p><em>Le pseudo doit comporter au minimum 5 caractères avec au moins une lettre (caractère spécial non autorisé)</em></p>
		  	</div>
			<div class="form-group">
			    <label class="font-weight-bold" for="psw">Mot de passe</label>
			    <input type="password" name="password" class="form-control" id="psw" required-pattern="^[A-Za-z]+[0-9]+[@$!%*#?&]+{5,}$" maxlength="15">
			    <p><em>Le mot de passe doit comporter au minimum 5 caractères avec au moins une lettre, un chiffre et un caractère spécial</em></p>
			</div>
		  	<input type="submit" value="Se connecter" class="btn btn-info loginSubmit">
		</form><br />
	</div>

	<div id="container" class="jumbotron container border border-info mb-4">
		<p>Nouveau sur le blog ? Créez votre compte et rejoignez la communauté des lecteurs. Une fois votre compte créé, vous pourrez commenter les derniers chapitres !</p>
		<a href="index.php?action=registration" class="btn btn-info">S'incrire</a>
	</div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>