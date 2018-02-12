import pigpio
import time
import sys
#initialisiern
pi = pigpio.pi()
pi.set_mode(27, pigpio.OUTPUT)
pi.write(27, 1)
time.sleep(0.5)
pi.write(27, 0)