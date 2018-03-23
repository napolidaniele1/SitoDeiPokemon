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

  $Email = $_POST["Email"];
  $Password = $_POST["Password"];

  require_once 'DbHelper.php';
  $db_Handle = new DbController();
  $db_Handle -> login();

   ?>
 </body>
 </html>
