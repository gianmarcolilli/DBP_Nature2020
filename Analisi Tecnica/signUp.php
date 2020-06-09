
<html
lang="it">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nature/sign up</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap-4.4.1.css" rel="stylesheet">
	  <link href="css/style.css" rel="stylesheet">
	  <link href="fontawesome/css/fontawesome.min.css" rel="stylesheet">
	  <link href="fontawesome/css/fontawesome.css" rel="stylesheet">
	  <!--<link href="css/bootstrap.css" rel="stylesheet">-->
	  <link rel="stylesheet" href="bootstrap-social-gh-pages/assets/css/fontawesome.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="bootstrap-social-gh-pages/assets/css/fontawesome.css">
	  <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;700&family=Sriracha&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu:400,700&display=swap" rel="stylesheet">
	  
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <!-- <script>
  $(document).ready(function(){
    $('#funamministratore').hide();
  });


  $(function() {
    $('#tipoutente').change(function(){
      if ( $('#tipoutente').val() == 'amministratore' ){
        $('#funamministratore').show();
      }else {
        $('#funamministratore').hide();
      }
    });
  });
  </script>-->

  </head>
	
<?php
//include("connection.php");
?>

	
<body>
	
	<nav class="navbar navbar-expand-lg navbar-fixed-top navbar-dark bg-success">
      <a class="navbar-brand align-text-center" href="loginSignUp.php"><h1>Registrati su Nature</h1> </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      </nav>
	<div class="container">
		<img class="img-thumbnail" src="img/Logo.JPEG" > 
	</div>
	<br>
	<br>
	
	<div class="container" style="align-content: center">
		<h2 class="text-secondary">REGISTRAZIONE</h2>
		<div class="row" style="align-content: center">
			<div class="col-12" style="align-content: center">
				
				
			<form name="form_registration" action="signUp_do.php" method="post"> <!--campi tabella utente da compilare-->
				<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-user fa-fw" aria-hidden="true"></i></span>
					Nome Utente: <input type="text" name="nomeUtente_reg"></div> <br/>
				
				<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-users fa-fw" aria-hidden="true"></i></span>
					Tipo Utente: 
					<select id="tipo" name="tipo">
						<option value="semplice">Semplice</option>
						
					</select></div> <br/>
				
				<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-key fa-fw" aria-hidden="true"></i></span>
					Password: <input type="password" name="password_reg" > </div> <br/>
				
				<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-envelope fa-fw" aria-hidden="true"></i></span>
					E-mail: <input type="text" name="email_reg" /> </div><br/>
				<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-birthday-cake fa-fw" aria-hidden="true"></i></span>
					Anno di Nascita: <input type="text" name="annoNascita_reg" /></div> <br/>
				
				<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-calendar fa-fw" aria-hidden="true"></i></span>
					Data registrazione:  <p name="dataReg" > <?php echo date("d/m/y") ?></p> </div><br/>
				
				<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-wrench fa-fw" aria-hidden="true"></i></span>
					Professione: <input type="text" name="professione_reg" /></div> <br/>
				<!---->
			
			<div class="form-group">
			<div class="row">
				<div class="col-12">
					<button onclick="" class="btn btn-success" >
						<i class="fa fa-user" aria-hidden="true"> REGISTRATI</i>
					</button>
				</div>
			</div>	
			</div>
</form>
		</div>
	</div>
	</div>
		
	
</body>
</html>
		
	

