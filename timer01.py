from time import sleep
import xml.etree.ElementTree as ET
import MySQLdb as msd

	''' 
		--timer01.py
		-About this script:
		Timed updates of site-recommendations and new-item recommendations in our index
		every 6 minutes
	'''

conn = msd.connect(host='localhost',user='freenik',passwd='haxerocks',db='beiya')

while(conn):
	cursor=conn.cursor()

	cursor.execute("(select id,l_r from rating where `idtype`=\"c\" group by `id` ORDER BY `total`/`votes` desc limit 100) ORDER BY `l_r` desc limit 5")
	results1=cursor.fetchmany(5)  # now we have the ids of the site-recoms, we use tuple results1 to get the info of commodities

	query='select * from comminfo where '
	for counter in range(0,len(results1)):
		if counter==len(results1)-1:
			query=query+' commId='+str(results1[counter][0])
		else:
			query=query+' commId='+str(results1[counter][0])+' or'
	cursor.execute(query)
	results2=cursor.fetchmany(5) # here we got the result of site-recommended item

	# now we start to get the result of new items
	cursor.execute('select * from comminfo order by add_time DESC limit 5')
	results_news=cursor.fetchmany(5) 
	'''
		Here we got two tuples, so we r using number index below
		0 for commId, 3 for commTitle, 5 for commPhotoId, 9 for price
	''' 
	# deal with xml
	domtree=ET.parse('D:/xampp/htdocs/beiya/indexdata.xml')
	root=domtree.getroot()

	items=root.findall("./siterec/item")  # the list of site recommendations
	i=0 # counter
	for row in results2:   # the site-recoms 
		items[i].find('commid').text=str(row[0])
		items[i].find('title').text=str(row[3])
		items[i].find('picid').text=str(row[5])
		items[i].find('price').text=str(row[9])
		i=i+1
	
	items=root.findall("./newitems/item")  # the list of newitems
	i=0 # counter
	for row in results_news: 
		items[i].find('commid').text=str(row[0])
		items[i].find('title').text=str(row[3])
		items[i].find('picid').text=str(row[5])
		items[i].find('price').text=str(row[9])
		i=i+1

	domtree.write('D:/xampp/htdocs/beiya/indexdata.xml')


	cursor.close()

	sleep(600) # update our index page every 10 minutes

	

