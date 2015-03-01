<?php get_header(); ?>
<div class="wrap" >
  <div class="main">
    <div class="article">
      <div class="map"><span> 当前位置：<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"> <i class="fa fa-home"></i>首页</a>>>
        <?php the_title(); ?>
        </span> </div>
      <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
      <div class="title">
        <h1>
          <?php the_title(); ?>
        </h1>
        <div class="subtitle"> <span><span><i class="fa fa-clock-o"></i>
          <?php the_time('Y年m月d日'); ?>
          </span><span><i class="fa fa-comment-o"></i>
          <?php comments_popup_link('暂无评论', '1 条评论', '% 条评论'); ?>
          </span><span><i class="fa fa-eye"></i>
          <?php post_views('', ''); ?>
          </span><span>
          <?php the_tags('<i class="fa fa-tags"></i>', ' / ','' ); ?>
          </span> </div>
      </div>
      <div class="article_content">
        <?php the_content('');?>
      </div>
      <?php endwhile; ?>
      <?php endif; ?>
    </div>
	<div class="clear"></div>
    <div class="con_pretext">
      <p>版权保护: 本文由 唐野 原创，转载请保留链接: <a href="<?php the_permalink()?>" title=<?php the_title(); ?>>
        <?php the_permalink(); ?>
        </a></p>
    </div>
    <div class="clear"></div>
    <div class="submain">
      <?php comments_template( '/comments.php' ); ?>
    </div>
  </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
