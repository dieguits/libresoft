<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Reporte <small>de Venta.</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>

                <!--FORMULARIO -->
                <?php echo form_open('/reportes/venta/ventareport', array('id' => 'frmImprimeVenta', 'enctype' => 'multipart/form-data')); ?>
                <div class="ibox-content">

                	<div class="row">
						<div class="col-md-4 col-md-offset-4">
		                	<div class="form-group" id="data_5">
		                        <label>Rango de fechas</label>
		                        <div class="input-daterange input-group" id="datepicker">
		                            <input id="fini" name="fini" type="text" class="input-sm form-control" name="start" value=""/>
		                            <span class="input-group-addon">to</span>
		                            <input id="fin" name="fin" type="text" class="input-sm form-control" name="end" value="" />
		                        </div>
		                    </div>
						</div>
					</div>
                    <div class="row">
                        <!--div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label class="control-label">Descripción Servicio</label>
                                <textarea id="descripcion" name="descripcion" placeholder="Descripción Servicio"
                                          class="form-control" rows="5" cols="25"></textarea>
                            </div>
                        </div-->
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-sm-4 col-sm-offset-6">
                                    <input type="button" id="cancelar" name="cancelar" 
                                           value="Cancelar" onclick="limpiarForm()" class="btn btn-white">
                                    <input type="submit" id="guardar" value="Imprimir" class="btn btn-primary">
                                    <input type="submit" id="consultar"  value="Consultar" class="btn btn-primary"> 
                                    <!--a href="#" onclick="consultarVentas();">Consultar</a onclick="consultarVentas();"-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

    <!------------------------------------------------------------------------>
    <!------------------------------TABLA ------------------------------------>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Reporte</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <table id="dtreporte" 
                           class="table table-striped table-bordered table-hover" >
                        <thead>
                            <tr>                                
                                <th>Numero</th>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                                <th>Valor Uni</th>
                                <th>Valor Tot</th>
                                <th>Usuario</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <!----------------------------FIN TABLA----------------------------------->
    <!------------------------------------------------------------------------>

</div>

<!-- Data Tables -->
<script src="<?php echo base_url(); ?>public/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>public/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>public/js/plugins/dataTables/dataTables.responsive.js"></script>
<script src="<?php echo base_url(); ?>public/js/plugins/dataTables/dataTables.tableTools.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/plugins/jeditable/jquery.jeditable.js"></script>
<!-- Data Tables -->

<!-- Page-Level Scripts -->
<script>
    $(document).ready(function() {
        var oTable = $('.dataTables-example').dataTable({
            responsive: true,
            "dom": 'T<"clear">lfrtip',
            /*"tableTools": {
             "sSwfPath": "< ?php echo base_url(); ?>public/js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
             }*/
            language: {
                url: '<?php echo base_url(); ?>public/js/plugins/dataTables/Spanish.json'
            }
        });

        /* Init DataTables */
        $('#editable').dataTable();

        /*Apply the jEditable handlers to the table 
         oTable.$('td').editable('../example_ajax.php', {
         "callback": function(sValue, y) {
         var aPos = oTable.fnGetPosition(this);
         oTable.fnUpdate(sValue, aPos[0], aPos[1]);
         },
         "submitdata": function(value, settings) {
         return {
         "row_id": this.parentNode.getAttribute('id'),
         "column": oTable.fnGetPosition(this)[2]
         };
         },
         "width": "90%",
         "height": "100%"
         });*/


    });

    function fnClickAddRow() {
        $('#editable').dataTable().fnAddData([
            "Custom row",
            "New row",
            "New row",
            "New row",
            "New row"]);

    }
</script>
<style>
    body.DTTT_Print {
        background: #fff;

    }
    .DTTT_Print #page-wrapper {
        margin: 0;
        background:#fff;
    }

    button.DTTT_button, div.DTTT_button, a.DTTT_button {
        border: 1px solid #e7eaec;
        background: #fff;
        color: #676a6c;
        box-shadow: none;
        padding: 6px 8px;
    }
    button.DTTT_button:hover, div.DTTT_button:hover, a.DTTT_button:hover {
        border: 1px solid #d2d2d2;
        background: #fff;
        color: #676a6c;
        box-shadow: none;
        padding: 6px 8px;
    }

    .dataTables_filter label {
        margin-right: 5px;

    }
</style>
<!-- Page-Level Scripts -->

<!-- /////////////////////////////////////////////////////////////-->
<!--div style="margin: 0 auto; text-align:center;">
	
	<label for="fini">Fecha Inicio: </label>
	<input type="date" id="fini" name="fini">&nbsp&nbsp

	<label for="fin">Fecha Fin: </label>
	<input type="date" id="fin" name="fin">&nbsp&nbsp&nbsp

	<a href="#" onclick="consultarVentas();">Consultar</a>
	<a href="../../files/pdfs/reporteVenta.pdf" target="_blank">PDF</a>
	<? php echo form_open('/reportes/venta/ventareport', array('id'=>'frmImprimeVenta')); ?>
		<input type="submit" value="Imprimir">
	<? php echo form_close(); ?>

</div>
</br></br>
<div id="reporte" name="reporte" style="text-align: center;">
	<table style="width: 80%" id="rptventa">
		<thead>
			<tr  id="columnas">
				<th>
					NOMBRE
				</th>
				<th>
					CANTIDAD
				</th>
				<th>
					VALOR UNI
				</th>
				<th>
					VALOR TOT
				</th>
				<th>
					USUARIO
				</th>
				<th>
					FECHA
				</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div -->