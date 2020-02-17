<?php

namespace Projet4\Model;

require_once('Manager.php');

/** 

* Class Pagination

* Used to get chapters pagination according to chapter number and chapters per page

**/

class Pagination extends Manager {

	public function getChaptersPagination() {
		$db = $this->dbConnect();
		$totalChapters = $db->query('SELECT COUNT(id) AS chapters_nb FROM chapter');

		return $totalChapters->fetch()['chapters_nb'];
	}

	/**

	* @param $chaptersNb integer 

	* @param $chaptersPerPage integer 

	* return integer

	**/
	public function getChaptersPages(int $chaptersNb, int $chaptersPerPage) {
		$pageNb = ceil($chaptersNb/$chaptersPerPage);

		return $pageNb;
	}
}