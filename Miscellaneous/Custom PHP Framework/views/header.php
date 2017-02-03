<!DOCTYPE>
<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
		<link href="/assets/css/main.css" rel="stylesheet" type="text/css">
	</head>
	<body>

	<nav class="navbar">
		<div class="container">
			<ul class="nav navbar-nav">
				<?php 

					foreach($data as $x) { 
						echo '<li <?=><a href="' . $x[1] . '">' . $x[0] . '</a></li>';
					}

				?>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<?if (@$_SESSION["loggedIn"] && @$_SESSION["loggedIn"] == 1) {?>
		    		<li><a href="/Profile">Profile</a></li>
		    		<li><a id="logout" href="/Auth/logout">Logout</a></li>
		    	<? } else { ?>
		    		<li><a class="btn pull-right" id="login" data-toggle="modal" data-target="#loginModal">Login</a></li>
		    	<? } ?>
			</ul>
		</div>
	</nav>

	<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <h4 class="modal-title" id="loginModalLabel">Login</h4>
	      </div>
	      <div class="modal-body">
	    	<form action="/Auth/login" method="POST">
	    		<input id="log-1" name="name" type="text" placeholder="Enter email..."><br>
	    		<input id="log-2" name="password" type="password" placeholder="Enter password..."><br>
	    		<button id="log-4" type="submit" class="btn">Login</button>
	    	</form>
	      </div>
	    </div>
	  </div>
	</div>