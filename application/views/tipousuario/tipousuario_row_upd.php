<td>
	<?= $tipo->idrol; ?>
    <input type="hidden" <?= 'value="'.$tipo->idrol.'"  id="id'.$tipo->idrol.'" '; ?> />
    <input type="hidden" <?= 'value="'.$tipo->nombre.'"  id="nombre'.$tipo->idrol.'" '; ?> />
    <input type="hidden" <?= 'value="'.$tipo->codigo.'"  id="codigo'.$tipo->idrol.'" '; ?> />
</td>
<td>
	<?= $tipo->nombre; ?>
</td>
<td>
    <?= $tipo->codigo; ?>
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
    <?= '<a id="btnEditarTipo'.$tipo->idrol.'" href="#" onmousedown="javascript:actualizarArticulo('.$tipo->idrol.');" class="btn btn-info">'; ?>
        <i class="icon-edit icon-white"></i>
        Editar
    </a>
</td>