<?php
switch ($_GET['do'] ?? 'title') {
    case 'title':
        // 步驟1 先斷開php 接著寫html
?>

    <!-- 步驟2 新增網站標題圖片/彈出視窗 文字置中 -->
    <h3 style='text-align:center'>新增標題區</h3>
    <hr>

    <!-- 步驟3 form>div*3 表單內放div較好排版 資料才用table-->
    <!-- input:file -->
    <!-- 考試不用寫id 實務要有id label才有用途 -->

    <!-- 步驟4 確認畫面 ajax功能 網址沒有重整 卻有彈出視窗 -->
    <!-- 不是寫在backend.php、title.php  -->
    <form action="">
        <div>
            <label>標題區圖片</label>
            <input type="file" name="img">
        </div>

        <div>
            <label>標題區替代文字</label>
            <input type="text" name="text">
        </div>

        <!-- 按鈕區 沒用button-->
        <!-- input:submit+input:reset -->
        <div>
            <input type="submit" value="新增">
            <input type="reset" value="重置">
        </div>
    </form>


<?php
        //   echo "title";
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