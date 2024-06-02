<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Login</title>
    <style>
        .login-title {
            color: green;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .input-group-text {
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="container justify-content-center">
    <div class="row justify-content-center">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h4 class="mt-3 login-title">LOGIN</h4>
                </div>
                <div class="card-body">
                    <form name="logForm" method="post" action="?open=Login-Validasi">
                        <div class="form-group">
                            <label for="txtUser">Pengguna</label>
                            <input name="txtUser" type="text" class="form-control" id="txtUser" maxlength="25">
                        </div>
                        <div class="form-group">
                            <label for="txtPassword">Kata Sandi</label>
                            <div class="input-group">
                                <input name="txtPassword" type="password" class="form-control" id="txtPassword" maxlength="25">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="togglePassword">
                                        <i class="fas fa-eye" id="eyeIcon"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" name="btnLogin" class="btn btn-primary">Login</button>
                            <br>       
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('txtPassword');
        const eyeIcon = document.getElementById('eyeIcon');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        } else {
            passwordField.type = 'password';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        }
    });
</script>
</body>
</html>
