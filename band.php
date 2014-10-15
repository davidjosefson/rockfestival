<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
ini_set('display_startup_errors',1);

    //Connecting to DB
    require('connect.php');

    $bandTable = array();
    $medlemTable = array();

    $STHbandInfo = $DBH->query('SELECT BandID, Namn, Landskod, Grundades, Musikstil, Trivia FROM Band');
    $STHmedlemInfo = $DBH->query('SELECT BandmedlemsID, Band, Namn, Instrument, Fodelseort, Fodelsear, MedlemSedan, Trivia FROM Bandmedlem');

    while($row = $STHbandInfo->fetch())
        $bandTable[] = $row;

    while($row = $STHmedlemInfo->fetch())
        $medlemTable[] = $row;

?>

<?php include('header.php'); ?>
<?php include('navbar.php'); ?>

<div class="col-md-12">
    <h1 class="page-header">Band</h1>

    <div class="panel-group" id="accordion">

        <?php foreach($bandTable as $band) : ?>
        <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $band['BandID']; ?>">
                  <?php echo $band['Namn']; ?>
                </a>
              </h4>
            </div>
            <div id="<?php echo $band['BandID']; ?>" class="panel-collapse collapse">
              <div class="panel-body">
                  <p><strong>Land:</strong> <?php echo $band['Landskod']; ?></p>
                  <p><strong>Grundades:</strong> <?php echo $band['Grundades']; ?></p>
                  <p><strong>Musikstil:</strong> <?php echo $band['Musikstil']; ?></p>
                  <p><strong>Musikstil:</strong> <?php echo $band['Trivia']; ?></p>
                  <p class="vertical-offset-3"><strong>Bandmedlemmar:</strong></p>
                  <?php foreach($medlemTable as $medlem) : 
                            if($medlem['Band'] == $band['BandID']) :
                  ?>
                  <div class="row">
                        <div class="col-md-5">
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h5 class="panel-title">
                                <a data-toggle="collapse" data-parent="#medlem" href="#<?php echo $band['BandID']; ?>-<?php echo $medlem['BandmedlemsID']; ?>">
                                  <?php echo $medlem['Namn']; ?>
                                </a>
                              </h5>
                            </div>
                            <div id="<?php echo $band['BandID']; ?>-<?php echo $medlem['BandmedlemsID']; ?>" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p><strong>Födelseår:</strong> <?php echo $medlem['Fodelsear']; ?></p>
                                    <p><strong>Födelseort:</strong> <?php echo $medlem['Fodelseort']; ?></p>
                                    <p><strong>Instrument:</strong> <?php echo $medlem['Instrument']; ?></p>
                                    <p><strong>Medlem i <em><?php echo $band['Namn']; ?></em> sedan:</strong> <?php echo $medlem['MedlemSedan']; ?></p>
                                    <p><strong>Trivia:</strong> <?php echo $medlem['Trivia']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                  
                  <?php endif; 
                    endforeach; ?>
                  
              </div>
            </div>
          </div>
        <? endforeach; ?>

    </div>    

</div>
<?php include('footer.php'); ?>
