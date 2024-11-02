<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Novo Post</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            width: 100%;
            height: 100vh;
            margin: 0;
            padding: 0;
            font-size: 16px;
        }
        center {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        form {
            width: 80%;
            max-width: 600px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        @media (max-width: 600px) {
            form {
                width: 95%;
                padding: 15px;
            }
            input[type="text"], textarea {
                width: 100%;
                padding: 12px;
                margin-bottom: 12px;
                border: 1px solid #ccc;
            }
            input[type="file"] {
                width: 100%;
                padding: 12px;
                margin-bottom: 12px;
                border: 1px solid #ccc;
            }
            input[type="submit"] {
                width: 100%;
                padding: 12px;
                background-color: #0d6efd;
                color: #fff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }
        }
    </style>
</head>
<body>
<center>
        <h2>Adicionar Novo Post</h2>
        <form action="salvar_post.php" method="POST" enctype="multipart/form-data">
            <label for="title">Título:</label><br>
            <input type="text" id="title" name="title" required><br><br>

            <label for="content">Conteúdo:</label><br>
            <textarea id="content" name="content" rows="5" required></textarea><br><br>

            <label for="link">Link (opcional):</label><br>
            <input type="text" id="link" name="link"><br><br>

            <label for="image">Imagem (opcional):</label><br>
            <input type="file" id="image" name="image" accept="image/*"><br><br>

            <input type="submit" value="Adicionar Post">
        </form>
    </center>
</body>
</html>
