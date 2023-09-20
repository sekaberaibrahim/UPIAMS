
**ATTENDANCE MANAGEMENT SYSTEM USING SYSTEM USING RADIO FREQUENCY**
---------------------------------------------------------------------


NOTE RELATED THESIS
--------------------
A Dissertation Submitted to the School of Science and Technology in Partial Fulfillment
of the Academic Requirements for the Award of a Bachelor’s Degree with Honors in
Computer Science


We humbly affirm that the project work titled "ATTENDANCE MANAGEMENT
SYSTEM USING RADIO FREQUENCY" has been submitted by us to KIGALI
INDEPENDENT UNIVERSITY (ULK).

NOTE RELATED PROJECT
--------------------


         Conecting MFRC TO Node Mcu :    
        -----------------------------    
remember to download esp8266 Board manager,

libraries	 #include <ESP8266WebServer.h>
         	 #include <ESP8266HTTPClient.h>
		#include <SPI.h>
		#include <MFRC522.h>


    NodeMCU ESP8266/ESP12E    RFID MFRC522 / RC522                      
            D2       <---------->   SDA/SS                               
            D5       <---------->   SCK                                  
            D7       <---------->   MOSI                                 
            D6       <---------->   MISO                                  
            GND      <---------->   GND                                  
            D1       <---------->   RST                                 
            3V/3V3   <---------->   3.3V


       Conecting Hrdware TO Software in arduino :      
       ----------------------------------------
----SSID and Password of your WiFi router------

const char* ssid = "ibraah";
const char* password = "passwordifany";

      Specify request destination
-----------------------------------------
  http.begin(client, "http://192.168.212.221/atte/Attendance.php");


-------How to run the the System---------

1. Download the zip file
2. Extract the file and copy atte folder
3.Paste inside root directory(for xampp xampp/htdocs, for wamp wamp/www)
4. Open PHPMyAdmin (http://localhost/phpmyadmin)
5. Create a database with name atte
6. Import atte.sql file(given inside the zip package in sql file folder)
7.Run the script http://localhost/atte (frontend)
8. For admin panel http://localhost/atte/admin (admin panel)

-------Credential for admin panel-----


email: admin@gmail.com
Password : 123

