<?php

session_start();

require_once 'connection.php';
$connection = newConnection();

function trueLogin($email, $pass)
{
    $connection = newConnection();

    $status = 0;

    $email = addcslashes(addslashes($email), "%_");
    $pass = addcslashes(addslashes($pass), "%_");


    $sql = "SELECT idUser FROM user WHERE email = '" . $email . "' and pass = '" . $pass . "'";

    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $status = 1;
    } else {
        $status = 0;
    }

    $id = $result->fetch_assoc();
    $_SESSION["idUser"] = $id['idUser'];

    return $status;
}

if (count($_POST) > 0) {
    $dados = $_POST;

    $statusLogin = trueLogin($dados['email'], $dados['pass']);
    if (!$statusLogin) {
        die('Email ou senha não incorretos' . $connection->connect_error);
    } else {
        if (!empty($_POST["remember"])) {
            setcookie("email", $_POST["email"], time() + 3600);
            setcookie("email", $_POST["email"],);
            setcookie("pass", $_POST["pass"], time() + 3600);
        } else {
            setcookie("email", "");
            setcookie("pass", "");
        }
        $_SESSION['time'] = time();
        header("Location:base.php");

        die('Não ignore meu cabeçalho...');
    }
}

$connection->close();

?>


<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
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
                <a type="button" href="index.php" class="css-btn-white btn btn-outline-danger me-3">Voltar</a>
            </div>
        </nav>
    </header>

    <div class="vw-100 vh-100 d-flex justify-content-center align-items-center">
        <main class="css-index-main">
            <div class="w-100 h-100 px-3 py-4 pb-3 bg-dark rounded login">
                <form action="#" method="post"><!-- <img class="mb-4" src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">s -->
                    <h1 class="h2 mb-4 fw-normal text-center">Entrar</h1>
                    <div class="form-floating my-2"><input type="email" class="form-control" id="loginEmail" placeholder="name@example.com" name="email" value="<?php if (isset($_COOKIE["email"])) {
                                                                                                                                                                    echo $_COOKIE["email"];
                                                                                                                                                                } ?>" required><label for="floatingInput">Email</label></div>
                    <div class="input-group form-floating my-2"><input type="password" class="form-control password" id="loginPass" placeholder="Password" name="pass" value="<?php if (isset($_COOKIE["pass"])) {
                                                                                                                                                                                    echo $_COOKIE["pass"];
                                                                                                                                                                                } ?>" require><label for="floatingPassword">Senha</label>
                        <button type="button" value="hide" class="btn btn-outline-light showPassword" data-bs-toggle="button">
                            <div class="olhinho"><svg xmlns="http://www.w3.org/2000/svg" width="clamp(0.15vh, 1.25vw, 10vh)" height="clamp(0.15vh, 1.25vw, 10vh)" fill="currentColor" class="bi bi-eye" viewBox="0 0 18 18">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                </svg></div>
                        </button>
                    </div>
                    <div class="checkbox mt-2 mb-3"><label><input type="checkbox" value="remember" name="remember"> Lembre-me</label></div>
                    <button class="css-btn-purple w-100 btn btn-outline-success my-2 mb-3 py-2" type="submit">Entrar</button>
                </form>
                <a href="cadastro.php" type="button" class="css-btn-light cadastrar w-100 btn btn-dark">Cadastrar-se</a>
                <p class="mt-4 mb-0 text-body-secondary text-center text-size-small">&copy; EnKrypto 2023</p>
            </div>
        </main>
    </div>



    <script src="js.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>