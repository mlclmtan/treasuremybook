<?php
include('db.php');

include('simple_html_dom.php');

$data = json_decode(file_get_contents("php://input"), true);
$siteurl = $data['text'];

$html = file_get_html($siteurl);

$cntitle = $html->find('div[class="mod type02_p002 clearfix"]', 0)->find('h1', 0)->plaintext;
$entitle = $html->find('div[class="mod type02_p002 clearfix"]', 0)->find('h2', 0)->find('a', 0)->plaintext;
$coverurl = $html->find('div[class="mod cnt_prod_img001 nolazyload_img clearfix"]', 0)->find('div', 0)->find('img', 0)->src;
$cnauthor = $html->find('div[class="type02_p003 clearfix"]', 0)->children(0)->children(0)->children(1)->plaintext;
$enauthor = $html->find('div[class="type02_p003 clearfix"]', 0)->children(0)->children(1)->children(0)->plaintext;

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // prepare sql and bind parameters
  $stmt = $conn->prepare("INSERT INTO treasuremybook (siteurl,coverurl, entitle,cntitle,enauthor,cnauthor)
            VALUES (:siteurl, :coverurl, :entitle,:cntitle,:enauthor,:cnauthor)");
  $stmt->bindParam(':siteurl', $siteurl);
  $stmt->bindParam(':coverurl', $coverurl);
  $stmt->bindParam(':entitle', $entitle);
  $stmt->bindParam(':cntitle', $cntitle);
  $stmt->bindParam(':enauthor', $enauthor);
  $stmt->bindParam(':cnauthor', $cnauthor);

  // insert a row
  $stmt->execute();

  echo "New records created successfully";
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;
