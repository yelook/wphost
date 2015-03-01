<div class="sider">
  <div class="bar">
    <div class="sidebox random">
      <h3>随机文章</h3>
      <?php wp_reset_query(); ?>
      <?php query_posts("showposts=5&caller_get_posts=1&order=DESC&orderby=rand"); ?>
      <ul>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <li>
          <div class="random-read"><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><img  class="sideico" src="<?php the_post_thumbnail('show',array( 'alt' => trim(strip_tags( $post->post_title )), 'title' => trim(strip_tags( $post->post_title )),'class' => 'icon')); ?>"></a>
            <a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></div>
        </li>
        <?php endwhile ?>
        <?php endif ?>
      </ul>
      <?php wp_reset_query(); ?>
    </div>
    <div class="sidebox">
      <h3>最新评论</h3>
      <ul>
        <?php r_comments($outer); ?>
      </ul>
    </div>
    <div class="sidebox">
      <h3>标签</h3>
      <ul class="tag_cloud">
        <?php wp_tag_cloud('number=30'); ?>
      </ul>
    </div>
    <?php wp_reset_query(); if (is_home()) : ?>
    <div class="sidebox linkcat">
      <h3>友情链接</h3>
      <ul>
        <?php wp_list_bookmarks('title_li='); ?>
      </ul>
    </div>
    <?php endif ?>
    <ul class="widgets">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
      <?php endif; ?>
    </ul>
  </div>
</div>
