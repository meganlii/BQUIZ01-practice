<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
  <!-- 步驟0：測試頁  更名為 動態文字廣告管理 -->
  <!-- 先不複製其他7個頁面 每頁互動方式不同要改變 避免混淆 -->
  <!-- 總共9個 7個差不多 另外2個有異動 -->

  <!-- 步驟1：複製 .\backend\title.php ctrl+a全選後貼上 -->

  <p class="t cent botli">最新消息管理</p>

  <form method="post" action="./api/edit.php">
    <table width="100%">
      <tbody>
        <tr class="yel">
          <td width="80%">最新消息內容</td>
          <td width="10%">顯示</td>
          <td width="10%">刪除</td>
          <td></td>
        </tr>

        <?php
        // 1. 貼上分頁功能變數
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

        // 1. 貼上分頁導航連結 end

        foreach ($rows as $row) :
        ?>
        <tr>
          <td>
            <textarea name="text[]" style="width: 90%;height: 60px;"><?= $row['text']; ?></textarea>
            <!-- <input type="text" name="text[]" value="< ?= $row['text']; ?>" style="width:90%"> -->
          </td>
          <td>
            <input type="checkbox" name="sh[]" value="<?= $row['id']; ?>" <?= ($row['sh'] == 1) ? "checked" : ""; ?>>
          </td>
          <td>
            <input type="checkbox" name="del[]" value="<?= $row['id']; ?>">
          </td>
          <td></td>
        </tr>

        <input type="hidden" name="id[]" value="<?= $row['id']; ?>">


        <?php
        endforeach;
        ?>

      </tbody>
    </table>

    <!-- 2. 貼上分頁導航連結 -->
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
      4. 套用到其他頁面-最新消息，三個<a>改成網址帶參數 do=image 改成 do= < ?=$do;?> 
      變數來自backend.php $do=$_GET['do']??'title';
      5. 測試 第2頁 任一筆取消顯示->修改確認後 會跳回第1頁 
      要改的話  要記住當前頁  用session/get/cookie皆可
      在第1頁示範即可

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

    <!-- 2. 分頁導航連結 end -->

    <table style="margin-top:40px; width:70%;">
      <tbody>
        <tr>
          <input type="hidden" name="table" value="<?= $do; ?>">

          <td width="200px">
            <input type="button" onclick="op('#cover','#cvr','./modal/<?= $do; ?>.php?table=<?= $do; ?>')"
              value="新增最新消息">
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
/**
// 路徑 ./當前目錄  以backend.php角度來看
// 所以<form> action="./api/edit_ad.php"  ./不是  ../
// 此頁 include 到 後台./backend.php-149行 可吃到db.php資料
// 位置 ./backend/title.php 後台右半部版型區

// 步驟1
複製 .\backend\ad.php 更名為news.php

// 步驟2
由上而下修改

1. 修改表單 欄位名稱
08行/14行/56行
最新消息管理/最新消息內容/新增最新消息

2. 28行 <input>改成<textarea>  </textarea>
不要斷行  不要加字
value="< ?= $row['text'] 寫到前後標籤中間 不用寫value=
設定高度60px


// 步驟3
// CURD 增C、改U  刪查/編輯功能
不須更新 update

// 步驟4
測試insert功能  新增modal
55行 onclick已經設定 新增模組-自動帶入參數 
1. 複製 .\modal\ad.php  更名為 news.php


// 步驟5
測試edit功能 修改 .\api\edit.php
新增最新消息內容後 可刪除 但顯示功能沒有變更  還沒有更新edit功能 


*/
</script>

<?php
// 用 PHP 註解或放在 footer 比較安全  此頁回上一層找cover 加上註解畫面會跑掉
// 盡量避免在<form> <table> → <tr> 中間直接加 HTML 註解，尤其是多層 include 的情況
// 移除&#39 --> 單引號' ' 標籤內有單雙引號時使用 html_entities
// https://www.w3schools.com/html/html_entities.asp

?>