<?php
switch ($_GET['do'] ?? 'title' ) {
 case 'title':
  echo "title";
  break;
 
 case 'ad':
  echo "ad";
  break;
}

?>