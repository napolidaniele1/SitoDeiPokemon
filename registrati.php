<html>
<head>
  <link rel="stylesheet" type = "text/css" href="Style.css" />
<title>Registrati</title>
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

    <div class="scrittabianca">

      Welcome <?php echo $_POST["Name"]; ?><br>
      Your email address is: <?php echo $_POST["Email"];
      ?>
      <?php
      $servername='localhost';
      $port=3306;
      $username='root';
      $password='mysql';
      $dbName='Pokemon';
    //Get all the data sent by the form

    $name = $_POST["Name"];
    $email = $_POST["Email"];
    $password_form = $_POST["Password"];
try{
  $conn = new PDO("mysql:host=$servername; dbname=$dbName", $username, $password);
  $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "insert into Clienti (Email,Password,Nome) values ('$email','$password_form','$name')";

  $sth=$conn->prepare($sql);
  $sth->execute();
  echo '<p class="mb-0">Registrazione avvenuta</p>';
}
catch(PDOException $e) {
  echo "<br />";
  echo "Connection failed: " . $e->getMessage();
}

?>
    </div>
  </body>
  </html>
