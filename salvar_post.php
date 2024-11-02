<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blogsegurancainformaca";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}


$title = $_POST['title'];
$content = $_POST['content'];
$link = $_POST['link'];
$imagePath = null;


if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    
    $imagePath = $uploadDir . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
}


$sql = "INSERT INTO posts (title, content, link, image_path) VALUES ('$title', '$content', '$link', '$imagePath')";

if ($conn->query($sql) === TRUE) {
    echo "<div class='success-message'>";
    echo "<p>Novo post adicionado com sucesso!</p>";
    echo "<a class='btn-a' href='posts.php' class='back-link'>Voltar para a página inicial</a>";
    echo "</div>";
} else {
    echo "Erro ao adicionar o post: " . $conn->error;
}


$conn->close();
?>

<style>
    .success-message {
        padding: 10px;
        text-align: center; /* Centraliza o conteúdo */
    }
    .menu-container {
        max-width: 600px; /* Define a largura máxima do container para melhor visibilidade em celulares */
        margin: 0 auto; /* Centraliza o container */
    }
    .menu {
        display: inline-block; /* Faz o menu se comportar como um bloco inline */
        text-align: center; /* Centraliza o menu */
    }
    .menu-list {
        list-style: none; /* Remove a formatação de lista */
        padding: 0; /* Remove o padding */
        margin: 0; /* Remove o margin */
    }
    .menu-item {
        display: inline-block; /* Faz os itens do menu se comportarem como blocos inline */
        margin-right: 20px; /* Adiciona espaçamento entre os itens do menu */
    }
    a {
        text-decoration: none; /* Remove a sublinhado dos links */
        color: #0d6efd; /* Define a cor dos links */
        font-weight: bold; /* Deixa os links em negrito */
    }
    /* Estiliza os links para serem compatíveis com celular e PC */
    @media (max-width: 600px) {
        a {
            font-size: 1.2rem; /* Aumenta o tamanho da fonte para melhor visibilidade em celulares */
        }
        .menu-item {
            margin-right: 10px; /* Reduz o espaçamento entre os itens do menu em celulares */
        }
    }
    @media (min-width: 601px) {
        a {
            font-size: 1rem; /* Reduz o tamanho da fonte para melhor visibilidade em PCs */
        }
    }
</style>
