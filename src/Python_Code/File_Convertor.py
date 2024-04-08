import sys # For command line
import csv # For file reading

from PyGLPK_Solver import *

#------------Helper Functions-----------------------------------------------

def copy(l):
    new_list=[]
    for val in l:
        new_list.append(val)
    return new_list

# Method calls the PyGLPK_Solver to create the LP and run PyGLPK
def call_PyCLPK_Solver(contents_course_restrict,contents_faculty_restrict,forced_courses):
    # Success tracks whether or not the schedule is feasible
    success = generate_and_run(contents_course_restrict,contents_faculty_restrict,forced_courses)
    if success:
        # print_all_rows_and_columns()
        print_readable_format(contents_course_restrict)
    else:
        print("infeasible")
    export_csv_website(success,contents_course_restrict,contents_faculty_restrict,forced_courses,"/Users/markymarkscomputer/Desktop/Course-Scheduler/src/Python_Code/CSV_Files/test_export.csv")

# Method specifically for single file CSVs. It splits the CSV into 2 
# separate lists and then calls PyGLPK_solver
def split_single_csv_and_run(contents_all_restrict):
    # Boolean values to denote whento parse different aspects
    course_bool = False
    faculty_bool = False

    # Stores the courses
    forced_courses=[]
    contents_course_restrict = []
    contents_faculty_restrict = []

    # Parses list and puts faculty and course into respective lists
    i=0
    while i < len(contents_all_restrict):
        if len(contents_all_restrict[i])==2:
            forced_courses.append(contents_all_restrict[i])
        elif len(contents_all_restrict[i])==1:
            if"<course" in contents_all_restrict[i][0]:
                course_bool=True
            if"<faculty" in contents_all_restrict[i][0]:
                faculty_bool=True
                course_bool=False
        if len(contents_all_restrict[i])>1: # Only adds rows with more than one value in it
            if course_bool:
                contents_course_restrict.append(contents_all_restrict[i])      
            elif faculty_bool:
                contents_faculty_restrict.append(contents_all_restrict[i])
        i+=1
    call_PyCLPK_Solver(contents_course_restrict,contents_faculty_restrict,forced_courses)

def expand_sections_from_site(contents_all_restrict):
    course_dict={}
 
    add_to_dict = False

    # populates the dictionary
    for line in contents_all_restrict:
        if len(line)>0:
            if "<course" in line[0]:
                add_to_dict=True
            if"<faculty" in line[0]:
                add_to_dict=False
            if len(line)>2 and add_to_dict:
                course_dict[line[0]]=int(line[2])
                line.remove(line[2])
    
    # adds in the section numbers to the conflicting courses
    for key in course_dict:
        is_course=False
        for line in contents_all_restrict:
            if len(line)>0:
                if "<course" in line[0]:
                    is_course=True
                if"<faculty" in line[0]:
                    is_course=False
            
            i=0
            section_num=1
            while i<len(line):
                if is_course and i>0 and line[i]==key:
                    if section_num<int(course_dict[key]):
                        line.insert(i,line[i])
                    line[i]+=str(section_num)
                    section_num+=1
                    
                i+=1

    # duplicates the rows of courses with multiple sections and edits their names to add
    # all section numbers
    for key in course_dict:
        is_course=False

        i=0
        val=0
        while i<len(contents_all_restrict):
            line=contents_all_restrict[i]
            if len(line)>0:
                if "<course" in line[0]:
                    is_course=True
                if"<faculty" in line[0]:
                    is_course=False

                if is_course and line[0]==key:
                    if val+1<int(course_dict[key]):
                        contents_all_restrict.insert(i+1,copy(line))
                    line[0]+=str(val+1)
                    val+=1
            i+=1

    # Adds all of the section numbers to the faculty restrictions 
    for key in course_dict:
        is_fac=False
        for line in contents_all_restrict:
            if len(line)>0:
                if"<faculty" in line[0]:
                    is_fac=True
            
            i=0
            section_num=1
            while i<len(line):
                if is_fac and i>0 and line[i]==key:
                    line[i]+=str(course_dict[key])
                    course_dict[key]-=1 
                i+=1

    # print(contents_all_restrict)
    split_single_csv_and_run(contents_all_restrict)

#------------Functions based on number of params----------------------------

# Default for testing as I redistribute code, will remove once complete
def no_csv_param():
    # Default test files
    course_restrict_file = open("/Users/markymarkscomputer/Desktop/Course-Scheduler/src/Python_Code/CSV_Files/csAndMathTemplateCourseRestrictions.csv",'r')
    faculty_restrict_file = open("/Users/markymarkscomputer/Desktop/Course-Scheduler/src/Python_Code/CSV_Files/csAndMathTemplateFacultyRestrictions.csv",'r')

    temp_course_restrict = csv.reader(course_restrict_file)
    contents_course_restrict = list(temp_course_restrict)
    temp_faculty_restrict = csv.reader(faculty_restrict_file)
    contents_faculty_restrict = list(temp_faculty_restrict)

    call_PyCLPK_Solver(contents_course_restrict,contents_faculty_restrict,[])
    

# For when there is only 1 csv file, has two params to specify the type of csv file
def one_csv_param(file,file_type):
    all_restrict_file = open(file,'r')

    temp_all_restrict = csv.reader(all_restrict_file)
    contents_all_restrict = list(temp_all_restrict)

    if file_type=="user":
        split_single_csv_and_run(contents_all_restrict)
    elif file_type=="site":
        expand_sections_from_site(contents_all_restrict)     
    else:
        print("error")

# Original standard, when there are 2 csv files
def two_csv_param(course_file,faculty_file):
    course_restrict_file = open(course_file,'r')
    faculty_restrict_file = open(faculty_file,'r')

    temp_course_restrict = csv.reader(course_restrict_file)
    contents_course_restrict = list(temp_course_restrict)
    temp_faculty_restrict = csv.reader(faculty_restrict_file)
    contents_faculty_restrict = list(temp_faculty_restrict)
    call_PyCLPK_Solver(contents_course_restrict,contents_faculty_restrict,[])

#------------Main--------------------------------------------------

# Will only run if file is called directly TODO change no params and the num_args==2 line
if __name__=="__main__":
    num_args = len(sys.argv)

    if(num_args==1):
        no_csv_param()  
    elif(num_args==2): #default in case it's called, will remove soon
        one_csv_param(sys.argv[1],"user")
    elif(num_args==3):
        one_csv_param(sys.argv[1],sys.argv[2])
        # two_csv_param(sys.argv[1],sys.argv[2])
    else:
        print("error, too many parameters")
