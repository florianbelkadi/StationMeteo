// WIFI + HTTP
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>
// JSON
#include <ArduinoJson.h>
// CAPTEUR ET BRANCHEMENT
#include <BME280I2C.h>
#include <Wire.h>
// Ecran LCD
#include <LCD_I2C.h>


#define SERIAL_BAUD 74880

// Reglages du capteur
//BME280I2C::Settings settings(
//   BME280::OSR_X1,
//   BME280::OSR_X1,
//   BME280::OSR_X1,
//   BME280::Mode_Forced,
//   BME280::StandbyTime_1000ms,
//   BME280::Filter_16,
//   BME280::SpiEnable_False,
//   BME280I2C::I2CAddr_0x76
//);
BME280I2C bme;

// reglage LCD (adresse i2C, colonnes, lignes)
LCD_I2C lcd(0x27,16,2); 

//Nom du capteur
const String sensorName = "Capteur principal";

//Paramètre de la connexion wifi 
const char* ssid = "Iphone de Chris";
const char* password = "StationMdp";

// Définition du délai entre les post au serveur
const int minutes = 10;

//Nom et adresse du raspberry Pi
String serverName = "http://172.20.10.7:80/stationMeteo/api/receiveData.php";

void setup() {
  
  Serial.begin(SERIAL_BAUD); 
  
// Utilise GPIO0 et GPIO2 pour récolter les données
  Wire.begin(0,2);


// connexion à l'écran
  lcd.begin(false);
  lcd.backlight();
  lcd.setCursor(0,1);
  lcd.print("Bonjour");
  delay(3000); 
  lcd.clear();
  
// connexion au capteur de température
  while(!bme.begin())
  {
    Serial.println("Impossible de trouver le capteur!");
    lcd.clear();
    Serial.println("Pas de capteur!");
    delay(1000);
  }
  Serial.println("Capteur trouvé!");
  lcd.clear();
  lcd.print("Capteur trouvé!");

 
 
  
// connexion au wifi 
  WiFi.begin(ssid, password);
  Serial.println("");
  lcd.clear();
  lcd.print("Connexion");
  while(WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Connecté au wifi avec l'adresse IP: ");
    lcd.clear();
    lcd.print("Connecte");
    delay(3000);
  Serial.println(WiFi.localIP());
}

void loop() {
   int timer = 0;
   String datas;
    lcd.print("Bonjour");
   while (timer<(12*minutes))
   {
       lcd.clear();
       datas = fetchData(); 
       showData(datas);
       timer++;
       delay(5000);
   }
   postData(datas);
}

String fetchData() {
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
   
   Serial.print("Pression: ");
   Serial.print(pres);
   Serial.print(String(presUnit == BME280::PresUnit_hPa ? "hPa" : "Pa") +"\n");
   
// Création du JSON 
 StaticJsonDocument<200> datas;
   datas["capteur"] = sensorName;
   datas["temp"] = temp;
   datas["humidite"] = hum;
   datas["pression"] = pres;

// affiche un apercu du Json dans le moniteur
 serializeJsonPretty(datas, Serial);

 String jsonDatas;
  serializeJson(datas, jsonDatas);
return jsonDatas;
}

void postData(String jsonDatas) {
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
     
      Serial.println("\n Reponse HTTP: ");
      Serial.println(httpResponseCode);
        
      // Libère la ressource
      http.end();
    }
    else {
      Serial.println("Pas de connexion wifi");
    }
}


void showData(String datas) 
{
  StaticJsonDocument<200> jsonDatas;
  deserializeJson(jsonDatas,datas); 
  lcd.print("Temperature");
  lcd.setCursor(0,1);
  String stemp = jsonDatas["temp"];
  lcd.print(stemp);
}
