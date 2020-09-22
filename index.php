<!DOCTYPE html>
<html lang="en">

<head>
  <title>私人圖書館</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!--===============================================================================================-->
  <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css" />
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css" />
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css" />
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css" />
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css" />
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="css/util.css" />
  <link rel="stylesheet" type="text/css" href="css/main.css" />
  <!--===============================================================================================-->
</head>

<body>
  <div class="limiter">
    <div class="container-table100">
      <div id="mal">
        <button id="showw" onclick="window.location.href = './index.php';"><a href="./index.php">主頁</a></button>
        <h2>📚Malcolm的圖書館📚</h2>
        <div>
          <button id="hid" onclick="window.location.href = './index.php';"><a href="./index.php">主頁</a></button>
          <button onclick="window.location.href = './addbook.html';"><a href="./addbook.html">+ 新增書籍</a></button>
        </div>
      </div>
      <div class="wrap-table100">
        <div class="table">
          <div class="row header">
            <div class="cell">Book Name</div>
            <div class="cell">書名</div>
            <div class="cell">Author</div>
            <div class="cell">作者</div>
          </div>

          <?php
          header('Content-Type: text/html; charset=utf-8');
          include('db.php');
          

          // Create connection
          $conn = mysqli_connect($servername, $username, $password, $dbname);
          $conn->set_charset("utf8");
          // Check connection
          if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
          }

          $sql = "SELECT siteurl,coverurl, entitle,cntitle,enauthor,cnauthor FROM treasuremybook";
          $result = mysqli_query($conn, $sql);

          if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
              // echo '<a class="row" id="o" href="' . $row["siteurl"] . '">
              echo '<a class="row" id="o">
              <div class="cell" data-title="Book Name">' . $row["entitle"] . '</div>
              <div class="cell" data-title="書名">' . $row["cntitle"] . '</div>
              <div class="cell" data-title="Author">' . $row["enauthor"] . '</div>
              <div class="cell" data-title="作者">' . $row["cnauthor"] . '</div>
            </a>
            <img src="' . $row["coverurl"] . '">';
            }
          } else {
            echo "0 results";
          }

          mysqli_close($conn);



          ?>
          <!-- <div class="row">
            <div class="cell" data-title="Book Name">Vincent Williamson</div>
            <div class="cell" data-title="書名">31</div>
            <div class="cell" data-title="Author">iOS Developer</div>
            <div class="cell" data-title="作者">Washington</div>
          </div> -->
        </div>
      </div>
    </div>
  </div>
  <style>
    img {
      position: absolute;
      display: none;
      width: 26vw;
    }

    #o:hover+img {
      display: block;
    }

    #mal {
      display: flex;
      justify-content: space-between;
      align-content: center;
      margin-left: 20vw;
      margin-right: 20vw;
      width: 100vw;
      margin-bottom: 23px;
      margin-top: 30px;
    }

    #mal h2 {
      font-weight: 900;
      line-height: 1.5;
    }

    #mal button {
      height: 50px;
      width: 130px;
      font-size: 20px;
      background-color: #6c7ae0;
      border-radius: 25px;
    }

    #mal button a {
      color: white;
    }

    #mal button:hover {
      box-shadow: 0 0 0 3px black;
      color: #422380;
    }

    #hid {
      display: none;
    }

    /* @media screen and (max-width: 1130px) {
      #mal {
        flex-wrap: wrap;
      }

      #mal h2 {
        display: flex;
        justify-content: center;
        width: 100vw;
        margin-left: auto;
        margin-right: auto;
      }
    } */

    @media screen and (max-width: 1130px) {
      #mal {
        flex-wrap: wrap;
      }

      #mal h2 {
        display: flex;
        justify-content: center;
        width: 100vw;
        margin-left: auto;
        margin-right: auto;
      }

      #showw {
        display: none;
      }

      #hid {
        display: block;
      }

      #mal div {
        width: 100vw;
        display: flex;
        justify-content: space-around;
        margin-top: 10px;
        align-content: center;
      }
    }

    body {
      background-color: #c4d3f6 !important;
    }
  </style>

  <!--===============================================================================================-->
  <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
  <!--===============================================================================================-->
  <script src="vendor/bootstrap/js/popper.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <!--===============================================================================================-->
  <script src="vendor/select2/select2.min.js"></script>
  <!--===============================================================================================-->
  <script src="js/main.js"></script>
</body>

</html>