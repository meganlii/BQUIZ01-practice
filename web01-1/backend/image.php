<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
  <p class="t cent botli">校園映像圖片管理</p>

  <form method="post" action="./api/edit.php">
    <table width="100%">
      <tbody>
        <tr class="yel">
          <td width="80%">校園映像圖片</td>
          <td width="10%">顯示</td>
          <td width="10%">刪除</td>
          <td></td>
        </tr>

        <?php
        // 步驟7：分頁功能變數設定 拆成6個參數  假設有 10 筆資料
        // 總資料數 $all=10  count()計算總數 貼上$rows
        $all = count(${ucfirst($do)}->all());

        // 每頁筆數：每頁3筆  設定每頁顯示 3 筆資料
        $div = 3;

        // 計算總頁數（給分頁導航用） 知道要產生幾個頁碼按鈕
        // ceil()無條件進位，確保即使最後一頁資料不足也會算一頁
        // $pages = ceil(10/3) = 4頁（用來顯示：1 2 3 4 頁碼按鈕）
        $pages = ceil($all / $div);

        // 取得目前頁碼，另外在URL設定參數p取得，如果沒有傳入參數，預設為第1頁
        // 點第3頁 $now = 3 
        $now = $_GET['p'] ?? 1;

        // 計算SQL查詢的起始索引位置（給SQL Limit查詢用） 知道要從哪筆開始取
        // $start = (3-1) * 3 = 6，表示從 索引6 開始取3筆 = 第 7,8,9 筆
        // 第3頁 (3-1)表示前2頁*每頁3筆 = 共6筆資料 = 索引值6
        $start = ($now - 1) * $div;


        // 輸出 $rows=$Title->all();
        // LIMIT限制筆數(索引值,查詢筆數) LIMIT 10,20 從資料表第11筆開始，取出20筆資料
        // 拼錯字limin
        $rows = ${ucfirst($do)}->all("limit $start,$div");
        // $rows = ${ucfirst($do)}->all();
        foreach ($rows as $row) :
        ?>
          <tr>
            <td>
              <img src="./images/<?= $row['img']; ?>" style=" width:120px;height:68px; ">
            </td>
            <td>
              <input type="checkbox" name="sh[]" value="<?= $row['id']; ?>" <?= ($row['sh'] == 1) ? "checked" : ""; ?>>
            </td>
            <td>
              <input type="checkbox" name="del[]" value="<?= $row['id']; ?>">
            </td>

            <td>
              <input type="button" value="更換圖片"
                onclick="op('#cover','#cvr','./modal/update.php?id=<?= $row['id']; ?>&table=<?= $do; ?> ')">
            </td>
          </tr>

          <input type="hidden" name="id[]" value="<?= $row['id']; ?>">

        <?php
        endforeach;
        ?>

      </tbody>
    </table>

    <!-- 步驟8：分頁導航連結 
    1. 新增div
    2. 套用原有css .cent{text-align: center} 文字置中
    3. < 1 2 3 >  數字 1 2 3 加上連結
    4. 斷行切開 加上<a>
    5. 增加css .cent a{text-decoration: none} 因為是外部連結引入 ctrl+F5強制更新才會重整畫面
    -->
    <div class="cent">
      <!-- 上一頁：因為<要設a連結到上頁  p=$now-1才可到下頁
      1.整段用php包起來  加判斷式 大括號{} 改用:/endif
      < ?php if():  ?>
      < ?php endif; ?>
      2. 加上 &p= < ?= $now-1; ?>
      3. $now-1>0 
      共3頁 第1頁  不顯示<  1-1=0   X
      共3頁 第2頁  顯示<    2-1=1  >0
      共3頁 第3頁  顯示<    3-1=2  >0
      -->
      <?php if ($now-1>0): ?>
        <a href="?do=<?=$do;?>&p=<?= $now-1 ;?>"> < </a>
      <?php endif; ?>

      <!-- 中間有多頁 無法寫死  
      1. 用for迴圈
      < ?php for():  ?>
      < ?php endfor; ?>
      
      2. 用三元運算?:  當前頁 數字放大顯示 
      $size($i==$now)?'20px':''; 少寫=
      3. style="font-size:< ?=$size;?>"
      4. 套用到其他頁面，三個<a>改成網址帶參數 do=image 改成 do= < ?=$do;?> 
      變數來自backend.php $do=$_GET['do']??'title';
      -->
      <?php
      for($i=1;$i<=$pages;$i++): 
      $size=($i==$now)?'30px':'';
      ?>
        <a href="?do=<?=$do;?>&p=<?=$i;?>" style="font-size:<?=$size;?>" >
          <?=$i;?> 
        </a>
      <?php endfor; ?>

  <!--  <a href=""> 1 </a>
        <a href=""> 2 </a>
        <a href=""> 3 </a> -->
      
      <!-- 下一頁：因為>要設a連結到下頁  p=$now+1才可到下頁
      $now+1<=$pages
      共3頁 第1頁 顯示>    1+1=2 <3
      共3頁 第2頁 顯示>    2+1=3 =3
      共3頁 第3頁 不顯示>  3+1=4  X
      -->
      <?php if ($now+1<=$pages): ?>
        <a href="?do=<?=$do;?>&p=<?= $now+1 ;?>"> > </a>
      <?php endif; ?>
    </div>


    <table style="margin-top:40px; width:70%;">
      <tbody>
        <tr>
          <input type="hidden" name="table" value="<?= $do; ?>">

          <td width="200px">
            <!-- <input type="button" onclick="op('#cover','#cvr','./modal/<?= $do; ?>.php?table=<?= $do; ?>')" -->
            <input type="button" onclick="op('#cover','#cvr','./modal/<?= $do; ?>.php?table=<?= $do; ?>')"
              value="新增校園映像圖片">
          </td>

          <td class="cent">
            <input type="submit" value="修改確定">
            <input type="reset" value="重置">
          </td>

        </tr>
      </tbody>
    </table>

  </form>
</div>

<script>
  /*
// 位置 ./backend/title.php 後台右半部版型區 
// 此頁 include 到 後台./backend.php-149行 可吃到db.php資料
// 有兩個<table>

// 路徑 屬於./當前目錄  web01-1目錄  以backend.php角度來看  
// 所以<form> action="./api/edit_title.php"  用./  不是../
// 其他資料夾modal、backend檔案 送到api處理  要以backend.php角度來看跟api關係  屬於./當前目錄  web01-1目錄 
// api處理完了，資料夾api內的檔案跟backend.php關係 則是回上一層  用../  回到後台


// 步驟7
分頁功能變數設定
總資料：10 筆
每頁顯示：3 筆
10 ÷ 3 = 3.33...
ceil(3.33) = 4（無條件進位）
結果：總共需要 4 頁

實際對應關係
  頁碼   |    計算過程   | 起始索引  | 實際取得的資料
第 1 頁  | (1-1)×3 = 0  |   0     |  第1,2,3筆
第 2 頁  | (2-1)×3 = 3  |   3     |  第4,5,6筆
第 3 頁  | (3-1)×3 = 6  |   6     |  第7,8,9筆

// 步驟8
另外在URL設定參數p取得
1. 測試 網址輸入&p=1 &p=2 &p=3
2. 點選連結即可切換到 第1 2 3 頁
3. 根據規格書示例 可知分頁導航連結在最下方  兩個<table>中間
4. 分頁導航連結  < 1 2 3 >  加上連結



-------------
// 步驟0
複製 .\backend\mvim.php 更名為image.php

// 步驟1
由上而下修改

1. 修改表單 欄位名稱
02行/08行/32行/54行
校園映像圖片管理/校園映像圖片/更換圖片/新增校園映像圖片

2. 33行 onclick已經設定更新模組-自動帶入參數 
./modal/update.php

// 步驟2
1. 記得db.php加上 DB物件 $Image
後面還有七個功能，可一次全部加上

// 步驟3
1. 22行 後台圖片大小有規範  後台管理顯示大小為 100*68 像素。
style="width:100px" 
置中失效 可能要設在別處？？
text-align:center / align-items: center / vertical-align:middle 

// 步驟4
// CURD 增C、改U  刪查/編輯功能
不須更新 update

// 步驟5
insert功能  新增modal
複製 .\modal\mvim.php  更名為 image.php

// 步驟6
edit功能
新增圖片後，顯示功能無法修改  還沒有更新edit功能 
修改 .\api\edit.php


----以下不須更動，已經用變數取代
2. 複製 .\modal\update_title.php 更名為 .\modal\update_mvim.php 

// 步驟3
6/27-5 整併更新圖片api為一支
1. 新增 <input type="hidden" name="table" value= 
2. 回到 .\backend\title.php 設定onclick路徑參數
3. 33行 新增onclick參數 &table= < ?= $do; ?>
參考52行 

// 步驟4
修改 33行 onclick路徑
沒有改成$do參數  避免一行程式 重複帶一樣參數

*/
</script>

<?php
// 用 PHP 註解或放在 footer 比較安全  此頁回上一層找cover 加上註解畫面會跑掉
// 盡量避免在<form> <table> → <tr> 中間直接加 HTML 註解，尤其是多層 include 的情況
// 移除&#39 --> 單引號' ' 標籤內有單雙引號時使用 html_entities
// https://www.w3schools.com/html/html_entities.asp

?>