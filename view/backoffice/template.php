<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="description" content="Avec ShareMyTrip, partagez vos plus beaux souvenirs de voyage !" />
		<!-- favicon -->
		<link rel="icon" type="image/png" href="public/img/icon-travelBlog.jpg" />
		<!-- viewport -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Style -->
		<link rel="stylesheet" href="public/css/style.css">
		<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playball">
		<!-- Bootstrap -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
		<!-- Twitter Card data -->
		<meta name="twitter:card" content="Avec ShareMyTrip, partagez vos plus beaux souvenirs de voyage !">
		<!-- Open Graph data -->
		<meta property="og:title" content="Bienvenue sur ShareMyTrip. Site communautaire de partage de récits et de photos de voyage. Pour découvrir le monde à travers vos plus beaux voyages !" />
		<meta property="og:type" content="website" />
		<meta property="og:url" content="http://projet5.bricemorat.fr" />
		<meta property="og:image" content="public/img/icon-travelBlog.jpg" />
		<meta property="og:description" content="Avec ShareMyTrip, partagez vos plus beaux souvenirs de voyage !" />
		<title><?= $title ?></title>
	</head>

	<body class="bg-light">
		<header>
			<nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">

				<?php 
					if (!empty($_SESSION) && $_SESSION['role'] === 'admin') {
			      		echo '<ul class="nav nav-pills"><li class="nav-item"><a class="nav-link" href="index.php?action=admin"><img src="public/img/icone-ecrivain"></img>Administration</a></li></ul>';
			      	} 
				?>

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    				<span class="navbar-toggler-icon"></span>
  				</button>

  				<div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
		    		<ul class="nav nav-pills">
		      			<li class="nav-item mr-2">
		        			<a class="nav-link" href="index.php">Accueil</a>
		      			</li>
		      			<li class="nav-item mr-2">
		        			<a class="nav-link" href="index.php?action=about">À propos</a>
		      			</li>

		      			<?php
			      			if (!empty($_SESSION)) {
			      				echo '<li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-user"></i> ' . htmlspecialchars($_SESSION['pseudo']) . '</a></li>';
			      			}
			      			if (!empty($_SESSION)) {
			      				echo '<li class="nav-item"><a class="nav-link" href="index.php?action=logout">Déconnexion</a></li>';
			      			} 
			      			else {
			      				echo '<li class="nav-item"><a class="nav-link" href="index.php?action=login">Connexion / Inscription</a></li>';
			      			}
		      			?>

		    		</ul>
	    		</div>
			</nav><br/><br/><br/>
		</header>

		<?= $content ?>


	    <!-- Tiny MCE -->
		<script src="https://cdn.tiny.cloud/1/awbrpbrntn6dluij2xowqpbazd9pmf2lnlwc90vrn1t6081t/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  		<script>tinymce.init({selector:'#textarea', content_css:'public/css/style.css'});</script>
		
		<!-- Font Awesome -->
		<script src="https://use.fontawesome.com/b4858dacdf.js"></script>
		<!-- Google Recaptcha -->
		<script src="https://www.google.com/recaptcha/api.js"></script>
		<!-- JQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<!-- Bootstrap -->
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

	    <!-- Script -->
	    <script src="public/js/app.js"></script>
  

	</body>
</html>
