<?php 
$isAdmin = false;

if(isset($_GET['admin']) )
    $isAdmin = true;
?>

<nav class="navbar navbar-<?php if($isAdmin) {echo "default";} else{echo "inverse";}; ?>" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="index.php">Rockfestival.</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php if ($isAdmin) : ?>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Lägg till <span class="caret"></span></a>
                      <ul class="dropdown-menu" role="menu">
                            <li><a href="addFunktionar.php?admin">Funktionär</a></li>
                            <li><a href="#">Säkerhetspass</a></li>
                            <li><a href="addScen.php?admin">Scen</a></li>
                            <li class="divider"></li>
                            <li><a href="addBand.php?admin">Band</a></li>
                            <li><a href="addBandmedlem.php?admin">Bandmedlem</a></li>
                            <li><a href="addSpelning.php?admin">Spelning</a></li>
                        </ul> 
                    </li>
                <?php endif; ?>
                <li><a href="displayBand.php<?php if($isAdmin) {echo "?admin";}; ?>">Band</a></li>
                <li><a href="displayProgram.php<?php if($isAdmin) {echo "?admin";}; ?>">Program</a></li>
                <?php if ($isAdmin) : ?>
                    <li><a href="displaySakerhetslista.php<?php if($isAdmin) {echo "?admin";}; ?>">Säkerhetslista</a></li>
                    <li><a href="displayKontaktpersoner.php<?php if($isAdmin) {echo "?admin";}; ?>">Kontaktpersoner</a></li>
                <?php endif; ?>
            </ul>                                         
        </div>
    </div>
</nav>