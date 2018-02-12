import pigpio
import time
import os.path
import os
#init
pi = pigpio.pi()
leds = [16,20,21]
datei = open("/var/www/html/continue.txt", "w")
datei.close()

pi.set_PWM_dutycycle(16, 0)
pi.set_PWM_dutycycle(20, 0)
pi.set_PWM_dutycycle(21, 0)

while('true'):
	for l in leds:
		for k in range(0,255,1):
			pi.set_PWM_dutycycle(l, k)
			time.sleep(0.01)
			print(k)
		for k in range(255,0, -1):
			pi.set_PWM_dutycycle(l, k)
			time.sleep(0.01)
			print(k)
		if os.path.isfile("/var/www/html/continue.txt"):
			print("continue")
		else:
			print("wird beendet")
			sys.exit
pi.stop()
