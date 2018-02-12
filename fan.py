#!/usr/bin/python
import os
import sys
#PWM initialisieren
os.system("gpio -g mode 18 pwm")
os.system("gpio pwm-ms")
os.system("gpio pwmr 128")
os.system("gpio pwmc 6")
VAL = sys.argv[1]


os.system("gpio -g pwm 18 {}".format(VAL))