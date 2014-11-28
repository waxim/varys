<?php

function add_advanced_filter_menu() {
  add_comments_page("Advanced Comment Filters", "Advanced Comment Filters", 'read', 'advanced-filter', 'advanced_filter_menu');
}

function advanced_filter_menu(){ echo "<div class='wrap'><h2>Advanced Filters</h2></div>"; }

?>
