<?php
session_start();
include('./db_connect.php');

if (isset($_SESSION['login_id'])) {
    header("location:index.php?page=home");
}

include 'header.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bootstrap Simple Login Form with Blue Background</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <style>
        body {
            color: #fff;
            background: #37517E;
        }

        .form-control {
            min-height: 41px;
            background: #f2f2f2;
            box-shadow: none !important;
            border: transparent;
        }

        .form-control:focus {
            background: #e2e2e2;
        }

        .form-control, .btn {
            border-radius: 2px;
        }

        .login-form {
            width: 350px;
            margin: 30px auto;
            text-align: center;
        }

        .login-form h2 {
            margin: 10px 0 25px;
        }

        .login-form form {
            color: #7a7a7a;
            border-radius: 3px;
            margin-bottom: 15px;
            background: #fff;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }

        .login-form .btn {
            font-size: 16px;
            font-weight: bold;
            background: #3598dc;
            border: none;
            outline: none !important;
        }

        .login-form .btn:hover, .login-form .btn:focus {
            background: #2389cd;
        }

        .login-form a {
            color: #fff;
            text-decoration: underline;
        }

        .login-form a:hover {
            text-decoration: none;
        }

        .login-form form a {
            color: #7a7a7a;
            text-decoration: none;
        }

        .login-form form a:hover {
            text-decoration: underline;
        }
    </style>
</head>


<body>
<div class="login-form">

    <form action="" id="login-form">
        <h2 class="text-center">Login</h2>
        <div class="form-group has-error">
            <input type="text" class="form-control" name="email" placeholder="Username" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required="required">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
        </div>

    </form>

</div>

<!-- /.login-box -->
<script>
    $(document).ready(function () {
        $('#login-form').submit(function (e) {
            e.preventDefault()
            start_load()
            if ($(this).find('.alert-danger').length > 0)
                $(this).find('.alert-danger').remove();
            $.ajax({
                url: 'ajax.php?action=login',
                method: 'POST',
                data: $(this).serialize(),
                error: err => {
                    console.log(err)
                    end_load();

                },
                success: function (resp) {
                    if (resp == 1) {
                        location.href = 'index.php?page=home';
                    } else {
                        $('#login-form').prepend('<div class="alert alert-danger">Email ou mot de passe est incorrect.</div>')
                        end_load();
                    }
                }
            })
        })
    })
</script>
<?php include 'footer.php' ?>
</body>
</html>
