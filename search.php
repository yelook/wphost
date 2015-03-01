<?php get_header(); ?>
<div class="wrap">
  <div class="main">
    <div class="map1"> <span> 当前位置：<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"> <i class="fa fa-home"></i>首页</a>>>含有<?php the_search_query(); ?>的搜索结果
      <h1>含有<?php the_search_query(); ?>的搜索结果</h1>
      </span> </div>
    <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
    <div class="block"> <span class="category">
      <?php the_category(','); ?>
      <i class="fa fa-caret-right"></i></span>
      <h2><a href="<?php the_permalink() ?>">
        <?php the_title(); ?>
        </a></h2>
      <div class="clear"></div>
      <div class="viewimg"> <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"> <img src="<?php echo post_thumbnail_src('thumbnail'); ?>" alt="<?php the_title(); ?>" class="thumbnail" /><span class="shine">&nbsp;</span> </a> </div>
      <div class="preview"> <?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 230,"……"); ?> </div>
      <div class="preem"> <span><i class="fa fa-clock-o"></i>
        <?php the_time('Y年m月d日'); ?>
        </span><span><i class="fa fa-comment-o"></i>
        <?php comments_popup_link('暂无评论', '1 条评论', '% 条评论'); ?>
        </span><span><i class="fa fa-eye"></i>
        <?php post_views('', ''); ?>
        </span><span>
        <?php the_tags('<i class="fa fa-tags"></i>', ' / ','' ); ?>
        </span><span class="more"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">阅读详情</a></span> </div>
    </div>
    <?php endwhile; ?>
    <?php else : ?>
    <div class="block">
      <h2>没有搜索结果，你是不是搜索啥猥琐东西了？</h2>
    </div>
    <?php endif; ?>
    <?php kriesi_pagination($query_string); ?>
  </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
