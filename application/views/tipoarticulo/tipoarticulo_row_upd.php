<td>
	<?= ' '.$tipo->idtipoarticulo.''; ?>
    <input type="hidden" <?= 'value="'.$tipo->idtipoarticulo.'"  id="id'.$tipo->idtipoarticulo.'" '; ?> />
    <input type="hidden" <?= 'value="'.$tipo->nombretipoarticulo.'"  id="nombre'.$tipo->idtipoarticulo.'" '; ?> />
</td>
<td>
	<?= ''.$tipo->nombretipoarticulo.''; ?>
</td>
<td>
	<?= $tipo->usuariocrea; ?>
</td>
<td>
	<?= date("d/m/Y", strtotime($tipo->fechacrea)); ?>
</td>
<td>
	<?= $tipo->usuarioactualiza; ?>
</td>
<td>
	<?= date("d/m/Y", strtotime($tipo->fechactualiza)); ?>
</td>
<td style="text-align: center;">
	<!--?php echo '<a href="#" id="btnEditarTipo'.$tipo->idtipoarticulo.'">editar</a>'; ?-->
    <?= '<a id="btnEditarTipo'.$tipo->idtipoarticulo.'" href="#" onmousedown="javascript:actualizarArticulo('.$tipo->idtipoarticulo.');" class="btn btn-info">' ?>
        <i class="icon-edit icon-white"></i>
        Editar
    </a>
</td>