<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
ini_set('display_startup_errors',1);

    //Connecting to DB
    require('connect.php');
    
    //Make an SQL-insertion if _POST is used
    if($_SERVER['REQUEST_METHOD']== "POST") {        
        $postData = array(htmlspecialchars($_POST['namn']),$_POST['publikantal'],$_POST['platsbeskrivning']);
        
        try{
            $STH1 = $DBH->prepare("INSERT INTO Scen(Namn, PublikAntal, PlatsBeskrivning) VALUES (?,?,?)");
            $STH1->execute($postData); 
        }
        catch(PDOException $e) {
            echo "SQL-error: ";
            echo $e->getMessage();
        }
    }

    //Create an array
    $scenTable = array();

    //SQL-query to get all data from table Scen
    $STH = $DBH->query('SELECT * FROM Scen');   
    
    //Adds each row from the table to the array
    while($row = $STH->fetch()) {
        $scenTable[] = $row;
    }

?>

<?php include('header.php'); ?>
<?php include('navbar.php'); ?>

       <div class="col-md-4">
        <div class="page-header">
            <h2>Lägg till scen</h2>
        </div>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="application/x-www-form-urlencoded" role="form" />
            <div class="form-group">
                <label class="control-label" for="namn">Namn:</label>
                <input type="text" name="namn" maxlength="30" class="input-large form-control" id="namn"
                       placeholder="Ex. Stora scenen" title="Scenens namn" required/>
            </div>
            <div class="form-group">
                <label class="control-label" for="publikantal">Publikantal:</label>
                <input type="number" name="publikantal" class="input-large form-control" id="publikantal" placeholder="Ex. 300"
                       title="Enbart siffror" required/>
            </div>
            <div class="form-group">
                 <label class="control-label" for="platsbeskrivning" >Platsbeskrivning:</label>
                 <textarea class="form-control" rows="3" name="platsbeskrivning" id="platsbeskrivning" required></textarea>
            </div>
            <input type="submit" value="Skicka" class="btn btn-default" name="insert"/>
        </form>
    </div>
    <div class="col-md-12">
        <h2 class="page-header">Tidigare inlagda scener</h2>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Namn</th>
                    <th>Publikantal</th>
                    <th>Platsbeskrivning</th>
                </tr>
            </thead>
        <tbody>
        <?php foreach ($scenTable as $row) : ?>
            <tr>
                <td><?php echo $row['Namn']; ?></td>
                <td><?php echo $row['PublikAntal']; ?></td>
                <td><?php echo $row['PlatsBeskrivning']; ?></td>
            </tr>
         <?php endforeach; ?>   
        </tbody>
    </table>
</div>

<?php include('footer.php'); ?>