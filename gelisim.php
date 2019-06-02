
<?php 

   session_start();

if ( isset( $_SESSION['login_user'] ) ) {
       
    
} else {
    // Redirect them to the login page
    header("Location: login.php");
}

   include("config.php");


$sql = "SELECT * FROM  weather ";
$result = mysqli_query($db,$sql);

$dataPointSıcaklık =  array();
while ($row = mysqli_fetch_array($result)){
  array_push($dataPointSıcaklık, array("y" => $row['degree'], "label" => $row['wdate']));

}
 
$sql = "SELECT * FROM  weather ";
$result = mysqli_query($db,$sql);
 $dataPointEnerji =  array();
while ($row = mysqli_fetch_array($result)){
  array_push($dataPointEnerji, array("y" => ($row['degree']*rand(8, 13)*$row['degree'] *10*24), "label" => $row['wdate']));

}




   ?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<style type="text/css">
  body {
  background-color: lightblue;
}
   .yanmenu{
border-radius: 5px;
    border-style: groove;
    background-color: white;
    border-width: thin;
    padding: 15px;
    margin-top: 20%;
    text-align: center;
    height: 575px;
  }
    .yatay{
border-radius: 5px;
    border-style: groove;
    background-color: white;
    border-width: thin;
    padding: 15px;
    text-align: center;
           width: 100%;
  }

</style>

<div>
    <div class="container">
          <div class="row">
              <div class="col-md-3">
                         
                                   <div class="yanmenu">
                                        <img id="logo"src="logo.png" style="width: 150px;">
                                        <hr>
                                        <div class="row" style="text-align: center;margin: auto;"> <a href="index.php"style="margin: auto;">Durumum</a></div>  
                                        <hr>
                                        <div class="row" style="background: chartreuse; margin: auto;"><a href="gelisim.php"style="margin: auto;">Gelişim</a></div>           
                                        <hr>
                                        <div class="row" style="margin: auto;"><a href="havadurumu.php"style="margin: auto;">Hava Durumu </a></div>
                                        <hr>

                                          
                                          
                                   </div>                                                   
              </div>
              <div class="col-md-9">
                           <div class="row" >
                                <div class="yatay" style="margin-top: 6% "> 
                                   <div class="row"> 
                                      <div class="col-md-9">
                                                    Hoşgeldiniz <b><?php  echo $_SESSION['login_user']; ?></b>
                                      </div>        
                                      <div class="col-md-3">
                                                   <a href="logout.php" class="btn btn-danger" style="margin-left: 2%; ">Logout</a> 
                                      </div>     
                                                                            
                                  </div>  
                                </div>
                           </div>
                           <div class="row" style="margin-top: 5%;overflow-x:auto;max-height: 465px;">
                                <div id="chartContainerSıcaklık" style="height: 370px; width: 100%;"></div>

                           </div>
                            <div class="row" style="margin-top: 5%;overflow-x:auto;max-height: 465px;">
                                <div id="chartContainerEnerji" style="height: 370px; width: 100%;"></div>

                           </div>
                          

              </div>




      </div>
    </div>
</div>
<script type="text/javascript">
  
$('#logo').click(function(){
   window.location.href='index.php';
})



</script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainerSıcaklık", {
  title: {
    text: "GÜNLÜK SICAKLIK TAHMİNİ"
  },
  axisY: {
    title: "Sıcaklık Derecesi"
  },
  data: [{
    type: "line",
    dataPoints: <?php echo json_encode($dataPointSıcaklık, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();
var chart = new CanvasJS.Chart("chartContainerEnerji", {
  title: {
    text: "GÜNLÜK ÜRETİLEN ENERJİ TAHMİNİ"
  },
  axisY: {
    title: "Enerji Miktarı"
  },
  data: [{
    type: "line",
    dataPoints: <?php echo json_encode($dataPointEnerji, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();

 
}
</script>