<?php



    $arr =[
        "MUSICALS" => ["Oklahoma","The Music Man","South Pacific"],
        "DRAMAS" => ["Lawrence of Arabia","To Kill a Mockingbird", "Casablanca" ],
        "MYSTERIES" => [ "The Maltese Falcon","Rear Window","North by Northwest"]
    ];

    ksort($arr);

    print_r($arr);
?>