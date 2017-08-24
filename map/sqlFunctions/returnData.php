
  <?php
    include('./sqlFunctions.php');

    //Establish connection to database
    $link = linkDB();

    //set up a MySQL query
    $sql = "SELECT * FROM shelters;";

    if(!$results = $link->query($sql)){
      die("Query Unsuccessful");
    }

    $valueMap = array();
    //
    // while ($data = $results->fetch_assoc()) {
    //   $rows[] = $data;
    // }

    // while ($data = $results->fetch_assoc()){
    //   $valueMap[] = array($data['title'], $data['lat'], $data['lng']);
    // }



    while ($data = $results->fetch_assoc()){
        $msg = "";
        $valueMap[] = array(
          'title' => $data['title'],
          'lat' => $data['lat'],
          'lng' => $data['lng'],

          'description' => $data['descriptionPub'] ? $data["description"] : "",
          'pName' => $data['pContactPub'] ? $data['pName'] : "",
          'pEmail' => $data['pContactPub'] ? $data['pEmail'] : "",
          'pPhone' => $data['pContactPub'] ? $data['pPhone'] : "",
          'pContactPub' => $data['pContactPub'],

        );
    }


    $JSONData = json_encode($valueMap);

    echo $JSONData;



    //echo "<script>document.getElementById('testDiv').innerHTML = $rows;</script>"
    //echo "var JSONDATA = " . '"' . $_POST['JSON'] . '";';




    // echo "<br><br>";
    // var_dump($JSONRows);
    // echo "<br><br>";
    // var_dump($rows);
    //
    // echo "<br><br>Heyo!!! ";
    // var_dump($rows[0]);

   ?>
