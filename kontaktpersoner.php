<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
ini_set('display_startup_errors',1);

    //Connecting to DB
    require('connect.php');

    //Create an array
    $kontaktpersonTable1 = array();
    $kontaktpersonTable2 = array();
    $kontaktpersonTable3 = array();

    //SQL-query to get all data from table Funktionar
    $STH = $DBH->query('SELECT Band.Namn AS Band, Funktionar.Namn AS Kontaktperson
                        FROM Band INNER JOIN Funktionar
                        ON Band.Kontaktperson = Funktionar.FunktionarsID');   

    //Adds each row from the table to the array
    while($row = $STH->fetch()) {
        $kontaktpersonTable1[] = $row;
    }
    
    //SQL-query to get all data from table Funktionar
    $STH = $DBH->query('SELECT Funktionar.Namn AS Kontaktperson, Band.Namn AS Band
                        FROM Band left JOIN Funktionar
                        ON Band.Kontaktperson = Funktionar.FunktionarsID
                        Order by Kontaktperson');   

    //Adds each row from the table to the array
    while($row = $STH->fetch()) {
        $kontaktpersonTable2[] = $row;
    } 

    //SQL-query to get all data from table Funktionar
    $STH = $DBH->query('SELECT Kontaktperson, SUM(AntalBandmedlemmar)
                        AS AntalBandmedlemmar FROM
                        (
                        SELECT Kontaktperson, AntalBandmedlemmar FROM

                        (SELECT Band.BandID, Funktionar.Namn as Kontaktperson
                        FROM Funktionar INNER JOIN Band ON
                        Funktionar.FunktionarsID = Band.Kontaktperson) AS Bandet

                        NATURAL JOIN

                        (SELECT BandID, Count(*) as AntalBandmedlemmar
                        FROM Band INNER JOIN Bandmedlem ON
                        Band.BandID = Bandmedlem.Band
                        GROUP BY Band.Namn) As Antal
                        ) as T1

                        Group by Kontaktperson;');   

    //Adds each row from the table to the array
    while($row = $STH->fetch()) {
        $kontaktpersonTable3[] = $row;
    }

?>

<?php include('header.php'); ?>

    <div class="col-md-10">
        <h2 class="page-header">Bandens kontaktpersoner</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Band</th>
                    <th>Kontaktperson</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($kontaktpersonTable1 as $row) : ?>
                <tr>
                    <td><?php echo $row['Band']; ?></td>
                    <td><?php echo $row['Kontaktperson']; ?></td>
                </tr>
             <?php endforeach; ?>   
            </tbody>
        </table>
    </div>

    <div class="col-md-10">
        <h2 class="page-header">Kontaktpersoners band</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Kontaktperson</th>
                    <th>Band</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($kontaktpersonTable2 as $row) : ?>
                <tr>
                    <td><?php echo $row['Kontaktperson']; ?></td>
                    <td><?php echo $row['Band']; ?></td>
                </tr>
             <?php endforeach; ?>   
            </tbody>
        </table>
    </div>
    <div class="col-md-10">
        <h2 class="page-header">Funktionärer och antal bandmedlemmar de ansvarar över</h2>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Kontaktperson</th>
                    <th>Antal bandmedlemar</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($kontaktpersonTable3 as $row) : ?>
                <tr>
                    <td><?php echo $row['Kontaktperson']; ?></td>
                    <td><?php echo $row['AntalBandmedlemmar']; ?></td>
                </tr>
             <?php endforeach; ?>   
            </tbody>
        </table>
    </div>

<?php include('footer.php'); ?>