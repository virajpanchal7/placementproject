<? include_once("Functions/Import.php") ?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Register</title>
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- Bootstrap Core CSS -->
    <link href="Asset/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="Asset/css/style.css" rel='stylesheet' type='text/css' />
    <link href="Asset/css/font-awesome.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="Asset/js/jquery.min.js"></script>
    <!----webfonts--->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
    <!---//webfonts--->
    <!-- Bootstrap Core JavaScript -->
    <script src="Asset/js/bootstrap.min.js"></script>
    <script src="Asset/js/bootstrapValidator.js"></script>
    <?=loadResource("css","bootstrap-select.css") ?>
    <?=loadResource("js","bootstrap-select.js") ?>
	<style>
			.loginfm {
			padding-left: 135px;
		  margin: 15px 0 0;
		  color: #b3b3b3;
		  font-size: 50px;
		}
		.loginfm a {
		  color: #0000FF;
		  text-decoration: none;
        }
        .white-copy {
            color: white;
            text-align: center;
        }
	</style>

</head>
<body id="login">

<a class="login-logo" style="text-decoration:none" href="#"><h1>Placement Project</h1></a>

<h2 class="form-heading">Registration</h2>
<div class="app-cam">
    <?php $token = CreateFormToken(); ?>
    <form method="post" id="defaultForm" class="form-horizontal">
	
        <div class="form-group">
            <div class="col-sm-12">
                <input type="text" name="username" placeholder="Enter Username">
            </div>
        </div>
	
        <div class="form-group">
            <div class="col-sm-12">
                <input type="text" name="email" placeholder="Enter Email">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-12">
                <input type="password" name="pass" id="pass" placeholder="Enter Password">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-12">
                <input type="password" name="cpass" id="cpass" placeholder="Confirm Password">
            </div>
        </div>

        <input type="hidden" name="token" value="<?=$token?>"/>

        <!--<div class="submit"><input type="submit" class="btn btn-lg btn-primary btn-block" id="" data-dismiss="modal" value="Register"></div>-->
		
		<div class="submit"><button class="btn btn-lg btn-primary btn-block" type="submit" id="" data-dismiss="modal">Register</button></div>
		
        <div class="loginfm">
             <p><a href="Login.php">Login</a></p>
        </div>
		
    </form>
</div>
<div class="app-cam" id="status"></div>
</body>
</html>


<script type="text/javascript">
    $(document).ready(function() {

        var email = $('#email').val();

        $("#defaultForm").bootstrapValidator({
            live: 'enable',
            excluded: ':disabled',
            fields: {
				name: {
                    validators: {
                        notEmpty: {
                            message: 'Please Enter Name'
                        },
                        regexp: {
                            regexp: /^[A-z]+$/,
                            message: 'Name should only contain letters'
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'Email is required'
                        },
                        emailAddress: {
                            message: 'The input is not a valid email address'
                        },
                        remote: {
                            type: 'POST',
                            data: {email: email, validate: "email"},
                            url: 'Actions/validate.php',
                            message: 'Email is already registered, please try another',
                            delay: 3000
                        }
                    }
                },
                pass: {
                    validators: {
                        notEmpty: {
                            message: 'Please Enter Password'
                        },stringLength: {
                            min: 8,
                            max: 15,
                            message: 'Password length must be of 8-15'
                        }
                    }
                },
                cpass: {
                    validators: {
                        notEmpty: {
                            message: 'Please Enter Confirm Password'
                        },identical: {
                            field: 'pass',
                            message: 'The password and its confirm are not the same'
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
                url: "Actions/register.php",
                data: data,
                cache: false,
                success: function (response) {
                    console.log(response);
                    if (response.error === "true") {
                        $("#status").html("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Error</strong> Invalid Username or Password</div>").hide().fadeIn("slow").fadeTo(2000, 500).slideUp(500, function(){
                            $("#status").slideUp(500);
                            $("#pass").val("");
                        });
                    }
                    else {
                        $("#status").html("<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Success</strong> User Created Successfully</div>");
                        $(".app-cam").fadeIn("slow").fadeTo(2000, 500).slideUp(500, function(){
                            $(".app-cam").slideUp(500);
                            window.location.href = "home";
                        });

                    }
                }
            });
        });
    });
</script>