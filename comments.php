<?php
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('请不要直接打开，谢谢。');
	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) { 
			?>
			<p class="nocomments">请输入密码后查看评论</p>
			<?php
			return;
		}
	}
	$oddcomment = '';
?>
<?php if ($comments) : ?>
<div class="comments">
	<div class="comments-data">
	<h2 class="comments-title"><?php comments_number('', '1 条吐槽', '% 条吐槽' );?></h2>
	</div>
	<div id="loading-comments"><span>Loading...</span></div>
	<div class="comments-container">
	<ol class="commentlist">
	<?php wp_list_comments('type=comment&callback=dw_comment&end-callback=dw_end_comment&max_depth=23'); ?>
	</ol>
	</div>
	<div class="page_navi"><?php paginate_comments_links('prev_text=上一页&next_text=下一页'); ?></div>
<?php else : ?>
	<?php if ('open' == $post->comment_status) : ?>
<div class="comments">
	<div class="comments-data">
        <h2 class="comments-title">暂无评论</h2>
	</div>
	 <?php else :  ?>
		<p class="nocomments">评论已关闭</p>
	<?php endif; ?>
	<?php endif; ?>
	<?php if ('open' == $post->comment_status) : ?>
	<div id="respond" class="respond">
		<h4 class="detitle">发布评论</h4>	
		<div class="cancel-comment-reply">	
			<small><?php cancel_comment_reply_link(); ?></small>
		</div>
		<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
		<p><?php print '您必须'; ?><a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"> [ 登录 ] </a>才能发表留言！</p>
    <?php else : ?>
    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
	<?php if ( ! $user_ID ): ?>
	<div id="comment-author-info">
		<p>
			<input type="text" name="author" id="author" class="commenttext" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
			<label for="author">昵称*</label>
		</p>
		<p>
			<input type="text" name="email" id="email" class="commenttext" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
			<label for="email">邮箱*</label>
		</p>
		<p>
			<input type="text" name="url" id="url" class="commenttext" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
			<label for="url">网址</label>
		</p>
	</div>
      <?php endif; ?>
      <div class="clear"></div>
	    <p><?php include(TEMPLATEPATH . '/includes/smiley.php'); ?></p>
		<p><textarea name="comment" id="comment" tabindex="4"></textarea></p>
		<p>
			<input class="submit" name="submit" type="submit" id="submit" tabindex="5" value="提交" />
			<?php comment_id_fields(); ?>
		</p>
		<?php do_action('comment_form', $post->ID); ?>
    </form>
	<div class="clear"></div>
    <?php endif;?>
	</div>
</div>
  <?php endif;?>