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

<?php 

// switch($_GET['do'] ?? 'title') {
//     case 'title':
//         echo "title";
//         break;
//     case 'ad':
//         echo "ad";
//         break;
//     case 'mvim':
//         $file = './backend/mvim.php';
//         break;
//     case 'image':
//         $file = './backend/image.php';
//         break;
//     case 'total':
//         $file = './backend/total.php';
//         break;
//     case 'bottom':
//         $file = './backend/bottom.php';
//         break;
//     case 'news':
//         $file = './backend/news.php';
//         break;
//     case 'admin':
//         $file = './backend/admin.php';
//         break;
//     case 'menu':
//         $file = './backend/menu.php';
//         break;
//     default:
//         $file = './backend/title.php';
// }

?>