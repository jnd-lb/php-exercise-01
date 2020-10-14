<?php 
    if(isset($_GET['word'])){
        check($_GET['word']);
    }

    function check($word){
        if(strrev($word) == $word){
            echo "<h1>The word $word is Palindrome</h1>";
        }else{
            echo "<h1>The word $word is NOT Palindrome</h1>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="get" action="<?php $_SERVER["self"] ?>">
    <label for="input">ENETER A WORD:</label>
    <input type="text" id="input" name="word" value="">
    <input type="submit" value="Check">
    </form>
</body>
</html>