<?php 
ob_start();
session_start();
$db = new Mysqli("localhost", "fbpowereditor", "india@123", "fb2");
if($db->connect_errno){
  die('Connect Error: ' . $db->connect_errno);
} 
?>
<html lang="en">
<head>
  <title>FBPower Editor</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/daterangepicker.css" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap-select.min.css" />
  <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
  <link rel="stylesheet" type="text/css" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/custom.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
  <!-- seetalert -->
  <link rel="stylesheet" href="css/sweetalert.css">
  <!-- Include Date Range Picker -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">




  <!--  <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyCD0hnFTGcoQXx6sR-Z5pJOW4kHaW0YcS8&libraries=places"></script> -->

 <script type="text/javascript" src="js/sweetalert.js"></script>
  <script type="text/javascript" src="js/custom.js"></script>
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script src="http://malsup.github.com/jquery.form.js"></script> 
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/moment.min.js"></script>
  <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
  <script type="text/javascript" src="js/jscolor.js"></script>
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lodash@4.17.4/lodash.min.js"></script>
  <script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
  <script type="text/javascript" src="js/daterangepicker.js"></script>
  <script type="text/javascript" src="js/owl.carousel.js"></script>
 <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
 <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>




</head>
<body>
<script>
 jQuery(document).ready(function(){
   var listItem,applyClicked=false;
   var first=0;
    <?php 
        if(isset($_SESSION['time_range']) && $_SESSION['time_range']['since']=='Invalid date'){
        ?>
            var start = 'Lifetime';
            var end   = moment();
       <?php
        } else if(isset($_SESSION['time_range']) && $_SESSION['time_range']['since']!='Invalid date'){
            $since=explode("-", $_SESSION['time_range']['since']);
            $since_day=$since[2];
            $since_month=$since[1];
            $since_year=$since[0];

            $until=explode("-", $_SESSION['time_range']['until']);
            $until_day=$until[2];
            $until_month=$until[1];
            $until_year=$until[0];          
        ?>
            var until_year=<?php echo $until_year ?>;
            var until_month=<?php echo $until_month ?>;
            var until_day=<?php echo $until_day ?>;


            var since_day=<?php echo $since_day ?>;
            var since_month=<?php echo $since_month ?>;
            var since_year=<?php echo $since_year ?>;


            var until_date=until_month+'/'+until_day+'/'+until_year;
            var since_date=since_month+'/'+since_day+'/'+since_year;
           
            var toDate = function(mmDDYYY) {
            var arr = mmDDYYY.split("/");
                return new Date(arr[2],arr[0]-1,arr[1]);
            }

            var start =toDate(since_date);
            var end =toDate(until_date);  
       <?php
            }else{
        ?>
            var start = moment();
            var end   = moment();

        <?php           
            }
        ?>


    function cb(start, end,label=null) {
   
        if(start._isValid == false){ 
            if($('#reportrange span').html()=='Lifetime' + ' - ' + end.format('MMMM D, YYYY')){          
              return false;
            }  
            $('#reportrange span').html('Lifetime' + ' - ' + end.format('MMMM D, YYYY'));
        }else{       
        //console.log('d'+start.format('MMMM D, YYYY')); 
            if(start.format('YYYY')<='1998'){
              start='Invalid date';
                 $('#reportrange span').html('Lifetime' + ' - ' + end.format('MMMM D, YYYY'));
            }else{
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
        }    
        if(first==0){    
          first=1;
          getDataRange(start, end);   
          applyClicked=false;

         }
    
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Lifetime': [moment().subtract(20, 'years').startOf('month'), moment()],
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);


     $(".ranges ul li").click(function() {
      listItem = $(this).text();
    });
    $(".range_inputs ").click(function() {
      applyClicked=true;
    });

  // cb(start, end,label=null); 

   // Set the default value
    var datepicker = $("#reportrange").data('daterangepicker');
    var initialSel = start;   // Or something else
    if (initialSel && datepicker.ranges && datepicker.ranges[initialSel]) {
        var range = datepicker.ranges[initialSel];
        console.log(range);
        datepicker.chosenLabel = initialSel;
        datepicker.setStartDate(range[0]);
        datepicker.setEndDate(range[1]);
        cb(datepicker.startDate, datepicker.endDate, datepicker.chosenLabel);
    } else {
        datepicker.chosenLabel = 'Today';
        cb(datepicker.startDate, datepicker.endDate, datepicker.chosenLabel);
    }



    $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
      console.log(listItem +" : "+ applyClicked);
      if(listItem!="Custom Range" && !applyClicked){
        picker.show();
        applyClicked=false;
         //getDataRange(start, end);
      }else{
        var start = picker.startDate;
        var end = picker.endDate;
        if(start.format('YYYY')<='1998'){
              start='Invalid date';
            }
        getDataRange(start, end);
         applyClicked=false;
      }
        
      //ev.preventDefault();

    });
    cb(start, end);
});
  </script>
<?php  $_SESSION['filters']=array();
   $_SESSION['search_filter']=array();
 //  $_SESSION['time_range']=array();
   $code=$_GET['code'];
 ?>


