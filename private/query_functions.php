<?php

	function find_all_subjects() {
		global $db;

		$sql = "SELECT * FROM subjects ";
		$sql .= "ORDER BY position ASC";
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		return $result;
}

function find_subject_by_id($id) {
	global $db;
	$sql = "SELECT * FROM subjects ";
	$sql .= "WHERE id='" . $id . "';";
	$result = mysqli_query($db, $sql);
	confirm_result_set($result);

	$subject = mysqli_fetch_assoc($result);
	mysqli_free_result($result);
	return $subject;
}

	function find_all_pages() {
		global $db;

		$sql = "SELECT * FROM pages ";
		$sql .= "ORDER BY subject_id ASC,position ASC";
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		return $result;
}

function find_page_by_id($id) {
	global $db;
	$sql = "SELECT * FROM pages ";
	$sql .= "WHERE id='" . $id . "';";
	$result = mysqli_query($db, $sql);
	confirm_result_set($result);

	$page = mysqli_fetch_assoc($result);
	mysqli_free_result($result);
	return $page;
}

function find_page_and_subject_by_id($id) {
	global $db;
	$sql = "SELECT b.menu_name as subject_name,";
	$sql .= " b.id as subject_id,";
	$sql .= " a.menu_name, a.position, a.id, a.visible ";
	$sql .= " FROM pages a, subjects b ";
	$sql .= " WHERE a.id='" . $id . "'";
	$sql .= " AND a.id = b.id";
	echo $sql;
	$result = mysqli_query($db, $sql);
	confirm_result_set($result);

	$page = mysqli_fetch_assoc($result);
	mysqli_free_result($result);
	return $page;
}
?>