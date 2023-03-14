// WIFI + HTTP
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>
// JSON
#include <ArduinoJson.h>
// CAPTEUR
#include <BME280I2C.h>
// BRANCHEMENT
#include <Wire.h>
// Ecran LCD
#include <LCD_I2C.h>


#define SERIAL_BAUD 74880

BME280I2C bme;

// reglage LCD (adresse i2C, colonnes, lignes)
LCD_I2C lcd(0x27,16,2); 

//Nom du capteur
const String sensorName = "Capteur principal";

//Paramètre de la connexion wifi 
const char* ssid = "moto g(8) plus 3586";
const char* password = "f10c8304fe9f";

// Définition du délai entre les post au serveur
const int minutes = 10;

//Nom et adresse du raspberry Pi
String serverName = "http://192.168.43.43:80/Station_Meteo/app/receiveDataSensor.php";

void setup() {
  
  Serial.begin(SERIAL_BAUD); 
  
// Utilise GPIO0 et GPIO2 pour récolter les données
  Wire.begin(0,2);


// connexion à l'écran
  lcd.begin(false);
  lcd.backlight();
  lcd.setCursor(4,0);
  lcd.print("Bonjour!");
  delay(3000); 
  lcd.clear();
  
// connexion au capteur de température
  while(!bme.begin())
  {
    Serial.println("Impossible de trouver le capteur!");
    lcd.clear();
    lcd.print("Connexion au ");
    lcd.setCursor(0,1);
    lcd.print("capteur en cours");
    delay(1000);
  }
  Serial.println("Capteur trouvé!");
  lcd.clear();
  lcd.print("Connexion au ");
  lcd.setCursor(0,1);
  lcd.print("capteur reussie");
  delay(2000);
 
 
  
// connexion au wifi 
  WiFi.begin(ssid, password);
  Serial.println("");
   lcd.clear();
  lcd.print("Connexion au ");
  lcd.setCursor(0,1);
  lcd.print("wifi en cours");
  int tentatives = 0;
  while((WiFi.status() != WL_CONNECTED)&& tentatives<50) {
    delay(500);
    Serial.print(".");
    tentatives++;
  }
  if (WiFi.status() == WL_CONNECTED)
  {
  Serial.println("");
  Serial.print("Connecté au wifi avec l'adresse IP: ");
  Serial.println(WiFi.localIP());
  lcd.clear();
  lcd.print("Connexion au ");
  lcd.setCursor(0,1);
  lcd.print("wifi reussie");
  delay(2000);
  }
  else 
  {
    lcd.clear();
    lcd.print("Mode hors ligne");
    delay(2000);
  }
}

void loop() {
   int timer = 0;
   String datas;
   datas = fetchData(); 
   if (WiFi.status() == WL_CONNECTED)
       postData(datas);
   while (timer<(12*minutes))
   {
       lcd.clear();
       datas = fetchData(); 
       showData(datas);
       if (WiFi.status() != WL_CONNECTED)
          {
            lcd.clear();
            lcd.print("Mode Hors Ligne");
            delay(2000);
           }
       timer++;
   }
  
   
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

void postData(String jsonDatas) 
{
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


void showData(String datas) 
{
  // String vers JSon
  StaticJsonDocument<200> jsonDatas;
  deserializeJson(jsonDatas,datas); 
  // Creation du caractère "°" 

  byte degres[8] = {
    0b01100,
    0b10010,
    0b01100,
    0b00000,
    0b00000,
    0b00000,
    0b00000,
    0b00000
    };
  lcd.createChar(1, degres); // création du caractère personnalisé
  
  lcd.print("Temperature");
  lcd.setCursor(0,1);
  float stemp = jsonDatas["temp"];
  lcd.print(stemp,2);
  lcd.print(" ");
  lcd.print(char(1));
  lcd.print("C");
  delay(2000);
  
  lcd.clear();
  lcd.print("Humidite");
  lcd.setCursor(0,1);
  float sHum = jsonDatas["humidite"];
  lcd.print(sHum,2);
  lcd.print(" %");
  delay(2000);
  
  lcd.clear();
  lcd.print("Pression");
  lcd.setCursor(0,1);
  float sPres = jsonDatas["pression"];
  lcd.print(sPres,2);
  lcd.print(" hPa");
  delay(2000);
}
