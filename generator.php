<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    *{
    margin:0;
    padding: 0;
}
body{
    margin-left: 35%;
    margin-top: 5%;
}
div{
    border:2px black solid;
    width: 200px;
    height: 100px;
    position: absolute;
    left:20px
}
</style>
</head>
<body>
    <h2>GENERATOR TABELI</h2>
    <form>
        <label>Podaj liczbe kolumn:</label>
        <input name="columns"/>
        <br>
        <label>Podaj liczbe wierszy:</label>
        <input name="rows"/>
        <br>
        <label>Obramowanie</label>
        <input type="checkbox" name="border"/>
        <br>
        <label>Czym wypełnić?: </label>
        <br>
        <label>Literami</label>
        <input type="radio" name="numering" id="letters" value="LETTERS"/>
        <br>
        <label>Cyframi</label>
        <input type="radio" name="numering" id="numbers" value="NUMBERS"/>
        <br>
        <input type="submit" value="WYGENERUJ"/>
    </form>

    
    </div>
    <?php
        $countNum = 0;
        $P = 65;
        $countLet = chr($P);
        $border = 0;
        $numering = 0;
        $rows = 0;
        $columns = 0;
        if(isset($_GET["rows"])){
        $rows = $_GET["rows"];
        
        }
        if(isset($_GET["columns"])){
        $columns = $_GET["columns"]; 
        }
        if(isset($_GET["border"])){
        $border = $_GET["border"]; 
        }
        if(isset($_GET["numering"])){
        $numering = $_GET["numering"]; 
        }

        
        if($border == "on"){
        echo "<table style='border:2px black solid; border-collapse: collapse;'>";
        }else{
        echo "<table>";  
        }
        for($i=0;$i<$rows;$i++){
            echo "<tr>";
            for($j=0;$j<$columns;$j++){
                
                if($border == "on"){
                    echo "<td style='border:2px black solid;padding:3px;text-align:center;'>";
                }else{
                    echo "<td style='padding:3px;text-align:center;'>";
                }
                if($numering == "NUMBERS"){
                    $countNum += 1;
                    echo $countNum;
                }else if($numering == "LETTERS"){
                    echo $countLet;
                    if($P == 90)
                    $P = 64;
                    $P += 1;
                    $countLet = chr($P);
                }else{
                    echo " ";
                }
                echo "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        
    ?>
<script>
    const form = document.getElementById("form")
    form.addEventListener('submit',sub)

    function sub(e){
        e.preventDefault();
        console.log("Próba wysłania")
     }

</script>
</body>
</html>