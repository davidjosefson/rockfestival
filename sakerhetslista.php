<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
ini_set('display_startup_errors',1);

    //Connecting to DB
    require('connect.php');

    //Create an array
    $sakerhetsTable = array();

    //SQL-query to get all data from table Funktionar
    $STH = $DBH->query('SELECT Dag, S.Namn AS Scen, Tid, F.FunktionarsID AS FunktionärsID, F.Namn AS Säkerhetsansvarig, Personnummer,
                        F.Mobilnummer 
                        FROM
                        (
                            (((SELECT * FROM Festivaldag, Scen, Sakerhetstid) AS S)

                            LEFT OUTER JOIN Sakerhetspass SP
                            ON S.Dag=SP.Festivaldag AND S.Tid=SP.Sakerhetstid AND S.Namn=SP.Scen)

                            LEFT OUTER JOIN Funktionar F
                            ON SP.Funktionar=F.FunktionarsID)
                        ORDER BY Dag');   

    //Adds each row from the table to the array
    while($row = $STH->fetch()) {
        $sakerhetsTable[] = $row;
    }

?>

<?php include('header.php'); ?>

    <div class="col-md-12">
        <h2 class="page-header">Lista över alla säkerhetspass med bokningar</h2>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Dag</th>
                    <th>Scen</th>
                    <th>Tid</th>
                    <th>Säkerhetsansvarig</th>
                    <th>Personnummer</th>
                    <th>Mobilnummer</th>
                </tr>
            </thead>
        <tbody>
        <?php foreach ($sakerhetsTable as $row) : ?>
            <tr>
                <td><?php echo $row['Dag']; ?></td>
                <td><?php echo $row['Scen']; ?></td>
                <td><?php echo $row['Tid']; ?></td>
                <td><?php echo $row['Säkerhetsansvarig']; ?></td>
                <td><?php echo $row['Personnummer']; ?></td>
                <td><?php echo $row['Mobilnummer']; ?></td>
            </tr>
         <?php endforeach; ?>   
        </tbody>
    </table>
</div>

<?php include('footer.php'); ?>