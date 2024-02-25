import sys # For command line
import csv # For file reading

from PyGLPK_Solver import *

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

    generate_and_run(contents_course_restrict,contents_faculty_restrict)
    print_readable_format(contents_course_restrict)
    
# TODO add command line support in the same way as above, 
# may need to export to a separate method

# For when there is only 1 csv file
def one_csv_param(file):
    print(file)

# Original standard, when there are 2 csv files
def two_csv_param(course_file,faculty_file):
    print(course_file+" "+faculty_file)

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
