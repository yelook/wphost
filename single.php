<?php get_header(); ?>
<div class="container wrap">
	<div class="main">
    <div class="article">
      <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
      <div class="title">
	  	<div class="aboutauthor"><?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_email(), '50' ); }?>
		</div>
        <h1>
          <?php the_title(); ?>
        </h1>
        <div class="emtitle">发布于<?php the_time('Y年m月d日'); ?> | <?php comments_popup_link('暂无评论', '1条评论', '%条评论'); ?> | <?php post_views('', ''); ?>阅读 | <?php the_category(','); ?>
        </div>
      </div>
      <div class="the_content">
        <?php the_content('');?>
      </div>
      <?php endwhile; ?>
      <?php endif; ?>
    </div>
    <div class="clear"></div>
    <div class="subpage">
      <?php comments_template( '/comments.php' ); ?>
    </div>
	</div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
