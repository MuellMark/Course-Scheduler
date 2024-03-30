import sys # For command line
import csv # For file reading

from PyGLPK_Solver import *

#------------Helper Functions-----------------------------------------------

# Method calls the PyGLPK_Solver to create the LP and run PyGLPK
def call_PyCLPK_Solver(contents_course_restrict,contents_faculty_restrict,forced_courses):
    generate_and_run(contents_course_restrict,contents_faculty_restrict,forced_courses)
    print_all_rows_and_columns()
    print_readable_format(contents_course_restrict)
    export_csv_website(contents_course_restrict,contents_faculty_restrict,forced_courses,"/Users/markymarkscomputer/Desktop/Course-Scheduler/Python-Code/CSV_Files/test_export.csv")

# Method specifically for single file CSVs. It splits the CSV into 2 
# separate lists and then calls PyGLPK_solver
#TODO, add in functinoality for forced columns
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
            if contents_all_restrict[i][0] == "<course_restrict>":
                course_bool=True
            if contents_all_restrict[i][0] == "<faculty_restrict>":
                faculty_bool=True
                course_bool=False
        if len(contents_all_restrict[i])>1: # Only adds rows with more than one value in it
            if course_bool:
                contents_course_restrict.append(contents_all_restrict[i])      
            elif faculty_bool:
                contents_faculty_restrict.append(contents_all_restrict[i])
        i+=1
    call_PyCLPK_Solver(contents_course_restrict,contents_faculty_restrict,forced_courses)

#------------Functions based on number of params----------------------------

# Default for testing as I redistribute code, will remove once complete
def no_csv_param():
    # Default test files
    course_restrict_file = open("/Users/markymarkscomputer/Desktop/Course-Scheduler/Python-Code/CSV_Files/csTemplateCourseRestrictions.csv",'r')
    faculty_restrict_file = open("/Users/markymarkscomputer/Desktop/Course-Scheduler/Python-Code/CSV_Files/csTemplateFacultyRestrictions.csv",'r')

    temp_course_restrict = csv.reader(course_restrict_file)
    contents_course_restrict = list(temp_course_restrict)
    temp_faculty_restrict = csv.reader(faculty_restrict_file)
    contents_faculty_restrict = list(temp_faculty_restrict)

    call_PyCLPK_Solver(contents_course_restrict,contents_faculty_restrict,[])
    

# For when there is only 1 csv file
def one_csv_param(file):
    all_restrict_file = open(file,'r')

    temp_all_restrict = csv.reader(all_restrict_file)
    contents_all_restrict = list(temp_all_restrict)

    split_single_csv_and_run(contents_all_restrict)

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

# Will only run if file is called directly TODO change no params
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
