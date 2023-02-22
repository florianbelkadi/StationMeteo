// WIFI + HTTP
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>
// JSON
#include <ArduinoJson.h>
//CAPTEUR ET BRANCHEMENT
#include <BME280I2C.h>
#include <Wire.h>

#define SERIAL_BAUD 74880

// Reglages du capteur

BME280I2C::Settings settings(
   BME280::OSR_X1,
   BME280::OSR_X1,
   BME280::OSR_X1,
   BME280::Mode_Forced,
   BME280::StandbyTime_1000ms,
   BME280::Filter_16,
   BME280::SpiEnable_False,
   BME280I2C::I2CAddr_0x76
);
BME280I2C bme(settings);

const String sensorName = "Capteur principal";


//Paramètre de la connexion wifi 
const char* ssid = "Iphone de Chris";
const char* password = "StationMdp";

//Nom et adresse du raspberry Pi
String serverName = "http://172.20.10.7:80/stationMeteo/index.php";

void setup() {
  Serial.begin(SERIAL_BAUD); 

 while(!Serial) {} // Wait
// Utilise GPIO0 et GPIO2 pour récolter les données
  Wire.begin(0,2);

// connexion au capteur de température
  while(!bme.begin())
  {
    Serial.println("Impossible de trouver le capteur!");
    delay(1000);
  }
  Serial.println("Capteur trouvé!");

// connexion au wifi 
  WiFi.begin(ssid, password);
  Serial.println("Connexion");
  while(WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Connecté au wifi avec l'adresse IP: ");
  Serial.println(WiFi.localIP());
}

void loop() {
  fetchData(); 
 delay(15*3600);
}

void fetchData()
{
   float temp(NAN), hum(NAN), pres(NAN);
   //Règle la température en °C et la pression en hPA
   BME280::TempUnit tempUnit(BME280::TempUnit_Celsius);
   BME280::PresUnit presUnit(BME280::PresUnit_hPa);
   
// Lecture des informations
   bme.read(pres, temp, hum, tempUnit, presUnit);
   
// Affichage des informations
   Serial.print("Temperature: ");
   Serial.print(temp);
   Serial.print("° "+ String(tempUnit == BME280::TempUnit_Celsius ? "C" :"F")+"\n" );
   
   Serial.print("Humidite: ");
   Serial.print(hum);
   Serial.print("% RH \n");
   
   Serial.println("Pression: ");
   Serial.print(pres);
   Serial.print(String(presUnit == BME280::PresUnit_hPa ? "hPa" : "Pa") +"\n");
   
// Création du JSON 
 StaticJsonDocument<200> datas;
   datas["capteur"] = sensorName;
   datas["temp"] = temp;
   datas["humidite"] = hum;
   datas["pression"] = pres;
String jsonDatas;
serializeJson(datas, jsonDatas);
// affiche un apercu du Json dans le moniteur
 serializeJsonPretty(datas, Serial);

  //Verifie la connexion wifi 
  if(WiFi.status()== WL_CONNECTED){
      WiFiClient client;
      HTTPClient http;
      
      // 
      http.begin(client, serverName);
  
      // Spécifie le type de données envoyée dans le header, ici JSON
      http.addHeader("Content-Type", "application/json");       
      // Envoie la requête POST HTTP
      int httpResponseCode = http.POST(jsonDatas);
     
      Serial.println("Reponse HTTP: ");
      Serial.println(httpResponseCode);
        
      // Libère la ressource
      http.end();
    }
    else {
      Serial.println("Pas de connexion wifi");
    }

}
