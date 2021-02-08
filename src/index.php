
<?php
  require_once('claim.php');

  // タイムゾーン設定
  date_default_timezone_set('Asia/Tokyo');

  // セッション開始
  session_start();

  // クラス生成
  $claim = new CClaim();

  // 変数初期化
  $emptyMsgClaim = null;
  $successMsg = null;
  $clean = array();

  // 送信ボタンが押下されたとき
  if(!empty($_POST['btn-submit'])){

    $isError = false;

    // 不満内容が空の時
    if(empty($_POST['input-claim'])){
      $claim->setErrMsg($claim->getEmptyMessageClaim());
      $isError = true;
    }else{
      $clean['input-claim'] = htmlspecialchars($_POST['input-claim'],ENT_QUOTES);
      $clean['input-claim'] = preg_replace( '/\\r\\n|\\n|\\r/', '<br>', $clean['input-claim']);
    }

    // エラーが無ければ保存
    if (!$isError){
      $claim->write($clean);

      // 更新が完了した時
      $successMsg = $claim->getSuccessMsg();
    }
  }

  // 不満読み込み
  $claim->read();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="css/css.css" rel="stylesheet" type="text/css">
  <script src="js/index.js"></script>
	<title>CLAIM</title>
</head>

<body>
  <!-- ヘッダ -->
	<header>
		<h1>CLAIM</h1>
	</header>
  
  <!-- メッセージ -->
  <?php if(!empty($emptyMsgClaim)): ?>
    <p class="error_message"><?php echo $emptyMsgClaim; ?>
  <?php endif; ?>
  <?php if(!empty($successMsg)): ?>
    <p class="success_message"><?php echo $successMsg; ?>
  <?php endif; ?>

  <!-- 入力フォーム -->
  <form method="POST">
    <div>
      <h4>不満内容</h4>
      <textarea  class="input-claim" name="input-claim"></textarea>
    </div>
    <input type="submit" name="btn-submit" value="送信する">
  </form>
  
  <!-- 不満一覧 -->
	<section>
    <?php if( !empty($claim->getClaimArray()) ): ?>
      <?php foreach($claim->getClaimArray() as $value): ?>
        <article>
          <div class="info">
            <b>ユーザー名</b>
            <time><?php echo date('Y年m月d日 H:i', strtotime($value['post_date'])); ?></time>
          </div>
          <p><?php echo $value['claim'] ?></p>
        </article>
      <?php endforeach; ?>
    <?php endif; ?>
	</section>

	<footer>

	</footer>
</body>
</html>