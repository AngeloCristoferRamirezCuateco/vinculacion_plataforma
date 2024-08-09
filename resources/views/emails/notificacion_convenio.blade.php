<!DOCTYPE html>
<html>
<head>
    <title>Solicitud de Convenio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            background-color: #ffffff;
            margin: 20px auto;
            padding: 20px;
            max-width: 600px;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background-color: #024A86;
            color: #ffffff;
            padding: 10px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .email-body {
            padding: 20px;
            color: #333333;
        }
        .email-footer {
            background-color: #024A86;
            color: #ffffff;
            padding: 10px;
            text-align: center;
            border-radius: 0 0 5px 5px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Hola {{ $name }}</h1>
        </div>
        <div class="email-body">
            <p>La empresa "{{ $empresaSolicitante }}" ha solicitado tener un convenio.</p>
        </div>
        <div class="email-footer">
            <p>© 2024 Your Company. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
