<div>
  <ul class="breadcrumb">
    <li>
      <a href="#" id="btnNuevoTipo" onmousedown="javascript:crearArticulo();">Nuevo</a>
    </li>
  </ul>
</div>

</br>

<div id="dlgSetTipoArticulo" title="Crear Tipo Articulo">
	<?= form_open('/tipoarticulo/tipoarticulo/redireccionar',array('id'=>'frmSetTipoArticulo')); ?>
		<label class="control-label" for="codiarti"> Id Tipo Articulo  </label>
        <input id="idtiparticulo" name="idtiparticulo" type="hidden" value="-1" />
        <input id="idTipoArticulo" name="idTipoArticulo" style="width: 40px;" type="text" value="-1" placeholder="Tipo Articulo" disabled="disabled" />
        </br></br>
		<label class="control-label" for="nombreTipoArticu"> Nombre Tipo Articulo  </label>
		<input id="nombreTipoarti" name="nombreTipoarti" class="input-xlarge focused" type="text" value="" placeholder="Nombre Tipo Articulo" />
		<p id="validanombre" hidden>*</p>
        </br></br>
        <div id="msgerror" style="display: none;"></div>
		<div class="form-actions" style="text-align: right">
            <button id="btnGuardarTipo" type="submit" class="btn btn-primary">guardar</button>
		</div>
	<?= form_close(); ?>
</div>

<div id="formutipoarticulo">
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
                    foreach ($tipoarticulos->result() as $tipo) { 
                    echo '<tr id="tr'.$tipo->idtipoarticulo.'" >';
                    ?>
                    	<td>
                        	<?= $tipo->idtipoarticulo; ?>
                            <input type="hidden" <?= 'value="'.$tipo->idtipoarticulo.'"  id="id'.$tipo->idtipoarticulo.'" '; ?> />
                            <input type="hidden" <?= 'value="'.$tipo->nombretipoarticulo.'"  id="nombre'.$tipo->idtipoarticulo.'" '; ?> />
                    	</td>
                    	<td>
                        	<?= $tipo->nombretipoarticulo; ?>
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
                            <?= '<a id="btnEditarTipo'.$tipo->idtipoarticulo.'" href="#" onmousedown="javascript:actualizarArticulo('.$tipo->idtipoarticulo.');" class="btn btn-info">'; ?>
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
