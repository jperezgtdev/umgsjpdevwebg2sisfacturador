<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            margin-bottom: 20px;
            white-space: nowrap;
        }

        .header p {
            margin: 5px;
        }

        .titulo-header {
            background-color: #f2f2f2;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        thead {
            background-color: #f2f2f2;
        }

        .total {
            text-align: right;
            font-weight: bold;
            padding-top: 30px;
        }

        .right-align {
            text-align: right;
        }

        .center_align {
            text-align: center;
        }

        .product-cell {
            width: 60%;
        }

        .price-cell {
            width: 20%;
        }

        .quantity-cell {
            width: 15%;
        }

        .contenido {
            border: 1px solid black;
            border-radius: 10px;
            padding: 10px;
        }
    </style>
</head>

<body>
    <?php
    $imgpath = base_url('assets/logo.png');
    $ext = pathinfo($imgpath, PATHINFO_EXTENSION);
    $data = file_get_contents($imgpath);
    $base64 = 'data:image/' . $ext . ';base64,' . base64_encode($data);
    ?>
    <div class="header">
        <div class="factura">
            <table>
                <tr>
                    <td>
                        <p class="titulo-header">Dato de factura</p>
                        <p>Serie:
                            <?php echo $detalles[0]->serie; ?>
                        </p>
                        <p>Número:
                            <?php echo $detalles[0]->numero; ?>
                        </p>
                        <p>Autorización:
                            <?php echo $detalles[0]->authorization; ?>
                        </p>
                    </td rowspan="2">
                    <td style="text-align:right;">
                        <img class="logo" src="<?php echo $base64; ?>" style="width: 200px; height: auto;">
                    </td>
                </tr>
            </table>
        </div>
        <div class="cliente contenido">
            <table>
                <tr>
                    <td>
                        <p>Cliente:</p>
                        <p>Direccion:</p>
                    </td>
                    <td>
                        <p>
                            <?php echo $detalles[0]->clien; ?>
                        </p>
                        <p>
                            <?php echo $detalles[0]->direccion; ?>
                        </p>
                    </td>
                    <td>
                        <p>Fecha de emision:</p>
                        <p>NIT:</p>
                    </td>
                    <td>
                        <p>
                            <?php echo $detalles[0]->fecha; ?>
                        </p>
                        <p>
                            <?php echo $detalles[0]->nit; ?>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p style="padding:3px;">Atendido por:
                            <?php echo $detalles[0]->atendio; ?>
                        </p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="contenido">
        <table style="height:90%;">
            <thead>
                <tr>
                    <th class="quantity-cell">Cantidad</th>
                    <th class="product-cell">Producto</th>
                    <th class="price-cell center_align">Precio Unitario</th>
                    <th class="price-cell center_align">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;

                foreach ($detalles as $detalle):
                    $subtotal = $detalle->cantidad * $detalle->precio;
                    $total += $subtotal;
                    ?>
                    <tr>
                        <td class="quantity-cell">
                            <?php echo $detalle->cantidad; ?>
                        </td>
                        <td class="product-cell">
                            <?php echo $detalle->producto; ?>
                        </td>
                        <td class="price-cell right-align">
                            <?php echo 'Q. ' . number_format($detalle->precio, 2, '.', ','); ?>
                        </td>
                        <td class="price-cell right-align">
                            <?php echo 'Q. ' . number_format($subtotal, 2, '.', ','); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <table>
            <tfoot>
                <tr>
                    <?PHP require_once APPPATH . '..\assets\CifrasEnLetras.php';
                    $v = new CifrasEnLetras(); ?>
                    <td colspan="3" class="total right-align">
                        <?php echo ' (' . ($v->convertirQuetzalesEnLetras($total)) . ')'; ?>
                    </td>
                    <td class="total right-align">
                        <?php echo 'TOTAL Q. ' . number_format($total, 2, '.', ','); ?>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>