<html>
<head>
</head>
<body>


<div class="scrittabianca">
<?php

class DbController
{
  private $conn;
  public function __construct()
  {
    $this -> conn = $this -> Connection();
  }
  public function Connection()
  {
    $servername = 'localhost';
    $port = 3306;
    $username = 'root';
    $password = 'mysql';
    $dbName= 'POKEMON';

    try
    {

      $connd = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
      // set the PDO error mode to exception
      $connd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $connd;

    }
    catch(PDOException $e)
    {

         }

  }
  public function login()
{
  $mail = $_POST["Email"];
  $pass =$_POST["Password"];

echo $mail;
echo $pass;

            $stmt = $this->conn->prepare("SELECT * FROM Clienti WHERE Email=:mail AND Password=:pass ");
            $stmt->execute(array(':mail'=>$mail, ':pass'=>$pass));
            if($stmt->rowCount()==1)
            {
              echo '<p class="mb-0">Login avvenuto correttamente!</p>';
            }

            else{
             echo "Login fallito ";
         }
     }

public function FindPokemon($nomeP){
  $stmt=$this->conn->prepare("SELECT * FROM pokemon WHERE identifier LIKE '%$nomeP%' ");
  $stmt->execute();
  echo "<table><tr><th>name</th><th>height</th><th>weight</th><th>Photo</th></tr>";
  while($result = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    echo "<tr><td>" .$result['identifier']. "</td><td>" . $result['height']
        ."</td><td>" .$result['weight'] . "</td><td><img src = 'sprites/".$result['id'].".png'></td></tr>";
  }
  echo "</table>";
  }






}

 ?>
</div>
</body>
</html>
