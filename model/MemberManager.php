<?php
namespace Projet4\Model;

require_once('Manager.php');

/** 

* Class MemberManager

* Used to create, loging, get, delete members and check pseudo, email.

**/

class MemberManager extends Manager {

	/**

	* @param $pseudo string  

	* @param $password string

	* @param $email string

	* return string

	**/
	public function createMember(string $pseudo, string $password, string $email) {
		$db = $this->dbConnect();
		$newMember = $db->prepare('INSERT INTO member(role, pseudo, password, email, registration_date) VALUES("user", ?, ?, ?, CURDATE())');

		$newMember->execute([$pseudo, $password, $email]);

		return $newMember;
	}

	/**

	* @param $pseudo string  

	* return string

	**/
	public function loginMember(string $pseudo) {
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, role, password FROM member WHERE pseudo = ?');
		$req->execute([$pseudo]);
		$member = $req->fetch();

		return $member;
	}

	/**

	* @param $pseudo string  

	* return string

	**/
	public function checkPseudo(string $pseudo) {
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT pseudo FROM member WHERE pseudo = ?');
		$req->execute([$pseudo]);
		$usernameValidity = $req->fetch();

		return $usernameValidity;
	}

	/**

	* @param $email string

	* return string

	**/
	public function checkEmail(string $email) {
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT email FROM member WHERE email = ?');
		$req->execute([$email]);
		$emailValidity = $req->fetch();

		return $emailValidity;
	}


	public function getMembers() {

		$db = $this->dbConnect();
		$members = $db->query('SELECT id, role, pseudo, DATE_FORMAT(registration_date, "%d/%m/%Y") AS reg_date FROM member ORDER BY id');

		return $members;
	}

	/**

	* @param $memberId integer

	* return string

	**/
	public function deleteMember(int $memberId) {
		$db = $this->dbConnect();
		$req = $db->prepare('DELETE FROM member WHERE id = ?');
		$deletedMember = $req->execute([$memberId]);

		return $deletedMember;
	}

	public function getSecretKey() {
		$secretKey = '6Lf7MNIUAAAAADeuj1TV8xqcfRMRZ8WrJ5Wd3F16';

		return $secretKey;
	}


	/**
	
	* @param $token string  

	* return string

	**/
	public function getReCaptcha(string $token) {
		$secretKey = $this->getSecretKey();
		$request = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secretKey . '&response=' . $token . '');
		$response = json_decode($request);

		return $response;
	}
}