<?php
function test_function(){   
    add_theme_page("说说日志设置", "说说编写", 'edit_themes', basename(__FILE__), 'display_function');  
} 
add_action('admin_menu', 'test_function');
function showform(){?> 
    <form method="post" name="ashu_form" id="ashu_form">   
    <h2>说说编写</h2>   
    <p>   
    <label>   
    <input name="says" size="40" />   
    输入说说，不超过140字   
    </label>   
    </p>   
    <p class="submit">   
        <input type="submit" name="action" value="save" />   
    </p>    
    </form>   
<?php 
}
function display_function(){ 
if (get_post_meta('1', 'ty_says', true)==''){
add_post_meta('1','ty_says', '0');
}
$saynum=get_post_meta('1', 'ty_says', true);
FOR ($i = 1; $i <= $saynum; $i++) 
{ 
$e.=$i.',';
} 
$array = array(
 $e
);
echo 你已经编写了.$saynum.条说说.$e;
	foreach ($array as $value) { 
		$output = get_post_meta($saynum, 'ty_say', true);
		echo $output;
	}
if ( 'save' == $_REQUEST['action'] ) {
		add_post_meta($saynum+1,'ty_say',$_REQUEST['says'],false); 
		update_post_meta('1','ty_says', $saynum+1);
		}
echo get_post_meta('2', 'ty_say', true); ?>
<?php } ?>  