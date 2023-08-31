<?php

session_start();

require_once 'connection.php';
$connection = newConnection();


function cloneEmail($email)
{
    $connection = newConnection();

    $status = 0;

    $sql = "SELECT email FROM user WHERE email = '" . $email . "'";

    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $status = 0;
    } else {
        $status = 1;
    }

    return $status;
}

if (count($_POST) > 0) {
    $dados = $_POST;

    $statusEmail = cloneEmail($dados['email']);

    if (!$statusEmail) {
        die('Erro: Email ja existente' . $connection->connect_error);
        // echo '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> This alert box could indicate a successful or positive action.</div>';
    } else {
        $dados = $_POST;

        require_once "connection.php";

        $sql = "INSERT INTO user (name, username, email, pass, points) VALUES (?, ?, ?, ?, 20)";

        $connection = newConnection();
        $stmt = $connection->prepare($sql);

        $params = [
            $dados['name'],
            $dados['username'],
            $dados['email'],
            $dados['pass']
        ];

        $stmt->bind_param("ssss", ...$params);

        if ($stmt->execute()) {
            unset($dados);
        }
    }
}

?>


<!doctype html>
<html lang="en">

<head>
    <title>Cadastro</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="photos/logo.png">
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>

<body class="css-body vw-100 vh-100 d-flex justify-content-center m-0" data-bs-theme=dark>
    <header class="css-header container-fluid rounded">
        <nav class="navbar w-100">
            <div class="container-fluid w-50">
                <a href="index.php" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img class="bi pe-none me-2 ms-2" src="photos/logo.png" alt="Home" width="40" height="40">
                    <span class="css-h1-size fs-4">KnowShare</span>
                </a>
            </div>
            <div class="d-flex justify-content-end container-fluid w-50">
                <a type="button" href="index.php" class="css-btn-white btn me-3">Voltar</a>
            </div>
        </nav>
    </header>

    <div class="vw-100 vh-100 d-flex justify-content-center align-items-center">
        <main class="css-index-main">
            <div class="w-100 h-100 px-3 py-4 pb-3 bg-dark rounded cadastro">
                <form action="#" method="post"><!-- <img class="mb-4" src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">s -->
                    <h1 class="h2 mb-4 fw-normal text-center">Cadastrar-se</h1>
                    <div class="form-floating my-2"><input type="text" class="form-control" placeholder="Name" name="name" required><label for="floatingInput">Name</label></div>
                    <div class="form-floating my-2"><input type="text" class="form-control" placeholder="Username" name="username" required><label for="floatingInput">Username</label></div>
                    <div class="form-floating my-2"><input type="email" class="form-control" placeholder="name@example.com" name="email" required><label for="floatingInput">Email</label></div>
                    <div class="input-group form-floating my-2"><input type="password" class="form-control password" id="loginPass" placeholder="Password" name="pass" require><label for="floatingPassword">Senha</label>
                        <button type="button" value="hide" class="btn btn-outline-light showPassword" data-bs-toggle="button">
                            <div class="olhinho"><svg xmlns="http://www.w3.org/2000/svg" width="clamp(0.15vh, 1.25vw, 10vh)" height="clamp(0.15vh, 1.25vw, 10vh)" fill="currentColor" class="bi bi-eye" viewBox="0 0 18 18">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                </svg></div>
                        </button>
                    </div><button class="css-btn-purple w-100 btn btn-outline-success my-2 mb-3 py-2" type="submit">Cadastrar</button>
                </form>
                <a href="login.php" type="button" class="css-btn-light logar w-100 btn btn-dark">Faça login</a>
                <p class="mt-4 mb-0 text-body-secondary text-center text-size-small">&copy; EnKrypto 2023</p>
            </div>
        </main>
    </div>


    <script src="js.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>