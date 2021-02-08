
<?php
  require_once('claim.php');
  require_once('define.php');

  $claim = new CClaim();

  // 変数初期化
  $emptyMsgClaim = null;
  $successMsg = null;
  $clean = array();

  // 送信ボタンが押下されたとき
  if(!empty($_POST['btn-submit'])){
    if( !empty($_POST['admin-password']) && $_POST['admin-password'] === PASSWORD ) {
      $_SESSION['admin-login'] = true;
    } else {
      $claim->setErrMsg('ログインに失敗しました。');
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
	<title>CLAIM　管理ページ</title>
</head>

<body>
  <!-- ヘッダ -->
	<header>
		<h1>CLAIM　管理ページ</h1>
	</header>
  
  <!-- メッセージ -->
  <?php if(!empty($claim->getErrMsg())): ?>
    <p class="error_message"><?php echo $emptyMsgClaim; ?>
  <?php endif; ?>
  
  
	<section>
  <?php if( !empty($_SESSION['admin-login']) && $_SESSION['admin-login'] === true ): ?>
    <!-- 不満一覧 -->
    <form method="get" action="./download.php">
      <input type="submit" name="btn_download" value="ダウンロード">
    </form>
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
  <?php else: ?>
  <!-- ログインフォーム --> 
    <form method="POST">
      <div>
        <label for="admin-password">ログインパスワード</label>
        <input id="admin-password" type="password" name="admin-password" value="">
      </div>
      <input type="submit" name="btn-submit" value="ログイン">
    </form>
  <?php endif; ?>
	</section>

	<footer>

	</footer>
</body>
</html>