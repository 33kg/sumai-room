<?php
  $post = $wp_query->post;
  if ( in_category('rent') ) {
	  include(TEMPLATEPATH.'/single-rent.php');
  } elseif ( in_category('buy') ) {
	  include(TEMPLATEPATH.'/single-buy.php');
  } elseif ( in_category('topics') ) {
	  include(TEMPLATEPATH.'/single-topics.php');
  } else {
	  include(TEMPLATEPATH.'/single-default.php');
  }
?>