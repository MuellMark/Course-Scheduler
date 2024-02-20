import sys

from PyGLPK_Solver import *

#------------Helper Functions--------------------------------------------------

# Creates dictionary to index items in a list
def createDict(dict,list):
    i=0
    for item in list:
        dict[item]=i
        i+=1

# TODO rename
def set_up(contents_course_restrict):
    # Stores all courses in a list
    courses=[]
    for course in contents_course_restrict:
        courses.append(course[0])

    # All possible meetings times
    times = ["m800","m930","m1100","m200","m330","t830","t1000","t1130","t100","t230"]

    # Makes dictionaries to call values by their respective names
    tI={}
    createDict(tI,times)
    cI={}
    createDict(cI,courses)

#------------Functions based on number of params----------------------------

#Needs command line support, should also return the 
#The correctly generated script

# Default for testing as I redistribute code, will remove once complete
def no_csv_param():
    # Default test files
    course_restrict_file = open("/Users/markymarkscomputer/Desktop/Course-Scheduler/Python-Code/csAndMathTemplateCourseRestrictions.csv",'r')
    faculty_restrict_file = open("/Users/markymarkscomputer/Desktop/Course-Scheduler/Python-Code/csAndMathTemplateFacultyRestrictions.csv",'r')

    temp_course_restrict = csv.reader(course_restrict_file)
    contents_course_restrict = list(temp_course_restrict)
    temp_faculty_restrict = csv.reader(faculty_restrict_file)
    contents_faculty_restrict = list(temp_faculty_restrict)



# notes for command line params:
# Need to add in file readers
    
# For when there is only 1 csv file
def one_csv_param(file):
    print(file)

# Original standard, when there are 2 csv files
def two_csv_param(course_file,faculty_file):
    print(course_file+" "+faculty_file)

#------------Main--------------------------------------------------

# Will only run if file is called directly
if __name__=="__main__":
    num_args = len(sys.argv)

    if(num_args==1):
        no_csv_param()
    elif(num_args==2):
        one_csv_param(sys.argv[1])
    elif(num_args==3):
        two_csv_param(sys.argv[1],sys.argv[2])
    else:
        print("error, too many parameters")


