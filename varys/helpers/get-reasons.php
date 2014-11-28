<?php

function get_reason($array, $comment){
  if($comment->comment_approved !== "1"){
    $reason = check_reasons($comment);
    echo "<div style='padding: 10px;background-color: #F2ECEC;border-left: 10px solid #BE6060;'>";
      echo "<ul>";
      if($reason){
        foreach($reason as $r){
          echo "<li><strong>".$r."</strong></li>";
        }
      } else { echo "<li><strong>Unknown Reason<strong></li>"; }
      echo "</ul>";
    echo "</strong></div>";
  }

  return $array;
}

?>
