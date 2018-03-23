<html>
<head>
  <link rel="stylesheet" type = "text/css" href="Style.css"/>
  <link rel="stylesheet" href = "bootstrap-4.0.0-dist/css/bootstrap.css"/>
<title> Catalogo </title>
</head>
<body>
  <ul>
    <li><a class="active" href="index.html">Home</a></li>
    <li><a href="login.html">Login</a></li>
    <li><a href="registrati.html">Registrati</a></li>
    <li><a href="Catalogo.php">Catalogo</a></li>
    <form action="CercaPokemon.php" method="post">
    <input type="text" placeholder="Cerca Pokemon" name="search">
    </form>
  </ul>
<?php
      $x_pag = 10;  //[1] how many rows to display for each page
      if (isset($_GET['pag'])) //[2]
      {
          $pag = $_GET['pag'];
      }
      else
      {
         $pag  = 1;
      }

      //You could do the same at th point [2] with
      //$pag = isset($_GET['pag']) ? $_GET['pag'] : 1;

      if (!$pag || !is_numeric($pag))  //[3]
      {
          $pag = 1;
      }

      $servername = 'localhost';
      $port = 3306;
      $username = 'root';
      $password = 'mysql';
      $dbName= 'POKEMON';

      try
      {

        $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      }
      catch(PDOException $e)
      {

           }


           $sql = "SELECT count(*) FROM pokemon"; // [4]
           $sth = $conn->prepare($sql);
           $sth->execute();
           $all_rows = $sth->fetchColumn();  //[5]
           $all_pages = ceil($all_rows / $x_pag); //[6]
           $first = ($pag-1) * $x_pag;  //[7]

           $sql = "SELECT * FROM pokemon LIMIT $first, $x_pag"; //[8]
           $sth = $conn->prepare($sql);
           $sth->execute();

           echo "<table><tr><th>name</th><th>height</th><th>weight</th><th>Photo</th></tr>";
           while($result = $sth->fetch(PDO::FETCH_ASSOC))
           {
             echo "<tr><td>" .$result['identifier']. "</td><td>" . $result['height']
                 ."</td><td>" .$result['weight'] . "</td><td><img src = 'sprites/".$result['id'].".png'></td></tr>";
           }
           echo "</table>";


           if ($all_pages > 1){ //[9]
               if ($pag > 1){  //[10]
                   //[11]:$_SERVER['PHP_SELF'] returns the courrent page address
                   //eg: http://localhost/PHP_TESTS/pkStore/catalog.php
                   //if we add the string ?pag=x, the value x is stored in $_GET['pag']
                   echo "<a href=\"" . $_SERVER['PHP_SELF'] . "?pag=" . ($pag - 1) . "\">";
                   echo "<</a>&nbsp;";
               }

               if ($all_pages > $pag){  //[12]
                   echo "<a href=\"" . $_SERVER['PHP_SELF'] . "?pag=" . ($pag + 1) . "\">";
                   echo "></a>";
               }
               echo "<br>";

               }

       ?>
     </body>
     </html>
