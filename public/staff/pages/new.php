<?php require_once('../../../private/initialize.php'); ?>

<?php
require_once('../../../private/initialize.php');
$page = [];
$page['id'] = $_POST['id'] ?? '';
$page['menu_name'] = $_POST['menu_name'] ?? '';
$page['position'] = $_POST['position'] ?? '';
$page['visible'] = $_POST['visible'] ?? '';
$page['subject_id'] = $_POST['subject_id'] ?? '';

if(is_post_request()) {
  // Handle form values sent by new.php
  $page = [];
  $page['id'] = $_POST['id'] ?? '';
  $page['menu_name'] = $_POST['menu_name'] ?? '';
  $page['position'] = $_POST['position'] ?? '';
  $page['visible'] = $_POST['visible'] ?? '';
  $page['subject_id'] = $_POST['subject_id'] ?? '';

  $result = insert_page($page['menu_name'], $page['subject_id'], $page['position'], $page['visible']);
  $new_id = mysqli_insert_id($db);
    redirect_to(url_for('/staff/pages/show.php?id=' . $new_id));

} 

$subject_set = find_all_subjects();
$subject_count = mysqli_num_rows($subject_set);
mysqli_free_result($subject_set);
$page_set = find_all_pages();
$page_count = mysqli_num_rows($page_set);
$page['position'] = $page_count + 1;

?>

<?php $subject_set = find_all_subjects(); ?>

<?php $page_title = 'Create Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>

  <div class="page new">
    <h1>Create Page</h1>

    <form action="<?php echo url_for('/staff/pages/new.php'); ?>" method="post">
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="<?php echo h($page['menu_name']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Subjects</dt>
        <dd>
          <select name="subject_id">;
            <?php while (($subject_target = mysqli_fetch_assoc($subject_set))) { ?>
              <option value='<?php echo $subject_target['id']; ?>'
                <?php echo ($subject_target['id'] == $page['subject_id']) ? ' selected' : ''; ?>>
                <?php echo $subject_target['menu_name']; ?></option>
            <?php } ?>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
            <?php
              for($i=1; $i <= $page_count + 1; $i++) {
                echo "<option value=\"{$i}\""; 
                if($page['position'] == $i) {
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
          <input type="checkbox" name="visible" value="1" <?php echo ($page['visible'] == '1') ? ' checked' : ''; ?>/>
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create Page" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
