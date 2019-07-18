print "Running"
import json
from pymongo import MongoClient
import requests
from nltk.sentiment.vader import SentimentIntensityAnalyzer
import nltk

nltk.download('vader_lexicon')
import sys
reload(sys)
sys.setdefaultencoding('utf8')
import io
from google.cloud import vision
from google.cloud.vision import types
client = vision.ImageAnnotatorClient()
import os
import datetime
m_client = MongoClient('localhost', 27017)
db = m_client.test
collection = db.text
collection.delete_many({})
path1 = 'photos/'

listing = os.listdir(path1)
keyword=''
collection.delete_many({})
for infile in listing:
	path=path1+'/'+infile
	T=''
        with io.open(path, 'rb') as image_file:
        	content = image_file.read()
	image = types.Image(content=content)
	response = client.text_detection(image=image)
	texts = response.text_annotations
	for text in texts:
		T+=text.description.encode('ascii','ignore')
        #collection.insert_one({"text":T,"keyword":keyword,"Date":datetime.datetime.now()})
	#print(T)
	line1=''
	for line in T.splitlines():
		line1+=line+'.'
	#print line1
	sid = SentimentIntensityAnalyzer()
	ss = sid.polarity_scores(line1)
	#print line1
	#print ss
       	Max=max(ss['neg'],ss['neu'],ss['pos'])
	print Max
	if(ss['neg'] == Max):
		score='N'
	elif(ss['neu'] == Max):
		score='NONE'
	elif(ss['pos'] == Max):
		score='P'
	print score
	collection.insert({"name":infile,"score":score,"Text":T})
	#print(M['score_tag'])
print "done"
