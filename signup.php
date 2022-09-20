
<!DOCTYPE html>
<html>
	<head>
		<?php include('header.php') ?>
        <?php 
        session_start();
        if(isset($_SESSION['login_id'])){
            header('Location:home.php');
        }
        ?>
		<title>Login | Simple Online Quiz System</title>
	</head>

	<body id='login-body' class="bg-light">
		<div class="card col-md-4 offset-md-4 mt-4">
                <div class="card-header-edge text-white">
                    <strong>Signup as Student</strong>
                </div>
            <div class="card-body">
                     <form id="login-frm">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="name" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="username" name="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                            <input type="hidden" name="user_type" value="3" class="form-control">
                            <input type="hidden" name="level_section" value="0" class="form-control">
                        </div> 
                        <div class="form-group text-right">
                            <button class="btn btn-primary btn-block" name="submit">Sign Up</button>
                        </div>
                        
                    </form>
                    <button class="btn btn-info btn-block" id="signup-frm" name="submit">Back to login</button>
            </div>
        </div>

		</body>

        <script>
            $(document).ready(function(){
                $('#signup-frm').click(function(e){
                    location.replace('login.php')
                });
                $('#login-frm').submit(function(e){
                    e.preventDefault()
                    $('#login-frm button').attr('disable',true)
                    $('#login-frm button').html('Please wait...')

                    $.ajax({
                        url:'./save_student.php',
                        method:'POST',
                        data:$(this).serialize(),
                        error:err=>{
                            console.log(err)
                            alert('An error occured');
                            $('#login-frm button').removeAttr('disable')
                            $('#login-frm button').html('Sign Up')
                        },
                        success:function(resp){
                            if(resp == 1){
                                alert("User signed up successfully !!. Please login")
                                location.replace('home.php')
                            }else{
                                alert("User already exists.")
                                $('#login-frm button').removeAttr('disable')
                                $('#login-frm button').html('Sign Up')
                            }
                        }
                    })

                })
            })
        </script>
</html>