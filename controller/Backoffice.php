<?php 

use Projet4\Model\ChapterManager;
use Projet4\Model\MemberManager;
use Projet4\Model\CommentManager;
use Projet4\Model\ReportManager;
use Projet4\Model\Pagination;

require_once('Controller.php');



/** 

* Class BackofficeController

* Used to recover model classes data to send it into back office views

**/

class BackofficeController extends Controller {

	public function loginAdmin() {
		if (isset($_POST['password']) && $_POST['password'] === 'Blog') {
			header('Location: index.php?action=admin');
		} else {
			header('Location: index.php?action=admin-login-view&account-status=unsuccess-login');
		}
	}

	public function displayAdmin() {
		$chapterManager = new ChapterManager();
		$reportManager = new ReportManager();
		$memberManager = new MemberManager();
		$pagination = new Pagination();

		$chaptersPerPage = 3;

		$chaptersNb = $pagination->getChaptersPagination();
		$pageNb = $pagination->getChaptersPages($chaptersNb, $chaptersPerPage);

		if (!isset($_GET['page'])) {
			$currentPage = 0;
		} elseif (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $pageNb) {
			$currentPage = (intval($_GET['page']) - 1) * $chaptersPerPage;
		}

		$chapters = $chapterManager->getChapters($currentPage, $chaptersPerPage);

		$reports = $reportManager->getReports();

		$members = $memberManager->getMembers();
		
		require('view/backoffice/adminView.php');
	}

	public function displayCreateChapter() {
		require('view/backoffice/createChapterView.php');
	}

	/**

	* @param $title string

	* @param $content string

	**/
	public function newChapter(string $title, string $content) {
		$chapterManager = new ChapterManager();

		$newChapter = $chapterManager->createChapter($title, $content);

		header('Location: index.php?action=admin&new-chapter=success');
	}

	public function displayUpdateChapter() {
		$chapterManager = new ChapterManager();

		$chapter = $chapterManager->getChapter($_GET['id']);

		require('view/backoffice/updateChapterView.php');
	}

	/**

	* @param $title string

	* @param $content string

	* @param $chapterId integer

	**/
	public function submitUpdateChapter(string $title, string $content, int $chapterId) {
		$chapterManager = new ChapterManager();

		$updatedChapter = $chapterManager->updateChapter($title, $content, $chapterId);

		header('Location: index.php?action=admin&update-chapter=success');
	}

	/**

	* @param $chapterId integer

	**/
	public function removeChapter(int $chapterId) {
		$chapterManager = new ChapterManager();

		$deletedChapter = $chapterManager->deleteChapter($chapterId);

		header('Location: index.php?action=admin&remove-chapter=success');
	}

	/**

	* @param $commentId integer

	**/
	public function removeComment(int $commentId) {
		$commentManager = new CommentManager();

		$deletedComment = $commentManager->deleteComments($commentId);

		header('Location: index.php?action=admin&remove-comment=success');
	}

	/**

	* @param $reportId integer

	**/
	public function restoreComment(int $reportId) {
		$reportManager = new ReportManager();

		$deletedReport = $reportManager->deleteReports($reportId);

		header('Location: index.php?action=admin&restore-comment=success');
	}

	/**

	* @param $memberId integer

	**/
	public function removeMember(int $memberId) {
		$memberManager = new MemberManager();

		$deletedMember = $memberManager->deleteMember($memberId);

		header('Location: index.php?action=admin&remove-member=success');
	}
}

