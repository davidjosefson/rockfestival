<?php
    include('connect.php');
    include('methods.php');

   /* $successMessage = '';
    $msg = $_GET['msg'];
    if($msg == '1') {
        $successMessage .= "<div class='alert alert-success'>";
        $successMessage .= "<button class='close' data-dismiss='alert'>&times;</button>";
        $successMessage .= "Allt lyckades!";
        $successMessage .= "</div>";
    }*/

    displayTable();

     
//på varje sida (index.php, bokaband.php osv) kan man sedan köra 
/*
include('connect.php');

    - specifik php-kod och sql-satser och annat
    - bygger upp en $content som kommer visas på sidan
    - 
    
include('layout.php'); //som innehåller all html, och en <?php echo $navigationbar, <?php echo $content osv.

*/
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- <meta charset="ISO-8859-1"> -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script>
            $("alert").alert('close');
        </script>
            
    </head>    
    <body>
        <div class="container">
            <div class="col-md-12">
                <nav class="navbar navbar-default" role="navigation">
                    <div class="container-fluid">

                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                        <a class="navbar-brand" href="#">Rockfestival.</a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Lägg till <span class="caret"></span></a>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Funktionär</a></li>
                                <li><a href="#">Band</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                                <li class="divider"></li>
                                <li><a href="#">One more separated link</a></li>
                              </ul> 
                            </li>

                            
                            <li><a href="#">Spelscheman</a></li>
                            <li><a href="#">Band</a></li>
                        
                        </ul>                                         

                    </div>
                    </div>
                </nav>
            </div>
            <div class="col-md-4">
                <div class="page-header">
                    <h2>Lägg till funktionär.</h2>
                </div>

                <?php // echo $successMessage; ?>

                <form method="post" enctype="application/x-www-form-urlencoded" role="form" />
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
                    <?php echo displayTable(); ?>
            </div>
        </div>
    </body>
</html>    
