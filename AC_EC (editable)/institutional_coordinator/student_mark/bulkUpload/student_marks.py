import pymysql,xlrd,sys,re
mapper={
		"sem":0,
		"email":1,
        "marks":2,
        "file_location":3,
        "host":4,
        "username":5,
        "password":6,
        "dbname":7,
        }
header=[]
header_id={}
start_col=1
argument=list(map(str.strip, sys.argv[1].strip('[]').split(',')))
n=len(argument)
# dept={'COMP':'1','IT':'2','EXTC':'3','ETRX':'4','MECH':'5'}
#database connection
connection = pymysql.connect(host=argument[mapper['host']], user=argument[mapper['username']], passwd=argument[mapper['password']], database=argument[mapper['dbname']])
cursor = connection.cursor()
file=xlrd.open_workbook(argument[mapper["file_location"]])
data = file.sheet_by_index(0)
for y in range(0,data.ncols):
	header.append(data.cell(0,y).value.lower())
try:
	for x in range(start_col,n-5):
		header_id[argument[x].lower()]=header.index(argument[x].lower())
except Exception as e:
    print(re.findall(r"'(.*?)'",str(e),)[0]+" is not a column in the uploaded sheet")
    sys.exit(0)

insert="""INSERT into student_marks(email_id,sem,gpa) VALUES(%s,%s,%s);"""
sem=argument[mapper['sem']]
try:
	for x in range (1,data.nrows):
		email=data.cell(x,header_id[argument[mapper['email']].lower()]).value
		#print(email)
		marks=data.cell(x,header_id[argument[mapper['marks']].lower()]).value
		#print(rollno)
		values=(email,sem,marks)
		#executing query
		cursor.execute(insert,values)
except Exception as e:
    print(str(e))
    sys.exit(0)
# print("executed query")
#commiting the query into db
connection.commit()
print("Successful")
connection.close()