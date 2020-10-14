<?php


function isExist($user){

    $clean = htmlspecialchars(stripslashes(trim($user)));
    $inp = file_get_contents('database.json');
    $tempArray = json_decode($inp);        
    
    foreach ($tempArray as $value) {
        if($value["name"]==$clean) return 1;
    }
    
    return 0;
}

function addUser($user){
 
    $inp = file_get_contents('database.json');
    $tempArray = json_decode($inp);
    array_push($tempArray, $user);
    $jsonData = json_encode($tempArray);
    file_put_contents('database.json', $jsonData);

}

/*
$data[] = $_POST['data'];
$inp = file_get_contents('database.json');
$tempArray = json_decode($inp);
array_push($tempArray, $data);
$jsonData = json_encode($tempArray);
file_put_contents('database.json', $jsonData);

$pages_array = array(
     array(
         'slug' => 'index',
         'title' => 'Site Index',
         'template' => 'interior'
     ),

     array(
         'slug' => 'a',
         'title' => '100% Wide (Layout A)',
         'template' => 'interior'
     ),

     array(
         'slug' => 'homepage',
         'title' => 'Homepage',
         'template' => 'homepage'
     )
);
*/
?>
