<?php
// 收後台./modal/title.php 新增網站標題圖片 送來的表單資料  寫到資料庫

include_once "db.php";
echo "<pre>";
print_r($_POST);
print_r($_FILES);
echo "</pre>";


// 檔案上傳四步驟：檢查 / 移動 / 紀錄 / 存入資料庫
// 二維陣列變數 $_FILES [' '] [' ']  / $_POST

// 步驟1 檢查 / !empty( ) 檢查是否有檔案上傳 
// $_FILES['img'] = 上傳的檔案資訊
// ['tmp_name'] = 檔案暫存區 / 當檔案上傳後會先存在暫存區  並由伺服器給予一組亂碼的檔名
// !empty() = 檢查是否「不是空的」 代表 上傳成功
// 意思：如果用戶真的有選檔案上傳，就執行下面的程式
if (!empty($_FILES['img']['tmp_name'])) {

    // 步驟2 移動 / move_uploaded_file( ) 移動 上傳完成檔案 到 指定目錄下，並指定檔名
    // 兩個參數 ( $from , $to )
    // 把檔案從暫存區移到 ../images/ 資料夾
    // $_FILES['img']['name'] = 檔案的原始名稱 可能帶副檔名
    // 合併寫法不知是否可行 "../images/{$_FILES['img']['name']}"
    move_uploaded_file($_FILES['img']['tmp_name'], "../images/" . $_FILES['img']['name']);

    // 步驟3 記錄 / 記錄檔案名稱 $_POST 同$_FILES 都是 陣列變數
    // 把右方檔案名稱 存到 $_POST['img'] 變數中  之後要送到資料庫
    // $_POST['img'] 鍵值來自 <input type="file" name="img">
    // 一維陣列-儲存 表單欄位/鍵值  鍵值是 欄位名稱['img']['text']

    // 補齊$_POST資料  對應資料表titles 欄位 ['img'] ['sh']
    // 郵差 接收表單資料 準備 投遞送到資料庫
    $_POST['img'] = $_FILES['img']['name'];

    // 所有上傳照片 預設不顯示 之後再手動調整
    // 這段可以移出判斷式
    // $_POST['sh']=0;
}

// 步驟4 
// 所有上傳照片 預設不顯示 之後再手動調整
$_POST['sh'] = 0;

// 步驟5 DB::save()
// 資料表目前是空的 需要先判斷資料表狀況 決定第一筆上傳資料開或關
// 要寫太多行程式 檢定不適合 改用最大可能性寫法
// 引入db.php共用函式 透過DB:: 彙整常用程式 看不到sql跟pdo 程式碼短更好閱讀
// 不用加一堆中文註解  但能看懂程式碼用法
$Title->save($_POST);

// 步驟6 回到後台 ?do=title 注意?
// 因為後台./madal/title.php發請求到api 需再將頁面導回後台
to('../backend.php?do=title');

?>

<script>
    /* 
1. 出現意外狀況 程式寫完後，要先執行刪除 再點選單選框就正常
剛寫完測試 點選單選框後，按下"修改確定"後，單選框顯示會消失不見
(有可能 同時選到顯示跟刪除)

2. 檢定與實務差異：檢定寫法是全部跑一次 全部處理
實務上要多寫很多檢查程式 自動判斷資料有無如何處理 或定位有變更才處理
規模不同 解決問題步驟有差異

3. 程式優化：再思考哪些功能可以合併，參6/27筆記-第120行

.\api\edit_ad.php
.\api\edit_title.php

.\api\insert_title.php
.\api\insert_ad.php
(1) 程式大多重複，只有少數不同的地方 可設參數
(2) 最後api只需要五個檔案，即可解決所有後台需求
(3) 功能變多10-20個時，逐個寫太花時間 也容易出錯 負擔加重
(4) 擴充功能 要刻畫面 寫api、modal 有更快方式解決
(5) 用判斷式if / switch case、迴圈 排除特例或做特別處理
簡化重複多的程式碼

*/
</script>