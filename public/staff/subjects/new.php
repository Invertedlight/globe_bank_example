<?php require_once('../../../private/initialize.php'); ?>

<?php
$subject = [];
$subject['menu_name'] = $_POST['menu_name'] ?? '';
$subject['position'] = $_POST['position'] ?? '';
$subject['visible'] = $_POST['visible'] ?? '';

if(is_post_request()) {
	// Handle form values sent by new.php

	$subject = [];
	$subject['menu_name'] = $_POST['menu_name'] ?? '';
	$subject['position'] = $_POST['position'] ?? '';
	$subject['visible'] = $_POST['visible'] ?? '';

	$errors = insert_subject($subject);
	if($errors === true) {
		$new_id = mysqli_insert_id($db);
		redirect_to(url_for('/staff/subjects/show.php?id=' . $new_id));
	} 	
}

	$subject_set = find_all_subjects();
  $subject_count = mysqli_num_rows($subject_set);
  $subject['position'] = $subject_count + 1;
  mysqli_free_result($subject_set);
?>

<?php $page_title = 'Create Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to List</a>

  <div class="subject new">
    <h1>Create Subject</h1>

		<?php echo display_errors($errors); ?>
    <form action="<?php echo url_for('/staff/subjects/new.php'); ?>" method="post">
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="<?php echo h($subject['menu_name']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
        	<label for 'position'>Last Position is: <?php echo $subject_count; ?></label>
          <select name="position">
            <?php
              for($i=1; $i <= $subject_count + 1; $i++) {
                echo "<option value=\"{$i}\""; 
                if($subject['position'] == $i) {
                  echo "selected";
                }
                echo ">{$i}</option>";
              }
            ?>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <input type="hidden" name="visible" value="0" />
          <input type="checkbox" name="visible" value="1" <?php echo ($subject['visible'] == '1') ? ' checked' : ''; ?>/>
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create Subject" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
