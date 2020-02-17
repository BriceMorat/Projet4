<?php
ob_start();

session_start();

require('controller/Frontoffice.php');
require('controller/Backoffice.php');

$frontofficeController = new FrontofficeController();
$backofficeController = new BackofficeController();

try {
	if (isset($_GET['action'])) {

		switch($_GET['action']) {

			case 'chapter':
				if (isset($_GET['id']) && (int) $_GET['id'] > 0) {
					$frontofficeController->listChapter();
				} else {
					throw new Exception('Aucun identifiant de billet envoyé');
				}

				break;

			case 'registration':
				$frontofficeController->displayRegistration();

				break;

			case 'addMember':

				if (!empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['password_confirm']) && !empty($_POST['email'])) {
					if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
						if ($_POST['password'] === $_POST['password_confirm']) {
							$frontofficeController->addMember($frontofficeController->valid_data($_POST['pseudo']), $frontofficeController->valid_data($_POST['password']), $frontofficeController->valid_data($_POST['email']));
						} else {
							throw new Exception('Les deux mots de passe ne correspondent pas.');
						}
					} else {
						throw new Exception('Adresse email non valide.');
					}
				} else {
					throw new Exception('Tous les champs ne sont pas remplis !');
				}

				break;

			case 'login':
				$frontofficeController->displayLogin();

				break;

			case 'loginSubmit':
				$frontofficeController->loginSubmit($frontofficeController->valid_data($_POST['pseudo']), $frontofficeController->valid_data($_POST['password']));

				break;

			case 'addComment':
				if (isset($_GET['id']) && (int) $_GET['id'] > 0) {
					if (!empty($_SESSION['pseudo']) && !empty($_POST['content'])) {
						$frontofficeController->addComment($_GET['id'], $_SESSION['pseudo'], $frontofficeController->valid_data($_POST['content']));
					} else {
						throw new Exception('Tous les champs ne sont pas remplis !');
					}
				} else {
					throw new Exception('Aucun identifiant de billet envoyé');
				}

				break;

			case 'report':
				$frontofficeController->report($_GET['comment-id'], $_SESSION['id']);

				break;

			case 'logout':
				$frontofficeController->logout();

				break;

			case 'admin-login-view':
				if (isset($_SESSION)) {
					$backofficeController->displayLoginAdmin();
				}	

				break;

			case 'adminLogin':
				$backofficeController->loginAdmin();

				break;

			case 'admin':
				if (isset($_SESSION) && (string) $_SESSION['role'] === 'admin') {
					$backofficeController->displayAdmin();
				} else {
					throw new Exception("Administrateur non identifié");
				}

				break;

			case 'createChapter':
				if (isset($_SESSION) && (string) $_SESSION['role'] === 'admin') {
					$backofficeController->displayCreateChapter();
				} else {
					throw new Exception("Administrateur non identifié");
				}

				break;

			case 'submitChapter':
				if (!empty($_POST['title']) && !empty($_POST['content'])) {
					$backofficeController->newChapter($_POST['title'], ($_POST['content']));
				} else {
					throw new Exception("Contenu vide !");
				}

				break;

			case 'updateChapter':
				if (isset($_GET['id']) && (int) $_GET['id'] > 0) {
					if (isset($_SESSION) && $_SESSION['role'] === 'admin') {
						$backofficeController->displayUpdateChapter();
					} else {
						throw new Exception("Administrateur non identifié");
					}
				}

				break;

			case 'submitUpdateChapter':
				$backofficeController->submitUpdateChapter($_POST['title'], ($_POST['content']), $_GET['id']);

				break;

			case 'deleteChapter':
				$backofficeController->removeChapter($_GET['id']);

				break;

			case 'deleteComment':
				$backofficeController->removeComment($_GET['id']);

				break;

			case 'restoreComment':
				$backofficeController->restoreComment($_GET['id']);

				break;

			case 'deleteMember':
				$backofficeController->removeMember($_GET['id']);

				break;

			case 'about':
				$frontofficeController->displayAbout();

				break;

			case 'privacy':
				$frontofficeController->displayPrivacy();

				break;

			default: 
				$frontofficeController->listChapters();
		}

	} else {
		$frontofficeController->listChapters();
	}

}

catch(Exception $e) {
	echo 'Erreur : ' . $e->getMessage();
}

