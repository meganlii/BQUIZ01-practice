<!-- 步驟0：6/27-6 整併更換圖片update功能為一支彈出視窗modal檔案
1. 複製本頁 改為.\modal\update.php
2. 整合 選單4：新增校園映像圖片的更換圖片 也是類似項目modal
3. 兩個頁面差異 只有<h3跟<label>標題文字不同
使用switch case 切換文字
最直覺方式 但下方<label>還要再寫一次 失去檔案精簡意義
strreplace也可  但要換三個 有點囉嗦  沒有快很多

4. 更簡化方式：改成陣列key=value形式處理 不用寫判斷條件式
// 二維陣列 可放多個參數值 給key值即可得到對應value
-->

<!-- 步驟1：加上php區段 -->
<?php

  // 步驟2：switch寫法
  // 依據接收的資料表名稱判斷 來自後台url參數 同下方隱藏欄位用法
  // switch ($_GET['table']) {
  //   case 'title':
  //     echo '更新標題區圖片';
  //     break;
  //   case 'mvim':
  //     echo '更換動畫圖片';
  //     break;
  //   case 'image':
  //     echo '更換校園映像圖片';
  //     break;

  // }

  // 步驟3：更簡化方式：改成陣列key=value形式處理 不用寫判斷條件式
  // (1)宣告二維陣列 選單名稱+兩組k-v 寫好格式：[''=> []];
  // (2)第二個陣列 有兩個內容 記得中間用逗號,隔開''=>'', 第二個陣列]，後方也有,
  // (3)複製3組  調整對齊 寫入3組選單名稱

  $str = [
    'title' => [
                'header' => '更新標題區圖片',
                'label' => '標題區圖片'
    ],

    'mvim' => [
                'header' => '更換動畫圖片',
                'label' => '動畫圖片'
    ],

    'image' => [
                'header' => '更換校園映像圖片',
                'label' => '校園映像圖片'
    ],

  ];

  // 步驟4：改成帶參數寫法
  // 應該用get打成POST
  // echo $str['tille']['header']
  // echo $str[$_POST['table']]['header']

  
?>

<!-- 步驟5：php放到最外層，echo移到<h3>裡面 跟<label>一致 -->
<!-- 印出 '更新標題區圖片' -->
<h3 style='text-align:center'>
<?= $str[$_GET['table']]['header'] ;?>
</h3>

<hr>

<form action="./api/update.php" method="post" enctype="multipart/form-data">
  <div>
    
    <!-- 步驟5：複製上方echo 改成label -->
    <!-- <label>標題區圖片：</label> -->
    <!-- 印出 '標題區圖片' -->
    <label>
      <?= $str[$_GET['table']]['label']; ?>：
    </label>
    <input type="file" name="img">
  </div>

  <div>
    <input type="hidden" name="id" value="<?= $_GET['id']; ?>">
    <input type="hidden" name="table" value="<?= $_GET['table']; ?>">
    <input type="submit" value="更新">
    <input type="reset" value="重置">
  </div>
</form>

<!-- 步驟6
1. 修改 .\backend\mvim.php   33行onclick路徑 改成 './modal/update.php
2. 修改 .\backend\title.php  33行onclick路徑 改成 './modal/update.php
3. 沒有改成$do參數  避免一行程式 重複帶一樣參數
-->

