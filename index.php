<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>AdminLTE 3 | Log in (v2)</title>

    <!-- Google Font: Source Sans Pro -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
    />
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="./assets/plugins/fontawesome-free/css/all.min.css"
    />
    <!-- icheck bootstrap -->
    <link
      rel="stylesheet"
      href="./assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css"
    />
    <!-- Theme style -->
    <link rel="stylesheet" href="./assets/css/adminlte.min.css" />
  </head>

  <body class="hold-transition login-page">
    <div class="login-box">
      <!-- /.login-logo -->
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <a href="../../index2.html" class="h2"><b>STAFF</b>Attendance</a>
        </div>
        <div class="card-body">
          <p class="login-box-msg">Sign in to start your session</p>

          <form id="loginForm" action="#" method="post" class="form-vertical">
            <div class="input-group mb-3">
              <input
                type="email"
                id="email"
                class="form-control"
                placeholder="Email"
              />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input
                type="password"
                id="password"
                class="form-control"
                placeholder="Password"
              />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">
                  Sign In
                </button>
              </div>
              <!-- /.col -->
            </div>
          </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="./assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="./assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="./assets/js/adminlte.min.js"></script>

    <script>
      $("#loginForm").submit(function (event) {
        event.preventDefault();
        var email = $("#email").val();
        var password = $("#password").val();
        $.ajax({
          url: "login.php",
          method: "POST",
          data: {
            email: email,
            password: password,
            login: "login",
          },
          success: function (response) {
            var res = JSON.parse(response);
            if (res.status == "success") {
              window.location.href = "dashboard.php";
            } else {
              alert(res.message);
            }
          },
          error: function () {
            alert("Oops something went wrong. Please try again");
          },
        });
      });
    </script>
  </body>
</html>
