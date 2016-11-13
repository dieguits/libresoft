<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Provincias españolas en pdf</title>
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
            border: 0px solid black;
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
    <!--style type="text/css">
        body {
         background-color: #fff;
         /*margin: 1px;*/
         font-family: Lucida Grande, Verdana, Sans-serif;
         font-size: 8px;
         color: #4F5155;
        }

        a {
         color: #003399;
         background-color: transparent;
         font-weight: normal;
        }

        h1 {
         color: #444;
         background-color: transparent;
         border-bottom: 1px solid #D0D0D0;
         font-size: 8px;
         font-weight: bold;
         margin: 0.2cm 0 0.2cm 0;
         padding: 0.2cm 0 0.2cm 0;
        }

        h2 {
         color: #444;
         background-color: transparent;
         border-bottom: 1px solid #D0D0D0;
         font-size: 8px;
         font-weight: bold;
         margin: 0.2cm 0 0.2cm 0;
         padding: 5px 0 6px 0;
         text-align: center;
        }

        table{
            text-align: center;
        }

        /* estilos para el footer y el numero de pagina */
        @page { margin: 180px 50px; }
        #header { 
            position: fixed; 
            left: 0px; top: -180px; 
            right: 0px; 
            height: 50px; 
            text-align: center; 
        }
        #footer { 
            position: fixed; 
            left: 0px; 
            bottom: -180px; 
            right: 0px; 
            height: 150px;
            text-align: center;
        }
        #footer .page:after { 
            content: counter(page, upper-roman); 
        }
    </style-->
</head>
<body>
    <!--header para cada pagina font-weight: bold;-->
    <div id="header" style="font-size: 12px; font-family: courier new; margin-left: -0.8cm; margin-right: -1cm; margin-top: -1cm; text-align: center;">
        <label><?= $titulo; ?></label>
        <label><?= $nit; ?></label>
        <label><?= $dir; ?></label>
        <label><?= $ciudad; ?></label>
        <label style="font-weight: bold;"><?= $telefono; ?></label>
    </div>
    <!--footer para cada pagina-->
    <!--div id="footer">
        <aqui se muestra el numero de la pagina en numeros romanos>
        <p class="page">
            <?= $variable; ?>
        </p>
    </div-->
    <div style="font-size: 10px; margin-left: -0.8cm;">
        
        <p style="margin-bottom: -20px;">Cajero: <?= $cajero; ?></p>

        <p style="margin-top: -4px; margin-bottom: -2px;">----------------------------------------------------------------------------------</p>
        <label>Reporte de venta</label>
        <p style="margin-top: -4px;">----------------------------------------------------------------------------------</p>
    </div>
    <table style="font-size: 10px; font-family: courier new;">
        <thead>
            <tr>
                <th width="8%" style="text-align: center; ">CANT</th>
                <th width="56%" style="text-align: left; ">ART</th>
                <th width="30%" style="text-align: right; margin-right: 0.8cm;">PRECIO</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $suma = 0;
                $totauni = 0;
                foreach ($resultado as $valor) {
                    $suma += $valor->valoruni*$valor->cantidadventa;
                    $totauni = $valor->valoruni*$valor->cantidadventa;
            ?>
            <tr>
                <td width="8%"  style="text-align: center;"><?php echo $valor->cantidadventa; ?></td>
                <td width="56%" style="text-align: left;"><?php echo $valor->nombrearticulo; ?></td>
                <td width="30%" style="text-align: right;"><?php echo '$'.number_format($totauni,0,",","."); ?></td>
            </tr>
            <?php
                }
            ?>
            <tr>
                <td colspan="2">Total</td>
                <td style="text-align: right;"><?php echo '$'.number_format($suma,0,",","."); ?></td>
            </tr>
        </tbody>
    </table>
    
    
    <div style="padding-top: 10px; margin-left: -0.8cm;">
        <label style="padding-bottom: -10px; margin-bottom: -10px;">******************************************</label>
        <center style="margin-right: -1.2cm;">
            <label><?= date('d/m/Y H:i:s'); ?></label>
        </center>
        <label style="padding: 0px;">******************************************</label>
    </div>
    <div style="font-size: 12px; font-family: courier new; margin-left: -0.8cm; margin-right: -1cm; margin-top: 0.1cm; text-align: center;">
        <label>GRACIAS POR SU COMPRA, DIOS LO BENDIGA.</label>
    </div>
    <div style="font-size: 12px; font-family: courier new; margin-left: -0.8cm; margin-right: -1cm; margin-top: 1cm; margin-bottom: 3cm; text-align: center;">
        <label><?= $pasaje; ?></label>
        <label style="padding: 0px;">******************************************</label>
    </div>
</body>
</html>