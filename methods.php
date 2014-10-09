<?php

     if(isset($_POST['select']))
        select();
    else if ($_POST['insert'])
        insert();

    function insert() {
        $namn = $_POST['namn'];
        $personnummer = $_POST['personnummer'];
        $gatuadress = $_POST['gatuadress'];
        $postnummer = $_POST['postnummer'];
        $postort = $_POST['postort'];
        $lon = $_POST['lon'];
        if($_POST['sakerhetsbehorig'] == 'true')
            $sakerhetsbehorig = 1;
        else
            $sakerhetsbehorig = 0;
        

        $sql = "INSERT INTO Funktionar (Namn, Personnummer, Gatuadress, Postnummer, Postort, Lon, Sakerhetsbehorig) VALUES ('$namn', '$personnummer', '$gatuadress' ,'$postnummer', '$postort', '$lon', $sakerhetsbehorig)";

        if(!mysql_query($sql))
            die('Aooooh, something went terribly wrong.. ' . mysql_error());

        mysql_close();

        header("Location:http://localhost:8888/index.php?msg=1");
    }
    
    function displayTable(){
        //OLD way
        /*$sql = "SELECT * FROM Funktionar";
        
        $query = mysql_query($sql) 
            or die('Couldn\'t perform the SELECT-query "'. $sql .'". This is the error: ' . mysql_error());
        */
        
        //PDO way
//        try{
            $STH = $DBH->query('SELECT * FROM Funktionar');        
//        }
//        catch(PDOException $e) {
//            echo $e->getMessage();
//        }
        
        $htmlTable = '<table class="table table-hover">';
        
        $htmlTable .= '<thead>';
            $htmlTable .= '<tr>';
                $htmlTable .= '<th>Namn</th>';
                $htmlTable .= '<th>Personnr</th>';
                $htmlTable .= '<th>Gatuadress</th>';
                $htmlTable .= '<th>Postnummer</th>';
                $htmlTable .= '<th>Postort</th>';
                $htmlTable .= '<th>Lön</th>';
                $htmlTable .= '<th>Säkerhetsbehörig</th>';
            $htmlTable .= '</tr>';
        $htmlTable .= '</thead>';
        
        $htmlTable .= '<tbody>';
        
        
//        while($row = $STH->fetch()) {
//            $htmlTable .= "<tr>";
//            $htmlTable .= "<td>" . $row['Namn'] . "</td>";
//            $htmlTable .= "<td>" . $row['Personnummer'] . "</td>";
//            $htmlTable .= "<td>" . $row['Gatuadress'] . "</td>";
//            $htmlTable .= "<td>" . $row['Postnummer'] . "</td>";
//            $htmlTable .= "<td>" . $row['Postort'] . "</td>";
//            $htmlTable .= "<td>" . $row['Lon'] . "</td>";
//
//            if($row['Sakerhetsbehorig'] == 1)
//                $htmlTable .= "<td>Ja</td>";
//            else
//                $htmlTable .= "<td>Nej</td>";
//            
//            $htmlTable .= "</tr>";
//        }
        
        $htmlTable .= '</tbody>';
        $htmlTable .= '</table>';
        
        return $htmlTable;
        
    }

?>