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
		if( $mysqli->errorCode() ) {
			$this->error_message[] = '書き込みに失敗しました。 エラー番号 '.$mysqli->connect_errno.' : '.$mysqli->connect_error;
		} else {
			
			// 書き込み日時を取得
			$now_date = date("Y-m-d H:i:s");
			
			// データを登録するSQL作成
			$sql = "INSERT INTO claim (claim, post_date, post_user) VALUES ( '{$array['input-claim']}', '{$now_date}',1)";
			
			// データを登録
			$res = $mysqli->query($sql);
			
			if( $res ) {
				$this->success_message = 'メッセージを書き込みました。';
			} else {
				$this->error_message[] = '書き込みに失敗しました。';
			}

			$mysqli = null;

		}
	}

	// 不満データ読み込み
	public function read(){

        // データベースに接続
        $mysqli = connectDB();

		// 接続エラーの確認
		if( $mysqli->errorCode() ) {
			$this->error_message[] = 'データの読み込みに失敗しました。 エラー番号 '.$mysqli->errorInfo().' : '.$mysqli->errorInfo()[0];
		} else {
			$sql = "SELECT claim, post_date FROM claim ORDER BY post_date DESC";
			$res = $mysqli->query($sql);
			
			if( $res ) {
				$this->claim_array = $res->fetchAll();
			}
			
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