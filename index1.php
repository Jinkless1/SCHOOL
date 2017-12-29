<?php
session_start();
require_once('connect.php');
if(isset($_POST) & !empty($_POST)){
	$password = mysqli_real_escape_string($connection, $_POST['password']);
	
	$sql = "SELECT * FROM `me` WHERE password='$password'";
	$result = mysqli_query($connection, $sql);
	$count = mysqli_num_rows($result);
	if($count == 1){
		$_SESSION['password'] = $password;
	}else{
		$fmsg = "Invalid pin";
	}
}
if(isset($_SESSION['password'])){
	 header("Location: member1.php");
}


?>
<!DOCTYPE html>
<html >
<head>
 <style>
form { 
margin: 0 auto; 
width:250px;
}
@import url(https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300);
* {
  font-family: 'Open Sans Condensed', sans-serif;
  color: #464646;
  -webkit-transition: all 1.9s linear;
  transition: all 1.5s linear;
  overflow: hidden !important;
  box-sizing: border-box;
}

.container {
  width: 100%;
  height: 100%;
}
.container .bg-img {
  position: fixed;
  top: -50%;
  center: -50%;
  width: 200%;
  height: 200%;
  opacity: 0;
  -webkit-filter: blur(5px);
          filter: blur(5px);
  -webkit-transform: scale(1.5);
          transform: scale(1.5);
}
.container .bg-img img {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  margin: auto;
  min-width: 50%;
  min-height: 50%;
}

.header {
  position: absolute;
  width: 100%;
  height: 100%;
  background-color: #464646;
  display: table;
  text-align: center;
  color: #e2e8e7;
  z-index: 10;
}
.header h1 {
  display: table-cell;
  text-align: center;
  vertical-align: middle;
  font-size: 72px;
  z-index: 2;
  position: relative;
  color: #E2E8E7;
}

.main {
  position: absolute;
  width: 100%;
  height: 100%;
}
.main .login {
  position: absolute;
  background: #fff;
  height: 260px;
  width: 300px;
  bottom: -520px;
  left: 50%;
  margin-left: -150px;
  box-shadow: 0 0 20px 2px #464646;
  z-index: 2;
}
.main .register {
  position: absolute;
  background: #fff;
  height: 440px;
  width: 300px;
  bottom: -880px;
  left: 50%;
  margin-left: -150px;
  box-shadow: 0 0 20px 2px #464646;
  z-index: 2;
}

.form-toggle {
  float: right;
  color: #00B3A0;
  font-size: 14px;
  line-height: 24px;
}

.form-toggle:hover {
  cursor: pointer;
}

.footer {
  position: absolute;
  top: 100%;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #e2e8e7;
}
.footer .footer-nav {
  list-style: none;
  width: 100%;
  height: 20%;
  position: relative;
  margin: 0;
  padding: 0;
  margin-top: 100px;
  text-align: center;
}
.footer .footer-nav .link {
  width: 25%;
  float: left;
  border-left: 1px solid #666666;
  border-right: 1px solid #464646;
}
.footer .footer-nav .link:first-child {
  border-left-width: 0;
}
.footer .footer-nav .link:last-child {
  border-right-width: 0;
}

.disclaimer {
  font-size: 12px;
  text-align: center;
  width: 80%;
  margin: 12px auto;
  padding: 12px;
}

.container.loaded .loading {
  display: none;
}
.container.loaded .bg-img {
  opacity: 1;
  -webkit-filter: blur(0);
          filter: blur(0);
  -webkit-transform: scale(1);
          transform: scale(1);
}
.container.loaded .header {
  height: 40px;
  background-color: #00b3a0;
  box-shadow: 0 0 20px 2px #464646;
}
.container.loaded .header h1 {
  font-size: 24px;
}
.container.loaded .main .login {
  bottom: calc(25% - 50px);
}
.container.loaded .footer {
  top: 75%;
}

.register {
  -webkit-transition: all .5s linear;
  transition: all .5s linear;
}

.container.loaded.show-register .login {
  box-shadow: 0 0 0 0 transparent;
}
.container.loaded.show-register .register {
  bottom: calc(25% - 50px);
}

form {
  padding: 12px 24px 24px;
}

input {
  margin: 12px 0;
  background-color: white;
  background-image: none;
  border: 0px dotted #cccccc;
  border-bottom-width: 2px;
  border-radius: 0;
  box-shadow: 0 0 0 transparent inset;
  color: #cccccc;
  display: block;
  font-size: 1.5em;
  height: 2.0em;
  line-height: 1.5;
  padding: 0 12px;
  -webkit-transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
  transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
  vertical-align: middle;
  width: 150%;
}

button {
  float: right;
  font-size: 1.5em;
  height: 2.0em;
  line-height: 1.5;
  margin: 12px 0;
  padding: 0;
  background-color: #00b3a0;
  color: #e2e8e7;
  border: 0 none transparent;
  width: 150%;
  text-align: center;
}

.loading {
  width: 150px;
  height: 150px;
  position: absolute;
  top: 50%;
  left: 50%;
  margin-top: -75px;
  margin-left: -75px;
}

.loading .block {
  width: 40px;
  height: 40px;
  /*border:5px solid #fff;*/
  position: absolute;
}
input.MyButton {
width: 300px;
padding: 20px;
cursor: pointer;
font-weight: bold;
font-size: 150%;
background: #3366cc;
color: #fff;
border: 1px solid #3366cc;
border-radius: 10px;
-moz-box-shadow:: 6px 6px 5px #999;
-webkit-box-shadow:: 6px 6px 5px #999;
box-shadow:: 6px 6px 5px #999;
}
input.MyButton:hover {
color: #ffff00;
background: #000;
border: 1px solid #fff;
}

.loading .block:nth-child(1) {
  -webkit-animation: top-left 3s infinite;
          animation: top-left 3s infinite;
  background-color: #00aacf;
}

.loading .block:nth-child(2) {
  -webkit-animation: top-right 3s infinite;
          animation: top-right 3s infinite;
  background-color: #f6c574;
}

.loading .block:nth-child(3) {
  -webkit-animation: bottom-left 3s infinite;
          animation: bottom-left 3s infinite;
  background-color: #fc5652;
}

.loading .block:nth-child(4) {
  -webkit-animation: bottom-right 3s infinite;
          animation: bottom-right 3s infinite;
  background-color: #00b3a0;
}

@-webkit-keyframes top-left {
  0% {
    left: 25px;
    top: 25px;
  }
  25% {
    left: 75px;
    top: 25px;
    -webkit-transform: rotate(90deg);
            transform: rotate(90deg);
  }
  50% {
    left: 75px;
    top: 75px;
    -webkit-transform: rotate(180deg);
            transform: rotate(180deg);
  }
  75% {
    left: 25px;
    top: 75px;
    -webkit-transform: rotate(270deg);
            transform: rotate(270deg);
  }
  100% {
    left: 25px;
    top: 25px;
    -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
  }
}
@-webkit-keyframes top-right {
  0% {
    left: 75px;
    top: 25px;
  }
  25% {
    left: 75px;
    top: 75px;
  }
  50% {
    left: 25px;
    top: 75px;
  }
  75% {
    left: 25px;
    top: 25px;
  }
  100% {
    left: 75px;
    top: 25px;
  }
}
@-webkit-keyframes bottom-left {
  0% {
    left: 75px;
    top: 75px;
  }
  25% {
    left: 25px;
    top: 75px;
    -webkit-transform: rotate(90deg);
            transform: rotate(90deg);
  }
  50% {
    left: 25px;
    top: 25px;
    -webkit-transform: rotate(180deg);
            transform: rotate(180deg);
  }
  75% {
    left: 75px;
    top: 25px;
    -webkit-transform: rotate(270deg);
            transform: rotate(270deg);
  }
  100% {
    left: 75px;
    top: 75px;
    -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
  }
}
@-webkit-keyframes bottom-right {
  0% {
    left: 25px;
    top: 75px;
  }
  25% {
    left: 25px;
    top: 25px;
  }
  50% {
    left: 75px;
    top: 25px;
  }
  75% {
    left: 75px;
    top: 75px;
  }
  100% {
    left: 25px;
    top: 75px;
  }
}



 </style>
</head>
<body>

<a class="btn btn-lg btn-primary btn-block" href="http://george.unaux.com/web/index.html">GOTO - HOME</a> <input class="MyButton" type="button" value="I DON'T HAVE PIN" onclick="window.location.href='http://ERROR.PHP'" />
	
</head>
<body>
<div class="container">
      <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
      <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
      <form action="index1.php" method="post">
        <h2 class="form-signin-heading">STEP 1 ENTER PIN</h2>
        <div class="input-group">
		  <span class="input-group-addon" id="basic-addon1">.</span>
		  <label for="inputPassword" class="sr-only">HELLO</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="ENTER PIN HERE" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">NEXT</button>
      </form>
</div>
</body>
</html>
