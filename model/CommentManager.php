<?php
namespace Projet4\Model;

require_once('Manager.php');

/** 

* Class CommentManager

* Used to get, add and delete comments

**/

class CommentManager extends Manager {

	/**

	* @param $chapterId integer 

	* return string

	**/
	public function getComments(int $chapterId) {
		$db = $this->dbConnect();
		$comments = $db->prepare('SELECT id, chapter_id, author, content, DATE_FORMAT(date_comments, \'%d/%m/%Y à %H:%i\') AS date_fra FROM comment WHERE chapter_id = ? ORDER BY date_comments DESC');
		$comments->execute([$chapterId]);

		return $comments;
	}

	/**

	* @param $chapterId integer 

	* @param $author string 

	* @param $content string 

	* return string

	**/
	public function addComments(int $chapterId, string $author, string $content) {
		$db = $this->dbConnect();
		$comments = $db->prepare('INSERT INTO comment(chapter_id, author, content, date_comments) VALUES(?, ?, ?, NOW())');
		$affectedLines = $comments->execute([$chapterId, $author, $content]);

		return $affectedLines;
	}

	/**

	* @param $commentId integer 

	* return string

	**/
	public function deleteComments(int $commentId) {
		$db = $this->dbConnect();
		$req = $db->prepare('DELETE FROM comment WHERE id = ?');
		$deletedComments = $req->execute([$commentId]);

		return $deletedComments;
	}
}