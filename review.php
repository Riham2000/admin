<?php ?>
////////////]دا علشاناربط ملف ال conn بملف الsql وادخلهم في فايل واحد
$servername = "localhost";
$username = "root";
$password = "";

try{
    $options=array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    $conn = new PDO("mysql:host=$servername;dbname=cars", $username, $password, $options);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}


/////////////////////الملف اللي هيطبق عليه كل حاجه
if($_SERVER["REQUEST_METHOD"] === "POST"){
        include_once("includes/conn.php");
        $fullname = $_POST["name"];
        $pass = $_POST["password"];
        $email = $_POST["email"];
        $gender = $_POST["gender"];
        try{
            $sql = "INSERT INTO `users`(`email`, `fullname`, `password`, `gender`) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$email, $fullname, $pass, $gender]);
            eader("Location: login.php");
            die();
            echo "Data inserted successfully";
        }catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
    }

