<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
ini_set('display_startup_errors',1);

    //Connecting to DB
    require('connect.php');
    
    //Make an SQL-insertion if _POST is used
    if($_SERVER['REQUEST_METHOD']== "POST") {        
               $postData = array($_POST['band'],
                    $_POST['namn'],$_POST['instrument'],$_POST['fodelseort'],$_POST['fodelsear'],$_POST['msedan'],$_POST['trivia']);
        try{
            $STH1 = $DBH->prepare("INSERT INTO Bandmedlem(Band, Namn, Instrument, Fodelseort, Fodelsear, MedlemSedan, Trivia)
                                    VALUES (?,?,?,?,?,?,?)");
            $STH1->execute($postData); 
        }
        catch(PDOException $e) {
            echo "SQL-error: ";
            echo $e->getMessage();
        }
    }

    //Create arrays
    $bandNameArray = array();
    $medlemTable = array();

    //SQL-querys
    $STHbandName = $DBH->query('SELECT BandID, Namn FROM Band');
    $STHbandmedlemTable = $DBH->query('SELECT Band.Namn as Band, Bandmedlem.Namn, Instrument, Fodelseort, Fodelsear, MedlemSedan,
                                        Bandmedlem.Trivia
                                        FROM 
                                        Bandmedlem LEFT JOIN Band
                                        ON Band.BandID = Bandmedlem.band
                                        ORDER BY Band');   
    
    //Fill the arrays with data
    while($row = $STHbandName->fetch())
        $bandNameArray[] = $row;
    while($row = $STHbandmedlemTable->fetch()) 
        $medlemTable[] = $row;
?>

<?php include('header.php'); ?>
<?php include('navbar.php'); ?>

    <!-- Displays a form for adding bandmembers-->
       <div class="col-md-4">
        <div class="page-header">
            <h2>Lägg till bandmedlem</h2>
        </div>
        <form method="post" enctype="application/x-www-form-urlencoded" role="form">
            <div class="form-group">
                <label class="control-label" for="band" >Band:</label>
                <select name="band" id="band" class="form-control">  
                    <?php foreach($bandNameArray as $band) : ?>
                        <option value="<?php echo $band['BandID']; ?>"><?php echo $band['Namn']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div> 
           <div class="form-group">
                <label class="control-label" for="namn">Namn:</label>
                <input type="text" name="namn" maxlength="50" class="input-large form-control" id="namn"
                       placeholder="Artistnamn" title="Artistnamn" required/>
            </div>
           <div class="form-group">
                <label class="control-label" for="instrument">Instrument:</label>
                <input type="text" name="instrument" maxlength="50" class="input-large form-control" id="instrument"
                       placeholder="Ex. Gitarr" title="Instrument" required/>
            </div>
           <div class="form-group">
                <label class="control-label" for="fodelseort">Födelseort:</label>
                <input type="text" name="fodelseort" maxlength="50" class="input-large form-control" id="fodelseort"
                       placeholder="Födelseort" title="Födelseort" required/>
            </div>
            <div class="form-group">
                <label class="control-label" for="fodelsear">Födelseår:</label>
                <input type="number" name="fodelsear" min="1900" max="2014" class="form-control" id="fodelsear"
                       placeholder="Ex. 1987" title="Årtal mellan 1900-2014" required/>
            </div>
            <div class="form-group">
                <label class="control-label" for="msedan">Medlem sedan:</label>
                <input type="number" name="msedan" min="1900" max="2014" class="form-control" id="msedan"
                       placeholder="Ex. 1987" title="Årtal mellan 1900-2014" required/>
            </div>
             <div class="form-group">
                 <label class="control-label" for="trivia" >Trivia:</label>
                 <textarea class="form-control" rows="3" name="trivia" id="trivia" required></textarea>
            </div>
           <input type="submit" value="Skicka" class="btn btn-default" name="insert"/>
        </form>
    </div>

    <!-- Displays a table with existing bandmembers-->
    <div class="col-md-12">
        <h2 class="page-header">Tidigare inlagda bandmedlemmar</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Band</th>
                    <th>Namn</th>
                    <th>Instrument</th>
                    <th>Födelseort</th>
                    <th>Födelseår</th>
                    <th>Medlem sedan</th>
                    <th>Trivia</th>
                </tr>
            </thead>
        <tbody>
            <?php foreach ($medlemTable as $row) : ?>
                <tr>
                    <td><?php echo $row['Band']; ?></td>
                    <td><?php echo $row['Namn']; ?></td>
                    <td><?php echo $row['Instrument']; ?></td>
                    <td><?php echo $row['Fodelseort']; ?></td>
                    <td><?php echo $row['Fodelsear']; ?></td>
                    <td><?php echo $row['MedlemSedan']; ?></td> 
                    <td><?php echo $row['Trivia']; ?></td>
                </tr>
             <?php endforeach; ?>   
        </tbody>
    </table>
</div>

<?php include('footer.php'); ?>