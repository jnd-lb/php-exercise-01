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

    print_r($tempArray);
    $jsonData = json_encode($tempArray);
    file_put_contents('database.json', $jsonData);

}
?>
