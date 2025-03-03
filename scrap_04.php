p<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        section {
            border: 1px solid black;
            padding: 10px;
            margin:10px;
        }
        .odpgood{
            background-color: green;
            color: white;
        }
    </style>
</head>
<body>
    

<?php
    $data = file_get_contents('Egzamin_01.html');

    echo "<textarea>" . $data . "</textarea>"; 

    echo "<hr>";

    $pytania = explode('"trescE">',$data);

    for ($i = 1; $i < count($pytania); $i++) {
        // $posStart = strpos($pytania[$i], '<a href="');
        $posEnd = strpos($pytania[$i], '<div class="sep">');
        
        $pytanie = substr($pytania[$i], 0, $posEnd);
        
        $tEnd = strpos($pytania[$i], '</div');
        $tStart = strpos($pytania[$i], '.');
        $tStart = $tStart + 2;
        $Finale = $tEnd - $tStart;

        $tresc = substr($pytania[$i], $tStart , $Finale);

        echo '<textarea>' . $pytanie . "</textarea>";
        echo '<section>' . $tresc;
        echo '<ol type="A">';

        //odp.A

        $odpAStart = strpos($pytanie, 'A. </strong>');
        $odpAEnd = strpos($pytanie, '<div id="odpb');
            

        $odpA = substr($pytanie, $odpAStart + 12, $odpAEnd - $odpAStart - 18);

        echo "<li>";

        // echo "<textarea>" . $odpA . "</textarea>";

        echo $odpA;
        echo "</li>";
        
        //odp.B

        $odpBStart = strpos($pytanie, 'B. </strong>');
        $odpBEnd = strpos($pytanie, '<div id="odpc');
            

        $odpB = substr($pytanie, $odpBStart + 12, $odpBEnd - $odpBStart - 18);
        echo "<li>" . $odpB . "</li>";

        // odp.C
        $odpCStart = strpos($pytanie, 'C. </strong>');
        $odpCEnd = strpos($pytanie, '<div id="odpd');
            

        $odpC = substr($pytanie, $odpCStart + 12, $odpCEnd - $odpCStart - 18);
        echo "<li>" . $odpC . "</li>";

        // odp.D

        $odpDStart = strpos($pytanie, 'D. </strong>');
        $odpDEnd = strpos($pytanie, '</div>');
        $odpD = substr($pytanie, $odpDStart + 12, -6);

        echo "<li>" . $odpD . "</li>";
        

        



    
        echo '</ol>';
        echo "</section>";
        
        

        // if($i === count($pytania) - 1){
        //     $stripped = explode('<div class="col-md-3" id="side" data-aos="fade-up">',$pytanie)[0];
        //     echo '<section style="background:red;">' . $stripped . '</section>';
        // } else {
        //     echo '<section>' . $pytania . "</section>";
        // }
    }

?>

</body>
</html>
