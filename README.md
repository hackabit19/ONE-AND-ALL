# ONE-AND-ALL
Emergency Road Accident Detection and Response System .
                 
                                       WORKING OF OUR PROJECT

1)	There is an iot device consisting of an Arduino Uno board , a temperature sensor, a bluetooth module and a parallel plate sensor.

2)	This device will be installed in the vehicles and it will be connected with a user’s app through Bluetooth.

3)	The parallel plate sensor has 2 plates. One plate will be in connection with the outer layer of the vehicle and another will be connected to the inner layer of the vehicle and so the parallel plate sensor circuit is incomplete.

4)	When an accident occurs the two layers of the vehicle will touch each other due to the impact and the parallel plate sensor circuit will be completed.

5)	Or when the vehicle catches fire and temperature increases then also the iot device will send a fire response to the app.

6)	When the circuit is completed the iot device will send an accident response to the app. The app will then send the GPS location of the accident and the current temperature to our firebase database.

7)	We have a javascript code written which will be hosted at servers.

8)	This code runs and checks for accident responses in our database and their GPS location and then sends the location through ably channels to the ambulance , pcr van or firefighters nearby.

9)	There is also an app for the ambulance and pcr vans which listens to the location published through ably realtime and gives the ambulance driver the location for the accident.

10)	We also have a heatmap feature which is used to analyse the accident data.

11)	Whenever an accident occurs the location is saved in our database. And using this data we can map it into google heatmap and create an accident intensity graph.

12)	It will help us to analyse which areas have higher accident rates and what is the reason behind it.

13) The activity_main.java and activity_main.xml file contains the code for the user's app.

14) Arduino_code.ino contains the code for the arduino board.

15) ably.php contains the code to publish locations thorugh ably realtime api.

16) heatmap.php contains the code for the accident intensity graph.  

17) drivers_App.php contains the driver platform to know about the accident location and get the directions.

