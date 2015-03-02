<?php get_header(); ?>
<div class="container wrap">
	<div class="main">
    <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
    <div class="box">
		<div class="pic"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php post_thumbnail_bigsrc() ?>"/></a></div>
		<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
      <div class="preview"> <?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 260,"……"); ?> </div>
      <div class="preem"> <?php the_time('y/m/d'); ?> | <?php comments_popup_link('暂无评论', '1 条评论', '% 条评论'); ?> | <?php post_views('', ''); ?>阅读
	  <span class="more"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">阅读详情</a></span> </div>
    </div>
    <?php endwhile; ?>
    <?php endif; ?>
    <?php kriesi_pagination($query_string); ?>
	</div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>