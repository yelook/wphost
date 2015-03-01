<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<?php if( is_single() || is_page() ) {
    if( function_exists('get_query_var') ) {
        $cpage = intval(get_query_var('cpage'));
        $commentPage = intval(get_query_var('comment-page'));
    }
    if( !empty($cpage) || !empty($commentPage) ) {
        echo '<meta name="robots" content="noindex" />';
        echo "\n";
    }
}
?>
<title>
<?php if (is_home() ) {?>
<?php bloginfo('name'); ?>
 |
<?php bloginfo('description'); ?>
<?php } else {?>
<?php wp_title('', true); ?>
 |
<?php bloginfo('name'); ?>
<?php } ?>
<?php if ( is_paged() ){ ?>
 | <?php printf( __('Page %1$s of %2$s', ''), intval( get_query_var('paged')), $wp_query->max_num_pages); ?>
<?php } ?>
</title>
	<?php if (is_home())
	{
	$description = get_option('ye_description');
	$keywords = get_option('ye_keywords');
	}
	elseif (is_category())
	{
	$description = category_description();
	$keywords = single_cat_title('', false);
	}
	elseif (is_tag())
	{
	$description = tag_description();
    $keywords = single_tag_title('', false);
	}
	elseif (is_single())
	{
     if ($post->post_excerpt) {$description = $post->post_excerpt;} 
	 else {$description = substr(strip_tags($post->post_content),0,240)."...";}
    $keywords = "";
    $tags = wp_get_post_tags($post->ID);
    foreach ($tags as $tag ) {$keywords = $keywords . $tag->name . ", ";}
	}
	?>
<meta name="keywords" content="<?php echo $keywords ?>" />
<meta name="description" content="<?php echo $description?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/img/favicon.ico" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
<link rel="stylesheet" type="text/css"  href="<?php bloginfo('template_url'); ?>/css/font-awesome.min.css"/>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/wphost.js"></script>
<?php wp_head(); ?>
</head>
<body>
<div class="topheader">
  <div class="wrap">
    <h1 class="logo"><a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></h1>
	<?php wp_nav_menu(array('theme_location' => 'top-menu','menu'=>'top-menu','container_class' => 'topmenu','menu_class' =>'nav'));  ?>
  </div>
</div>
</div>
