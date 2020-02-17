<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

<?php
	while ($data = $chapters->fetch()) {
		if (!empty($data)) {
?>

			<section id="container" class="jumbotron container border border-info">
				<div class="bg-info rounded-lg pl-2 pt-2 pb-2">
					<h3>
						<?= htmlspecialchars($data['title']); ?>
						<em><small>le <?= $data['date_fr']; ?></em></small>

					</h3>
				</div>

				<p class="text-justify">
					<?php
						$extract = substr($data['content'], 0, 1000);
						echo html_entity_decode(htmlspecialchars($extract . " ..."));
					?>

				</p><br/>

				<div class="text-md-right">
					<a class="btn btn-info text-right" href="index.php?action=chapter&id=<?= $data['id'];?>">Lire la suite ...</a>
				</div>
			</section>

<?php
		} else {
			echo "Ce chapitre n'existe pas.";
		}
	}
	$chapters->closeCursor();
?>

			<nav>
		  		<ul class="pagination justify-content-center">

				<?php 
					for ($i = 1; $i <= $pageNb; $i++) {
						echo '<li class="page-item"><a class="page-link" href="index.php?page='.$i.'">'.$i.'</a></li>';
					}
				?>

		  		</ul>
			</nav>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
