<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
ini_set('display_startup_errors',1);

    //Connecting to DB
    require('connect.php');

    //Create arrays
    $bandKontaktTable = array();
    $kontaktBandTable = array();
    $numberOfMembersTable = array();

    //SQL-querys
    $STHbandKontakt = $DBH->query('SELECT Band.Namn AS Band, Funktionar.Namn AS Kontaktperson
                        FROM Band INNER JOIN Funktionar
                        ON Band.Kontaktperson = Funktionar.FunktionarsID');   
    $STHkontaktBand = $DBH->query('SELECT Funktionar.Namn AS Kontaktperson, Band.Namn AS Band
                        FROM Band left JOIN Funktionar
                        ON Band.Kontaktperson = Funktionar.FunktionarsID
                        Order by Kontaktperson');   
    $STHnumberMembers = $DBH->query('SELECT Kontaktperson, SUM(AntalBandmedlemmar)
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
    
    //Fill the arrays with data
    while($row = $STHbandKontakt->fetch()) 
        $bandKontaktTable[] = $row;
    while($row = $STHkontaktBand->fetch()) 
        $kontaktBandTable[] = $row;
    while($row = $STHnumberMembers->fetch()) 
        $numberOfMembersTable[] = $row;

?>

<?php include('header.php'); ?>
<?php include('navbar.php'); ?>

<!-- Displays a table with every bands contactperson-->
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
                <?php foreach ($bandKontaktTable as $row) : ?>
                    <tr>
                        <td><?php echo $row['Band']; ?></td>
                        <td><?php echo $row['Kontaktperson']; ?></td>
                    </tr>
                 <?php endforeach; ?>   
            </tbody>
        </table>
    </div>

<!-- Displays a table with the band that each contactperson is assigned to-->
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
                <?php foreach ($kontaktBandTable as $row) : ?>
                    <tr>
                        <td><?php echo $row['Kontaktperson']; ?></td>
                        <td><?php echo $row['Band']; ?></td>
                    </tr>
                 <?php endforeach; ?>   
            </tbody>
        </table>
    </div>

<!-- Displays a table with the amount of bandmembers each contactperson is assigned to-->
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
                <?php foreach ($numberOfMembersTable as $row) : ?>
                    <tr>
                        <td><?php echo $row['Kontaktperson']; ?></td>
                        <td><?php echo $row['AntalBandmedlemmar']; ?></td>
                    </tr>
                 <?php endforeach; ?>   
            </tbody>
        </table>
    </div>

<?php include('footer.php'); ?>