print "Running"
import json
from pymongo import MongoClient
import requests
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
url = "http://api.meaningcloud.com/sentiment-2.1"
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
	print(T)
	line1=''
	for line in T.splitlines():
		line1+=line+'.'
	#print line1
	payload = "key=41b0eba519ad447e4a4050d38a2bcc47&lang=en&txt="+line1+"&txtf=plain&url=YOUR_URL_VALUE&doc=YOUR_DOC_VALUE"

	headers = {'content-type': 'application/x-www-form-urlencoded'}
	response = requests.request("POST", url, data=payload, headers=headers)
       	M=json.loads(response.text)
	collection.insert({"name":infile,"score":M['score_tag'],"Text":T})
	#print(M['score_tag'])
print "done"
