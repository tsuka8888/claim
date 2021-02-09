
<?php

//DB接続関数定義部分
function connectDB() {
    $host;
    $user;
    $pass;
    $db;

  if($_SERVER['SERVER_NAME']=='localhost'){
    //ローカル環境
    $host = 'mysql:host=db';
    $db = 'claim';
    $user = 'root';
    $pass = 'rootpassword';
  }else{
    //本番環境
    $host = 'mysql148.phy.lolipop.lan';
    $user = 'LAA1256286';
    $pass = 'mGqOgWsX';
    $db = 'LAA1256286-claim';
  }
  
  try{
    $pdo = new PDO("${host}; dbname=${db}; charset=utf8",$user,$pass);
  }catch(PDOException $e){
    exit();
  }

  // $mysqli = new mysqli($host,$user,$pass,$db);

  return $pdo;

}

?>