#include <SoftwareSerial.h>
const int buttonPin = 2;     // the number of the pushbutton pin
     // the number of the LED pin

// variables will change:
int buttonState = 0;     
SoftwareSerial BTserial(10, 11); // RX | TX
#include "DHT.h"
#define DHTPIN 5
#define DHTTYPE DHT11
DHT dht(DHTPIN, DHTTYPE);

void setup() {
  pinMode(buttonPin,INPUT);
   BTserial.begin(9600);
  dht.begin();
}

void loop()
{
   buttonState = digitalRead(buttonPin);
  // check if the pushbutton is pressed. If it is, the buttonState is HIGH:
  if (buttonState == HIGH) {
    // turn LED on:
    BTserial.print("Accident ");
  } 
  else {
    // turn LED off:
    BTserial.print(" Safe ");
  
  }
  readSensor();
  delay(5000);

}
void readSensor() {
  float h = dht.readHumidity();
  float t = dht.readTemperature();

  if (isnan(h) || isnan(t)) {
    BTserial.println("Failed to read from DHT sensor!");
    return;
  }

  float hic = dht.computeHeatIndex(t, h, false);
  BTserial.print("Temperature: ");
  BTserial.print(t);
  BTserial.print(" *C ");
  BTserial.print("Heat index: ");
  BTserial.print(hic);
  BTserial.print(" *C ");
  BTserial.print("\n");
}
