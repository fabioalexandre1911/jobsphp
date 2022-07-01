<?php

  # Incluindo os arquivos necessários
  include_once 'model/config.php';
  include_once 'model/class/User.class.php';
  include_once 'controller/validate.php';
  include_once 'model/dictionary.php';

  # Startando a sessão
  session_start();

  # Teste de Existencia de Sessão
  if(isset($_SESSION[md5("user_data")])){
    # Guardando os dados da sessão no objeto
    $user = $_SESSION[md5("user_data")];

    # Redirecionando pra página
    header("location: $project_index/".$user->profile_page.".php");
  }

?><!DOCTYPE html>
<html lang="en">
<head>
<title>Login de Acesso</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="PowerClinic - CE">
<meta name="description" content="">

<!-- CSS datepicker -->
<link rel="stylesheet" href="view/assets/bootstrap/css/datepicker.css" />

<!-- Link do Favicon -->
<link rel="shortcut icon" href="" type="image/x-icon">

<!-- Bootstrap core CSS -->
<link href="view/assets/bootstrap/css/bootstrap.css" rel="stylesheet">

<!-- Estilos personalizados para este modelo -->
<link href="view/assets/bootstrap/css/dashboard.css" rel="stylesheet">
<link rel="stylesheet" href="view/assets/bootstrap/css/jquery.bootgrid.min.css">
<link href="view/assets/bootstrap/css/jquery-ui-1.10.4.custom.css" rel="stylesheet">
<link href="view/assets/bootstrap/css/style.php" media="screen" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="view/assets/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="view/assets/bootstrap/css/waiting.css" />
<link rel="stylesheet" type="text/css" href="view/assets/bootstrap/css/style.css" />

<!-- <link rel="stylesheet" type="text/css" href="css/login.css" /> -->

</head>
<body>
<!--style>
        body{
            background-image: url('https://www.helpebs.com.br/assets/images/background/bg-1.jpg') !important;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: left top;
            background-size: cover;
        }
    </style-->
<div class="bg-topo">
  <div class="container">
    <div class="row rowDivTopo">
      <div class="bg-topo-menu"> <a href="#"> <img src="https://www.helpebs.com.br/university/logos/logo.png" /></a> &nbsp; </div>
    </div>
  </div>
  <div class="bg-linha-amarela"> </div>
</div>

<!-- TOPO
    ================================================== --> 
<!-- CONTAINER
            ================================================== -->
<div class="container">
  <div class="row">
    <div class="account-wall">
      <div class="foto-box"> <i class="fa fa-user-o"></i> </div>
      <div class=" bloco-login">
        <div class="bg-titulo">
          <h1>Login de Acesso</h1>
          <!--<h3>Fazer Login para prosseguir com para XXXXX </h3>--> 
        </div>
        <form action="controller/login.php" method="POST" class="form-signin">
          <div class="divCamposLogin">
            <div class="form-group">
              <label class="control-label erro"></label>
              <input type="text" name="email" placeholder="Email" class="form-control campo-inpt bloco-login-icon" id="email" value="">
            </div>
            <div class="form-group">
              <label class="control-label erro"></label>
              <input type="password" name="password"  placeholder="Senha" class="form-control campo-inpt bloco-pass-icon" id="senha">
            </div>
          </div>
          <div style="display: none;" class="alert"></div>
          
          <!--RADIO BOX-->
          <div class="row">
            <div class="col-md-6 bloco-radio-bottom ">
              <input type="checkbox" id="checklembreme" name="checklembreme"  value="lembreme">
              <label class="checkbox"> Lembrar o meu Email </label>
            </div>
            <div class="col-md-6 pull-right">
              <button type="submit" class="btn btn-lg btn-primary btn-block botao-orange" id="btEntrar">Entrar</button>
            </div>
          </div>
        </form>
        <!--div class="bloco-text-senha centralizar total"> <a id="linkEsqueceuSenha" class="need-help " href="#">Esqueci minha Senha </a> </div-->
        <div class="clearfix"> </div>
      </div>
      <div class="bloco-btn-amarelo-cadas "> &nbsp; </div>
    </div>
  </div>
  <div class="modal fade" id="modalSucesso">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Sucesso</h4>
        </div>
        <div class="modal-body">
          <div class="alert alert-success"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
        </div>
      </div>
      <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
  </div>
  <!-- /.modal -->
  <div class="modal fade" id="modalErro">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Erro</h4>
        </div>
        <div class="modal-body">
          <div class="alert alert-danger"></div>
        </div>
        <div class="modal-footer">
          <button type="button" id="btFechaErro" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
  </div>
  <!-- /.modal -->
  <div id="modalEscolherEmpresaLogin" class="modal fade"> </div>
</div>
<footer class="footer">
  <div class="linha-bottom"></div>
  <div class="container">
    <div class="row rowDivTopo">
      <div class="bg-bottom-menu pull-right"> <a target="_blank" href="http://www.helpebs.com.br" target="_blank" style="color: #000">By HelpEbs 2022</a> </div>
    </div>
  </div>
</footer>
</body>
</html>

<!-- Colocado no final do documento para que as páginas sejam carregadas mais rapidamente -->
<script src="view/assets/bootstrap/js/jquery-1.11.1.min.js"></script>
<script src="view/assets/bootstrap/js/ie-emulation-modes-warning.js"></script>

<!-- Font -->
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
<!-- ==================================================================================================================== -->
<script src="view/assets/bootstrap/js/css3-mediaqueries.js"></script>
<script src="view/assets/bootstrap/util.js?v=693.03"></script>
<script src="view/assets/bootstrap/js/jquery.placeholder.min.js"></script>
<script src="view/assets/bootstrap/js/jquery.waiting.js"></script>