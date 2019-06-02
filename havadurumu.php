
<?php 

   session_start();

if ( isset( $_SESSION['login_user'] ) ) {
       
    
} else {
    // Redirect them to the login page
    header("Location: login.php");
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
                                        <div class="row" style="margin: auto;"><a href="gelisim.php"style="margin: auto;">Gelişim</a></div>           
                                        <hr>
                                        <div class="row" style="background: chartreuse;margin: auto;"><a href="havadurumu.php"style="margin: auto;">Hava Durumu </a></div>
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
 <table class="table table-bordered"  style="background: rgba(0,123,255,.25);">
    <thead>
      <tr>
        <th>İlçe</th>
        <th>İl</th>
        <th>Periyot</th>
        <th>Durum</th>
        <th>Mak. Sıcaklık</th>
        <th>Min. Sıcaklık</th>
      </tr>
    </thead>
    <tbody>
                                <?php
$icerik = getir();
if (!$icerik){
    echo "Hata: MGM'ye bağlanılamadı. ";
    return false;
}
$tempDegree=0;
$tempİlçe="";
$xml = simplexml_load_string($icerik);
foreach ($xml->ilceler as $veri){
$ilce = $veri->ilce;
$sehir = $veri->Sehir;
$periyot = $veri->Peryot;
$durum = $veri->Durum;
$maks = $veri->Mak;
$min=$veri->Min;
if ($sehir=="İzmir" && $ilce=="Buca") {
$degree=$maks;  
$_SESSION['w']=(int)$degree;
}
if ($tempDegree<(int) $maks) {
$tempDegree=(int)$maks;  
$tempİlçe=(string)$ilce;
}
echo '
 <tr>
        <td>'.$ilce.'</td>
        <td>'.$sehir.'</td>
        <td>'.$periyot.'</td>
        <td>'.$durum.'</td>
        <td>'.$maks.'</td>
        <td>'.$min.'</td>
 </tr>
';
}
 
function getir() {
$url = 'https://www.mgm.gov.tr/FTPDATA/bolgesel/izmir/sonSOA.xml';
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_REFERER, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$resultS = curl_exec($ch);
curl_close($ch);
return $resultS;
}
   $_SESSION['temp']=$tempDegree." Derece ".$tempİlçe;
   include("config.php");

      // username and password sent from form    
      $d=date("Y-m-d",strtotime("+1 days")); 

      $sql = "SELECT * FROM   weather WHERE  wdate = '$d' ";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        
      $count = mysqli_num_rows($result);
      
      if($count == 1) {
        
        


      }else {       
       $sql="INSERT INTO weather (degree, wdate) VALUES ('$degree','$d')" ;
       $result = mysqli_query($db,$sql);
      }



?>
 </tbody>
  </table>

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