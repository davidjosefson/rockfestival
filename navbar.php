<?php 
$isAdmin = false;

if(isset($_GET['admin']) )
    $isAdmin = true;
?>

<nav class="navbar navbar-default" role="navigation">
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
                            <li><a href="funktionar.php?admin">Funktionär</a></li>
                            <li><a href="#">Säkerhetspass</a></li>
                            <li><a href="scen.php?admin">Scen</a></li>
                            <li class="divider"></li>
                            <li><a href="AddBand.php?admin">Band</a></li>
                            <li><a href="bandmedlem.php?admin">Bandmedlem</a></li>
                            <li><a href="spelning.php?admin">Spelning</a></li>
                        </ul> 
                    </li>
                <?php endif; ?>
                <li><a href="#">Band</a></li>
                <li><a href="program.php<?php if($isAdmin) {echo "?admin";}; ?>">Program</a></li>
                <li><a href="sakerhetslista.php<?php if($isAdmin) {echo "?admin";}; ?>">Säkerhetslista</a></li>
                <li><a href="kontaktpersoner.php<?php if($isAdmin) {echo "?admin";}; ?>">Kontaktpersoner</a></li>
            </ul>                                         
        </div>
    </div>
</nav>