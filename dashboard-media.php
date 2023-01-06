<form method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	<input type="file" class="form-control postUploadBtn" id="post_file" name="post_file"
		placeholder="Upload Your Media" />
</form>


<div class="post_area">
	<?php
	$all_user_post = show_post_by_current_user($_COOKIE['login_auth']);
	foreach ($all_user_post as $key => $value) {

		?>
		<?php if ($value[4] == 'image') { ?>
			<div><img src="uploads/posts/<?= $value[2]; ?>" /></div>
		<?php } else { ?>
			<div>
				<iframe width="320" height="240" src="uploads/posts/<?= $value[2]; ?>">
				</iframe>
			</div>
		<?php } ?>


		<?php
	}
	?>
</div>