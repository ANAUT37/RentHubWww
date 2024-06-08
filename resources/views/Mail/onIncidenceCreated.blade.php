<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Facturación - RêntHûb</title>
</head>

<body style="margin: 0; padding: 0; font-family: 'Roboto', sans-serif; background-color: #f1f1f1; color: #333;">
    <div style="width: fit-content; margin: 20px auto;">
        <div
            style="background-color: #fff; padding: 40px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); ">
            <div style="text-align: start;">
                <h1 style="font-size: 24px; margin-bottom: 20px;"><a href="https://renthub.es" style="color: #333; text-decoration: none;">RêntHûb.es</a></h1>
            </div>
            <div>
                <p style="font-size: 16px;">¡Hola!</p>
                <p style="font-size: 16px;">Se ha registrado una nueva incidencia.</p>
                <p style="font-size: 16px;">A continuación, te presentamos un resumen de la información de la incidencia:
                </p>
            </div>
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                <thead>
                    <tr>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">ID Contrato</th>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">ID incidencia</th>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Tipo</th>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Descripción</th>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Creada por</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="border: 1px solid #ddd; padding: 8px;">{{$contract_id}}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">{{$incidence->display_id}}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">{{$incidenceType}}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">{{ucfirst($incidence->description)}}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">{{$userFullName}}</td>
                    </tr>
                </tbody>
            </table>
            <p style="font-size: 16px; ">Puedes consultar esta y más información o resolver la incidencia en tu apartado de <strong>Incidencias</strong> del contrato.</p>
            <p style="font-size: 16px; ">Si tienes alguna pregunta sobre este
                reporte, por favor contacta con nuestro equipo de soporte en <strong>support@renthub.es</strong>.</p>
            <br>
            <p style="font-size: 16px; ">Gracias por ser parte de RêntHûb.</p>
            <p style="font-size: 16px; ">Atentamente, el equipo de RêntHûb</p>
            <br>
            <p style="font-size: 16px; ">No responder a este correo. Para
                contactar con el servicio de soporte hágalo vía <strong>support@renthub.es</strong> o visite nuestra
                <strong><a href="https://renthub.es/help" style="color: #333; text-decoration: none;">página de
                        ayuda</a></strong>.
            </p>
        </div>
    </div>
</body>

</html>