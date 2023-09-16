<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado do Upload</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }
        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
        }
        .btn-custom {
            background-color: #007bff;
            color: #fff;
            border: none;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Resultado do Upload</h2>
                    </div>
                    <div class="card-body">
                        <?php
        
                        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
                            $extensoes_permitidas = array('jpg', 'jpeg', 'png', 'bmp');
                            $nome_arquivo = $_FILES['imagem']['name'];
                            $extensao_arquivo = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));

                            if (in_array($extensao_arquivo, $extensoes_permitidas)) {
                                
                                $imagem_temp = $_FILES['imagem']['tmp_name'];

                                
                                echo "<h3>Imagem:</h3>";
                                echo "<img src='data:image/{$extensao_arquivo};base64," . base64_encode(file_get_contents($imagem_temp)) . "' class='img-fluid' />";
                                move_uploaded_file($imagem_temp, "uploads/{$nome_arquivo}");
                            } else {
                                echo "<div class='alert alert-danger'>Extensão de arquivo de imagem não permitida. Por favor, envie um arquivo jpg, png ou bmp.</div>";
                            }
                        }

                        
                        if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] === UPLOAD_ERR_OK) {
                            $extensao_permitida = 'pdf';
                            $nome_arquivo = $_FILES['pdf']['name'];
                            $extensao_arquivo = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));

                            if ($extensao_arquivo === $extensao_permitida) {
                               
                                $pdf_temp = $_FILES['pdf']['tmp_name'];

                                echo "<h3>Arquivo PDF:</h3>";
                                echo "<a href='uploads/{$nome_arquivo}' target='_blank' class='btn btn-primary'>Baixar PDF</a>";

                                
                                move_uploaded_file($pdf_temp, "uploads/{$nome_arquivo}");
                            } else {
                                echo "<div class='alert alert-danger'>Extensão de arquivo PDF não permitida. Por favor, envie um arquivo PDF.</div>";
                            }
                        }
                        ?>
                        <a href="index.html" class="btn btn-secondary btn-custom mt-3">Voltar para a Página Inicial</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>