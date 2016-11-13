<td style="text-align: center;">
	<input id="idinventariotable" name="idinventariotable" type="hidden" value="<?= $inve->id; ?>">
	<?= date("d/M/Y", strtotime($inve->fecha)); ?>
</td>
<td style="text-align: right;">
	<?= $inve->codigo; ?>
</td>
<td style="text-align: left;">
	<?= $inve->nombre; ?>
</td>
<td style="text-align: left;">
	<?= $inve->nombretip; ?>
</td>
<td style="text-align: center;">
	<?= $inve->cantientra; ?>
</td>
<td style="text-align: right;">
	$<?= number_format($inve->valorentra, '0', ',', '.'); ?>
</td>
<td style="text-align: right;">
	$<?= number_format($inve->valorventa, '0', ',', '.'); ?>
</td>
<td style="text-align: center;">
	<?= $inve->ventacantidad; ?>
</td>
<td style="text-align: right;">
	$<?= number_format($inve->valor, '0', ',', '.'); ?>
</td>
<td style="text-align: right;">
	$<?= number_format($inve->ventavaloruni, '0', ',', '.'); ?>
</td>
<td style="text-align: center;">
	<?= $inve->cantidad; ?>
</td>
<td style="text-align: right;">
	$<?= number_format($inve->valor, '0', ',', '.'); ?>
</td>
<td style="text-align: right;">
	$<?= number_format($inve->valorventa, '0', ',', '.'); ?>
</td>
<td style="text-align: right;">
	$<?=  number_format($inve->valor * $inve->cantidad, '0', ',', '.'); ?>
</td>