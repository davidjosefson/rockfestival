<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
ini_set('display_startup_errors',1);

    //Connecting to DB
    require('connect.php');

    //Create arrays
    $scenprogramTable = array();
    $thuTable = array();
    $friTable = array();
    $satTable = array();   

    //SQL-querys
    $STHscenProgram = $DBH->query('Select t1.Dag, t1.Tid, t1.Scen, t2.namn AS Band from
                        (SELECT Dag, Scentid.Tid , Scen.Namn as Scen
                        FROM Scen, Festivaldag, Scentid)as t1
                        left join
                        (SELECT  Spelning.Scentid, Spelning.Festivaldag, 
                        Namn, Landskod, Musikstil, Spelning.Scen
                        FROM Band INNER JOIN Spelning 
                        ON Band.BandID = Spelning.Band) as t2
                        ON t1.Dag = t2.Festivaldag
                        AND t1.Scen = t2.Scen
                        AND t1.Tid = t2.Scentid
                        order by Dag asc, Scen asc, Tid asc');  
    $STHthursday = $DBH->query('SELECT Starttid, Namn Band, Landskod Land, Scen
                        FROM Band INNER JOIN Spelning
                        ON Band.BandID = Spelning.Band
                        WHERE Spelning.Festivaldag = "Torsdag"
                        ORDER BY Starttid asc');   
    $STHfriday = $DBH->query('SELECT Starttid, Namn Band, Landskod Land, Scen
                        FROM Band INNER JOIN Spelning
                        ON Band.BandID = Spelning.Band
                        WHERE Spelning.Festivaldag = "Fredag"
                        ORDER BY Starttid asc');   
    $STHsaturday = $DBH->query('SELECT Starttid, Namn Band, Landskod Land, Scen
                        FROM Band INNER JOIN Spelning
                        ON Band.BandID = Spelning.Band
                        WHERE Spelning.Festivaldag = "Lördag"
                        ORDER BY Starttid asc');   

    //Fill the arrays with data
    while($row = $STH->fetch())
        $scenprogramTable[] = $row;
    while($row = $STH->fetch()) 
        $thuTable[] = $row;
    while($row = $STH->fetch()) 
        $friTable[] = $row;
    while($row = $STH->fetch()) 
        $satTable[] = $row;

?>

<?php include('header.php'); ?>
<?php include('navbar.php'); ?>

<!-- Displays a table for the every available time on each stage-->
    <?php if($isAdmin) : ?>
        <div class="col-md-12">
            <h2 class="page-header">Scenprogram med bokningar</h2>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Dag</th>
                        <th>Tid</th>
                        <th>Scen</th>
                        <th>Band</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($scenprogramTable as $row) : ?>
                    <tr>
                        <td><?php echo $row['Dag']; ?></td>
                        <td><?php echo $row['Tid']; ?></td>
                        <td><?php echo $row['Scen']; ?></td>
                        <td><?php echo $row['Band']; ?></td>
                    </tr>
                 <?php endforeach; ?>   
                </tbody>
            </table>
        </div>
    <?php endif; ?>
<!-- Displays a table for the festivalprogram for thursday-->
    <div class="col-md-12">
        <h2 class="page-header">Program Torsdag</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Startar</th>
                    <th>Band</th>
                    <th>Land</th>
                    <th>Scen</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($thuTable as $row) : ?>
                    <tr>
                        <td><?php echo $row['Starttid']; ?></td>
                        <td><?php echo $row['Band']; ?></td>
                        <td><?php echo $row['Land']; ?></td>
                        <td><?php echo $row['Scen']; ?></td>
                    </tr>
                 <?php endforeach; ?>   
            </tbody>
        </table>
    </div>
<!-- Displays a table for the festivalprogram for Friday-->
    <div class="col-md-12">
        <h2 class="page-header">Program Fredag</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Startar</th>
                    <th>Band</th>
                    <th>Land</th>
                    <th>Scen</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($friTable as $row) : ?>
                    <tr>
                        <td><?php echo $row['Starttid']; ?></td>
                        <td><?php echo $row['Band']; ?></td>
                        <td><?php echo $row['Land']; ?></td>
                        <td><?php echo $row['Scen']; ?></td>
                    </tr>
                 <?php endforeach; ?>   
            </tbody>
        </table>
    </div>
    
<!-- Displays a table for the festivalprogram for saturday-->
    <div class="col-md-12">
        <h2 class="page-header">Program Lördag</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Startar</th>
                    <th>Band</th>
                    <th>Land</th>
                    <th>Scen</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($satTable as $row) : ?>
                    <tr>
                        <td><?php echo $row['Starttid']; ?></td>
                        <td><?php echo $row['Band']; ?></td>
                        <td><?php echo $row['Land']; ?></td>
                        <td><?php echo $row['Scen']; ?></td>
                    </tr>
                 <?php endforeach; ?>   
            </tbody>
        </table>
    </div>


<?php include('footer.php'); ?>
