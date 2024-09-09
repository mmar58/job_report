#!C:\Python310\Python.exe
import requests,cgi,json
from bs4 import BeautifulSoup
from datetime import date
from datetime import timedelta
import mysql.connector as connector
mydb=connector.connect(
    host="localhost",
    username="root",
    password="123456",
    database="job_report"
)
email="rahmanapu118@gmail.com"
cursor=mydb.cursor()
print("Content-Type: text/html\n\n")
output={"result":[]}
def saveData(thedata):
    print(thedata)
    cursor.execute("select * from dailywork	where date = '"+thedata["date"]+"'")
    result=cursor.fetchall()
    hour="0"
    testmin=[]
    processedData=thedata['data'].split("h")
    if len(processedData)>1:
        hour=processedData[0]
        testmin=processedData[1].split("m")
    else:
        testmin=processedData[0].split("m")
    minute="0"
    if(len(testmin)>1):
        minute=testmin[0].replace(" ","")
    if result==[]:
        cursor.execute("insert into dailywork (date,hour,minutes) values (%s,%s,%s)",(thedata['date'],hour,minute))
        mydb.commit()
    else:
        cursor.execute("update dailywork set hour='"+hour+"', minutes = '"+minute+"' where date='"+thedata["date"]+"'")
        print("updated")
        mydb.commit()
def printOutput():
    for row in output["result"]:
        saveData(row)
def GetWorkingTime(date):
    webdata=BeautifulSoup(requests.get("https://data.staffcounter.net/report/"+email+"?date="+date).content, 'html.parser')
    closerdata=webdata.find('div', {"style": "display: inline-block;vertical-align: middle;"})
    data=closerdata.parent.find_next('td').text.strip()
    output["result"].append({"date":date,"data":data})
import cgi

# Get the form data from the request
form = cgi.FieldStorage()

# Get the value of the "data" parameter
days=form.getvalue("days")
if days==None:
    GetWorkingTime(str(date.today()))
    printOutput()
else:
    days=int(days)
    count=0
    while count<days:
        GetWorkingTime(str(date.today()-timedelta(days=count)))
        count+=1
    printOutput()

        
