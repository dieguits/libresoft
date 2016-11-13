<div>
  <ul class="breadcrumb">
    <li>
      <a href="#" id="btnNuevoUsuario" onmousedown="javascript:crearUsuario();">Nuevo</a>
    </li>
  </ul>
</div>

</br>

<div id="dlgSetUsuario" title="Crear Usuario" >
	<?= form_open('/usuario/usuario/redireccionar', array('id'=>'frmSetUsuario')); ?>
		</br>
		<label for="nombres" style="padding-left: 27px;"> Nombres:  </label>
        <input id="nombres" name="nombres" style="width: 220px;" type="text" placeholder="Nombres" />
        <p id="validanombres" hidden>*</p>
        <input id="idUsuario" name="idUsuario" type="hidden" value="-1">
        </br></br>
		
		<label for="apellidos" style="padding-left: 26px;"> Apellidos:  </label>
		<input id="apellidos" name="apellidos" type="text" placeholder="Apellidos" style="width: 220px;"/>
		<p id="validaapellidos" hidden>*</p>
        </br></br>
        
        <label for="cedula" style="padding-left: 41px;"> Cedula:  </label>
        <input id="cedula" name="cedula" type="text" placeholder="Cedula" style="width: 220px;"/>
        <p id="validacedula" hidden>*</p>
        </br></br>

        <label for="nombreusuario" style="padding-left: 36px;"> Usuario:  </label>
        <input id="nombreusuario" name="nombreusuario" type="text" placeholder="Usuario" onfocus="generarUsuario()" style="width: 220px;"/>
        <p id="validausuario" hidden>*</p>
        </br></br>
        
        <label for="clave" style="padding-left: 9px;"> Contraseña:  </label>
        <input id="clave" name="clave" type="password" placeholder="Contraseña" style="width: 220px;"/>
        <p id="validaclave" hidden>*</p>
        </br></br>

        <label for="role"> Tipo Usuario:  </label>
        <select id="role" name="role" style="width: 226px;">
            <option value="-1">-- Tipo Usuario --</option>
            <?php
                foreach ($tipousuario->result() as $tipo) {
                    echo '<option value="'.$tipo->idrol.'">'.$tipo->nombre.'</option>';
                }
            ?>
        </select>
        <p id="validarole" hidden>*</p>
        </br></br>

        <div id="msgerror" style="display: none;"></div>
		</br>
		<div style="text-align: right; padding-right: 8px;">
            <button id="btnGuardarUsuario" type="submit" >guardar</button>
		</div>
	<?= form_close(); ?>
</div>

<div id="formusuario">
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
                    			NOMBRES
                    		</th>
                            <th style="text-align: center;">
                                APELLIDOS
                            </th>
                    		<th style="text-align: center;">
                    			CEDULA
                    		</th>
                    		<th style="text-align: center;">
                    			NOMBRE USUARIO
                    		</th>
                    		<th style="text-align: center;">
                    			TIPO USUARIO
                    		</th>
                    		<th style="text-align: center;">
                    			USUARIO CREA
                    		</th>
                    		<th style="text-align: center;">
                    			FECHA CREACION
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
                    foreach ($usuarios->result() as $tipo) { 
                    	echo '<tr id="tr'.$tipo->idUsuario.'" >'; ?>
                    	<td>
                        	<?= $tipo->idUsuario; ?>
              				<input type="hidden" <?= 'value="'.$tipo->idUsuario.'"  id="id'.$tipo->idUsuario.'" '; ?> />
                            <input type="hidden" <?= 'value="'.$tipo->nombres.'"  id="nombre'.$tipo->idUsuario.'" '; ?> />
                            <input type="hidden" <?= 'value="'.$tipo->apellidos.'"  id="apellidos'.$tipo->idUsuario.'" '; ?> />
                            <input type="hidden" <?= 'value="'.$tipo->cedula.'"  id="cedula'.$tipo->idUsuario.'" '; ?> />
                            <input type="hidden" <?= 'value="'.$tipo->nombreusuario.'"  id="usuario'.$tipo->idUsuario.'" '; ?> />
                            <input type="hidden" <?= 'value="'.$tipo->idrole.'"  id="tipousuario'.$tipo->idUsuario.'" '; ?> />
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
                <?php
                	} ?>
                    </tbody>
                </table>
            </div>
        </div><!--/span-->
    </div>
</div>
