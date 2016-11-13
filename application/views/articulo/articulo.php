<div>
  <ul class="breadcrumb">
    <li>
      <a href="#" id="btnNuevo" onmousedown="javascript:crearArticulo();">Nuevo</a>
    </li>
  </ul>
</div>


<div id="dlgSetArticulo" name="dlgSetArticulo" title="Crear Articulo">
	<?php echo form_open('/articulo/articulo/redireccionar', array('id'=>'frmSetArticulo')); ?>
		
		</br></br>
		<label for="codiarti">Referencia  </label>
        <input id="idarticulo" name="idarticulo" type="hidden" value="-1" />
        <input id="codiarti" name="codiarti" class="input-xlarge focused" type="text" value="" placeholder="Codigo" />
        <p id="validaref" hidden>*</p>
		</br></br>
		<label for="nombrearticu">Nombre Articulo  </label>
		<input id="nombrearticu" name="nombrearticu" class="input-xlarge focused" type="text" value="" placeholder="Nombre Articulo" />
		<p id="validanombre" hidden>*</p>
		</br></br>
		<label class="control-label" for="autorarticu">Autor Articulo  </label>
		<input id="autorarticu" name="autorarticu" class="input-xlarge focused" type="text" value="" placeholder="Autor Articulo" />
		<p id="validaautor" hidden>*</p>
		<!--?php $this->load->view($tiposArticulo->row()->nombretipoarticulo); ?-->
		</br></br>
		<label class="control-label" for="selectarticu">Tipo Articulo</label>	
        <select id="selectarticu" name="selectarticu" style="width: 200px;">
            <option value="-1">-- Seleccione Tipo --</option>
            <?php
                foreach ($tipoarticulos->result() as $tipo) {
                    echo '<option value="'.$tipo->idtipoarticulo.'">'.$tipo->nombretipoarticulo.'</option>';
                }
            ?>
        </select>
        <p id="validatipo" hidden>*</p>
		</br></br>
		<label class="control-label" for="valorArti">Valor Articulo</label>

		<span class="add-on">$ </span>
        <input id="valorarti" name="valorarti" style="margin-left: -5px;" size="16" placeholder="valor" type="text" >
        <p id="validavalor" hidden>*</p>
        </br></br>
        <label class="control-label" for="valorartiventa">Valor venta</label>

		<span class="add-on">$ </span>
        <input id="valorartiventa" name="valorartiventa" style="margin-left: -5px;" size="16" placeholder="valor" type="text" >
        <p id="validavalorventa" hidden>*</p>
        </br></br>
        <div id="msgerror" style="display: none;"></div>
		<div style="text-align: right;">
            <button id="btnAccion" type="submit" >guardar</button>
		</div>
	<?php echo form_close(); ?>
</div>

<table id="tblArticulo" cellpadding="2px" style="width: 100%;" class="table table-bordered datatable">
	<thead>
		<tr>
			<th style="text-align: center;">
				ID
		  	</th>
			<th style="text-align: center;">
				CODIGO
		  	</th>
		  	<th style="text-align: center; width: 30%;">
				NOMBRE
		  	</th>
			<th style="text-align: center;">
				AUTOR
			</th>
			<th style="text-align: center;">
				VALOR
			</th>
			<th style="text-align: center;">
				VALOR VENTA
			</th>
			<th style="text-align: center;">
				TIPO
			</th>
			<th style="text-align: center;">
				ACCIONES
			</th>
	  	</tr>
	</thead>   
	<tbody>
	<?php
		foreach ($articulos->result() as $articulo) { 
			echo '<tr id="tr'.$articulo->idarticulo.'">'; ?>
				<td style="text-align: right; padding-right: 5px;">
				  	<?php $hiddens = $articulo->idarticulo.' 
	                <input type="hidden" id="id'.$articulo->idarticulo.'" value="'.$articulo->idarticulo.'" />
	                <input type="hidden" id="codigo'.$articulo->idarticulo.'" name="codigo'.$articulo->idarticulo.'" value="'.$articulo->codigoarticulo.'" />
	                <input type="hidden" id="nombre'.$articulo->idarticulo.'" value="'.$articulo->nombrearticulo.'" />
	                <input type="hidden" id="autor'.$articulo->idarticulo.'" value="'.$articulo->autorarticulo.'" />
	                <input type="hidden" id="tipo'.$articulo->idarticulo.'" value="'.$articulo->tipoarticulo.'" />
	                <input type="hidden" id="nombretipo'.$articulo->idarticulo.'" value="'.$articulo->nombretipoarticulo.'" />
	                <input type="hidden" id="valor'.$articulo->idarticulo.'" value="'.$articulo->valorarticulo.'" />
	                <input type="hidden" id="valorventa'.$articulo->idarticulo.'" value="'.$articulo->valorarticuloventa.'" />
	                ';
	                echo $hiddens; ?>
				</td>
				<td style="text-align: right;">
				    <?= $articulo->codigoarticulo; ?>
				</td>
				<td>
				    <?php echo $articulo->nombrearticulo ?>
				</td>
				<td>
				    <?php echo $articulo->autorarticulo ?>
				</td>
				<td style="text-align: right;">
					<?= "$ ".$articulo->valorarticulo; ?>
				</td>
				<td style="text-align: right;">
					<?= "$ ".$articulo->valorarticuloventa; ?>
				</td>
				<td>
				    <?php echo $articulo->nombretipoarticulo ?>
			    </td>
				<td style="text-align: center;">
					<!--a class="btn btn-success" href="#" onclick="editar">
						<i class="icon-zoom-in icon-white"></i>  
						View                                            
					</a-->
					<?php echo '<a id="btnEditar'.$articulo->idarticulo.'" href="#" onmousedown="javascript:editarArticulo('.$articulo->idarticulo.');">' ?>
						<i class="icon-edit icon-white"></i>
						Editar
					</a>
				<!--?php $atributo = array('class'=>'btn btn-info',
										'id'=>'btnEditar' 
					                   );
				  //echo anchor('inicio/inicio/editar/'.$articulo->idarticulo.'', '<i class="icon-edit icon-white"></i> Editar', $atributo);
				  //echo anchor('', '<i class="icon-edit icon-white"></i> Editar', $atributo);
				? -->
				</td>
			</tr>
	<?php
		}
	?>
	</tbody>
</table>