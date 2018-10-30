#include <SoftwareSerial.h>

#define TX_PIN 7
#define RX_PIN 6

#define sensor A0

SoftwareSerial ble(RX_PIN, TX_PIN);

int state = 0;
float t = 0;
float read_A0;       
float vol_A0 = 0;  
float vol_Filter = 0;

void setup(){
  ble.begin(9600);
}

void loop(){
  if(ble.available()){
    char re = ble.read();
    if (re == 'E') state = 1;
    switch(re){
      case 'E':
        start();
      break;
    }
  }
}

void start(){
  while(1){
    read_sensor();
    ble.print('|'); 
    ble.print(vol_A0); 
    delay(100);
    
    if(ble.available()){
      if(ble.read() == 'Q') return;
    }
  }
}

float read_sensor(){
  read_A0 = analogRead(A0);    
  vol_A0 = map(read_A0,0,1023,0,5000);
  delay(100);
}
