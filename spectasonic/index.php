<?php 
// connexion to database
$db = new PDO('mysql:host=localhost;dbname=hicloud','root','root');
$sql = "select temperature_sensor,humidity_sensor,vibration_sensor from sensor";
$req1 = $db->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
$req1->execute();
$datafile = $req1->fetchAll();
                    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Spectasonic</title>
	

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/bouton.css">
    




    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <script src="js/Chart.bundle.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <style>
    canvas {
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
    </style>
   
</head><!--/head-->

<body class="homepage">

    <header id="header">
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-xs-4">
                        <div class="top-number"><p><i class="fa fa-phone-square"></i>  04 81 68 06 97</p></div>
                    </div>
                    <div class="col-sm-6 col-xs-8">
                       <div class="social">
                            <ul class="social-share">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                           
                            </ul>
                           
                       </div>
                    </div>
                </div>
            </div><!--/.container-->
        </div><!--/.top-bar-->

        <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html"><img src="images/logo.png" alt="logo"></a>
                </div>
				
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">                                      
                        <li class="dropdown">                          
                        </li>                  
                                              
                    </ul>
                </div> 
            </div><!--/.container--> //159.5
        </nav><!--/nav-->
		
    </header><!--/header-->

   <div calss="text"> <p><h2>"User name : date of purchase of a product."</h2></p></div>
  <div class="text1" id="battery" > <p><h2>Battery 40%</h2></p></div>
 <div class="onoffswitch" >
        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" checked>
        <label class="onoffswitch-label" for="myonoffswitch">
            <span class="onoffswitch-inner"></span>
            <span class="onoffswitch-switch"></span>
        </label>
    </div>
  <div style="width:75%;">
        <canvas id="canvas"></canvas>
    </div>
    <br>
    <br>
    <div>
    <script>
       
        var randomScalingFactor = function() {
            return Math.round(Math.random() * 100 * (Math.random() > 0.5 ? -1 : 1));
        };
         var randomScalingFactor1 = function() {
            return Math.round(Math.random() * 100 * (Math.random() > 0.5 ? 1 : 1));
        };
        var randomScalingFactor2 = function() {
            return Math.round(Math.random() * 50 * (Math.random() > 0.5 ? 1 : 1));
        };

        var randomColorFactor = function() {
            return Math.round(Math.random() * 255);
        };
        var randomColor = function(opacity) {
            return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',' + (opacity || '.3') + ')';
        };
        // create variable for the graph
        var temp = [];
        var hum = [];
        var vib = [];
        // convert php values into javascript
        <?php foreach($datafile as $data) { ?>
            temp.push(<?php echo $data["temperature_sensor"];  ?>);
            hum.push(<?php echo $data["humidity_sensor"];  ?>);
            vib.push(<?php echo $data["vibration_sensor"];  ?>);
        <?php } ?>
        // conf of the graph
        var config = {
            type: 'line',
            data: {
                labels: ["1min", "2min", "3min", "4min", "5min", "6min", "7min","8min","9min","10min","11min"],
                datasets: [{
                    label: "Humidity %",
                    data: hum,
                    fill: false,
                    borderDash: [20, 20],
                }, {
                    label: "Temperature °C",
                    data: temp,


                }, {
                    label: "vibration",
                    data: vib,
                         borderDash: [20, 20],

                }]
            },
            options: {
                responsive: true,
                title:{
                    display:true,
                    text:"Statistical Amplifier"
                },
                tooltips: {
                    mode: 'label',
                },
               
                hover: {
                    mode: 'label'
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            show: true,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            show: true,
                            labelString: 'Value'
                        }
                    }]
                }
            }
        };

        $.each(config.data.datasets, function(i, dataset) {
            dataset.borderColor = randomColor(0.4);
            dataset.backgroundColor = randomColor(0.5);
            dataset.pointBorderColor = randomColor(0.7);
            dataset.pointBackgroundColor = randomColor(0.5);
            dataset.pointBorderWidth = 1;
        });

        window.onload = function() {
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myLine = new Chart(ctx, config);

        };

      
    </script>

</div>
<div></div>
    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2013 <a target="_blank" href="http://shapebootstrap.net/" title="Free Twitter Bootstrap WordPress Themes and HTML templates">ShapeBootstrap</a>. All Rights Reserved.
                </div>
            </div>
        </div>
    </footer>



</body>
</html>