/* 

This code needs to be uploaded to the waspmotes - v1.1 Xbee Pro cant be docked

TODO:
"SensorX" "ID_0X" destination macadress needs to be in variables  
RTC pull RTC needs to be optimized as is it consumes more energy
RTC.setTime really necessary?
Sensors insertation need to be automized
*/

int x_acc, y_acc, z_acc, w_rtc =0;
long previous=0;
char X[10];
char Y[10];
char Z[10];
char W[10];
packetXBee* paq_sent;
char data[40];
uint8_t state=2;
uint8_t counter=0;


#define NORMAL_OPTION  0
#define FREE_OPTION  1

void setup()
{  
  ACC.begin();    // opens I2C bus
  ACC.setMode(ACC_ON); // starts accelerometer
  ACC.setFF();

  RTC.ON();       
  
  RTC.setTime("09:10:20:03:17:35:00");

  xbee802.init(XBEE_802_15_4,FREQ2_4G,NORMAL); // init 'xbee802' object  
  xbee802.ON(); // opens UART and powers XBee

  previous=millis();
}

void loop()
{
  if( intFlag & ACC_INT )
  {
    intFlag &= ~(ACC_INT);    
    sendData(FREE_OPTION);
    ACC.setFF();
  }
  else if( (millis()-previous) > 100 )
  {
    sendData(NORMAL_OPTION);
    previous=millis();
  }
}

// sends a message changing it depending on the input option
void sendData(uint8_t option)
{
   paq_sent=(packetXBee*) calloc(1,sizeof(packetXBee)); 
   paq_sent->mode=UNICAST;
   paq_sent->MY_known=0;
   paq_sent->packetID=0x52;
   paq_sent->opt=0; 
   xbee802.hops=0;

   xbee802.setOriginParams(paq_sent, "SensorX", NI_TYPE);
  
   
  switch(option)
  {
    case  NORMAL_OPTION :      x_acc=ACC.getX();
                               y_acc=ACC.getY();
                               z_acc=ACC.getZ();   
                               w_rtc=RTC.getTemperature();                            
                               
                               Utils.long2array(x_acc,X);
                               Utils.long2array(y_acc,Y);
                               Utils.long2array(z_acc,Z);
                               Utils.long2array(w_rtc,W);
                               sprintf(data,"ID_W0X#%u#%s#%u#%s#%s#%s%c%c", PWR.getBatteryLevel(), W, 0, X, Y, Z, '\r','\n');
                               break;
                               
    case  FREE_OPTION :        x_acc=ACC.getX();
                               y_acc=ACC.getY();
                               z_acc=ACC.getZ();
                               w_rtc=RTC.getTemperature();   
                                               
                               Utils.long2array(x_acc,X);
                               Utils.long2array(y_acc,Y);
                               Utils.long2array(z_acc,Z);
                               Utils.long2array(w_rtc,W);
                                              
                               int auxReg = ACC.readRegister(FF_WU_SRC);
                               int acc=0;
                               if (auxReg & XHIE) acc+=1;
                               if (auxReg & YHIE) acc+=2;
                               if (auxReg & ZHIE) acc+=4;                                          
                                              
                               sprintf(data,"ID_W0X#%u#%s#%u#%s#%s#%s%c%c", PWR.getBatteryLevel(), W, acc, X, Y, Z, '\r','\n');
                               break;                                          
  }

   xbee802.setDestinationParams(paq_sent, "0013A200406748A3", data, MAC_TYPE, DATA_ABSOLUTE);
   while( counter<3 ) {
     state=xbee802.sendXBee(paq_sent);
     counter++;
   }
   counter=0;
   if(!state)
   {
     XBee.println("OK");
   }
   free(paq_sent);
   paq_sent=NULL;
}

