<?php

  require_once 'connectDB.php';

  $checkRole = include('checkRole.php');
  if (!isset($_COOKIE['currentUsername'])) {
    return header('Location: login.php');
  }

  $checkTokenExpiry = include('checkTokenExpiryTime.php');
  $isTokenAvailable = $checkTokenExpiry($_COOKIE['currentUsername']);
  if (!$isTokenAvailable) {
    return header('Location: logout.php?s=0');
  }
  
  if ($checkRole($_COOKIE['currentUsername']) == 'user') {
    header('Location: dashboard.php');
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title> Add Choco </title>
    <link rel="stylesheet" href="../styles/tambah-coklat.css">
  </head>

  <body>
    <div class="navbar">
        <ul>
            <li><a href="dashboard.php">Home</a></li>
            <li><a class="active" href="tambah-coklat.php">Add New Chocolate</a></li>
            <li class="logout-link"><a href="logout.php">Logout</a></li>
            <li class="search-bar">
            <form method="get" action="SearchPage.php">
                <input type="text" name="search" id="search" autocomplete="off" placeholder="Search">
            </form>
            </li>
        </ul>
      </div> <br> <br> <br>

    <div class="flex-container">
      <h3> Add New Chocolate </h3>
    </div>

    <div class="flex-container">
      <form enctype="multipart/form-data" action="TambahCoklat.php" method="POST">
        <table border="1" style="width:100%;">
          <tr>
            <td> Name: </td>
            <td> <input type="text" name="name" size="50" autocomplete="off"> </td>
          </tr>
          <tr> 
            <td> Price: </td>
            <td> <input type="text" name="price" size="50" autocomplete="off"> </td>
          </tr>
          <tr>
            <td> Description:  </td>
            <td> <textarea style="resize:none;" rows="5" cols="51" name="desc" autocomplete="off" required></textarea> </td>
          </tr>
          <tr>
            <td> Upload Image (max 2MB): </td>
            <td> <input type="file" name="pic" id="pic"> </td>
          </tr>
          <tr>
            <td> Amount: </td>
            <td> <input type="text" name="count" autocomplete="off" size="50"> </td>
          </tr>
          <tr>
            <td> Bahan: </td>
            <td id="bahan-list"> 
              <div class="bahan-field" id="bahan1">
                <div><input id="namabahan1" type="text" name="bahan[]" autocomplete="off" size="50"> </div>
                <div id="add1" class="btn-add" onClick="addBahanField()"> <b> Add </b> </div> 
                <div class="btn-cancel" onClick="removeBahanField('bahan1')"> <b> Remove </b> </div>
                <div> Jumlah Satuan: </div>
                <div> <input class="plus-minus-button" type="button" onclick="minusButton('quantity1')" value="-"> </div>
                <div> <input type="number" id="quantity1" name="quantity[]" value="0" style="text-align: center;" readonly required> </div>
                <div> <input class="plus-minus-button" type="button" onclick="plusButton('quantity1')" value="+"> </div>
              </div>
            </td>
          </tr>
          <tr> 
            <td colspan="2"> 
              <button class="btn-add btn-nav" type="submit"> <b> Add Chocolate </b> </button> 
              <button class="btn-cancel btn-nav" onclick="location.href = 'dashboard.php'"> <b> Cancel </b> </button>
            </td>
          </tr>
        </table>
      </form>
    </div>

    <div class="flex-container">
      <h3> Perkiraan Harga </h3>
      <input id="perkiraanharga" value="Rp 0" style="text-align: center; margin-left: 20px" readonly required>
    </div>

    <div class="flex-container">
      <h3> Daftar Supply </h3>
    </div>

    <div class="flex-container">

      <table id="supplies" border="1" style="width:100%; text-align:left"> 
        <tr>
          <td> <b> Supply Name </b> </td>
          <td> <b> Supply Price </b> </td>
        </tr>

        <?php

          function file_get_contents_curl($url) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            $data = curl_exec($ch);
            curl_close($ch);
            return $data;
          }

          $api = include('configAPI.php');

          ini_set("allow_url_fopen", 1);
          $api_url = $api['SUPPLY_API_URL'];

          try {
            // run your code here
            $json_data = file_get_contents_curl($api_url);
            $response_data = json_decode($json_data);

            for ($x = 0; $x < count($response_data); $x++) {
              echo "<tr>";
              echo "<td>".$response_data[$x]->nama_bahan."</td>";
              echo "<td>".$response_data[$x]->harga_satuan."</td>";
              echo "</tr>";
            }
          } catch (exception $e) {
              //code to handle the exception
              echo $e;
          }
        ?>
      </table>
    </div>
    <script src="../scripts/add-chocolate.js"></script>
  </body>

</html>