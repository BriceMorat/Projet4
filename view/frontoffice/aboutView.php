<?php $title = 'À propos'; ?>

<?php ob_start(); ?>

<section id="container" class="jumbotron container border border-info pt-4">
	<div class="card mb-3">
		<div class="row no-gutters">
	    	<div class="col-md-4 d-flex align-items-center">
	      		<img src="public/img/image-personnage.jpg" class="card-img rounded-circle border border-dark" alt="Image d'un écrivain">
	    	</div>
	    	<div class="col-md-8">
	      		<div class="card-body text-justify">
	        		<h2 class="card-title">À propos de l'auteur</h5>
	        		<p class="card-text text-justify">Né en 1980 dans l'Ouest du Canada, je suis un écrivain canadien dont les thèmes de prédilection sont l'aventure et la nature sauvage.</p>
					<p class="card-text text-justify">Je suis également l'auteur de “<em>L'Appel de la montagne</em>” ainsi que d'autres romans célèbres comme “<em>Le voyage en terre inconnue</em>”</p>
					<p class="card-text text-justify">Autodidacte, j'ai fait mon éducation par les livres. En 1989, à l'âge de neuf ans, je découvre les “<em>Contes de l'Alhambra de Washington Irving</em>”, et ç'est ainsi que la passion pour les livres ne me quittera plus.</p>
					<p class="card-text text-justify">Aujourd'hui, au travers de ce blog, je souhaite partager ma passion pour l'écriture à un maximum de lecteurs.</p>
					<p class="card-text text-justify">Le principe est simple : je publie épisodiquement des chapitres de mon nouveau roman sur ce blog et je laisse l'opportunité à mes lecteurs de commenter ces derniers et de me donner leur avis. Ces avis peuvent alors m'aiguiller sur mon travail d'écriture et donc possiblement changer le scénario du livre.</p>
					<p class="card-text text-justify">Je vous invite donc à venir me rejoindre sans plus tarder en vous créant un espace membre et en commentant mes chapitres.</p>
					<p class="card-text text-justify">Je vous dis à très bientôt mes chers lecteurs !</p>

	        	</div>
	    	</div>
	  	</div>
	</div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

