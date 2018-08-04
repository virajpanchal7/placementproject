<?php include_once "Functions/Import.php";

if(isset($_SESSION["name"]))
{
    header("Location: home");
}

?>
<? include_once("Functions/Import.php") ?>
<!DOCTYPE HTML>
<html>
<head>

    <title>Login | Placement Project</title>
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- Bootstrap Core CSS -->
    <link href="Asset/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="Asset/css/style.css" rel='stylesheet' type='text/css' />
    <link href="Asset/css/font-awesome.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="Asset/js/jquery.min.js"></script>
    <script src="Asset/js/bootstrap.min.js" type="text/javascript"></script>

    <script src="Asset/js/bootstrap.min.js"></script>
    <!----webfonts--->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
    <!---//webfonts--->
    <!-- Bootstrap Core JavaScript -->
    <script src="Asset/js/bootstrap.min.js"></script>
    <script src="Asset/js/bootstrapValidator.js"></script>
    <style>
        .reg
        {
            padding-top: 30px;
            margin-left: 165px;
        }
        .message {
			padding-left: 35px;
			margin: 15px 0 0;
			color: #b3b3b3;
			font-size: 12px;
		}
		.fpass {
			padding-left: 100px;
			margin: 15px 0 0;
			color: #b3b3b3;
			font-size: 12px;
		}
		.fpass a {
			color: #0000FF;
			text-decoration: none;
		}
		.message a {
			color: #0000FF;
			text-decoration: none;
		}
		.login-logoo {
			font-family:Courier; 
			color:Red; 
			font-size: 20px;
			margin: 0;
			text-align: center;
		}
		.white-copy {
			color: white;
			text-align: center;
			padding-top:250px;
		}
    </style>
</head>

<body id="login">

    <a class="login-logo" style="text-decoration:none" href="#"><h1>Placement Project</h1></a>

<h2 class="form-heading">login</h2>
<div class="app-cam">
    <?php $token = CreateFormToken(); ?>

    <form method="post" id="defaultForm" class="form-horizontal">
        <div class="form-group">
            <div class="col-sm-12">
                <input type="text" name="email" placeholder="Enter Email">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-12">
                <input type="password" name="pass" placeholder="Enter Password">
            </div>
        </div>

        <input type="hidden" name="token" value="<?=$token?>"/>

        <!--<div class="submit"><input type="submit" class="btn btn-default" id="" data-dismiss="modal" name="submit" value="Login">-->
		<div class="submit"><button class="btn btn-lg btn-primary btn-block" type="submit" id="" data-dismiss="modal">Login</button></div>
		
        <div class="message">
             <p>Not registered? <a href="Register.php">Create an account</a></p>
			 <p>Record Screen? <a href="video.html">Record</a></p>
        </div>
    </form>
</div>
<div class="app-cam" id="status"></div>
</body>
</html>


<script type="text/javascript">
    $(document).ready(function() {
        $("#defaultForm").bootstrapValidator({
            live: 'enable',
            fields: {
                username: {
                    validators: {
                        notEmpty: {
                            message: 'Please Enter Username'
                        }
                    }
                },
                pass: {
                    validators: {
                        notEmpty: {
                            message: 'Please Enter Password'
                        }
                    }
                }
            }
        }).on('success.form.bv', function (e) {
            e.preventDefault();
            var $form = $(e.target),
                validator = $form.data('bootstrapValidator');
            var data = $form.serialize();
            $.ajax({
                type: "POST",
                url: "Actions/login.php",
                data: data,
                cache: false,
                success: function (response) {
                    console.log(response.tc);
                    if(response.tc == "0") {

                        $("#large").modal().show();

                    }
                    if (response.error === "true") {
                     $("#status").html("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Error</strong> Invalid Email or Password</div>").hide().fadeIn("slow").fadeTo(2000, 500).slideUp(500, function(){
                     $("#status").slideUp(500);
                     $('#defaultForm').data('bootstrapValidator').resetForm(true);
                     });
                     }
                     else {
                     $("#status").html("<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Success</strong> Logged In Successfully</div>").hide().fadeIn("slow").fadeTo(2000, 500).slideUp(500, function(){
                     $("#status").slideUp(500);

                        window.location.href = "home";
                     });

                     }
                }
            });
        });
    });
</script>