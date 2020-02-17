<?php

use Projet4\Model\ChapterManager;
use Projet4\Model\MemberManager;
use Projet4\Model\CommentManager;
use Projet4\Model\ReportManager;
use Projet4\Model\Pagination;

require_once('Controller.php');


/** 

* Class FrontofficeController

* Used to recover model classes data to send it into front office views

**/

class FrontofficeController extends Controller {

	public function listChapters() {
		$pagination = new Pagination();
		$chapterManager = new ChapterManager();

		$chaptersPerPage = 3;

		$chaptersNb = $pagination->getChaptersPagination();
		$pageNb = $pagination->getChaptersPages($chaptersNb, $chaptersPerPage);

		if (!isset($_GET['page'])) {
			$currentPage = 0;
		} elseif (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $pageNb) {
			$currentPage = (intval($_GET['page']) - 1) * $chaptersPerPage;
			}

		$chapters = $chapterManager->getChapters($currentPage, $chaptersPerPage);

		require('view/frontoffice/homeView.php');
	}

	public function listChapter() {
		$chapterManager = new ChapterManager();
		$commentManager = new CommentManager();
		$reportManager = new ReportManager();

		$chapter = $chapterManager->getChapter($_GET['id']);

		if ($chapter) {
			$comments = $commentManager->getComments($_GET['id']);

			if (!empty($_SESSION)) {
				$idComment = $reportManager->getIdReport($_SESSION['id']);
			}
		} else {
			header('Location: index.php');
		}
		
		require('view/frontoffice/chapterView.php');
	}

	public function displayRegistration() {
		require('view/frontoffice/registrationView.php');
	}

	public function valid_data($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = strip_tags($data);
        return $data;
    }

	/**

	* @param $pseudo string

	* @param $password string

	* @param $email string

	**/
	public function addMember(string $pseudo, string $password, string $email) {
		$memberManager = new MemberManager();

		$reCaptcha = $memberManager->getReCaptcha($_POST['g-recaptcha-response']);

		// if ($reCaptcha->success == true) {
			$usernameValidity = $memberManager->checkPseudo($pseudo);
			$emailValidity = $memberManager->checkEmail($email);

			if (!$usernameValidity && !$emailValidity) {
				$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

				$newMember = $memberManager->createMember($pseudo, $password, $email);

				header('Location: index.php?account-status=account-successfully-created');

			} elseif ($usernameValidity) {
				header('Location: index.php?action=registration&error=invalidUsername');

			} elseif ($emailValidity) {
				header('Location: index.php?action=registration&error=invalidEmail');
			}
		// } else {
		// 	header('Location: index.php?action=registration&error=google-recaptcha');
		// }
	}

	public function displayLogin() {
		require('view/frontoffice/loginView.php');
	}


	/**

	* @param $pseudo string

	* @param $password string

	**/
	public function loginSubmit(string $pseudo, string $password) {
		$memberManager = new MemberManager();

		$member = $memberManager->loginMember($pseudo);

		$isPasswordCorrect = password_verify($_POST['password'], $member['password']);

		if (!$member) {
			header('Location: index.php?action=login&account-status=unsuccess-login');
		} elseif ($isPasswordCorrect) {
			$_SESSION['id'] = $member['id'];
			$_SESSION['pseudo'] = ucfirst(strtolower($pseudo));
			$_SESSION['role'] = $member['role'];
			header('Location: index.php');
		} else {
			header('Location: index.php?action=login&account-status=unsuccess-login');
		}
	}

	/**

	* @param $chapterId integer

	* @param $author string

	* @param $content string

	**/
	public function addComment(int $chapterId, string $author, string $content) {
		$commentManager = new CommentManager();

		$affectedLines = $commentManager->addComments($chapterId, $author, $content);

		if ($affectedLines === false) {
			throw new Exception("Impossible d'ajouter le commentaire !");
		} else {
			header('Location: index.php?action=chapter&id=' . $chapterId);
		}
	}

	/**

	* @param $chapterId integer

	* @param $commentId integer

	* @param $memberId integer

	**/
	public function report(int $commentId, int $memberId) {
		$reportManager = new ReportManager();

		$reported = $reportManager->reports($commentId, $memberId);

		header('Location: index.php?action=chapter&id=' . $chapterId . '&report=success');

		require('view/frontoffice/chapterView.php');
	}

	public function logout() {
		$_SESSION = array();
		setcookie(session_name(), '', time() - 42000);
		session_destroy();

		header('Location: index.php?logout=success');
	}

	public function displayAbout() {
		require('view/frontoffice/aboutView.php');
	}

	public function displayPrivacy() {
		require('view/frontoffice/privacyView.php');
	}
}



