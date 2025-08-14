<?php
    // 6/24-1-1 建立彈出視窗版型-測試頁 提供之後所有需要透過彈出視窗進行的功能使用
    // 步驟1 先斷開php 接著寫html
switch ($_GET['do'] ?? 'title') {
    case 'title':
?>

    <!-- 步驟2 彈出視窗/新增網站標題圖片 文字置中 -->
    
    <!-- 步驟5-1 <h3><form>整段移到 ./madal/title.php -->
    <h3 style='text-align:center'>新增標題區</h3>
    <hr>

    <!-- 步驟3 form>div*3 表單內放div較好排版 資料才用table-->
    <!-- input:file -->
    <!-- 考試不用寫id 實務要有id label才有用途 -->

    <!-- 步驟4 確認畫面 ajax功能 網址沒有重整 卻有彈出視窗 -->
    <!-- 不是寫在 backend.php、title.php 另外寫在view.php  -->
    
    <form action="">
        <div>
            <label>標題區圖片</label>
            <input type="file" name="img">
        </div>

        <div>
            <label>標題區替代文字</label>
            <input type="text" name="text">
        </div>

        <!-- 按鈕區 沒用button -->
        <!-- input:submit+input:reset -->
        <div>
            <input type="submit" value="新增">
            <input type="reset" value="重置">
        </div>
    </form>

    <!-- 步驟5-2 <h3><form>整段移到 ./madal/title.php -->
    <!-- 步驟6 之後會刪除 view2.php -->


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