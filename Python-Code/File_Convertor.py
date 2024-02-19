import sys

from PyGLPK_Solver import *

#Needs command line support, should also return the 
#The correctly generated script

def no_csv_param():
    print("TODO")

def one_csv_param(file):
    print(file)

def two_csv_param(course_file,faculty_file):
    print(course_file+" "+faculty_file)

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


