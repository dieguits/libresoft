<?= '<tr id="tr'.$tipo->idUsuario.'" >'; ?>
	<td>
    	<?= $tipo->idUsuario; ?>
		<input type="hidden" <?= 'value="'.$tipo->idUsuario.'"  id="id'.$tipo->idUsuario.'" '; ?> />
        <input type="hidden" <?= 'value="'.$tipo->nombres.'"  id="nombre'.$tipo->idUsuario.'" '; ?> />
        <input type="hidden" <?= 'value="'.$tipo->apellidos.'"  id="apellidos'.$tipo->idUsuario.'" '; ?> />
        <input type="hidden" <?= 'value="'.$tipo->cedula.'"  id="cedula'.$tipo->idUsuario.'" '; ?> />
        <input type="hidden" <?= 'value="'.$tipo->nombreusuario.'"  id="usuario'.$tipo->idUsuario.'" '; ?> />
        <input type="hidden" <?= 'value="'.$tipo->tipoUsuario.'"  id="tipousuario'.$tipo->idUsuario.'" '; ?> />
	</td>
	<td>
    	<?= $tipo->nombres; ?>
	</td>
    <td>
        <?= $tipo->apellidos; ?>
    </td>
	<td>
    	<?= $tipo->cedula; ?>
	</td>
	<td>
    	<?= $tipo->nombreusuario; ?>
	</td>
	<td>
    	<?= $tipo->tipoUsuario; ?>
	</td>
	<td>
		<?= $tipo->usuarioadd; ?>
	</td>
	<td>
    	<?= date("d/m/Y", strtotime($tipo->fechaadd)); ?>
	</td>
	<td>
    	<?= $tipo->usuarioupd; ?>
	</td>
	<td>
    	<?= date("d/m/Y", strtotime($tipo->fechaupd)); ?>
	</td>
	<td style="text-align: center;">
		<!--?php echo '<a href="#" id="btnEditarTipo'.$tipo->idtipoarticulo.'">editar</a>'; ?-->
        <?= '<a id="btnEditarUsuario'.$tipo->idUsuario.'" href="#" onmousedown="javascript:actualizarUsuario('.$tipo->idUsuario.');" '; ?>
            <i class="icon-edit icon-white"></i>
            Editar
        </a>
	</td>
</tr>