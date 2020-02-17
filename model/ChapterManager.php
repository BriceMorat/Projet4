<?php
namespace Projet4\Model;

require_once('Manager.php');

/** 

* Class ChapterManager

* Used to get, create, update and delete chapters

**/

class ChapterManager extends Manager {

	/**

	* @param $currentPage integer 

	* @param $chaptersPerPage integer 

	* return string

	**/
	public function getChapters(int $currentPage, int $chaptersPerPage) {
		$db = $this->dbConnect();
		$chapters = $db->query('SELECT id, title, content, DATE_FORMAT(date_creation, \'%d/%m/%Y à %H:%i\') AS date_fr, DATE_FORMAT(date_update, \'%d/%m/%Y à %H:%i\') AS date_update_fr FROM chapter ORDER BY date_creation DESC LIMIT '.$currentPage.','.$chaptersPerPage);

		return $chapters;
	}


	/**

	* @param $chapterId integer 

	* return string

	**/
	public function getChapter(int $chapterId) {
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, title, content, DATE_FORMAT(date_creation, \'%d/%m/%Y à %H:%i\') AS date_fr, DATE_FORMAT(date_update, \'%d/%m/%Y à %H:%i\') AS date_update_fr FROM chapter WHERE id = ?');
		$req->execute([$chapterId]);
		$chapter = $req->fetch(\PDO::FETCH_ASSOC);

		return $chapter;
	}


	/**

	* @param $title string

	* @param $content string

	* return string

	**/
	public function createChapter(string $title, string $content) {
		$db = $this->dbConnect();
		$req = $db->prepare('INSERT INTO chapter(title, content, date_creation, date_update) VALUES (?, ?, NOW(), NOW())');
		$newChapter = $req->execute([$title, $content]);

		return $newChapter;
	}


	/**

	* @param $title string

	* @param $content string

	* @param $chapterId string

	* return string

	**/
	public function updateChapter(string $title, string $content, int $chapterId) {
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE chapter SET title = ?, content = ?, date_update = NOW() WHERE id = ?');
		$updatedChapter = $req->execute([$title, $content, $chapterId]);

		return $updatedChapter;
	}

	/**
	
	* @param $chapterId integer

	* return string

	**/
	public function deleteChapter(int $chapterId) {
		$db = $this->dbConnect();
		$comment = $db->prepare('DELETE FROM comment WHERE chapter_id = '.$chapterId.'');
		if ($comment->execute()) {
			$req = $db->prepare('DELETE FROM chapter WHERE id = ?');
			$deletedChapter = $req->execute([$chapterId]);

			return $deletedChapter;
		}
	}
}


