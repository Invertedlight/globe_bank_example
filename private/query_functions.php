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

function find_page_and_subject_name_by_page_id($id) {
	global $db;
	$sql = "SELECT b.menu_name as subject_name,";
	$sql .= " b.id as subject_id,";
	$sql .= " a.menu_name, a.position, a.id, a.visible ";
	$sql .= " FROM pages a, subjects b ";
	$sql .= " WHERE a.id='" . $id . "'";
	$sql .= " AND b.id = a.subject_id";
	//echo $sql;
	$result = mysqli_query($db, $sql);
	confirm_result_set($result);

	$page = mysqli_fetch_assoc($result);
	mysqli_free_result($result);
	return $page;
}

function insert_subject($menu_name, $position, $visible) {
	global $db;

	$sql = "INSERT INTO subjects ";
	$sql .= "(menu_name, position, visible) ";
	$sql .= "VALUES (";
	$sql .= "'" . $menu_name . "',";
	$sql .= "'" . $position . "',";
	$sql .= "'" . $visible . "'";
	$sql .= ")";
	//echo $sql;
	$result = mysqli_query($db, $sql); 
	// For insert statements $result is true/false
	if($result) {
		return true;

	} else {
		// Insert failed
		echo mysqli_error($db);
		db_disconnect($db);
		exit;
	}
}

function insert_page($menu_name, $subject_id, $position, $visible) {
	global $db;

	$sql = "INSERT INTO pages ";
	$sql .= "(menu_name, subject_id, position, visible) ";
	$sql .= "VALUES (";
	$sql .= "'" . $menu_name . "',";
	$sql .= "'" . $subject_id . "',";
	$sql .= "'" . $position . "',";
	$sql .= "'" . $visible . "'";
	$sql .= ")";
	echo $sql;
	$result = mysqli_query($db, $sql); 
	// For insert statements $result is true/false
	if($result) {
		return true;

	} else {
		// Insert failed
		echo mysqli_error($db);
		db_disconnect($db);
		exit;
	}
}

function update_subject($subject) {
	global $db;

	$sql = "update subjects set ";
  $sql .= "menu_name ='" . $subject['menu_name'] . "', ";
  $sql .= "position='" . $subject['position'] . "', ";
  $sql .= "visible='" . $subject['visible'] . "' ";
  $sql .= "WHERE id='" . $subject['id'] . "' ";
  $sql .= "LIMIT 1";
  echo $sql;
  $result = mysqli_query($db, $sql);
  // For UPDATE statements, $result is true/false
  if($result) {
    return true;
  } else {
    //UPDATE failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }

}

function update_page($page) {
	global $db;

	$sql = "update pages set ";
  $sql .= "menu_name ='" . $page['menu_name'] . "', ";
  $sql .= "subject_id='" . $page['subject_id'] . "', ";
  $sql .= "position='" . $page['position'] . "', ";
  $sql .= "visible='" . $page['visible'] . "' ";
  $sql .= "WHERE id='" . $page['id'] . "' ";
  $sql .= "LIMIT 1";
  echo $sql;
  $result = mysqli_query($db, $sql);
  // For UPDATE statements, $result is true/false
  if($result) {
    return true;
  } else {
    //UPDATE failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }

}
?>