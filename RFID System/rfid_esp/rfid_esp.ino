#include<ESP8266WiFi.h>
#include<WiFiClient.h>
#include<ESP8266WebServer.h>
#include<ESP8266HTTPClient.h>
#include<SPI.h>
#include<MFRC522.h>

#define SS_PIN D8
#define RST_PIN D3
#define RedLed 5
#define GreenLed 4

MFRC522 mfrc522(SS_PIN, RST_PIN);

const char *ssid = "Username";
const char *pass = "password";

String host = "http://192.168.1.103/loginsystem/";

String getData, Link;
String CardID = "";

void setup() {
  delay(1000);
  Serial.begin(115200);
  SPI.begin();
  mfrc522.PCD_Init();

  WiFi.begin(ssid, pass);
  Serial.print("Connecting to: ");
  Serial.println(ssid);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("Connected");
  Serial.print("IP Address: ");
  Serial.println(WiFi.localIP());

  pinMode(RedLed, OUTPUT);
  pinMode(GreenLed, OUTPUT);
}

void loop() {
  if (WiFi.status() != WL_CONNECTED) {
    WiFi.disconnect();
    WiFi.mode(WIFI_STA);
    Serial.print("Reconnecting to ");
    Serial.println(ssid);
    WiFi.begin(ssid, pass);

    while (WiFi.status() != WL_CONNECTED) {
      delay(500);
      Serial.print(".");
    }
    Serial.println("");
    Serial.println("Connected");
    Serial.print("IP address: ");
    Serial.println(WiFi.localIP());  //IP address assigned to your ESP
  }

  if (!mfrc522.PICC_IsNewCardPresent()) {
    return;
  }

  if (!mfrc522.PICC_ReadCardSerial()) {
    return;
  }

  for (byte i = 0; i < mfrc522.uid.size; i++) {
    CardID += mfrc522.uid.uidByte[i];
  }

  Serial.print("Card Id: ");
  Serial.println(CardID);

  HTTPClient http;

  getData = "?CardID=" + CardID;
  Link = host + "data.php" + getData;

  http.begin(Link);
  Serial.println(Link);
  
  int httpCode = http.GET();
  delay(10);
  Serial.print("HTTP Code: ");
  Serial.println(httpCode);
  
  String payload = http.getString();
  
  if (payload.length() > 0) {
    Serial.print("Return Data: ");
    Serial.println(payload);
    digitalWrite(GreenLed, HIGH);
    delay(2000);
    digitalWrite(GreenLed, LOW);
  }
  else {
    digitalWrite(RedLed, HIGH);
    delay(2000);
    digitalWrite(RedLed, LOW);
  }

  Link = CardID = getData = "";
}
