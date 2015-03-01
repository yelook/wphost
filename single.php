<?php get_header(); ?>
<div class="container wrap">
	<div class="main">
    <div class="article">
      <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
      <div class="title">
        <h1>
          <?php the_title(); ?>
        </h1>
        <div class="emtitle">发布于<?php the_time('Y年m月d日'); ?>
          <?php comments_popup_link('暂无评论', '1条评论', '%条评论'); ?>
          <?php post_views('', ''); ?>阅读
          <?php the_category(','); ?>
        </div>
      </div>
      <div class="the_content">
        <?php the_content('');?>
      </div>
      <?php endwhile; ?>
      <?php endif; ?>
    </div>
    <div class="clear"></div>
    <div class="con_pretext">
      <ul>
        <li class="first">上一篇：
          <?php previous_post_link('%link') ?>
        </li>
        <li class="last">下一篇：
          <?php next_post_link('%link') ?>
        </li>
      </ul>
    </div>
    <div class="clear"></div>
    <div class="subpage">
      <?php comments_template( '/comments.php' ); ?>
    </div>
	</div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
