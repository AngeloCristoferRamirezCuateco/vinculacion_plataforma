<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trato de Vinculación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .company-name {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .content {
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Trato de Vinculación</h1>
        <div class="company-name">
            <strong>Empresa:</strong> {{ $empresa->nombreEmpresa }}
        </div>
        <div class="content">
            {!! $content !!}
        </div>
    </div>
</body>
</html>
