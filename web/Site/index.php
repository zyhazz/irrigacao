<!DOCTYPE html>
<html lang="en">

  <head>
	<title>Irrigação Inteligente</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
	<link rel="shortcut icon" href="img/favicon.ico?v=2">

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/angelica.min.css" rel="stylesheet">
  </head>

  <body id="page-top">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">            
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#page-top">Início</a>
            </li>
			<li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#status">Status</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#dados">Dados</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <header class="masthead">
      <div class="container">
        <a href="./"><img width="15%" height="15%" class="img-fluid" src="img/vaso.jfif" alt=""></a>
        <div class="intro-text">
          <span class="name">Sistema de Irrigação</span>
          <hr class="star-light">
          <span class="skills">Projeto de IoT - Angélica Alves Viana</span>
        </div>
      </div>
    </header>

    

    <!-- About Section -->
    <section class="success" id="status">
      <div class="container">
        <h2 class="text-center">Status</h2>
        <hr class="star-light">
        <div class="row">
          <div class="col-lg-4 ml-auto">
            <p>Este Sistema Embarcado foi desenvolvido utilizando o pricípio de Internet das Coisas.</p>
          </div>
          <div class="col-lg-4 mr-auto">
            <p>Seu objetivo é proporcionar a automação de irrigação de hortas através da web.</p>
          </div>
          <div class="col-lg-8 mx-auto text-center">            
			<a href="index.php?status=ligado" class="btn btn-primary" onclick="redireciona()">              
              Ligar Irrigador
            </a>
			<a href="index.php?status=desligado" class="btn btn-danger" onclick="redireciona()">              
              Desligar Irrigador
            </a>
          </div>		  
        </div>
      </div>
    </section>

    <!-- Contact Section -->
    <section id="dados">
      
    </section>

    <!-- Footer -->
    <footer class="text-center">
      <img src = "img/planta.jpg">      
       <div class="footer-above">
	
        <div class="container">
          <div class="row">
            <div class="footer-col col-md-4">
              <h3>Maracanaú</h3>
              <p>Av. Parque Central, 1315
                <br>CEP: 61939-140</p>
            </div>
            <div class="footer-col col-md-4">
              <h3>Mídias</h3>
              <ul class="list-inline">
                <li class="list-inline-item">
                  <a class="btn-social btn-outline" href="#">
                    <i class="fa fa-fw fa-facebook"></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a class="btn-social btn-outline" href="#">
                    <i class="fa fa-fw fa-instagram"></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a class="btn-social btn-outline" href="#">
                    <i class="fa fa-fw fa-github"></i>
                  </a>
                </li>                
              </ul>
            </div>
            <div class="footer-col col-md-4">
              <h3>Sobre a Autora</h3>
              <p>Graduanda em Bacharelado de Ciência da Computação, no
                <a href="http://ifce.edu.br" target="_blank">Instituto Federal do Ceará</a>.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-below">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              Grupo <a href="http://sanusb.org" target="_blank">SanUsb</a> 2017
            </div>
          </div>
        </div>
      </div>
    </footer>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top d-lg-none">
      <a class="btn btn-primary js-scroll-trigger" href="#page-top">
        <i class="fa fa-chevron-up"></i>
      </a>
    </div>    

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/freelancer.min.js"></script>
  </body>
</html>

<?php
//ini_set('display_errors', 0 );
error_reporting(0);

//conectando no banco de dados mysql
$db="irrigador"; //nome do banco
$link = mysql_connect('localhost', 'root', ''); //local (ip), usuario do banco, senha
if (! $link)
die(mysql_error());
mysql_select_db($db , $link) or die("Select Error: ".mysql_error());

$status = $_GET['status'];
if ($status == "ligado") {
	$result=mysql_query("UPDATE table_status SET status = '1' WHERE id='1';");
	echo "<script language=javascript>alert( 'Irrigador Ligado!' );</script>";
}

if ($status == "desligado") {
	$result=mysql_query("UPDATE table_status SET status = '0' WHERE id='1';");
	echo "<script language=javascript>alert( 'Irrigador Desligado!' );</script>";
}
	
mysql_close($link);
?>
