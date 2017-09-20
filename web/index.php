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
    <link href="css/toastr.min.css" rel="stylesheet">
    <link href="css/chartist.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/angelica.css" rel="stylesheet">
  </head>

  <body id="page-top">
  <script type="text/javascript">

		function alteraStatus1() {
			$valor = document.getElementById('statusSensor1').value;			
			$.ajax({
				url:"./ligaDesliga.php?status="+$valor,				
				complete: function (response) {
					//alert(response.responseText);
                                        toastr.success('Sistema Ativo', 'Irrigação System');
				},
				error: function () {
				    //alert('Erro! Não foi possível alterar o Status');
                                    toastr.erro('Falha na operação', 'Irrigação System');
				}
			});  
			return false;
		}
  </script>	
  
  <script type="text/javascript">
		function alteraStatus2() {
			$valor = document.getElementById('statusSensor2').value;			
			$.ajax({
				url:"./ligaDesliga.php?status="+$valor,				
				complete: function (response) {
					//alert(response.responseText);
                                        toastr.success('Sistema Desativado', 'Irrigação System');
				},
				error: function () {
				    //alert('Erro! Não foi possível alterar o Status');
                                    toastr.erro('Falha na operação', 'Irrigação System');
				}
			});  
			return false;
		}
  </script>	
  
  <script type="text/javascript">

  		/*
    	function send() {
        var person = {
            name: $("#id-name").val(),
            address:$("#id-address").val(),
            phone:$("#id-phone").val()
        }

        $('#target').html('sending..');

        $.ajax({
            url: '/test/PersonSubmit',
            type: 'post',
            dataType: 'json',
            success: function (data) {
                $('#target').html(data.msg);
            },
            data: person
        });
		*/

		function alteraSetup() {
			var config = {
				min: $('#min').val(),
				max: $('#max').val(),
				limite: $('#limite').val()
			}
			//console.log(config);
			$.ajax({				
				url:"./setup.php",
				type:'post',
				datatype: 'json',
				success: function (response) {
					//console.log("enviado com sucesso");
					//console.log(response);
					temp = JSON.parse(response);
					if(temp.status == "ok"){
						//console.log("configuracoes salvas");
						toastr.success('Configurações salvas com sucesso', 'Irrigação System');
					}
					//alert(response.responseText);
					//window.location.reload();
				},
				data: JSON.stringify(config),
				error: function () {
					console.log('erro');
					toastr.error('Deu Zebra!', 'Irrigação System');
				}
			});  
			return false;
		}
  </script>
  
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
              <a class="nav-link js-scroll-trigger" href="#setup">Configuração</a>
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

    <!-- Status Section -->
    <section class="status" id="status">
      <div class="container">
        <h2 class="text-center">Status</h2>
        <hr class="star-light star-status">
        <div class="row">
          <div class="col-lg-4 ml-auto">
            <p>Este Sistema Embarcado foi desenvolvido utilizando o pricípio de Internet das Coisas.</p>
          </div>
          <div class="col-lg-4 mr-auto">
            <p>Seu objetivo é proporcionar a automação de irrigação de hortas através da web.</p>
          </div>
          <div class="col-lg-8 mx-auto text-center">
			<button value="ligado" id="statusSensor1" type="button" class="btn btn-primary" onclick="alteraStatus1();">Ligar Irrigador</button>
			<button value="desligado" id="statusSensor2" type="button" class="btn btn-danger" onclick="alteraStatus2();">Desligar Irrigador</button>
          </div>		  
        </div>
      </div>
    </section>
	
	<!-- Setup Section -->
    <section class="configuracao" id="setup">
      <div class="container">
        <h2 class="text-center">Setup</h2>
        <hr class="star-light star-configuracao">


        <div class="row">
          <div class="col-lg-4 ml-auto">
            <p>Você pode realizar a configuração do sensor de umidade a partir dos campos a seguir.</p>
          </div>
          <div class="col-lg-4 mr-auto">
            <p>Defina o limite mínimo e máximo para a dectecção de umidade pelo sensor.</p>
          </div>
          </div>


         <div class="row">
		  <div class="col-lg-8 mx-auto text-center">            
			<div class="input-group">
          		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></span>
          		<span class="input-group-btn">
          			<button type="button" class="quantity-left-minus btn btn-danger btn-number"  data-type="minus" data-field="limite">
          				<span class="glyphicon glyphicon-minus"></span>
          			</button>
          		</span>
          		<input type="text" name="maximo" class="form-control input-number" value="100" min="1" max="100" id="limite">
          		<span class="input-group-btn">
          			<button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="limite">
          				<span class="glyphicon glyphicon-plus"></span>
          			</button>
          		</span>
          	</div>
          </div>
          </div>
          <br>
		<div class="row">
          <div class="col-lg-8 mx-auto text-center">            
          	<div class="input-group">
          		<span class="input-group-addon" id="basic-addon1">Mínimo</span>
          		<span class="input-group-btn">
          			<button type="button" class="quantity-left-minus btn btn-danger btn-number"  data-type="minus" data-field="min">
          				<span class="glyphicon glyphicon-minus"></span>
          			</button>
          		</span>
          		<input type="text" name="minimo" class="form-control input-number" value="1" min="1" max="100" id="min">
          		<span class="input-group-btn">
          			<button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="min">
          				<span class="glyphicon glyphicon-plus"></span>
          			</button>
          		</span>
          	</div>
        </div>
          </div>
          <br>
         <div class="row">
		  <div class="col-lg-8 mx-auto text-center">            
			<div class="input-group">
          		<span class="input-group-addon" id="basic-addon1">Máximo</span>
          		<span class="input-group-btn">
          			<button type="button" class="quantity-left-minus btn btn-danger btn-number"  data-type="minus" data-field="max">
          				<span class="glyphicon glyphicon-minus"></span>
          			</button>
          		</span>
          		<input type="text" name="maximo" class="form-control input-number" value="100" min="1" max="100" id="max">
          		<span class="input-group-btn">
          			<button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="max">
          				<span class="glyphicon glyphicon-plus"></span>
          			</button>
          		</span>
          	</div>
          </div>
          </div>
          <br>
          <div class="row">
		  <div class="col-lg-8 mx-auto text-center">            			
			<button type="button" class="btn btn-primary" onclick="alteraSetup();">Configurar</button>
          </div>		  
        </div>
      </div>
    </section>	

    <!-- Dados Section -->
    <section id="dados" class="dados">
    	<div class="container">
      		<h2 class="text-center">Dados</h2>
        	<hr class="star-light star-dados">
            <div class="chart">
            	
            </div>
    	</div>
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
    <script src="js/toastr.min.js"></script>
    <script src="js/chartist.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>
