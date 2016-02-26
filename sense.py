import sys
import Adafruit_DHT
import MySQLdb
import Adafruit_BMP.BMP085 as BMP085

sensor=BMP085.BMP085();
humid,temp=Adafruit_DHT.read_retry(Adafruit_DHT.DHT11,5)
humid1,temp1=Adafruit_DHT.read_retry(Adafruit_DHT.DHT11,4)
pressure=sensor.read_pressure()

print str(temp)+" "+str(humid)+" "+str(temp1)+" "+str(humid1)+" "+str(pressure)
if humid is not None and temp is not None and temp1 is not None and humid1 is not None and pressure is not None:
	db=MySQLdb.connect("localhost","root","mysql","sensor")
	curs=db.cursor()
	try:
		sqlline="insert into sensors values(NOW(),{0:0.1f},{1:0.1f},{2:0.1f},{3:0.1f},{4:0.1f});".format(temp,humid,temp1,humid1,pressure)
		curs.execute(sqlline)
#		curs.execute("DELETE FROM sensor WHERE ttime<NOW()-INTERVAL 180 DAYS;")
		db.commit()
		print "Data Committed"
	except MySQLdb.Error as e: 
		print "error:The Database is being rolled back"+str(e)
		db.rollback()
else:
	print "Failed to get reading.Try Again!"

