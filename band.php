
<?php

error_reporting(E_ALL);
ini_set('display_errors',1);
ini_set('display_startup_errors',1);

    //Connecting to DB
    require('connect.php');

$bandTable = array();

$STH = $DBH->query('SELECT Band.Namn, Band.Landskod FROM Band');

 while($row = $STH->fetch()) {
        $bandTable[] = $row;
    }

?>

<?php include('header.php'); ?>
<?php include('navbar.php'); ?>

<div class="col-md-12">
            <h2 class="page-header">Bokade band</h2>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Namn</th>
                        <th>Land</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($bandTable as $row) : ?>
                    <tr>
                        <td><?php echo $row['Namn']; ?></td>
                        <td><?php echo $row['Landskod']; ?></td>
                    </tr>
                 <?php endforeach; ?>   
                </tbody>
            </table>
</div>
<?php include('footer.php'); ?>
