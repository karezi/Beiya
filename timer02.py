from time import sleep
import MySQLdb as msd

'''	
 	--timer02.py
	-About this script:
	This script controls the timed detection of ratings:
		We examine the 'l_r' column (AKA he last rating time ) in table 'rating' every 2 minutes,
		if any commodity or shop is rated in the past 2 minutes, we update its 'rating' column 
		in table 'comminfo' or table 'shopinfo' 
'''

conn = msd.connect(host='localhost',user='freenik',passwd='haxerocks',db='beiya')
while(conn):
	cursor=conn.cursor()
	cursor.execute("select id,idtype,(votes/total) as raty from rating where TIMESTAMPDIFF(MINUTE,`l_r`,CURRENT_TIMESTAMP)<2")

	result=cursor.fetchall() #we now get a tuple of tuples

	if result:
		# prepare to update the database
		query_c="update comminfo SET rating= CASE commId "   #comminfo
		query_s="update shopinfo SET rating= CASE shopId "	#shopinfo

		# Behold..
		def func_c():
			query_c=query_c+" WHEN "+str(row[0])+" THEN "+str(row[2])
		def func_s():
			query_s=query_s+" WHEN "+str(row[0])+" THEN "+str(row[2])
		for row in result:
			{
			'c':lambda:func_c,
			's':lambda:func_s
			}[row[1]]()

		query_c=query_c+" END WHERE commId IN ( "
		query_s=query_s+" END WHERE shopId IN ( "

		def func_c2():
			query_c=query_c+str(neorow[0])+" , "
		def func_s2():
			query_s=query_s+str(neorow[0])+" , "
		i=0 # counter
		for neorow in result:
			if i!=len(result)-1:
				{
				'c':lambda:func_c2,
				's':lambda:func_s2
				}[neorow[1]]()
			else:
				if neorow[1]=='c':
					query_c=query_c+str(neorow[0])+" )"
				if neorow[1]=='s':
					query_s=query_s+str(neorow[0])+" )"
		# Gotcha!


		detection1=cursor.execute(query_c)
		detection2=cursor.execute(query_s)

		if detection1: # executed successfully
			print 'C Good!'
		else:
			print 'C Not cool at all!'
		if detection2: # executed successfully
			print 'S Good!'
		else:
			print 'S Not cool at all!'

		# Mission complete

		cursor.close()
	else:
		cursor.close()

	sleep(120) # updates every 2 minutes