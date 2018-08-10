<style>
.box.box-primary {
    border-top-color: #e48105;
}

span.netbaykey {
    display: inline-block;
    background-color: #e48105;
    color: #FFF;
    min-width: 136px;
    padding: 2px;
    margin-bottom: 2px;
    text-align: left;
}
span.netbayval {
    background-color: #eeeeee;
    padding: 2px;
    min-width: 500px;
    display: inline-block;
}

</style>
<?php

    if(!empty($taskRecords)) {
        $taskRecords = $taskRecords[0];
        $taskRecords->id = $id;
//        print_r($taskRecords);

        $created_date = date('d-m-Y', strtotime($taskRecords->created_at));
        $SLADate = date('d-m-Y',strtotime(("+".$taskRecords->sla." day"), strtotime($taskRecords->created_at)));

        $addon = "";
        if(!empty($taskRecords->addonstatus)) {
            $addon = json_decode($taskRecords->addonstatus);
        }

        $task =array(
            'id' => $id,
            'title' => $taskRecords->title,
            'description' => $taskRecords->description,
            'assigned' => $taskRecords->assigned,
            'assigned_to' => $taskRecords->assigned_to,
            'category' => $taskRecords->category,
            'status' => $taskRecords->status,
            'groupId' => $taskRecords->groupId,
            'last_updated' => $taskRecords->last_updated,
            'created' => $taskRecords->created_at,
            'deadline' => $SLADate,
            'sla' => $taskRecords->sla,
            'customfield' => $addon
        );
    } else {
        $task =array(
            'id' => '',
            'title' => '',
            'description' => '',
            'assigned' => '',
            'assigned_to' => '',
            'category' =>'',
            'status' => 1,
            'groupId' => $usergroup,
        );
    }


?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Task Management
        <small>Add / Edit Task</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">


                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">รายละเอียด #<?= $task['id'] ?> - <?= $task['title'] ?></h3>

                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php
                        $formURL = base_url().'task/editTask';
                    ?>
                    <form role="form" id="task" action="<?php echo $formURL ?>" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="created_date">
                                        สร้างเมื่อ
                                        <?= date('d/m/Y เวลา H:i', strtotime($task['created'])); ?> |
                                        แก้ไขล่าสุด
                                        <?= date('d/m/Y เวลา H:i', strtotime($task['last_updated'])); ?> |
                                        กำหนดแล้วเสร็จ
                                        <?= date('d/m/Y', strtotime($task['deadline'])); ?>
                                    </h5>
                                </div>


                                <div class="col-md-12" style="visibility: hidden; height: 0px">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" class="form-control required" id="description" name="description" style="width:100% ;height:150px;" disabled><?= $task['description'] ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">รายละเอียดเพิ่มเติม</label>
                                        <textarea name="description" class="form-control required" id="description" name="description" style="width:100% ;height:150px;" autofocus></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="assign">มอบหมายงานให้กับ</label>
                                        <input type="text" class="form-control required" id="assign"  name="assign" maxlength="100" value="<?= $task['assigned'] ?>" style="width: 300px;">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Group</label>
                                        <select class="form-control required" id="group" name="group" <?php //if($role >2) echo "disabled"; ?>>
                                            <option value="0">Select Group</option>
                                            <?php
                                            if(!empty($group))
                                            {
                                                foreach ($group as $g)
                                                {
                                                    ?>
                                                    <option value="<?php echo $g->id ?>" <?php if($task['groupId']==$g->id) echo "selected=selected"; ?>><?php echo $g->group_name_TH ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-0">
                                    <div class="form-group">
                                        <label for="UserId"></label>
                                        <input type="hidden" class="form-control required equalTo" id="UserId" name="UserId" maxlength="10" value="<?= $task['assigned_to'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Status</label>
                                        <select class="form-control required" id="status" name="status">
                                            <option value="0">Select Status</option>
                                            <?php
                                            if(!empty($status))
                                            {
                                                foreach ($status as $s)
                                                {
                                                    ?>
                                                    <option value="<?php echo $s->statusId ?>" <?php if($task['status']==$s->statusId) echo "selected=selected"; ?>><?php echo $s->statusName ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Category</label>
                                        <select class="form-control required" id="cats" name="cats">
                                            <option value="0">Select Category</option>
                                            <?php
                                            if(!empty($cats))
                                            {
                                                foreach ($cats as $cat)
                                                {
                                                    ?>
                                                    <option value="<?php echo $cat->categoryId ?>" <?php if($task['category']==$cat->categoryId) echo "selected=selected"; ?>><?php echo $cat->name ?> (SLA = <?php echo $cat->sla ?> days)</option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <?php if(!empty($customfields)){ ?>
                                <div class="row">
                                    <hr>
                                    <!-- <div class="col-md-6"> -->
                                        <div style="text-align: center"><button class="btn btn-default" id="syncnow">Sync data from SPN</button></div>
                                    <!-- </div> -->
                                    <hr>
                                    <!--                                --><?php //print_r($customfields->fields); ?>
                                    <?php foreach($customfields->fields as $key=>$val){ ?>
                                    <?php
                                        $colwidth = 6;
                                        $minicols = ["Agent"];
                                        $microcols = [
                                            "shift","refNo","preCaseNo","preCaseDate","preCaseCloseDate","caseNo","caseDate","caseCloseDate","importDate",
                                                "amount","dutyAmount","paidby","chequeStatus",
                                                "dutyPaidby","dutyChequeStatus",
                                                "dutyChequeDate","chequeDate","chequeNo","dutyChequeNo"
                                            ];
                                        $supermicro = ["CAT",];
                                        $mediumocols = ["consignee"];

                                        if(in_array($key, $minicols)) {
                                            $colwidth = 5;
                                        } else if(in_array($key, $microcols)) {
                                            $colwidth = 4;
                                        } else if(in_array($key, $mediumocols)) {
                                            $colwidth = 6;
                                        } else if(in_array($key, $supermicro)) {
                                            $colwidth = 2;
                                        } 
                                    ?>
                                        <?php if(is_array($val)){ ?>

                                            <div class="col-md-<?= $colwidth ?>">
                                                <div class="form-group">
                                                    <label for="role"><?= $function->showKey($key) ?></label>
                                                    <select class="form-control required" id="custom-<?= $key ?>" name="custom[<?= $key ?>]">
                                                        <option value="0">Select <?= $key ?></option>
                                                        <?php
                                                            // print_r($task['customfield']->$key);
                                                        if(!empty($val))
                                                        {
                                                            foreach ($val as $v)
                                                            {
                                                                ?>
                                                                <option value="<?php echo $v ?>" <?php 
                                                                    if(is_object($task['customfield'])){
                                                                        if(isset($task['customfield']->$key) && $task['customfield']->$key == $v) {
                                                                            echo "selected=selected";
                                                                        }
                                                                    }

                                                                ?>><?php echo $v ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>


                                        <?php } else { 

                                            ?>
                                            <?php if($key == "chequeNo" || $key == "dutyChequeNo" || $key == "paidby" || $key == "dutyPaidby") { ?>
                                                <div class="col-md-12" style="clear:both;height: 20px;"></div>
                                            <?php } ?>
                                            <?php
                                            
                                            if(empty($task['customfield']->$key)) {
                                                $task['customfield']->$key = "";
                                            }
                                            ?>
                                            <div class="col-md-<?= $colwidth ?>">
                                                <div class="form-group">
                                                    <label for="assign"><?= $function->showKey($key) ?></label>
                                                    <input type="text" class="form-control required" id="vcustom-<?= $key ?>"  name="custom[<?= $key ?>]" value="<?php if(is_object($task['customfield'])) echo $task['customfield']->$key; ?>" >
                                                </div>
                                            </div>
                                        <?php } } ?>



                                </div>
                            <?php } ?>


                        </div><!-- /.box-body -->


                        <input type="hidden" class="form-control required" id="taskId"  name="taskId" maxlength="50" value="<?= $task['id'] ?>">
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Task Tracking</h3>
                            </div><!-- /.box-header -->
                        <div class="box-body">
                            <form role="form" id="task" action="<?php echo base_url() ?>task/addTaskLog/<?= $task['id'] ?>" method="post" role="form">
<!--                                 <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Log</label>
                                        <textarea name="description" class="form-control required" id="description" name="description" style="width:100% ;height:150px;" autofocus></textarea>
                                    </div>
                                </div> -->

<!--                                 <div class="box-footer" style="text-align: right;">
                                    <input type="hidden" name="oldstatus" value="<?= $task['status'] ?>">
                                    <select class="form-control required" id="status" name="status" style="width: 100px; float: left;">
                                        <option value="0">Select Status</option>
                                        // <?php 
                                        // if(!empty($status))
                                        // {
                                        //     foreach ($status as $s)
                                        //     {
                                        //         ?>
                                        //         <option value="<?php echo $s->statusId ?>" <?php if($task['status']==$s->statusId) echo "selected=selected"; ?>><?php echo $s->statusName ?></option>
                                        //         <?php
                                        //     }
                                        // }
                                        ?>
                                    </select>

                                    <input type="submit" class="btn btn-primary" value="Submit Update" />
                                <input type="reset" class="btn btn-default" value="Reset" /> 
                                </div> -->
                            </form>

                            <div class="trackinglog">
                                <?php
                                    foreach($tasklog as $log) {
                                        ?>
                                        <div class="panel">
                                            <h5><?= date('d/m/Y เวลา H:i', strtotime($log->created_at)); ?> - <?= $log->name ?></h5>
                                            <p><?= $log->detail ?></p>
                                        </div>

                                <?php
                                    }
                                ?>



                            </div>


                        </div>
                    </div>
                </div>

            </div>
        </div>    
    </section>
    
</div>
<script src="<?php echo base_url(); ?>assets/js/addUser.js" type="text/javascript"></script>

<script>
    jQuery.fn.extend({
        insertAtCaret: function(myValue){
            return this.each(function(i) {
                if (document.selection) {
                    //For browsers like Internet Explorer
                    this.focus();
                    var sel = document.selection.createRange();
                    sel.text = myValue;
                    this.focus();
                }
                else if (this.selectionStart || this.selectionStart == '0') {
                    //For browsers like Firefox and Webkit based
                    var startPos = this.selectionStart;
                    var endPos = this.selectionEnd;
                    var scrollTop = this.scrollTop;
                    this.value = this.value.substring(0, startPos)+myValue+this.value.substring(endPos,this.value.length);
                    this.focus();
                    this.selectionStart = startPos + myValue.length;
                    this.selectionEnd = startPos + myValue.length;
                    this.scrollTop = scrollTop;
                } else {
                    this.value += myValue;
                    this.focus();
                }
            });
        }
    });

    $( document ).ready(function() {
//        var options = {
//            data: ["blue", "green", "pink", "red", "yellow"]
//        };



        var options = {
            url: "<?php echo base_url() ?>task/getUsers",

            getValue: "name",

            list: {
                match: {
                    enabled: true
                },
                onClickEvent: function() {
                    var value = $("#assign").getSelectedItemData().userId;
                    $("#UserId").val(value).trigger("change");
                }
            }
        };


        $("#assign").easyAutocomplete(options);

        $("#syncnow").click(function() {
            
            hawb = <?= $task['title'] ?>;

            var jqxhr = $.getJSON( "http://23.168.85.150:8081/task-tracker/nbapi/gethawb/"+hawb, function() {
              console.log( "success" );
            })
              .done(function(data) {
                console.log( data );
                // console.log( data.id );
                $('#custom-consignee').val(data.company_name_e);
                // $('#custom-refNo').val(data.declarationRef);

              })
              .fail(function() {
                console.log( "error" );
              })
              .always(function() {
                console.log( "complete" );
              });



            // alert('Sync '+hawb);
            return false;
        });

    });
</script>

<script>
    $("#assign").change(function(){
            if( $(this).val().length === 0 ) {
                $("#UserId").val(0);
            }
    });
</script>

<?php 
    if($role >=4) {
?>
<script>
    $( "#assign" ).prop( "disabled", true ); 
</script>
<?php 
    }
?>

<?php 
    if($role >=1) {
?>
<script>
    $( "#group" ).prop( "disabled", true ); 
</script>
<?php 
    }
?>


<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->


    <script type="text/javascript">
            $("#vcustom-caseDate").datepicker({
              dateFormat: "yy-mm-dd"
            });

            $("#vcustom-importDate").datepicker({
              dateFormat: "yy-mm-dd"
            });

            $("#vcustom-preCaseDate").datepicker({
              dateFormat: "yy-mm-dd"
            });

            $("#vcustom-preCaseCloseDate").datepicker({
              dateFormat: "yy-mm-dd"
            });

            $("#vcustom-preCaseCloseDate").datepicker({
              dateFormat: "yy-mm-dd"
            });

            $("#vcustom-caseCloseDate").datepicker({
              dateFormat: "yy-mm-dd"
            });
            
            $("#vcustom-chequeDate").datepicker({
              dateFormat: "yy-mm-dd"
            });
            $("#vcustom-dutyChequeDate").datepicker({
              dateFormat: "yy-mm-dd"
            });
  </script>