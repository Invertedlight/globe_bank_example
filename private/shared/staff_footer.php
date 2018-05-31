<footer>
	&copy; <?php echo date('Y'); ?> Globe Bank
</footer>
	
  </body>
</html>

<?php 
if($db) {
	db_disconnect($db);
} 

?>