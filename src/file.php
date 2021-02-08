<?php
class CFile{

	// 成功メッセージ
	protected $successMsg = null;

	// エラーメッセージ
	protected $errMsg = array();

	// コンストラクタ
	public function __construct(){

	}

	// ファイル書き込み
	public function write($array){

	}

	// ファイル読み込み
	public function read(){

	}

	public function getPath(){
		return $this->path;
	}

	public function setPath($path){
		return $this->path = $path;
	}

	public function getErrMsg(){
		return $this->errMsg;
	}
}

?>