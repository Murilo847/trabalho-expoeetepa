<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Blog de Segurança Cibernética</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <h1>Blog de Segurança Cibernética</h1>
        <p>Fique por dentro das últimas novidades e dicas sobre segurança digital.</p>
    </header>
    <nav class="navbar navbar-expand-md navbar-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="posts.php">Posts</a>
                </li>
                <li class="nav-item">
                    <?php
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                        echo "<a class='nav-link' id='addPostButton' href='novo_post.php'>Adicionar Post</a>";
                    } else {
                        echo "<a class='nav-link' id='addPostButton' href='novo_post.php' style='display:none;'>Adicionar Post</a>";
                    }
                    ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sobre.php">Sobre</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contato.php">Contatos</a>
                </li>
                <li class="nav-item">
                    <button class="nav-link btn" onclick="login()">⚙️</button>
                </li>
                <li class="nav-item" id="logoutItem" style="display:none;">
                    <a class="nav-link" href="#" onclick="logout()">Sair</a>
                </li>
            </ul>
        </div>
    </nav>
    <main class="main-content container">
        <section id="posts" class="posts d-flex justify-content-center">
            <div class="post-container" style="max-width: 600px; width: 100%;">
            <?php
          
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "blogsegurancainformaca";

           
            $conn = new mysqli($servername, $username, $password, $dbname);

            
            if ($conn->connect_error) {
                die("Falha na conexão: " . $conn->connect_error);
            }

            $sql = "SELECT title, content, link, image_path, created_at FROM posts ORDER BY created_at DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<article class='post'>";
                    echo "<h2>" . $row["title"] . "</h2>";
                    if ($row["image_path"]) {
                        echo "<img src='" . $row["image_path"] . "' alt='Imagem do post' class='post-image'>";
                    }
                    echo "<p class='preview' style='display: block; overflow: hidden; max-height: 4.5em; line-height: 1.5em;'><span>" . $row["content"] . "</span></p>";
                    echo "<p class='full-content' style='display: none;'>" . $row["content"] . "</p>";
                    echo "<a href='#' class='read-more' onclick='togglePost(event, this)'>Ler mais</a>";
                    echo "<p class='date'>Publicado em: " . date("d/m/Y", strtotime($row["created_at"])) . "</p>";
                    echo "</article>";
                }
            } else {
                echo "<center><p>Nenhum post encontrado.</p></center>";
            }

            $conn->close();
            ?>
            </div>
        </section>
    </main>
    <footer class="footer">
        <p>&copy; 2024 Blog de Segurança Cibernética | Todos os direitos reservados</p>
    </footer>
    <script>
        function login() {
            var username = prompt("Usuário:");
            var password = prompt("Senha:");
            if (username === "scrr" && password === "scrr") {
                document.getElementById("addPostButton").style.display = "block";
                document.getElementById("logoutItem").style.display = "block";
                alert("Bem-vindo, veyr!");

                fetch('posts.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ loggedin: true })
                });
                $_SESSION['loggedin'] = true;
            } else {
                alert("Login falhou!");
            }
        }

        function logout() {
            fetch('posts.php', {
                method: 'POST'
            }).then(() => {
                location.reload();
            });
        }

        function togglePost(event, link) {
            event.preventDefault();
            const previewContent = link.previousElementSibling;
            const fullContent = previewContent.previousElementSibling;

            if (previewContent.style.display === "block") {
                previewContent.style.display = "none";
                fullContent.style.display = "block";
                link.innerText = "Ler mais";
            } else {
                previewContent.style.display = "block";
                fullContent.style.display = "none";
                link.innerText = "Ler menos";
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const posts = document.querySelectorAll('.post');
            posts.forEach(post => {
                const previewContent = post.querySelector('.preview');
                const fullContent = post.querySelector('.full-content');
                const link = post.querySelector('.read-more');

                if (fullContent.style.display === "none") {
                    previewContent.style.display = "block";
                    link.innerText = "Ler mais";
                } else {
                    previewContent.style.display = "none";
                    link.innerText = "Ler menos";
                }
            });
        });

        // Verificar se o usuário ta logado ao carregar a página
        if (<?php echo isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true ? 'true' : 'false'; ?>) {
            document.getElementById("addPostButton").style.display = "block";
            document.getElementById("logoutItem").style.display = "block";
        }
    </script>
</body>
</html>
