


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Dashboard</title>
  <link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/id/thumb/3/35/Lambang-UMKU.png/250px-Lambang-UMKU.png" type="png/images">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">

      <!-- Tabs -->
      <ul class="nav nav-tabs mb-4" id="formTabs" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login"
                  type="button" role="tab" aria-controls="login" aria-selected="true">Login</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register"
                  type="button" role="tab" aria-controls="register" aria-selected="false">Daftar</button>
        </li>
      </ul>

      <!-- Forms -->
      <div class="tab-content" id="formTabsContent">
        <!-- Login Form -->
        <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
          <div class="card p-4 shadow-sm">
            <h3 class="mb-3">Login</h3>
            <form action="verifLogin.php" method="POST">
              <div class="mb-3">
                <label for="loginEmail" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="loginEmail" placeholder="Masukan Email">
              </div>
              <div class="mb-3">
                <label for="loginPassword" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="loginPassword" placeholder="Masukkan Password">
              </div>
              <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
          </div>
        </div>

        <!-- Register Form -->
        <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
          <div class="card p-4 shadow-sm">
            <h3 class="mb-3">Daftar</h3>
            <form action="verifRegister.php" method="POST">
              <div class="mb-3">
                <label for="registerName" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="registerName" placeholder="Masukkan Username">
              </div>
              <div class="mb-3">
                <label for="registerEmail" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="registerEmail" placeholder="Masukkan email">
              </div>
              <div class="mb-3">
                <label for="registerPassword" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="registerPassword" placeholder="Masukkan Password">
              </div>
              <button type="submit" class="btn btn-success w-100">Register</button>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
