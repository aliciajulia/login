<?php
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "login");

$dbh = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER . ';charset=utf8', DB_USER, DB_PASSWORD);

session_start();

if(!isset($_SESSION["login"])){
    
}
$_SESSION["login"] = filter_input(INPUT_POST, 'anvnam', FILTER_SANITIZE_SPECIAL_CHARS);

//var_dump($_SESSION);

if(!isset($_POST["anvnam"]) and !isset($_POST["losord"])){
    echo 'Fyll i båda användarnamn och lösenord tack!';   
}

if(isset($_POST["anvnam"]) and !isset($_POST["losord"])){
$anvnam = filter_input(INPUT_POST, 'anvnam', FILTER_SANITIZE_SPECIAL_CHARS);
$losord = filter_input(INPUT_POST, 'losord', FILTER_SANITIZE_SPECIAL_CHARS);
$sql = "SELECT * FROM `login` WHERE username='$anvnam' AND password='$losord'";
$stmt = $dbh->prepare($sql);
    $stmt->execute();

    $login = $stmt->fetch();
    
    if(!empty($login)){
        $_SESSION["login"];
    }

}

if(isset($_SESSION["login"])){
    echo 'Välkommen, du är nu inloggad!';
}

    
    


?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Välkommen, logga in.</title>
    </head>
    <body>
        <form method="POST">
            <p>Användarnamn:</p> <input type="text" name="anvnam">
            <p>Lösenord:</p><input type="text" name="losord">
            <input type="submit" value="Logga in">
        </form>
        
        <?php
    
?>

    </body>
</html>
