<div>
  <ul class="breadcrumb">
    <li>
      <a href="#" id="btnNuevoTipo" onmousedown="javascript:crearTipoUsuario();">Nuevo</a>
    </li>
  </ul>
</div>

</br>

<div id="dlgSetTipoUsuario" title="Crear Tipo Usuario">
	<?= form_open('/tipousuario/tipousuario/redireccionar',array('id'=>'frmSetTipoUsuario')); ?>
		<label class="control-label" for="codiarti"> Id Tipo Usuario  </label>
        <input id="idTipoUsuario" name="idTipoUsuario" style="width: 40px;" type="text" value="-1" placeholder="Tipo Usuario" disabled="disabled" />
        </br></br>
		<label class="control-label" for="nombreTipoUsuario"> Nombre Tipo Usuario  </label>
		<input id="nombreTipoUsuario" name="nombreTipoUsuario" class="input-xlarge focused" type="text" value="" placeholder="Nombre Tipo Usuario" />
		<p id="validanombre" hidden>*</p>
        </br></br>
        <label class="control-label" for="codigoTipoUsuario"> Codigo Tipo Usuario  </label>
        <input id="codigoTipoUsuario" name="codigoTipoUsuario" class="input-xlarge focused" type="text" value="" placeholder="Codigo Tipo Usuario" onfocus="generarCodigo(this)" />
        <p id="validacodigo" hidden>*</p>
        </br></br>
        <div id="msgerror" style="display: none;"></div>
		<div class="form-actions" style="text-align: right">
            <button id="btnGuardarTipo" type="submit" class="btn btn-primary">guardar</button>
		</div>
	<?= form_close(); ?>
</div>

<div id="formutipousuario">
    <div class="row-fluid">     
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                </div>
            </div>
                                <!-- bootstrap-datatable table-striped -->
            <div class="box-content">
                <table id="tblArticulo">
                	<thead>
                        <tr>
                    		<th>
                    			ID
                    		</th>
                    		<th style="text-align: center;">
                    			NOMBRE
                    		</th>
                            <th style="text-align: center;">
                                CODIGO TIPO USUARIO
                            </th>
                    		<th style="text-align: center;">
                    			USUARIO CREA
                    		</th>
                    		<th style="text-align: center;">
                    			FECHA CREA
                    		</th>
                    		<th style="text-align: center;">
                    			USUARIO ACTUALIZA
                    		</th>
                    		<th style="text-align: center;">
                    			FECHA ACTUALIZA
                    		</th>
                    		<th style="text-align: center;">
                    			ACCIONES
                    		</th>
                    	</tr>
                    </thead>
                    <tbody>
                <?php
                    foreach ($tipousuarios->result() as $tipo) { 
                    echo '<tr id="tr'.$tipo->idrol.'" >';
                    ?>
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
                    </tr>
                <?php
                	} ?>
                    </tbody>
                </table>
            </div>
        </div><!--/span-->
    </div>
</div>
