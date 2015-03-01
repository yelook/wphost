<?php
//保护后台登录
add_action('login_enqueue_scripts','login_protection');  
function login_protection(){  
    if($_GET['tang'] != 'ye')header('Location: http://www.yelook.com/');  
}
/*支持菜单*/
if(function_exists('register_nav_menus')){
register_nav_menus(
array(
'top-menu' => __( '顶部菜单' ),
'index-menu' => __( '主菜单' ),
)
);
}
if ( function_exists('add_theme_support') )
add_theme_support('post-thumbnails');
add_image_size('thumbnail', 160, 120, true);
add_image_size('show', 80, 60, true);
function post_thumbnail_src1($size){
global $post;
echo $size;
}

function autoset_featured() {
          global $post;
          $already_has_thumb = has_post_thumbnail($post->ID);
              if (!$already_has_thumb)  {
              $attached_image = get_children( "post_parent=$post->ID&post_type=attachment&post_mime_type=image&numberposts=1" );
                          if ($attached_image) {
                                foreach ($attached_image as $attachment_id => $attachment) {
                                set_post_thumbnail($post->ID, $attachment_id);
                                }
                           }
                        }
      }  //end function
add_action('the_post', 'autoset_featured');
add_action('save_post', 'autoset_featured');
add_action('draft_to_publish', 'autoset_featured');
add_action('new_to_publish', 'autoset_featured');
add_action('pending_to_publish', 'autoset_featured');
add_action('future_to_publish', 'autoset_featured');
remove_filter('the_content', 'wptexturize');
//输出缩略图地址 From wpdaxue.com
function post_thumbnail_src(){
    global $post;
	if( $values = get_post_custom_values("show") ) {	//输出自定义域图片地址
		$values = get_post_custom_values("show");
		$post_thumbnail_src = $values [0];
	} elseif( has_post_thumbnail() ){    //如果有特色缩略图，则输出缩略图地址
        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
		$post_thumbnail_src = $thumbnail_src [0];
    } else {
		$post_thumbnail_src = '';
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		$post_thumbnail_src = $matches [1] [0];
if(empty($post_thumbnail_src)){return false;}	//获取该图片 src
	};
	echo $post_thumbnail_src;
}
/*小工具*/
if( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'before_widget' => '<li class="subblock">', // widget 的开始标签
		'after_widget' => '</li>', // widget 的结束标签
		'before_title' => '<h3>', // 标题的开始标签
		'after_title' => '</h3>' // 标题的结束标签
	));
}

/*导航菜单*/
register_nav_menus( array(  
 'primary' => __( 'Primary Navigation'),
 ));

//访问计数
function record_visitors(){
	if (is_singular()) {global $post;
	 $post_ID = $post->ID;
	  if($post_ID) 
	  {
		  $post_views = (int)get_post_meta($post_ID, 'views', true);
		  if(!update_post_meta($post_ID, 'views', ($post_views+1))) 
		  {
			add_post_meta($post_ID, 'views', 1, true);
		  }
	  }
	}
}
add_action('wp_head', 'record_visitors');  
function post_views($before = '(点击 ', $after = ' 次)', $echo = 1)
{
  global $post;
  $post_ID = $post->ID;
  $views = (int)get_post_meta($post_ID, 'views', true);
  if ($echo) echo $before, number_format($views), $after;
  else return $views;
};
//自定义表情地址
function custom_smilies_src($src, $img){return get_bloginfo('template_directory').'/img/smilies/' . $img;}
add_filter('smilies_src', 'custom_smilies_src', 10, 2);

//头像使用duoshuo缓存 
function get_avatar_deadwood( $avatar ) { 
  $avatar = preg_replace( "/http:\/\/(www|\d).gravatar.com/","http://gravatar.duoshuo.com",$avatar ); 
  return $avatar; 
} 
add_filter( 'get_avatar', 'get_avatar_deadwood' );
/* comment_mail_notify v1.0 by willin kan. (所有回复都发邮件) */
function comment_mail_notify($comment_id) {
  $comment = get_comment($comment_id);
  $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
  $spam_confirmed = $comment->comment_approved;
  if (($parent_id != '') && ($spam_confirmed != 'spam')) {
    $wp_email = 'skipperty@163.com'; //e-mail 发出点, no-reply 可改为可用的 e-mail.
    $to = trim(get_comment($parent_id)->comment_author_email);
    $subject = '您在 [' . get_option("blogname") . '] 的留言有了回复';
    $message = '
    <div style="background-color:#eef2fa; border:1px solid #d8e3e8; color:#111; padding:0 15px; -moz-border-radius:5px; -webkit-border-radius:5px; -khtml-border-radius:5px;">
      <p>' . trim(get_comment($parent_id)->comment_author) . ', 您好!</p>
      <p><strong>您曾在《' . get_the_title($comment->comment_post_ID) . '》的留言:</strong><br />'
       . trim(get_comment($parent_id)->comment_content) . '</p>
      <p><strong>' . trim($comment->comment_author) . ' 给您的回复:</strong><br />'
       . trim($comment->comment_content) . '<br /></p>
      <p>您可以点击 <a href="' . htmlspecialchars(get_comment_link($parent_id)) . '" target="_blank">查看回复完整內容</a></p>
      <p>欢迎再度光临 <a href="http://www.yelook.com" target="_blank">' . get_option('blogname') . '</a></p>
      <p>(此邮件由系统自动发送，请勿回复.)</p>
    </div>';
      $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
      $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
      wp_mail( $to, $subject, $message, $headers );
  }
}
add_action('comment_post', 'comment_mail_notify');
// -- END ----------------------------------------
 //评论回复
function dw_comment($comment, $args, $depth) {$GLOBALS['comment'] = $comment;
    global $commentcount,$wpdb, $post;
     if(!$commentcount) { 
          $comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_post_ID = $post->ID AND comment_type = '' AND comment_approved = '1' AND !comment_parent");
          $cnt = count($comments);
          $page = get_query_var('cpage');
          $cpp=get_option('comments_per_page');
         if (ceil($cnt / $cpp) == 1 || ($page > 1 && $page  == ceil($cnt / $cpp))) {
             $commentcount = $cnt + 1;
         } else {$commentcount = $cpp * $page + 1;}
     }
		?>

<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
  <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php $add_below = 'div-comment'; ?>
    <div class="comment-avatar"><?php echo get_avatar( $comment, 50 ); ?></div>
    <div class="italk">
	<span class="comment-span">
      <?php comment_author_link() ?>
      </span>
      <?php edit_comment_link('编辑','&nbsp;&nbsp;',''); ?>
      <?php if ( $comment->comment_approved == '0' ) : ?>
      <span style="color:#C00; font-style:inherit">您的评论正在等待审核中...</span> <br />
      <?php endif; ?>
      <div  class="comment-text">
        <?php comment_text() ?>
      </div>
	  <div class="clear"></div>
      <span class="datetime"><?php echo time_since(abs(strtotime($comment->comment_date_gmt . "GMT")), true);?> </span><span class="reply">
      <?php comment_reply_link(array_merge( $args, array('reply_text' => '[回复]', 'add_below' =>$add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
      </span> </div>
  </div>
  <?php
}
function dw_end_comment() {echo '</li>';};
//登陆显示头像
function dw_own_avatar($email, $size = 48){
return get_avatar($email, $size);
};
//屏蔽全英文评论
function refused_spam_comments( $comment_data ) {  
$pattern = '/[一-龥]/u';  
if(!preg_match($pattern,$comment_data['comment_content'])) {  
wp_die( "You should type some Chinese word (like \"你好\") in your comment to pass the spam-check, thanks for your patience! 您的评论中必须包含汉字!" );
}
return( $comment_data );  
}  
add_filter('preprocess_comment','refused_spam_comments'); 
function time_since($older_date,$comment_date = false) {
		$chunks = array(
			array(86400 , '天前'),
			array(3600 , '小时前'),
			array(60 , '分钟前'),
			array(1 , '秒前'),
		);
		$newer_date = time();
		$since = abs($newer_date - $older_date);
		if($since < 2592000){
			for ($i = 0, $j = count($chunks); $i < $j; $i++){
				$seconds = $chunks[$i][0];
				$name = $chunks[$i][1];
				if (($count = floor($since / $seconds)) != 0) break;
			}
			$output = $count.$name;
		}else{
			$output = !$comment_date ? (date('Y-m-j G:i', $older_date)) : (date('Y-m-j', $older_date));
		}
		return $output;
	}
//边栏评论
function r_comments($outer){
	global $wpdb;
	$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type,comment_author_url,comment_author_email, SUBSTRING(comment_content,1,16) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' AND user_id='0' AND comment_author != '".$outer."' ORDER BY comment_date_gmt DESC LIMIT 5";
	$comments = $wpdb->get_results($sql);
	$output = $pre_HTML;
	foreach ($comments as $comment) {$output .= "\n<li class='sideshow gsmall'><a href=\"". get_permalink($comment->ID) ."#comment-".$comment->comment_ID."\"title=\"发表在： " .$comment->post_title . "\">".get_avatar( $comment, 32,'',$comment->comment_author)." ". strip_tags($comment->com_excerpt)."</a></li>";}
	$output .= $post_HTML;
	echo $output;
};
/*分页代码*/
function kriesi_pagination($query_string){   
global $posts_per_page, $paged;   
$my_query = new WP_Query($query_string ."&posts_per_page=-1");   
$total_posts = $my_query->post_count;   
if(empty($paged))$paged = 1;   
$prev = $paged - 1;   
$next = $paged + 1;   
$range = 2; // only edit this if you want to show more page-links   
$showitems = ($range * 2)+1;   
$pages = ceil($total_posts/$posts_per_page);   
if(1 != $pages){   
echo "<div class='pagination'>";   
echo ($paged > 2 && $paged+$range+1 > $pages && $showitems < $pages)? "<a href='".get_pagenum_link(1)."'>最前</a>":"";   
echo ($paged > 1 && $showitems < $pages)? "<a href='".get_pagenum_link($prev)."'>上一页</a>":"";   
for ($i=1; $i <= $pages; $i++){   
if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){   
echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";   
}   
}
echo ($paged < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($next)."'>下一页</a>" :"";   
echo ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($pages)."'>最后</a>":"";   
echo "</div>\n";   
}   
}
require get_template_directory() . '/includes/do.php';
include("includes/theme_options.php"); 
?>