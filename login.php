<?php 
	
	session_start();
	include("header.php");

?>

<style type="text/css">
    body {
        color: #999;
		background: #f5f5f5;
		font-family: 'Varela Round', sans-serif;
	}
	.form-control {
		box-shadow: none;
		border-color: #ddd;
	}
	.form-control:focus {
		border-color: #4aba70; 
	}
	.login-form {
		position: absolute;
	    top: 15%;
	    left: 0;
	    right: 0;
        width: 350px;
		margin: 0 auto;
		padding: 30px 0;
	}
    .login-form form {
        color: #434343;
		border-radius: 1px;
    	margin-bottom: 15px;
        background: #fff;
		border: 1px solid #f3f3f3;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
	}
	.login-form h4 {
		text-align: center;
		font-size: 22px;
        margin-bottom: 20px;
	}
    .login-form .avatar {
        color: #fff;
		margin: 0 auto 30px;
        text-align: center;
		width: 100px;
		height: 100px;
		border-radius: 50%;
		z-index: 9;
		background: #4aba70;
		padding: 15px;
		box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
	}
    .login-form .avatar i {
        font-size: 62px;
    }
    .login-form .form-group {
        margin-bottom: 20px;
    }
	.login-form .form-control, .login-form .btn {
		min-height: 40px;
		border-radius: 2px; 
        transition: all 0.5s;
	}
	.login-form .close {
        position: absolute;
		top: 15px;
		right: 15px;
	}
	.login-form .btn {
		background: #4aba70;
		border: none;
		line-height: normal;
	}
	.login-form .btn:hover, .login-form .btn:focus {
		background: #42ae68;
	}
    .login-form .checkbox-inline {
        float: left;
    }
    .login-form input[type="checkbox"] {
        margin-top: 2px;
    }
    .login-form .forgot-link {
        float: right;
    }
    .login-form .small {
        font-size: 13px;
    }
    .login-form a {
        color: #4aba70;
    }
</style>


<div class="login-form">    
    <form action="verify_login_register.php" method="post">

		<div class="avatar"><i class="fa fa-medkit fa-4x" aria-hidden="true"></i></div>
    	<h4 class="modal-title">Autentikohuni ne sistem</h4>

        <div class="form-group">
            <input type="text" class="form-control" id="username" name="username" placeholder="emri i perdoruesit" required="required" autocomplete="off" autofocus />
        </div>

        <div class="form-group">
            <input type="password" class="form-control" id="passwordi" name="passwordi" placeholder="fjalekalimi" required="required" autocomplete="off" autofocus />
        </div>

        <button class="btn btn-custom-primary btn-lg btn-block" name="user_login" id="user_login"><i class="fa fa-arrow-circle-o-right"></i> Autentikohu</button>

    </form>			
    <div class="text-center small">Nese nuk ke nje llogari? <a href="register.php">Regjistrohu</a></div>
</div>

