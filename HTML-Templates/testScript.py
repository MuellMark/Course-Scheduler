import sys

def main(arg1, arg2, arg3, arg4):
    print("Chosen courseID: " + arg1)
    print("Given course name: " + arg2)
    print("Given course abbreviation: " + arg3)
    if(arg4 == "on"):
        print("this course meets for 4 hours " + arg4)

if __name__ == "__main__":
    main(sys.argv[1], sys.argv[2],sys.argv[3], sys.argv[4])