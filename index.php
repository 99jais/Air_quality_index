<?php
$conn=mysqli_connect("localhost","root","","airqualityindex");

$sql1="SELECT * FROM location1 ORDERBY timestamp DESC LIMIT 1";
$sql2="SELECT * FROM location2 ORDERBY timestamp DESC LIMIT 1";
$sql3="SELECT * FROM location3 ORDERBY timestamp DESC LIMIT 1";
$resulttable1=mysqli_query($conn,$sql1); 
$resulttable2=mysqli_query($conn,$sql2);
$resulttable3=mysqli_query($conn,$sql3);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Air Quality Index Monitoring</title>
	    <!--Refresh webpage after every 2 minutes-->
    <meta http-equiv="refresh" content="120">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.js"></script>
    <style>
      #map {
        height: 450px;  /* The height is 400 pixels */
        width: 46%;  /* The width is the width of the web page */
        align-items: right;
       }
       .column {
        float: left;
        width: 50%;
        padding: 10px;
       }
       /* Clear floats after the columns */
       .row:after {
        content: "";
        display: table;
        clear: both;
       }
       body {
        font-family: Arial;
       }
       /* Style the tab */
      .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
       }
       /* Style the buttons inside the tab */
      .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 17px;
       }
       /* Change background color of buttons on hover */
       .tab button:hover {
        background-color: #ddd;
       }

       /* Create an active/current tablink class */
       .tab button.active {
        background-color: #ccc;
       }
       /* Style the tab content */
       .tabcontent {
        display: none;
        padding: 6px 12px;
        -webkit-animation: fadeEffect 1s;
        animation: fadeEffect 1s;
        }
        /* Fade in tabs */
        @-webkit-keyframes fadeEffect {
            from {opacity: 0;}
            to {opacity: 1;}
        }
        @keyframes fadeEffect {
            from {opacity: 0;}
            to {opacity: 1;}
        }
        table, th, td { 
            border: 1px solid black; 
            border-collapse: collapse; 
        } 
          
        th, td { 
            padding: 20px; 
        } 
    </style>
</head>
<body>
	<body style="color: rgb(87, 86, 43); border: 20px; border color: black"><font color="black">

    <div align= center style="font-size: 75px; width top:250px; background-color: #138FCC"><font color="black">Air Quality Index</font>
    </div>

    <div>
      <p align= right>Date/Time: <span id="datetime"></span>
      </p>
    </div>

    <script>
      var dt = new Date();
      document.getElementById("datetime").innerHTML = dt.toLocaleString();
    </script>

    <p id="currentinfo" style="font-size: 20px;"></p>

    <div class="row"style="border-style: solid;
  border-color:black;">
      <div class="tab column">
        <div>
          <button class="tablinks" onclick="openCity(event, 'Kolkata')">Kolkata</button>
          <button class="tablinks" onclick="openCity(event, 'Delhi')">Delhi</button>
            <button class="tablinks" onclick="openCity(event, 'Mumbai')">Mumbai</button>
        </div>
          
      <div align=left id="Kolkata" class="tabcontent" >
        <font color="black">
        <?php
      while($rows_kol=mysqli_fetch_assoc($resulttable1))
      {

        ?>
          <h3><br>Kolkata</h3>
		      <p>AQI Index:<?php echo  $rows_kol['AQIIndex'];?>  <br><br> CO Level:<?php echo  $rows_kol['COLevel'];?> <br><br> LPG level:<?php echo  $rows_kol['LPGLevel'];?> <br><br> Methane level:<?php echo  $rows_kol['Methanelevel'];?> <br><br> MQ7 level:<?php echo  $rows_kol['MQ7Level'];?> <br><br></p>
        </font>
        <?php

      }
       ?>
      </div>
          
      <div align=left id="Delhi" class="tabcontent">
        <font color="black"> 
          <?php
      while($rows_delhi=mysqli_fetch_assoc($resulttable2))
      {

        ?>
          <h3><br>Delhi</h3>
            <p>AQI Index:<?php echo  $rows_delhi['AQIIndex'];?>  <br><br> CO Level:<?php echo  $rows_delhi['COLevel'];?> <br><br> LPG level:<?php echo  $rows_delhi['LPGLevel'];?> <br><br> Methane level:<?php echo  $rows_delhi['Methanelevel'];?> <br><br> MQ7 level:<?php echo  $rows_delhi['MQ7Level'];?> <br><br></p>
          </font>
        <?php

      }
       ?>
      </div>
          
      <div align=left id="Mumbai" class="tabcontent" ; style="background-color= #FFC300;">
        <font color="black">
        <?php
          while($rows_mumbai=mysqli_fetch_assoc($resulttable3))
          {

        ?>
          <h3><br>Mumbai</h3>
            <p>AQI Index:<?php echo  $rows_mumbai['AQIIndex'];?>  <br><br> CO Level:<?php echo  $rows_mumbai['COLevel'];?> <br><br> LPG level:<?php echo  $rows_mumbai['LPGLevel'];?> <br><br> Methane level:<?php echo  $rows_mumbai['Methanelevel'];?> <br><br> MQ7 level:<?php echo  $rows_mumbai['MQ7Level'];?> <br><br></p>
        </font>
        <?php

      }
       ?>
      </div>
    </div>
          
      <div>
        <p>
              
        </p>
      </div>
      <div align=right id="map" class = "column"></div>
        <script>
          var map=L.map('map').setView([20.5937,78.9629],4.4);

          L.tileLayer('https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=wVDJ0PlmQn55Lz8Th4Ca',{
                attribution: '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy;OpenStreetMap contributors</a>'
          }).addTo(map);
          var marker1 = L.marker([22.5726, 88.3639]).addTo(map);
          var marker2 = L.marker([28.7041, 77.1025]).addTo(map);
          var marker3 = L.marker([19.0760, 72.8777]).addTo(map);
          <?php
            while($rows_kol=mysqli_fetch_assoc($resulttable1))
            {
          ?>
          marker1.bindPopup("<b>Kolkata</b><br>AQI Level:<?php echo $rows_kol['AQILevel'];?> <br>MQ2: <br>MQ7: ");
          <?php
            }
          ?>
          <?php
            while($rows_delhi=mysqli_fetch_assoc($resulttable2))
            {
          ?>
          marker1.bindPopup("<b>Delhi</b><br>AQI Level:<?php echo $rows_delhi['AQILevel'];?> <br>MQ2: <br>MQ7: ");
          <?php
            }
          ?>
          <?php
            while($rows_mumbai=mysqli_fetch_assoc($resulttable1))
            {
          ?>
          marker1.bindPopup("<b>Mumbai</b><br>AQI Level:<?php echo $rows_mumbai['AQILevel'];?> <br>MQ2: <br>MQ7: ");
          <?php
            }
          ?>
        </script>
      </div>
    <br><br><br>

      <div style="border-style: solid;
         border-color: #FF9933; background-color: #660099">
        <h3 style="text-align: center; background-color: #138FCC">
                   Air Quality Forecast
        </h3>
      
      </div>
      <div>
        <p>
          

        </p>
      </div>
      <div align="center"; style="background-color: #f1f1f1;">
        <table border=3 id="table_id"style="width:700px">
          <tr>
            <th> City</th>
            <th> Date</th>
            <th> Date1</th> 
            <th> Date2</th>
            <th> Date3</th>
            <th> Date4</th>
            <th> Date5</th>
            <th> Date6</th>
          </tr>
          <tr>
    		<td>Kolkata</td>
    		<td class="y_n">100</td>
    		<td class="y_n">200</td>
    		<td class="y_n">300</td>
    		<td class="y_n">400</td>
    		<td class="y_n">34</td>
    		<td class="y_n">20</td>
    		<td class="y_n">70</td>
    	  </tr>   
		  <tr>
    		<td>Delhi</td>
    		<td class="y_n">30</td>
    		<td class="y_n">200</td>
    		<td class="y_n">450</td>
    		<td class="y_n">400</td>
    		<td class="y_n">12</td>
    		<td class="y_n">250</td>
    		<td class="y_n">400</td>
    	  </tr>   
		  <tr>
    		<td>Mumbai</td>
    		<td class="y_n">300</td>
    		<td class="y_n">20</td>
    		<td class="y_n">500</td>
    		<td class="y_n">70</td>
    		<td class="y_n">14</td>
    		<td class="y_n">30</td>
    		<td class="y_n">90</td>
    	  </tr>   
			
  	    </table>
      </div>

    <div>
      <p>
        

      </p>

    </div>
  <div style="border-style: solid;
  border-color: #FF9933; background-color: #660099">
      <h3 style="text-align: center; background-color: #138FCC">
        Air Quality Forecast Today
      </h3>
      
  </div>
  <div>
        <p>
          

        </p>
      </div>
  <div align="center" style="background-color: #f1f1f1;">
  	<table border=3 bordercolor="#FFFFFF" id="table_id"style="width:700px">
      
      <tr>
        <th>City</th>
        <th>Peak AQI Time</th>
        <th>Max AQI</th> 
        <th>Min AQI</th>
      </tr>
      
    	<tr>
    		<td>Kolkata</td>
    		<td class="y_n">08:00AM</td>
    		<td class="y_n">300</td>
    		<td class="y_n">200</td>
    		
    	</tr>
		<tr>
    		<td>Delhi</td>
    		<td class="y_n">11:30PM</td>
    		<td class="y_n">400</td>
    		<td class="y_n">100</td>
    		
    	</tr>
		<tr>
    		<td>Mumbai</td>
    		<td class="y_n">09:15PM</td>
    		<td class="y_n">200</td>
    		<td class="y_n">30</td>
    		
    	</tr>
    	
    </table>
  </div>
  <div style="border-style: solid;
  border-color: #FF9933; background-color: #660099">
      <h3 style="text-align: center; background-color: #138FCC">
        About the Air Quality and Pollution Measurement:
      </h3>
  </div>


  <div align="center"; style="background-color: #f1f1f1;">
    <table border=3 style="width:700px">
      <tr>
        <th>  AQI</th>
        <th> Air Pollution Level</th>
        <th> Health Implications</th> 
      </tr>
      <tr style="background-color :#009966">
        <td >0-50</td>
        <td>Good</td>
        <td>Air quality is considered satisfactory, and air pollution poses little or no risk</td>
      </tr>
      <tr style="background-color:#FFDE33">
        <td>51-100</td>
        <td>Moderate</td>
        <td>Air quality is acceptable; however, for some pollutants there may be a moderate health concern for a very small number of people who are unusually sensitive to air pollution</td>
      </tr>

      <tr style="background-color:#FF9933">
        <td>101-150</td>
        <td>Unhealthy for Sensitive Groups</td>
        <td>Members of sensitive groups may experience health effects. The general public is not likely to be affected.</td>
      </tr>
      <tr style="background-color :#CC0033">
        <td>151-200</td>
        <td>Unhealthy</td>
        <td>Everyone may begin to experience health effects; members of sensitive groups may experience more serious health effects</td>
      </tr>

      <tr style=" background-color:#660099">
        <td>201-300</td>
        <td>Very Unhealthy</td>
        <td>Health warnings of emergency conditions. The entire population is more likely to be affected.</td>
      </tr>

      <tr style=" background-color:#7E0023">
        <td >300+</td>
        <td>Hazardous</td>
        <td>Health alert: everyone may experience more serious health effects</td>
      </tr>
    </table>
  </div>



        
        


    <script>
    //Fading effect for city AQI information

    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
    
    // color cell according to value
    $(document).ready(function(){
      $('#table_id td.y_n').each(function(){
        
        if ($(this).text() >=0 && $(this).text() <=50) {
            $(this).css('background-color','#009966');

          }
        if ($(this).text() >=51 && $(this).text() <=100) {
            $(this).css('background-color','#FFDE33');}

            
        if ($(this).text() >=101 && $(this).text() <=150) {
            $(this).css('background-color','#FF9933');}


        if ($(this).text() >=151 && $(this).text() <=200) {
            $(this).css('background-color','#CC0033');}


        if ($(this).text() >=201 && $(this).text() <=300) {
            $(this).css('background-color','#660099');
          }

        if ($(this).text() >=300) {
            $(this).css('background-color','#7E0023');
          }
        });
    });
    </script>
  


    
</body>
</html>