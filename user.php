<?php


function isExist($user){
    $inp = file_get_contents('database.json');
    $tempArray = json_decode($inp);        
    foreach ($tempArray as $arr) {
        if($arr->userName==$user) return true;  
    }
    return false;
}

function addUser($user){
    $inp = file_get_contents('database.json');
    $tempArray = json_decode($inp,TRUE);
    $tempArray[] = $user;

    $jsonData = json_encode($tempArray);
    file_put_contents('database.json', $jsonData);
}

function isExistUser($userName,$password){
    
    $inp = file_get_contents('database.json');
    $tempArray = json_decode($inp);       
    foreach ($tempArray as $arr) {
        if($arr->userName==$userName AND $arr->password == $password) return TRUE;  
    }
    return FALSE;
}
?>
