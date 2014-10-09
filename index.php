<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
ini_set('display_startup_errors',1);

    //Connecting to DB
    require('connect.php');
    
    //Make an SQL-insertion if _POST is used
    if($_SERVER['REQUEST_METHOD']== "POST") {
       
        echo $_POST['namn']; //<>[]{}
        echo htmlspecialchars($_POST['namn']); //<>[]{}
        
        if (isset($_POST['sakerhetsbehorig']))
            $sakerhetsbehorig = 1;
        else
            $sakerhetsbehorig = 0;
        
        $postData = array(htmlspecialchars($_POST['namn']), $_POST['personnummer'],$_POST['gatuadress'],$_POST['postnummer'],$_POST['postort'],$_POST['lon'], $sakerhetsbehorig);
        
        try{
            $STH1 = $DBH->prepare("INSERT INTO Funktionar(Namn, Personnummer, Gatuadress, Postnummer, Postort, Lon, Sakerhetsbehorig) VALUES (?,?,?,?,?,?,?)");
            $STH1->execute($postData); 
        }
        catch(PDOException $e) {
            echo "SQL-error: ";
            echo $e->getMessage();
        }
        echo "Success";
    }

    //Create an array
    $funktionarTable = array();

    //SQL-query to get all data from table Funktionar
    $STH = $DBH->query('SELECT * FROM Funktionar');   
    
    //Adds each row from the table to the array
    while($row = $STH->fetch()) {
        $funktionarTable[] = $row;
    }

?>

<?php include('header.php'); ?>
       <div class="col-md-4">
        <div class="page-header">
            <h2>Lägg till funktionär.</h2>
        </div>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="application/x-www-form-urlencoded" role="form" />
            <div class="form-group">
                <label class="control-label" for="namn">Namn:</label>
                <input type="text" name="namn" class="input-large form-control" id="namn" />
            </div>
            <div class="form-group">
                <label class="control-label" for="personnummer">Personnummer:</label>
                <input type="text" name="personnummer" class="input-large form-control" id="personnummer"/>
            </div>
            <div class="form-group">
                <label class="control-label" for="gatuadress">Gatuadress:</label>
                <input type="text" name="gatuadress" class="form-control" id="gatuadress" />
            </div>
            <div class="form-group">
                <label class="control-label" for="postnummer">Postnummer:</label>
                <input type="text" name="postnummer" class="input-large form-control" id="postnummer"/>
            </div>
            <div class="form-group">
                <label class="control-label" for="postort">Postort:</label>
                <input type="text" name="postort" class="input-large form-control" id="postort"/>
            </div>
            <div class="form-group">
                <label class="control-label" for="lon">Lön:</label>
                <input type="text" name="lon" class="input-large form-control" id="lon"/>
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="true" name="sakerhetsbehorig" id="sakerhetsbehorig">Säkerhetsbehörig
                    </label>
                </div>
            </div>

            <input type="submit" value="Skicka" class="btn btn-default" name="insert"/>

        </form>
    </div>

    <div class="col-md-12">
        <h2 class="page-header">Tabell.</h2>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Namn</th>
                    <th>Personnr</th>
                    <th>Gatuadress</th>
                    <th>Postnummer</th>
                    <th>Postort</th>
                    <th>Lön</th>
                    <th>Säkerhetsbehörig</th>
                </tr>
            </thead>
        <tbody>
        <?php foreach ($funktionarTable as $row) : ?>
            <tr>
                <td><?php echo $row['Namn']; ?></td>
                <td><?php echo $row['Personnummer']; ?></td>
                <td><?php echo $row['Gatuadress']; ?></td>
                <td><?php echo $row['Postnummer']; ?></td>
                <td><?php echo $row['Postort']; ?></td>
                <td><?php echo $row['Lon']; ?></td>

                <?php if($row['Sakerhetsbehorig'] == 1) :  ?>
                    <td>Ja</td>
                <?php else : ?>
                    <td>Nej</td>
                <?php endif; ?>
            </tr>
         <?php endforeach; ?>   
        </tbody>
    </table>
</div>


<?php include('footer.php'); ?>