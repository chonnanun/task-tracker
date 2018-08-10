<style type="text/css">
    .lastupdated td {
    background-color: #dcffd9;
    font-weight: bold;
    color: #129e02;
    transition: background-color 1s linear;
}

.quickassign {
    width: 60%;
}

.lastupdated {
    background-color: #94ea9e;
}

span.colorbar-default {
    display: inline-block;
    padding: 2px;
    background-color: #eaeaea;
    width: 100%;
    text-align: center;
}

.row-RLSE td {
    background-color: #e3ffd7;
}

.row-Pending td {
    background-color: rgba(255, 255, 192, 0.88);
}

.oversla {
    background-color: #FF0000 !important;
    color: #FFF;
}

input[type="search"] {
    width: 300px;
}

table {
  width: 100%;
  overflow-x: scroll;
  overflow-y: auto;
}

th {
    padding: 6px !important;
}

/* Custom column*/
th.cust-causes {
    min-width: 200px;
}
th.cust-othercause.sorting {
    min-width: 200px;
}

th.custcols {
    min-width: 100px;
}

th.cust-shift {
    min-width: 20px;
}

th.cust-CAT {
    min-width: 20px;
}

th.default-assign {
    min-width: 160px;
}
.whitebar {
    background-color: #fffb81 !important;
    border-top: #bfbfbf solid 2px;
}

table.ui-datepicker-calendar td {
    text-align: center;
}

div#ui-datepicker-div {
    background-color: #ffca00;
    padding: 20px;
}

td.ui-datepicker-current-day {
    background-color: #ffe78c;
    border: #e42828 solid 1px;
}

td.ui-datepicker-today {
    background-color: #f3ff8c;
}

a.ui-datepicker-next.ui-corner-all {
    text-align: right;
    float: right;
}

.ui-datepicker-title {
    text-align: center;
    font-size: 20px;
}

table.ui-datepicker-calendar td a {
    color: #c70000;
    font-weight: bold;
}
thead {
    background-color: #d0cfca;
}


.tablealert {
    background-color: rgba(255, 203, 5, 0.26);
}
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
<!--     <section class="content-header">
      <h1>
        <?= $groupName; ?> - Tasks
        <small>Add, Edit, Delete</small>
      </h1>
    </section> -->


    <section class="newcontent" style="display:none">
        <div class="row" style="display:none">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?= $today ?></h3>
                        <p>งานวันนี้</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="<?= base_url()?>tasks?task=today" class="small-box-footer">ดูเฉพาะงานวันนี้ <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>53<sup style="font-size: 20px">%</sup></h3>
                        <p>งานที่ยังค้าง</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="<?= base_url()?>tasks?task=done" class="small-box-footer">ดูเฉพาะงานที่เสร็จแล้ว <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?= $all ?></h3>
                        <p>งานของฉัน</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="http://localhost/DHL/task-tracker/tasks?task=remain" class="small-box-footer">ดูเฉพาะงานที่ค้าง <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>65</h3>
                        <p>งานที่เกินกำหนด</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="<?= base_url()?>tasks?task=overdue" class="small-box-footer">ดูเฉพาะงานที่เกินกำหนด <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
        </div>
    </section>


    <section class="content">
        <div class="row">
            <div class="col-xs-3">
                <fieldset>
                        <legend><?= $groupName; ?></legend>
                </fieldset>
                <div class="form-group">
                    <label>Report Monthly Summary</label>
                    <select id="report_year">
                        <option value="2016" <?php if(date('Y') == "2016") echo "selected"; ?>>2016</option>
                        <option value="2017" <?php if(date('Y') == "2017") echo "selected"; ?>>2017</option>
                        <option value="2018" <?php if(date('Y') == "2018") echo "selected"; ?>>2018</option>
                        <option value="2019" <?php if(date('Y') == "2019") echo "selected"; ?>>2019</option>
                        <option value="2020" <?php if(date('Y') == "2020") echo "selected"; ?>>2020</option>
                    </select>

                    <select id="report_month">
                        <option value="01" <?php if(date('m') == "1") echo "selected"; ?>>01</option>
                        <option value="02" <?php if(date('m') == "2") echo "selected"; ?>>02</option>
                        <option value="03" <?php if(date('m') == "3") echo "selected"; ?>>03</option>
                        <option value="04" <?php if(date('m') == "4") echo "selected"; ?>>04</option>
                        <option value="05" <?php if(date('m') == "5") echo "selected"; ?>>05</option>
                        <option value="06" <?php if(date('m') == "6") echo "selected"; ?>>06</option>
                        <option value="07" <?php if(date('m') == "7") echo "selected"; ?>>07</option>
                        <option value="08" <?php if(date('m') == "8") echo "selected"; ?>>08</option>
                        <option value="09" <?php if(date('m') == "9") echo "selected"; ?>>09</option>
                        <option value="10" <?php if(date('m') == "10") echo "selected"; ?>>10</option>
                        <option value="11" <?php if(date('m') == "11") echo "selected"; ?>>11</option>
                        <option value="12" <?php if(date('m') == "12") echo "selected"; ?>>12</option>

                    </select>

                    <button onclick='goReport(event);'>view report</button>
                </div>

                <script type="text/javascript">
        function goReport(event) {
            event.preventDefault();
            year = $('#report_year').val();
            month = $('#report_month').val();
            window.open("<?php echo base_url()."tasks/report/monthly/"; ?>"+year+"/"+month, "_blank", "toolbar=no,scrollbars=yes,resizable=no,top=100,left=100,width=600,height=600");
        }
                </script>

<!--               <h1>
                <?= $groupName; ?> - Tasks
                <small></small>
              </h1> -->
            </div>

            <div class="col-xs-5 text-center">
                <div class="form-group">
                <fieldset>
                    <legend>Filter</legend>

                    From | จาก: <input type="text" id="datepicker1" value="<?= date('Y-m-d',strtotime("last week")) ?>" style="width: 90px;">
                    To | ถึง: <input type="text" id="datepicker2" value="<?= date('Y-m-d',strtotime("now")) ?>" style="width: 90px;">

                    <input type="checkbox" name="onlypending" id="onlypending" value="pending" <?php if($status=='pending') { echo " checked"; } ?>> แสดงเฉพาะงานที่ยังไม่เสร็จเท่านั้น
                    <a class="btn btn-default" href="#" onclick='filter(event);' style="background-color: #ffcb05;">Filter</a>
                </fieldset>
                </div>
            </div>


            <div class="col-xs-3 text-center">
                <div class="form-group">
                <fieldset>
                    <legend>Add / เพิ่มใหม่</legend>
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>task/addNew">Add New</a>

                    <a class="btn btn-success" href="#" onclick='linkopen(event);'>Easy Add</a>

                    <a class="btn btn-warning" href="#" onclick='linkopen2(event);'>Batch Add</a>
                </fieldset>
                </div>

            </div>
        </div>

        <?php
            if(!empty($filter)) { 
        ?>
        <script type="text/javascript">
            $('#datepicker1').val("<?= $filter['from'] ?>");
            $('#datepicker2').val("<?= $filter['to'] ?>");
        </script>
        <?php } ?>


        <script>

        // $( function() {
        //     $( "#datepicker" ).datepicker();
        //   } );

        $('#datepicker1').keypress(function (e) {
          if (e.which == 13) {
            filter();
            return false;    //<---- Add this line
          }
        });
        $('#datepicker2').keypress(function (e) {
          if (e.which == 13) {
            filter();
            return false;    //<---- Add this line
          }
        });



        function filter() {
            from = $('#datepicker1').val();
            to = $('#datepicker2').val();
            if($('#onlypending').prop( "checked" )) {
                status = $('#onlypending').val();
                status = 'all';
            } else {
                status = 'all';
            }
            
            url = "<?= base_url()?>tasks/1/"+from+"/"+to+"/"+status+"?"+"<?= $_SERVER['QUERY_STRING'] ?>";
            // console.log(url);
            window.location.href = url;
        }


        function linkopen(event) {
            event.preventDefault();
            window.open("<?php echo base_url()."task/addNew?mode=easy"; ?>", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=100,width=400,height=600");
        }

        function linkopen2(event) {
            event.preventDefault();
            window.open("<?php echo base_url()."task/addNewBatch"; ?>", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=100,width=400,height=600");
        }
        </script>


        <!-- Today Task List-->

 <?php //print_r($customfields); ?>
        <!-- All Task List-->
        <div class="row allbox boxen">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">All Task List</h3>
                        <div class="box-tools">
                            <form action="<?php echo base_url() ?>taskListing" method="POST" id="searchList">
                                <div class="input-group" style="display: none;">
                                    <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                    <div class="alert alert-default tablealert" role="alert">
                      <span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span>
                      <span class="sr-only">Info:</span>
                      [08/06/2017] ได้ทำการปรับเปลี่ยนการแสดงผลในหน้าตารางเป็นข้อมูล 3 วันย้อนหลังเพื่อแก้ปัญหาแสดงผลช้า หากไม่เจองานที่ค้นหาหรืองานที่ค้นหาเก่ากว่า 3 วัน ให้เลือกวันที่ (From - จาก) ในส่วน Filter ด้านบนเป็นวันที่ต้องการ และกด Filter
                    </div>

                        <table class="table table-hover" id="reporttbl">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title / HWB</th>
                                <th>Status</th>
                                <th style="min-width: 120px;">Description</th>
                                <th style="min-width: 80px;">Created Date</th>

                                <th style="min-width: 80px;">Last update</th>
                                <th style="min-width: 80px;">SLA date</th>
                                <th class="default-cats">Category</th>
                                <th class="default-assign">Assigned To</th>
                                <th class="default-assign">Assigned To</th>
                                <th style="width: 1px; display: none"></th>

                                <?php
                                foreach($customfileds_head as $field )
                                { 
                                ?>
                                <th class="custcols cust-<?= $field ?>"><?= $function->showKey($field) ?></th>
                                <?php
                                }
                                ?>

          
                            </tr>
                            </thead>
<!--                             <tbody>
                            
                            </tbody> -->

                            <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Title / HWB</th>
                                <th>Status</th>
                                <th style="min-width: 120px;">Description</th>
                                <th style="min-width: 80px;">Created Date</th>

                                <th style="min-width: 80px;">Last update</th>
                                <th style="min-width: 80px;">SLA date</th>
                                <th class="default-cats">Category</th>
                                <th class="default-assign">Assigned To</th>
                                <th class="default-assign">Assigned To</th>
                                <th style="width: 1px; display: none"></th>

                                <?php
                                foreach($customfileds_head as $field )
                                { 
                                ?>
                                <th class="custcols cust-<?= $field ?>"><?= $function->showKey($field) ?></th>
                                <?php
                                }
                                ?>

          
                            </tr>
                            </tfoot>


                        </table>

                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <?php echo $this->pagination->create_links(); ?>
                    </div>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>

  <script>
        function assigned(id) {
            event.preventDefault();

            <?php if($role >=4) { ?>
                // alert("you have no permission to change task owner. ต้องเป็น Supervisor ขึ้นไปเท่านั้น");
                exit();
            <?php } ?>

            now = $('#assigned-'+id).html();
            $('#now-user-'+id).hide();
            $('#new-user-'+id).show();


            // alert(now);


            // window.open("<?php //echo base_url()."task/addNew?mode=easy"; ?>", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=100,width=400,height=600");
        }

         function doAssign(id) {
            newuser = $('#select-new-'+id).find(":selected").val();
            newusertxt = $('#select-new-'+id).find(":selected").text();
            $.ajax({
               type: "GET",
               url: "<?php echo base_url() ?>assignTask/"+id+"/"+newuser,
               success: function(result){
                    $('#new-user-'+id).hide();
                    $('#now-user-'+id).html(newusertxt).show().addClass('lastupdated');

                   }
             });
         }

        $('.cancleassign').click(function(){
            $(this).parent().hide();
            $(this).parent().siblings().show();
        });


        function linkedit(id) {
            event.preventDefault();
            window.open("<?php echo base_url()."task/view/"; ?>"+id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=100,width=1050,height=600");
        }

</script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();
            var link = jQuery(this).get(0).href;
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "taskListing/" + value);
            jQuery("#searchList").submit();
        });




        jQuery('.deleteTaskBtn').click(function(){
            var taskId = $(this).data("taskid"),
                hitURL = baseURL + "tasks/deleteTask",
                currentRow = $(this);

            var confirmation = confirm("Are you sure to delete task? คุณต้องการลบ? การลบนี้จะถูกบันทึกลงระบบ กด OK หากยืนยัน");

            if(confirmation)
            {
                jQuery.ajax({
                    type : "POST",
                    url : hitURL,
                    data : { taskId : taskId }
                }).done(function(data){
                    currentRow.parents('tr').remove();
                    if(data.status = true) { alert("Successfully deleted"); }
                    else if(data.status = false) { alert("Deletion failed"); }
                    else { alert("Access denied..!"); }
                });
            }

        });

    });
</script>
<?php if(isset($_GET["updated"])){ ?>
    <script type="text/javascript">
        jQuery('#row-<?= $_GET["updated"] ?>').addClass("lastupdated");
    </script>
<?php } ?>

<?php if(isset($_GET["task"]) && $_GET["task"] == 'today'){ ?>
    <script type="text/javascript">
        jQuery('.boxen').hide();
        jQuery('.todaybox').show();
    </script>
<?php } else if(isset($_GET["task"]) && $_GET["task"] == 'all'){ ?>
    <script type="text/javascript">
        jQuery('.boxen').hide();
        jQuery('.allbox').show();
    </script>
<?php } else if(isset($_GET["task"]) && $_GET["task"] == 'done'){ ?>
    <script type="text/javascript">
        jQuery('.boxen').show();
        // jQuery('.todaybox').show();
    </script>
<?php } ?>


  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
  <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script type="text/javascript">
    
            // var $j = jQuery.noConflict();
            $("#datepicker1").datepicker({
              dateFormat: "yy-mm-dd"
            });

            $("#datepicker2").datepicker({
              dateFormat: "yy-mm-dd"
            });

            $('body').removeClass().addClass('skin-blue sidebar-mini sidebar-collapse');



</script>

<script type="text/javascript">
            

        $(document).ready(function() {

            $('#reporttbl thead th').each( function () {
                var title = $(this).text();
                $(this).html( title + '<input type="text" placeholder=" '+title+'" style="width:100%; background-color: #ecf0f5; font-size: 10px;" />' );
            } );


            var table = $('#reporttbl').DataTable( {
                "ajax": "<?= base_url()?>data/legal.txt",
                "deferRender": true,


                "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
                "iDisplayLength": 5,
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
                            columns: [ 0,1,2,4,7,9,10,11,12,13,14,15,16]
                        }
                    },
                    {
                        extend: 'excel',
                        text: 'Excel',
                        exportOptions: {
                            columns: [ 0,1,2,4,7,9,10,11,12,13,14,15,16]
                            // modifier: {
                            //     page: 'current'
                            // }
                        }
                    }
                    ,
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [ 0,1,2,4,7,9,10,11,12,13,14,15,16]
                        }
                    }
                    ,
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: [ 0,1,2,4,7,9,10,11,12,13,14,15,16]
                        }
                    }
                ],

                "columnDefs": [
                    {
                        "targets": [ 1 ],
                        "visible": true,
                        "searchable": true
                    }
                    ,{
                        "targets": [ 2 ],
                        "visible": false
                    }
                    ,{
                        "targets": [ 3 ],
                        "visible": true
                    }
                    ,{
                        "targets": [ 4 ],
                        "visible": true
                    }
                    ,{
                        "targets": [ 5 ],
                        "visible": true
                    },{
                        "targets": [ 9 ],
                        "visible": false
                    }
                ]
            } );

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


        } );



</script>


