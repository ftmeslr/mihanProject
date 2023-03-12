<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>

			<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.','kubrick'); ?></p>

			<?php
			return;
		}
	}
	$oddcomment = 'class="alt" ';
	global $user_ID;
?>

<?php if ('open' == $post->comment_status) : ?>
<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>برای ارسال نظر باید وارد شوید<a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e('logged in','kubrick'); ?></a></p>
<?php else : ?>

<div class="px-195">
<form action="<?php echo home_url(); ?>/wp-comments-post.php" method="post" id="commentform" name="commform" onsubmit="return validateForm()">

	<textarea id="comment" placeholder="Your Message" name="comment" class="rounded10 border bg-gray p-2 f13 w-100" required></textarea>
	
	<div class="row mt-3">
		<?php if (!$user_ID ) : ?>
		<div class="col-5">
			<input type="text" class="rounded10 border bg-gray h-46 w-100 px-2 f13" name="author"  id="author" value="<?php if(!empty($comment_author)){echo $comment_author;}?>" required>

		</div>
		<div class="col-5">
			<input type="text" class="col-5 rounded10 border bg-gray h-46 w-100 px-2 f13" name="email" class="mail" id="email" value="<?php if(!empty($comment_author_email)){echo $comment_author_email;} ?>" required>

		</div>
		<?php endif; ?>
		<div class="col-2">
				<button class="rounded10 bg-green-light f13 text-white px-4 h-46 border-0 w-100" type="submit">
					ارسال نظر
			</button>
		</div>
	</div>

</form>


<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
<?php do_action('comment_form', $post->ID); ?>

<?php endif; ?>
<?php endif; ?>
<?php
$args = array("class"=>"img")
?>
<?php if ($comments) : 
wp_list_comments( 'type=comment&callback=cn_comments' );
else :?>

<?php if ('open' == $post->comment_status) : ?>

<?php else : ?>
<p class="nocomments">نظرات بسته شده اند</p>
<?php endif; ?>

<?php endif; ?>
</div>