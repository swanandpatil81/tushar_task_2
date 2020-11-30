<?php 

$secret="6LdsS7UUAAAAAFvuyjNDzmGa5Yi2FobWYNClNI3x";
$response=$_REQUEST["g-recaptcha-response"];
 
$verify=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}");
$secret = "6LdsS7UUAAAAAFvuyjNDzmGa5Yi2FobWYNClNI3x6LdsS7UUAAAAAFvuyjNDzmGa5Yi2FobWYNClNI3x";
$response = trim($_REQUEST["g-recaptcha-response"]);

?>