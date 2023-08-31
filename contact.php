<?php
require_once 'connection.php';

$connection = newConnection();

$sql = "SELECT * FROM contact";

$result = $connection->query($sql);

$records = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $records[] = $row;
    }
} else {
    echo $connection->error;
}

$connection->close();

if (count($_POST) > 0) {
    $dados = $_POST;

    require_once "connection.php";

    $sql = "INSERT INTO contact (name, email, message) VALUES (?, ?, ?)";

    $connection = newConnection();
    $stmt = $connection->prepare($sql);

    $params = [
        $dados['name'],
        $dados['email'],
        $dados['message']
    ];

    $stmt->bind_param("sss", ...$params);

    if ($stmt->execute()) {
        unset($dados);
        $sql = "SELECT * FROM contact";

        $result = $connection->query($sql);

        $records = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $records[] = $row;
            }
        } else {
            echo $connection->error;
        }
    }
}

?>

<div class="d-flex flex-column rounded text-break h-auto w-100">
    <div class="d-flex justify-content-center mt-3 mb-4">
        <h1>Contato</h1>
    </div>
    <form class="w-100" action="#" method="post">
        <span class="css-text-size text-dark" for="name">Nome Completo</span>
        <input class="form-control text-bg-light border-0 mb-3" name="name" type="text">
        <span class="css-text-size text-dark" for="name">Email</span>
        <input class="form-control text-bg-light border-0 mb-3" name="email" type="text">
        <span class="css-text-size text-dark" for="message">Mensagem</span>
        <textarea class="form-control text-bg-light border-0 mb-3" name="message" id="" cols="30" rows="10"></textarea>
        <div class="d-flex justify-content-end">
        <button class="css-btn-purple btn" type="submit">Enviar</button>
        </div>
    </form>
</div>