

<!--     <script type="text/javascript">
    updatedashboard();
    function updatedashboard() {
        var jqxhr = $.getJSON( "http://23.168.85.150:8081/task-tracker/api/dashboard", function() {
              console.log( "success" );
            })
              .done(function(data) {
                console.log( data );
                // console.log( data.id );
                $('#alltotal').html(data.alltotal);
                $('#allpending').html(data.allpending);
                $('#alldone').html(data.alldone);
                $('#latesttask').html("New task @" + data.allnewest.created_at + " | HWB: "+ data.allnewest.title);

              })
              .fail(function() {
                console.log( "error" );
              })
              .always(function() {
                console.log( "complete" );
              });

              window.setTimeout(updatedashboard, 10000);
          }
    

    </script> -->

<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script type="text/javascript">
            $("#custom-caseDate").datepicker({
              dateFormat: "yy-mm-dd"
            });

            $("#custom-importDate").datepicker({
              dateFormat: "yy-mm-dd"
            });

            $("#custom-preCaseDate").datepicker({
              dateFormat: "yy-mm-dd"
            });

            $("#custom-preCaseCloseDate").datepicker({
              dateFormat: "yy-mm-dd"
            });

            $("#custom-preCaseCloseDate").datepicker({
              dateFormat: "yy-mm-dd"
            });

            $("#custom-caseCloseDate").datepicker({
              dateFormat: "yy-mm-dd"
            });


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
  </script> -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>IT team DHL BKKHUB</b> Parinya Panyato / Gett | Version 1.2 major change : new design and system | Develop By Sirikanya Phaktachai / Yuii | Version 1.3 
        </div>
        <strong>Copyright &copy; 2014-2018 <a href="<?php echo base_url(); ?>">IT DHL BKKHUB</a>.</strong> All rights reserved.
    </footer>
    
    <!-- jQuery UI 1.11.2 -->
    <!-- <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script> -->
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/app.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/validation.js" type="text/javascript"></script>

    <script type="text/javascript">
        var windowURL = window.location.href;
        pageURL = windowURL.substring(0, windowURL.lastIndexOf('/'));
        var x= $('a[href="'+pageURL+'"]');
            x.addClass('active');
            x.parent().addClass('active');
        var y= $('a[href="'+windowURL+'"]');
            y.addClass('active');
            y.parent().addClass('active');
    </script>
  </body>
</html>