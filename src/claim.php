<?php

require_once('file.php');
require_once('database.php');

// 不満一覧クラス
class CClaim extends CFile{

	// 不満データ
	private $claim= array();

	// 不満データの配列
	private $claim_array = array();

	// 不満データ書き込み
	public function write($array){

		// データベースに接続
		$mysqli = connectDB();

		// 接続エラーの確認
		if( $mysqli->connect_errno ) {
			$this->error_message[] = '書き込みに失敗しました。 エラー番号 '.$mysqli->connect_errno.' : '.$mysqli->connect_error;
		} else {
			
			// 文字コード設定
			$mysqli->set_charset('utf8');
			
			// 書き込み日時を取得
			$now_date = date("Y-m-d H:i:s");
			
			// データを登録するSQL作成
			$sql = "INSERT INTO board (claim, post_date, user_id) VALUES ( '{$array['input-claim']}', '{$now_date}',1)";
			
			// データを登録
			$res = $mysqli->query($sql);
		
			if( $res ) {
				$this->success_message = 'メッセージを書き込みました。';
			} else {
				$this->error_message[] = '書き込みに失敗しました。';
			}
		
			// データベースの接続を閉じる
			$mysqli->close();

		}
	}

	// 不満データ読み込み
	public function read(){

        // データベースに接続
        $mysqli = connectDB();

		// 接続エラーの確認
		if( $mysqli->connect_errno ) {
			$this->error_message[] = 'データの読み込みに失敗しました。 エラー番号 '.$mysqli->connect_errno.' : '.$mysqli->connect_error;
		} else {
			$sql = "SELECT claim, post_date FROM board ORDER BY post_date DESC";
			$res = $mysqli->query($sql);
			
			if( $res ) {
				$this->claim_array = $res->fetch_all(MYSQLI_ASSOC);
			}
			
			$mysqli->close();
		}

	}

	public function getClaimArray(){
		return $this->claim_array;
	}

	public function getSuccessMsg(){
		return "メッセージを書き込みました。";
	}

	public function getEmptyMessageClaim(){
		return "不満内容を入力してください。";
	}

	public function setErrMsg($errMsg){
		$this->errMsg = $errMsg;
	}
}

?>