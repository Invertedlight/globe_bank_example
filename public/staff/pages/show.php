<?php require_once('../../../private/initialize.php'); ?>

<?php
$id = $_GET['id'] ?? '1'; //PHP > 7.0

$page = find_page_and_subject_name_by_page_id($id); 
?>

<?php $page_title = 'Show Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

	<a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>

	<div class="page show">

 		<h1>Page: <?php echo h($page['menu_name']); ?></h1>

 		<div class="attributes">
 			<dl>
 				<dt>Menu Name</dt>
 				<dd><?php echo h($page['menu_name']); ?></dd>
 			</dl>
 			<dl>
 				<dt>Subject ID</dt>
 				<dd><?php echo h($page['subject_id']); ?></dd>
 			</dl>
 			<dl>
 				<dt>Subject Name</dt>
 				<dd><?php echo h($page['subject_name']); ?></dd>
 			</dl>
 			<dl>
 				<dt>Position</dt>
 				<dd><?php echo $page['position']; ?></dd>
 			</dl>
 			<dl>
 				<dt>Visible</dt>
 				<dd><?php echo $page['visible'] == '1' ? 'true' : 'false'; ?></dd>
 			</dl>
 			<dl>
        <dt>Page Content</dt>
        <dd>
          <textarea rows="10" cols="50" readonly name="content"><?php echo $page['content']; ?></textarea> . 
        </dd>
      </dl>
 		</div>
	</div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
