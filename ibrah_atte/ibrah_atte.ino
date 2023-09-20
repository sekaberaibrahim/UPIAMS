#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>
#include <SPI.h>
#include <MFRC522.h>

#define SS_PIN  D2
#define RST_PIN D1
MFRC522 mfrc522(SS_PIN, RST_PIN);

const char* ssid = "Ibraah";
const char* password = "seka1234";

ESP8266WebServer server(80);
int readsuccess;
byte readcard[4];
char str[32] = "";
String StrUID;

void setup() {
  Serial.begin(115200);
  SPI.begin();
  mfrc522.PCD_Init();
  delay(500);

  WiFi.begin(ssid, password);
  Serial.println("");
  
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  
  Serial.println("");
  Serial.print("Successfully connected to : ");
  Serial.println(ssid);
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());

  pinMode(LED_BUILTIN, OUTPUT);
  digitalWrite(LED_BUILTIN, HIGH);
  
  Serial.println("Please tag a card or keychain to see the UID !");
  Serial.println("");
}

void loop() {
  readsuccess = getid();

  if (readsuccess) {
    digitalWrite(LED_BUILTIN, LOW);
    
    HTTPClient http;
    String UIDresultSend, postData;
    UIDresultSend = StrUID;

    postData = "device_id=1&card=" + UIDresultSend;
    
    WiFiClient client;
    http.begin(client, "http://192.168.212.221/atte/Attendance.php");
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");

    int httpCode = http.POST(postData);
    String response = http.getString();

    Serial.println("Card UID: " + UIDresultSend);
    Serial.println("HTTP Code: " + String(httpCode));
    Serial.println("Response: " + response);

    if (response.startsWith("Attendance recorded successfully")) {
      // Blink the LED rapidly 5 times with 100ms duration
      blinkLED(5, 100);
    } else if (response.startsWith("Attendance already taken")) {
      // Blink the LED slowly 2 times with 500ms duration
      blinkLED(2, 500);
    } else {
      // Blink the LED 3 times with 300ms duration
      blinkLED(3, 300);
    }

    http.end();
    delay(1000);
    digitalWrite(LED_BUILTIN, HIGH);
  }
}

int getid() {
  if (!mfrc522.PICC_IsNewCardPresent()) {
    return 0;
  }
  
  if (!mfrc522.PICC_ReadCardSerial()) {
    return 0;
  }

  for (int i = 0; i < 4; i++) {
    readcard[i] = mfrc522.uid.uidByte[i];
    array_to_string(readcard, 4, str);
    StrUID = str;
  }
  
  mfrc522.PICC_HaltA();
  return 1;
}

void array_to_string(byte array[], unsigned int len, char buffer[]) {
  for (unsigned int i = 0; i < len; i++) {
    byte nib1 = (array[i] >> 4) & 0x0F;
    byte nib2 = (array[i] >> 0) & 0x0F;
    buffer[i * 2 + 0] = nib1 < 0xA ? '0' + nib1 : 'A' + nib1 - 0xA;
    buffer[i * 2 + 1] = nib2 < 0xA ? '0' + nib2 : 'A' + nib2 - 0xA;
  }
  buffer[len * 2] = '\0';
}

void blinkLED(int times, int duration) {
  for (int i = 0; i < times; i++) {
    digitalWrite(LED_BUILTIN, LOW);
    delay(duration);
    digitalWrite(LED_BUILTIN, HIGH);
    delay(duration);
  }
}