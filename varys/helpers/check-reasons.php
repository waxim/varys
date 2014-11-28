<?php

function check_reasons($comment){

  $url = "";
  $text = $comment->comment_content;
  $text = apply_filters('comment_text', $text);

  $ip = $comment->comment_author_IP;
  $author = $comment->comment_author;
  $email = $comment->comment_author_email;
  $useragent = $comment->comment_agent;

  $reason = [];

  if ($max_links = get_option( 'comment_max_links')){
    $num_links = preg_match_all( '/<a [^>]*href/i', $text, $out);
    $num_links = apply_filters('comment_max_links_url', $num_links, $url);
    if ($num_links >= $max_links){
      $reason[] = "Too many links";
    }
  }

  $mod_keys = trim(get_option('moderation_keys'));
  if (!empty($mod_keys)) {
      $words = explode("\n", $mod_keys);

      foreach ((array) $words as $word){
          $word = trim($word);

          // Skip empty lines
          if (empty($word))
              continue;

          $word = preg_quote($word, '#');
          $pattern = "#$word#i";

          // Check comment for blocked words
          preg_match($pattern, $text, $matches);
          if(count($matches) > 0){ $reason[] = "Comment body matched the blocked word (".implode(",",$matches).")"; }
          $matches = array();

          // check for blocked user names or emails
          preg_match($pattern, $author, $matches);
          preg_match($pattern, $email, $matches2);
          if(count($matches) > 0 || count($matches2) > 0){ $reason[] = "Comment author or email is blocked."; }
          $matches = array();

          // check for blocked useragents
          preg_match($pattern, $useragent, $matches);
          if(count($matches) > 0){ $reason[] = "The browser of this user is blocked (".implode(",",$matches).")"; }
          $matches = array();

          // check for blocked ips
          preg_match($pattern, $ip, $matches);
          if(count($matches) > 0){ $reason[] = "The IP address of the comment author is blocked (".implode(",",$matches).")"; }
      }
  }

  if(count($reason) > 0){
    return $reason;
  } else { return false; }

}

?>
