def check_upper_limit(stu_course,courses,pref_id):
	max_limit=courses[pref_id][1]
	if(len(stu_course[pref_id])>=max_limit):
		return False
	else:
	    return True	

import pandas as pd 
import numpy as np
import pymysql,sys

mapper={
		"sem":0,
		"year":1,
        "student_pref_table":2,
        "student_course_table":3,
        "course_allocate_info_table":4,
        "course_table":5,
		"pref_percent_table":6,
		"pref_student_alloted_table":7,
        "no_of_preferences":8,
        "host":9,
        "username":10,
        "password":11,
        "dbname":12,
        }
argument=list(map(str.strip, sys.argv[1].strip('[]').split(',')))
n=len(argument)
mydb = pymysql.connect(
  host=argument[mapper['host']],
  user=argument[mapper['username']],
  passwd=argument[mapper['password']],
  database=argument[mapper['dbname']]
)
mycursor = mydb.cursor()

course_query="SELECT cid,min,max FROM "+argument[mapper['course_table']]+" WHERE sem='"+argument[mapper['sem']]+"' and year='"+argument[mapper['year']]+"'"
mycursor.execute(course_query)

myresult = mycursor.fetchall()
courses={}
for x in myresult:
  l=[x[1],x[2]]
  courses[x[0]]=l


preferences=""
for x in range(1,int(argument[mapper['no_of_preferences']])):
	preferences+="pref"+str(x)+","
preferences+="pref"+str(argument[mapper['no_of_preferences']])
student_pref_query="SELECT email_id,rollno,timestamp,"+preferences+" FROM "+argument[mapper['student_pref_table']]+" WHERE sem='"+argument[mapper['sem']]+"' and year='"+argument[mapper['year']]+"'" 	
mycursor.execute(student_pref_query)
myresult = mycursor.fetchall()
student=[]

for res in myresult:
	l=[res[0],res[1],res[2]]
	for x in range(0,int(argument[mapper['no_of_preferences']])):
		l.append(res[(x+3)])
	student.append(l)
#print(student)	
cols=['email_id','rollno','timestamp']
for x in range(1,int(argument[mapper['no_of_preferences']])+1):
	cols.append("pref"+str(x))
	
data=pd.DataFrame(student,columns=cols)
total_responses=len(data.index)
data['timestamp']=pd.to_datetime(data["timestamp"])
data=data.sort_values(by='timestamp')
data.reset_index(inplace=True,drop=True)
stu_course={}
for key in courses.keys():
	stu_course[key]=[]

student_pref_no={}
#print(courses)
print("Ater sort")
print(data.head())
overlow_by={}
for i in range(len(data)):
	eid=data.loc[i,'email_id']
	time=data.loc[i,'timestamp']
	pref=data.loc[i,data.columns[3:]].values
	pref=[x for x in pref if x.find("same")==-1 and x in courses]
	pref_true_no=[]
	trueno=1
	for h in data.loc[i,data.columns[3:]].values:
		if h.find("same")==-1 and h in courses:
			pref_true_no.append([h,trueno])
		trueno+=1
	for j in range (len(pref)):
		if(check_upper_limit(stu_course,courses,pref[j])):
			stu_course[pref[j]].append([eid,1,time,j+1,pref])
			# student_pref_no[eid]=(j+1)
			student_pref_no[eid]=pref_true_no[j][1]
			break
		else:
			student_pref_no[eid]=-1
			overlow_by[pref[j]]=overlow_by.get(pref[j],0)+1
			continue
			
count=0
count2=0
count1=0
over=[]
under=[]
unallocated=[]
total_allocated=0
for k,v in student_pref_no.items():
	if(v==-1):
		#print(k)
		count=count+1
		unallocated.append(k)
	else:
		total_allocated=total_allocated+1
		
underflow_stu_list=[]

print("After 1st iteration:")
for k,v in courses.items():
	if(len(stu_course[k])>v[1]):
		over.append(k)
		
		count1=count1+1
	if(len(stu_course[k])<v[0] and (len(stu_course[k])!=0)):
		under.append(k)
		underflow_stu_list.extend(x for x in stu_course[k])
		
		count2=count2+1
		
	print(str(len(stu_course[k]))+" are there in course "+k+" whose max is "+str(v[1])+" and min is "+str(v[0]))
	print()	
		
print(str(count1) +" courses are overflow")
print(str(count2) + " courses are underflow")
print(str(count) + "are unallocated")
print(str(total_allocated))

underflow_stu_list.sort(key = lambda underflow_stu_list: underflow_stu_list[2])
loop=0
for v in underflow_stu_list: 
    print(v[0],end=',')
print('length',len(underflow_stu_list))
print("#################################################")    
while (len(underflow_stu_list)!=0):
	for s in underflow_stu_list:
		
		prefl=s[4]
		email=s[0]
		time=s[2]
		o=underflow_stu_list.index(s)
		if(s[3]==len(prefl)):
			print(email +" "+str(s[3])+" "+str(len(prefl))+" pref list exhuasted")
			unallocated.append(email)
			del underflow_stu_list[o]
			temp=stu_course[prefl[s[3]-1]]
			temp=[k for k in temp if k[0]!=email]
			student_pref_no[email]=-1
			stu_course[prefl[s[3]-1]]=temp			
		

					
		for i in range(s[3],len(s[4])):
			
			
			#previous_pref_no=prefl[i]
			print("previous course which "+email+" opted "+prefl[s[3]-1])
			#print(email+" "+str(i)+ " "+str(len(prefl)))
			next_pref=prefl[i]
			if(i>=len(prefl)-1):
				unallocated.append(email)
				del underflow_stu_list[o]
				temp=stu_course[prefl[s[3]-1]]
				temp=[k for k in temp if k[0]!=email]
				student_pref_no[email]=-1
				stu_course[prefl[s[3]-1]]=temp
				print(email,"unallocated added")
			else:
				if(next_pref in under):
					print("sorry the course is scraped")
					continue
				
				elif(check_upper_limit(stu_course,courses,next_pref)):
					# print(email,'in else if.')
					stu_course[next_pref].append([email,1,time,i+1,prefl])
					student_pref_no[email]=i+1
					# print('before',underflow_stu_list[o])
					del underflow_stu_list[o]
					temp=stu_course[prefl[s[3]-1]]
					temp=[k for k in temp if k[0]!=email]
					stu_course[prefl[s[3]-1]]=temp
					# print('after',underflow_stu_list[o])
					print('max student:'+email+' got course '+prefl[i])
					break
				else:
					# print(email,'in else else.')
					last_stu=stu_course[next_pref][-1]
					if(last_stu[2]>time):
						print(str(len(stu_course[next_pref]))+ "length of stu_course")
						stu_course[next_pref].pop()
						temp=stu_course[prefl[s[3]-1]]
						temp=[k for k in temp if k[0]!=email]
						stu_course[prefl[s[3]-1]]=temp
						print(str(len(stu_course[next_pref]))+ "length of stu_course after pop")
						del underflow_stu_list[o]
						underflow_stu_list.append(last_stu)
						underflow_stu_list.sort(key = lambda underflow_stu_list: underflow_stu_list[2]) 
						stu_course[prefl[i]].append([email,1,time,i+1,prefl])
						student_pref_no[email]=i+1
						print('student:'+email+' got course '+prefl[i])
						break
					else:
						# print('continue')
						# print(email,'in else.')
						continue
						

	print("after iteration "+str(loop+1))				
	for v in underflow_stu_list: 
		print(v[0],end=',')
		print(student_pref_no[v[0]])
	print('length',len(underflow_stu_list))
	loop=loop+1
	if(loop==20):
		break




print("courses after 2nd iteration")			
count1=0
count2=0
for k,v in courses.items():
	if(len(stu_course[k])>v[1]):
		over.append(k)
		count1=count1+1
	if(len(stu_course[k])<v[0] and (len(stu_course[k])!=0)):
		under.append(k)
		print('v',len(stu_course[k]))
		underflow_stu_list.extend(x for x in stu_course[k])
		count2=count2+1
		
	print(str(len(stu_course[k]))+" are there in course "+k+" whose max is "+str(v[1])+" and min is "+str(v[0]))
	print()	
		
print(str(count1) +" courses are overflow")
print(str(count2) + " courses are underflow")
print(str(len(unallocated)) + "are unallocated")	

count11=0
count22=0
#print(student_pref_no)
dict1={}
for item in student_pref_no.values():
	dict1[item]=dict1.get(item,0)+1


		


print(dict1)
print(overlow_by)
print(len(overlow_by))
print(len(courses))
count=0
total_allocated=0
for k,v in student_pref_no.items():
	if(v==-1):
		#print(k)
		count=count+1
		#unallocated.append(k)
	else:
		total_allocated=total_allocated+1
print(total_allocated)
print(count)
# print('Unallocated',unallocated)
# sql updations
table_name_1='student_audit'
table_name_2='student_preference_audit'
table_name_3='audit_course'
sem=5
year='2020-21'
for course,student in stu_course.items():
	query="UPDATE `"+argument[mapper['course_table']]+"` SET no_of_allocated="+str(len(student))+" WHERE cid='"+course+"' and year='"+argument[mapper['year']]+"' and sem='"+argument[mapper['sem']]+"'"
	# print(query)
	mycursor.execute(query)
	# mydb.commit()
	for i in range(len(student)):	
		query="INSERT INTO `"+argument[mapper['student_course_table']]+"`(`email_id`, `cid`, `sem`, `year`) VALUES ('"+student[i][0]+"','"+course+"',"+str(sem)+",'"+year+"')"
		mycursor.execute(query)
		# mydb.commit()
		query="UPDATE `"+argument[mapper['student_pref_table']]+"` SET allocate_status=1 where email_id='"+student[i][0]+"' and year='"+year+"' and sem="+str(sem)
		# print(query)
		mycursor.execute(query)
		query="INSERT INTO `"+argument[mapper['pref_student_alloted_table']]+"` (email_id,pref_no) VALUES('"+student[i][0]+"','"+str(student_pref_no[student[i][0]])+"')"
		mycursor.execute(query)

		# print("INSERT INTO `"+table_name+"`(`email_id`, `cid`, `sem`, `year`) VALUES ('"+student[i][0]+"','"+course+"',"+str(sem)+",'"+year+"')")
for k,v in dict1.items():
	query="INSERT INTO `"+argument[mapper['pref_percent_table']]+"`(`pref_no`,`no_of_stu`,`percent`) VALUES('"+str(k)+"','"+str(v)+"','"+str(round(v/total_responses,4)*100)+"')"
	mycursor.execute(query)
# for k,v in student_pref_no.items():
# 	if v!=-1:
# 		query="INSERT INTO `"+argument[mapper['pref_student_alloted_table']]+"` (email_id,pref_no) VALUES('"+str(k)+"','"+str(v)+"')"
# 		mycursor.execute(query)
mydb.commit()
		