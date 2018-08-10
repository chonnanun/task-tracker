<html>
<head>
	<title>Report 1 Legal team - เดือน <?= $mo ?>/<?= $year ?></title>
	<script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js"></script>

    <!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/datatables.min.js"></script>  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.15/b-1.3.1/b-colvis-1.3.1/b-flash-1.3.1/b-html5-1.3.1/b-print-1.3.1/cr-1.3.3/fc-3.2.2/fh-3.1.2/r-2.1.1/rg-1.0.0/rr-1.2.0/sc-1.4.2/se-1.2.2/datatables.min.css"/>
 
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.15/b-1.3.1/b-colvis-1.3.1/b-flash-1.3.1/b-html5-1.3.1/b-print-1.3.1/cr-1.3.3/fc-3.2.2/fh-3.1.2/r-2.1.1/rg-1.0.0/rr-1.2.0/sc-1.4.2/se-1.2.2/datatables.min.js"></script>

	<style type="text/css">
		tfoot {
		    background-color: #e6e6e6;
		    font-size: 17px;
		    font-weight: bolder;
		}	

		thead {
		    background-color: #ffc625;
		}

		td.percent100 {
		    background-color: #dedbdb;
		    border: 2px solid #FFFFFF;
		}

		span.percent {
		    display: block;
		    background-color: #ff9425;
		    width: 100%;
		    height: 25px;
		}

		span.percentnum {
		    margin-top: -20px;
		    display: block;
		    text-align: right;
		    font-size: 14px;
		    font-weight: bold;
		}

		td.fields {
		    text-align: right;
		    font-family: sans-serif;
		}

		td.fields.field-name {
		    text-align: center;
		    font-size: 14px;
		}

		td.fields.field-RLSE {
		    background-color: #d5ffe0;
		}

		td.fields.field-Total {
		    font-weight: bold;
		    background-color: #d8d8d8 !important;
		}

		#reporttb2 tbody tr:hover {
		    background-color: #ffe8a6 !important;
		}

	</style>
</head>
<body>
<?php

	function translate($eng) {
		$text = $eng;
		if($eng == 'total') { return 'รวม'; }
		if($eng == 'Open') { return 'งานใหม่'; }
		if($eng == 'Pending') { return 'งาน Pending'; }
		if($eng == 'Closed') { return 'ปิดงานโดยไม่ RLSE'; }
		if($eng == 'RLSE') { return 'RLSE'; }
		if($eng == 'PassCQL') { return 'Pass CSQ'; }
		if($eng == 'ChangeRef') { return 'เปลี่ยนโพย'; }
		if($eng == 'WaitAgent') { return 'รอเจ้าหน้าที่'; }
		if($eng == 'Delete') { return 'ลบ'; }
		if($eng == 'PassJPV') { return 'Pass JPV'; }
		if($eng == 'WaitCustomer') { return 'รอลูกค้า'; }
		if($eng == 'Total') { return 'รวม'; }

		return $eng;
	}

?>
<h2 style="background-color: #ffbc00;
    text-align: center;
    color: #130000;
    padding: 10px;">
	Summary เดือน <?= $mo ?>/<?= $year ?>
</h2>

<table id='reporttbl'>
<thead>
	<tr>
		<th>Status</th>
		<th>เดือนนี้</th>
		<th></th>
		<th>จำนวนรวมทั้งปี</th>
	</tr>
</thead>
<tbody>
<?php 
	$i = 0;
	foreach ($result['all'][0] as $key => $value) {
		if($result['all'][0]->total == 0) { $result['all'][0]->total = 0.0001; }
		if($key == 'total') continue;
?>
	<tr>
		<td><?= translate($key) ?></td>
		<td><?= $value ?></td>
		<td class="percent100" style="padding: 7px 2px;">
		<span class="percent" style="width: <?= number_format(($result['all'][0]->$key/$result['all'][0]->total)*100,2) ?>%"></span>
		<span class="percentnum"><?= number_format(($result['all'][0]->$key/$result['all'][0]->total)*100,2) ?> %</span></td>
		<td><?= number_format($result['year'][0]->$key,0) ?></td>
	</tr>
<?php
	}
?>

<tfoot>
	<tr>
		<td>TOTAL</td>
		<td><?= number_format($result['all'][0]->total,0) ?></td>
		<td> 100% </td>
		<td><?= number_format($result['year'][0]->total,0) ?></td>
	</tr>
</tfoot>

</tbody>
</table>

<h2 style="background-color: #ffbc00;
    text-align: center;
    color: #130000;
    padding: 10px;">สมาชิก Legal Team เดือน <?= $mo ?>/<?= $year ?></h2>


<table id="reporttb2" class="display">
	<thead>
		<tr>
		<?php foreach ($result['userstatus'][0] as $statushead => $val) { ?>
			<th style="font-size: 12px; width: 40px !important; text-align: center !important;"><?= translate($statushead) ?></th>
		<?php } ?>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($result['userstatus'] as $status) { ?>
			<tr>
			<?php foreach ($status as $key => $userstatus) { ?>
				<td class="fields field-<?= $key ?>"><?= $userstatus ?></td>
			<?php } ?>
			</tr>
		<?php } ?>
	</tbody>
</table>


<ul>
<?php 
	foreach ($member as $key => $value) {
?>
	<li><?= ++$i.") ".($value->name). " " ?></li>
<?php
	}
?>
</ul>


  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
  <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
            

        $(document).ready(function() {


            var table = $('#reporttbl').DataTable( {
                "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
                "iDisplayLength": 50,
                // "scrollY":        "60vh",
                // "scrollCollapse": true,
                // "paging":         false,
                // "stateSave": true,
                "dom": 'Bfrtip',
                // "buttons": [
                //     'copy', 'csv', 'excel', 'print'
                // ],
                "buttons": [
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [ 0,1,2]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [ 0,1,2]
                        }
                    }
                    ,
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: [ 0,1,2]
                        }
                    }
                ],

                "columnDefs": [
                    {
                        "targets": [ 1 ],
                        "visible": true,
                        "searchable": true
                    }
 
                ]
            } );

            table
		    .column( '1:visible' )
		    .order( 'desc' )
		    .draw();

            // Apply the search
            table.columns().every( function () {
                var that = this;
         
                $( 'input', this.header() ).on( 'keyup change', function () {
                    // console.log(this.value);
                    if ( that.search(this.value) !== this.value ) {
                    //     console.log(that.search(this.value));
                        that.search( this.value ).draw();
                    }
                } );
            } );


            var table2 = $('#reporttb2').DataTable(
            {
            	"buttons": [
                    'copy', 'excel', 'print'
                ]
            });
            table2
		    .column( '1:visible' )
		    .order( 'desc' )
		    .draw();


        } );



</script>


    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/app.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/validation.js" type="text/javascript"></script>

</body>
</html>