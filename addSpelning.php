<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
ini_set('display_startup_errors',1);

    //Connecting to DB
    require('connect.php');
    
   //Make an SQL-insertion if _POST is used
    if($_SERVER['REQUEST_METHOD']== "POST") {
        $postData = array($_POST['band'], $_POST['scen'],$_POST['dag'],$_POST['scentid'],$_POST['starttid']);
        
        try{
            $STHinsert = $DBH->prepare("INSERT INTO Spelning(Band, Scen, Festivaldag, Scentid, Starttid) VALUES (?,?,?,?,?)");
            $STHinsert->execute($postData); 
        }
        catch(PDOException $e) {
            echo "SQL-error: ";
            echo $e->getMessage();
        }

        echo "Success"; 
    }

    //Create arrays
    $bandNameArray = array(); 
    $scenArray = array();
    $dayArray = array();
    $timeArray = array();
    $bandTable = array();

    //SQL-querys
    $STHbandName = $DBH->query('SELECT BandID, Namn FROM Band');
    $STHscen = $DBH->query('SELECT Namn FROM Scen');
    $STHday = $DBH->query('SELECT Dag FROM Festivaldag');
    $STHtime = $DBH->query('SELECT Tid FROM Scentid');
    $STHspelningTable = $DBH->query('SELECT Namn Band, Scen, Festivaldag, Scentid, Starttid
    FROM Band INNER JOIN Spelning ON Band.BandID = Spelning.Band ORDER BY Starttid asc;');    

    //Fill the arrays with data
    while($row = $STHbandName->fetch())
        $bandNameArray[] = $row;
        
    while($row = $STHscen->fetch()) 
        $scenArray[] = $row;

    while($row = $STHday->fetch())
        $dagArray[] = $row;

    while($row = $STHtime->fetch()) 
        $tidArray[] = $row;

    while($row = $STHspelningTable->fetch())
        $spelningTable[] = $row;
?>

<?php include('header.php'); ?>
<?php include('navbar.php'); ?>

       <div class="col-md-4">
        <div class="page-header">
            <h2>Lägg till spelning</h2>
        </div>

        <form method="post" enctype="application/x-www-form-urlencoded" role="form">
            <div class="form-group">
                <label class="control-label" for="band">Band:</label>
                <select name="band" id="band" class="form-control">  
                    <?php foreach($bandNameArray as $band) : ?>
                    <option value="<?php echo $band['BandID']; ?>"><?php echo $band['Namn']; ?></option>
                    <?php endforeach; ?>
                </select>

           </div>
           <div class="form-group">
                <label class="control-label" for="scen">Scen:</label>
                <select name="scen" id="scen" class="form-control">  
                    <?php foreach($scenArray as $scen) : ?>
                    <option value="<?php echo $scen['Namn']; ?>"><?php echo $scen['Namn']; ?></option>
                    <?php endforeach; ?>
                </select>
           </div>
           <div class="form-group">
                <label class="control-label" for="dag">Dag:</label>
                <select name="dag" id="dag" class="form-control">  
                    <?php foreach($dagArray as $dag) : ?>
                    <option value="<?php echo $dag['Dag']; ?>"><?php echo $dag['Dag']; ?></option>
                    <?php endforeach; ?>
                </select>
           </div>
           <div class="form-group">
                <label class="control-label" for="scentid">Scentid:</label>
                <select name="scentid" id="scentid" class="form-control">  
                    <?php foreach($tidArray as $tid) : ?>
                    <option value="<?php echo $tid['Tid']; ?>"><?php echo $tid['Tid']; ?></option>
                    <?php endforeach; ?>
                </select>
           </div>
            <div class="form-group">
                <label class="control-label" for="starttid">Starttid:</label>
                <input type="text" name="starttid"  class="input-large form-control"
                       id="starttid" placeholder="Ex: 16:30" title="Klockslag, t.ex 16:30" required/>
            </div>

            <input type="submit" value="Skicka" class="btn btn-default" name="insert"/>

        </form>
    </div>
    <div class="col-md-12">
        <h2 class="page-header">Tidigare inlagda spelningar</h2>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Band</th>
                    <th>Scen</th>
                    <th>Festivaldag</th>
                    <th>Scentid</th>
                    <th>Starttid</th>
                </tr>
            </thead>
        <tbody>
        <?php foreach ($spelningTable as $row) : ?>
            <tr>
                <td><?php echo $row['Band']; ?></td>
                <td><?php echo $row['Scen']; ?></td>
                <td><?php echo $row['Festivaldag']; ?></td>
                <td><?php echo $row['Scentid']; ?></td>
                <td><?php echo $row['Starttid']; ?></td>
            </tr>
         <?php endforeach; ?>   
        </tbody>
    </table>
</div>

<?php include('footer.php'); ?>