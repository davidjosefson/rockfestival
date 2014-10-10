<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
ini_set('display_startup_errors',1);

    //Connecting to DB
    require('connect.php');
    
   //Make an SQL-insertion if _POST is used
    if($_SERVER['REQUEST_METHOD']== "POST") {
        
        
        $postData = array($_POST['namn'], $_POST['landskod'],$_POST['grundades'],$_POST['musikstil'],$_POST['trivia'],$_POST['funktionar']);
        
        try{
            $STH1 = $DBH->prepare("INSERT INTO Band(Namn, Landskod, Grundades, Musikstil, Trivia, Kontaktperson) VALUES (?,?,?,?,?,?)");
            $STH1->execute($postData); 
        }
        catch(PDOException $e) {
            echo "SQL-error: ";
            echo $e->getMessage();
        }
        
        
        
        echo "Success"; 
    }

    //Create an array
    $bandTable = array();

    //SQL-query to get all data from table Funktionar
    $STH = $DBH->query('SELECT Band.Namn, Landskod, Grundades, Musikstil, Trivia, Funktionar.Namn as Kontaktperson
                        FROM Band LEFT JOIN Funktionar
                        ON Band.Kontaktperson = Funktionar.FunktionarsID');   
    
    //Adds each row from the table to the array
    while($row = $STH->fetch()) {
        $bandTable[] = $row;
    }

?>

<?php include('header.php'); ?>
<?php include('navbar.php'); ?>

       <div class="col-md-4">
        <div class="page-header">
            <h2>Lägg till band</h2>
        </div>

        <form method="post" enctype="application/x-www-form-urlencoded" role="form" />
            <div class="form-group">
                <label class="control-label" for="namn">Bandnamn:</label>
                <input type="text" name="namn" maxlength="30" class="input-large form-control" id="namn"
                       placeholder="Bandnamn" title="Max 30 tecken" required/>
            </div>
            <div class="form-group">
                <label class="control-label" for="landskod">Landskod:</label>
                <input type="text" name="landskod" pattern="[A-Za-z]{3}"  class="input-large form-control"
                       id="landskod" placeholder="Ex: SWE" title="Landskod i form av 3 bokstäver, t.ex SWE" required/>
            </div>
            <div class="form-group">
                <label class="control-label" for="grundades">Grundades:</label>
                <input type="number" name="grundades" min="1800" max="2014" class="form-control" id="grundades"
                       placeholder="Ex. 1987" title="Årtal mellan 1800-2014" required/>
            </div>
            <div class="form-group">
                <label class="control-label" for="musikstil">Musikstil:</label>
                <input type="text" name="musikstil" maxlength="50" class="input-large form-control"
                       id="musikstil" placeholder="Genre" title="Max 50 tecken" required/>
            </div>
           
             <div class="form-group">
                 <label class="control-label" for="trivia" >Trivia:</label>
                 <textarea class="form-control" rows="3" name="trivia" id="trivia" required></textarea>
            </div>
            <div class="form-group">
                <label class="control-label" for="funktionar" >Kontaktperson:</label>
                <select name="funktionar" id="funktionar">  
                    <?php
                        $STHtest = $DBH->query('SELECT FunktionarsID, Namn FROM Funktionar');   
                        while($row = $STHtest->fetch()) { 
                            echo '<option value="' . $row['FunktionarsID'] . '"> ' . $row['Namn'] .     '</option>';  
                        }
                    ?>  
                </select>
            </div>

            <input type="submit" value="Skicka" class="btn btn-default" name="insert"/>

        </form>
    </div>
    <div class="col-md-12">
        <h2 class="page-header">Tidigare inlagda band</h2>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Namn</th>
                    <th>Landskod</th>
                    <th>Grundades</th>
                    <th>Musikstil</th>
                    <th>Trivia</th>
                    <th>Kontaktperson</th>
                </tr>
            </thead>
        <tbody>
        <?php foreach ($bandTable as $row) : ?>
            <tr>
                <td><?php echo $row['Namn']; ?></td>
                <td><?php echo $row['Landskod']; ?></td>
                <td><?php echo $row['Grundades']; ?></td>
                <td><?php echo $row['Musikstil']; ?></td>
                <td><?php echo $row['Trivia']; ?></td>
                <td><?php echo $row['Kontaktperson']; ?></td>
            </tr>
         <?php endforeach; ?>   
        </tbody>
    </table>
</div>

<?php include('footer.php'); ?>