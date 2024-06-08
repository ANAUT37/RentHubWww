<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Roboto', sans-serif; background-color: #f1f1f1; color: #333;">
    <div style="width: fit-content; margin: 20px auto;">
        <div style="background-color: #fff; padding: 40px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); text-align: center;">
            <h1 style="font-size: 24px; margin-bottom: 20px;">Inicio de sesión</h1>
            <p style="font-size: 16px; line-height: 1.6; margin-bottom: 20px;">¡Hola! Hemos detectado un inicio de sesión en tu cuenta.</p>
            <p style="font-size: 16px; line-height: 1.6; margin-bottom: 20px;">Tu código de verificación es:</p>
            <div style="background-color: #f1f1f1; padding: 10px 20px; border-radius: 5px; display: inline-block; font-size: 18px; margin-bottom: 20px;">{{ $twoFactorCode }}</div>
            <p style="font-size: 16px; line-height: 1.6; margin-bottom: 20px;">Si no has sido tú quien ha iniciado sesión, puedes cambiar tu contraseña <strong><a href="https://renthub.es/account/security" style="color: #333; text-decoration: none;">aquí</a></strong>.</p>
            <p style="font-size: 16px; line-height: 1.6; margin-bottom: 20px;">Gracias, el equipo de <strong><a href="https://renthub.es" style="color: #333; text-decoration: none;">RêntHûb.es</a></strong></p>
            <br>
            <p style="font-size: 16px; line-height: 1.6; margin-bottom: 20px;">No responder a este correo. Para contactar con el servicio de soporte hágalo vía <strong>support@renthub.es</strong> o visite nuestra <strong><a href="https://renthub.es/help" style="color: #333; text-decoration: none;">página de ayuda</a></strong>.</p>
        </div>
    </div>
</body>
</html>
