<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'EventTecNM'); ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7fa;
            padding: 20px;
            line-height: 1.6;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 30px;
            text-align: center;
            color: #ffffff;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 14px;
            opacity: 0.9;
        }

        .content {
            padding: 40px 30px;
            color: #333333;
        }

        .content h2 {
            color: #667eea;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .content p {
            margin-bottom: 15px;
            color: #555555;
            line-height: 1.8;
        }

        .button {
            display: inline-block;
            padding: 14px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: 600;
            transition: transform 0.2s;
        }

        .button:hover {
            transform: translateY(-2px);
        }

        .info-box {
            background-color: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 15px 20px;
            margin: 20px 0;
            border-radius: 4px;
        }

        .info-box strong {
            color: #667eea;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 25px 30px;
            text-align: center;
            color: #888888;
            font-size: 13px;
        }

        .footer a {
            color: #667eea;
            text-decoration: none;
        }

        .divider {
            height: 1px;
            background-color: #e9ecef;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>EventTecNM</h1>
            <p>Sistema de Gestión de Eventos Académicos</p>
        </div>

        <div class="content">
            <?php echo $__env->yieldContent('content'); ?>
        </div>

        <div class="footer">
            <p>Este es un correo automático, por favor no responder.</p>
            <p>© <?php echo e(date('Y')); ?> EventTecNM. Todos los derechos reservados.</p>
            <p>Tecnológico Nacional de México</p>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\merin\Downloads\ProyectoPW\resources\views/emails/layout.blade.php ENDPATH**/ ?>