<?php 

   session_start();

if ( isset( $_SESSION['login_user'] ) ) {
       $ilçe=$_SESSION['temp'];
    
} else {
    // Redirect them to the login page
    header("Location: login.php");
}

 $d=date("Y-m-d",strtotime("+1 days")); 
   include("config.php");

      $sql = "SELECT * FROM   weather WHERE  wdate = '$d' ";
      $result = mysqli_query($db,$sql); 
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
    $row = mysqli_fetch_array($result);
      if($count == 1) {
         $_SESSION['w'] = $row['degree'];
          $tahminiEnerji= rand(8, 13)*$_SESSION['w'] *10*24;
          $tahminiKar=$tahminiEnerji*"0.0087";
          $satılanEnerji=$tahminiEnerji*(8/10);
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
                                        <div class="row" style="background: chartreuse;text-align: center;margin: auto;"> <a href="index.php"style="margin: auto;">Durumum</a></div>  
                                        <hr>
                                        <div class="row" style="margin: auto;"><a href="gelisim.php"style="margin: auto;">Gelişim</a></div>           
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
                                 <div class="col-md-6">
                                     <div class="card">
                                          <div class="card-header bg-info">
                                               Günlük Tahmini Üretim
                                          </div>
                                          <div class="card-body">
                                             <p class="card-text"><?php  echo $tahminiEnerji." Watt"; ?> </p>
                                          </div>
                                      </div>
                                 </div>
                                  <div class="col-md-6">
                                     <div class="card">
                                          <div class="card-header bg-info">
                                               Günlük Tahmini Kar
                                          </div>
                                          <div class="card-body">
                                             <p class="card-text"><?php  echo $tahminiKar." TL"; ?> </p>
                                          </div>
                                      </div>
                                 </div>
                           </div>
                           <div class="row" style="margin-top: 5%">
                                 <div class="col-md-6">
                                     <div class="card">
                                          <div class="card-header bg-info">
                                               Günlük Satılan Enerji
                                          </div>
                                          <div class="card-body">
                                             <p class="card-text"><?php  echo $satılanEnerji." Watt"; ?>  </p>
                                          </div>
                                      </div>
                                 </div>
                                  <div class="col-md-6">
                                     <div class="card">
                                          <div class="card-header bg-info">
                                               Günün En Sıcak İlçesi
                                          </div>
                                          <div class="card-body">
                                             <p class="card-text">
                                              <?php echo $ilçe; ?>
                                              </p>
                                          </div>
                                      </div>
                                 </div>
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