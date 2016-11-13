<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Reporte Inventario</title>
    <?php date_default_timezone_set("America/Bogota"); ?>
    <style type="text/css">
        table {
            width:100%;
            font-size: 10pt;
            margin-left: -24px;
            margin-right: -26px;
            padding-right: -14px; 
        }
        table, th, td {
            border: 1px dashed black;
            border-collapse: collapse;
        }
        th, td {
            padding: 1px;
            text-align: left;
        }
        
        body {
            font-family: Courier New;
        }
    </style>
</head>
<body>
    <div style="text-align: center;">
        <h1>Reporte de Inventario</h1>
    </div>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>Tipo</th>
            <th>Valor</th>
            <th>Autor</th>
        </tr>
        
        <?php foreach ($resultado as $valor) { ?>
        <tr>
            <td>
                <?php echo $valor->nombre; ?>
            </td>
            <td>
                <?php echo $valor->cantidad; ?>
            </td>
            <td>
                <?php echo $valor->nombretip; ?>
            </td>
            <td>
                <?php echo $valor->valor; ?>
            </td>
            <td>
                <?php echo $valor->autor; ?>
            </td>
        </tr>
        <?php } ?>
    </table>
    <br>
    <div id="header" style="font-size: 12px; font-family: courier new; margin-left: -0.8cm; margin-right: -1cm; margin-top: -1cm; text-align: center;">
        <label><?= $titulo; ?></label>
        <label><?= $nit; ?></label>
        <label><?= $dir; ?></label>
        <label><?= $ciudad; ?></label>
        <label style="font-weight: bold;"><?= $telefono; ?></label>
    </div>
</body>
</html>