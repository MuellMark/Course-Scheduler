import glpk

#------------Helper Functions and Code----------------------------

# Global variable to keep track of the row index for pyGLPK LP
class Row_Index:
    def __init__(self,row_Index):
        self.row_Index = row_Index

    def add(self):
        self.row_Index+=1

    def getRowIndex(self):
        return self.row_Index

# Stores the matrix as it is built to then be added to lp.matrix  
class Global_Matrix:
    def __init__(self):
        self.matrix = []

    def append(self,temp_matrix):
        self.matrix+=temp_matrix
    
    def get_Global_Matrix(self):
        return self.matrix
    
row_index = Row_Index(0) # Init rowIndex

global_matrix = Global_Matrix() #Init global matrix

# Creates dictionary to index items in a list
def createDict(dict,list):
    i=0
    for item in list:
        dict[item]=i
        i+=1

# # All possible meetings times
times = ["m800","m930","m1100","m200","m330","t830","t1000","t1130","t100","t230"]

# Initialize LP
lp = glpk.LPX() #Creates lp
lp.name = 'schedule'
lp.obj.maximize = False #Minimizing, not maximizing

#------------Constraint Methods----------------------------

# writes objective function
def add_objective_function(all_combos):
    obj_fun = []
    for combo in all_combos:
        obj_fun.append(int(combo[len(combo)-1:]))

    lp.obj[:]=obj_fun


# Adds the variables into the LP
def add_cols(all_combos):
    col_index=0
    for combo in all_combos:
            lp.cols.add(1)
            lp.cols[col_index].name=str(combo)
            lp.cols[col_index].bounds = 0,1
            lp.cols[col_index].kind=int
            col_index+=1

# Makes sure each given course is only offered once
def courses_offered_cons(all_combos):
    matrix=[]
    for course in courses:
        lp.rows.add(1)
        lp.rows[row_index.getRowIndex()].name = course
        lp.rows[row_index.getRowIndex()].bounds = 1
        row_index.add()
        
        # initialize an array to store values for a given row
        temp_matrix = [0]*len(all_combos)
        for time in times:
            for col in range(num_cols):
                temp_matrix[(maxT*maxC*col)+(cI[course]*maxT)+tI[time]]=1
        matrix+=(temp_matrix)

    global_matrix.append(matrix)

# Makes sure each time/ column paring only has 1 course offered          
def time_overlap_cons(all_combos):
    matrix=[]
    for col in range(num_cols):
        for time in times:
            lp.rows.add(1)
            temp_matrix = [0]*len(all_combos)
            temp_name = "col"+str(col+1)
            temp_name+=time
            lp.rows[row_index.getRowIndex()].name = temp_name
            lp.rows[row_index.getRowIndex()].bounds = 0,1
            row_index.add()
            for course in courses:
                temp_matrix[(maxT*maxC*col)+(cI[course]*maxT)+tI[time]] = 1
            matrix+=temp_matrix
    global_matrix.append(matrix)

#TODO 
# Each column can only have 10 different courses and a certain amount of any
# of courses have to be in a given column before the next is considered
def generalColCons(all_combos):
    matrix=[]
    for col in range(num_cols):
        lp.rows.add(1)
        temp_matrix = [0]*len(all_combos)
        lp.rows[row_index.getRowIndex()].name = "Col"+ str(col+1)
        lp.rows[row_index.getRowIndex()].bounds = 0,10
        row_index.add()
        for course in courses:
            for time in times:
                temp_matrix[(maxT*maxC*col)+(cI[course]*maxT)+tI[time]] = 1
        matrix+=temp_matrix

    global_matrix.append(matrix)

    # Idea should be that columns fill up before moving onto the next one,
    # I think these need to be reworked, aside from the current issue

    # if(num_cols>1):
    #     col1Matrix=[]
    #     for col in range(num_cols):
    #         lp.rows.add(1)
    #         temp_matrix = [0]*len(all_combos)
    #         lp.rows[row_index.getRowIndex()].name = "Col1First"
    #         lp.rows[row_index.getRowIndex()].bounds = 0,9
    #         row_index.add() 
    #         for course in courses:
    #             for time in times:
    #                 if(col==0):
    #                     temp_matrix[(maxT*maxC*col)+(cI[course]*maxT)+tI[time]] = 1
    #         col1Matrix+=temp_matrix
    #     global_matrix.append(matrix)

    # # comment this out to see if that fixes it 
    # if(num_cols>2):
    #     col1Matrix=[]
    #     for col in range(num_cols):
    #         lp.rows.add(1)
    #         temp_matrix = [0]*len(all_combos)
    #         lp.rows[row_index.getRowIndex()].name = "Col2Second"
    #         lp.rows[row_index.getRowIndex()].bounds = 0,7
    #         row_index.add() 
    #         for course in courses:
    #             for time in times:
    #                 if(col==1):
    #                     temp_matrix[(maxT*maxC*col)+(cI[course]*maxT)+tI[time]] = 1
    #         col1Matrix+=temp_matrix
    #     global_matrix.append(matrix)

# Forces 4 hour courses to be held on MWF
def four_contact_hour_cons(all_combos,contents):
    matrix=[]
    for row in contents:
        if(row[1]=='TRUE'):
            for col in range(num_cols):
                lp.rows.add(1)
                temp_matrix = [0]*len(all_combos)
                lp.rows[row_index.getRowIndex()].name = "4HrCol"+ str(col+1)+row[0]
                lp.rows[row_index.getRowIndex()].bounds = 0
                row_index.add()
                for time in times:
                    # check if time starts with t, because 4 hr courses can't
                    # meet on tuesdays or thursdays
                    if(time[0]=='t'): 
                        temp_matrix[(maxT*maxC*col)+(cI[row[0]]*maxT)+tI[time]] = 1
                matrix+=temp_matrix

    global_matrix.append(matrix)


# Contains much of the course constraints: takes into account invalid times and
# when 2 courses can't be taught at the same time
def two_course_conflict_cons(all_combos,contents,duplicates):
    matrix = []
    for row in contents:
        for otherCI in range(2,len(row)): # other course index
                if row[otherCI] in courses: # Check to make sure 
                    if duplicates[cI[row[0]]][cI[row[otherCI]]] == 0 and duplicates[cI[row[otherCI]]][cI[row[0]]] == 0:
                        duplicates[cI[row[0]]][cI[row[otherCI]]]=1
                        duplicates[cI[row[otherCI]]][cI[row[0]]]=1
                        for time in times:
                            lp.rows.add(1)
                            temp_matrix = [0]*len(all_combos)
                            lp.rows[row_index.getRowIndex()].name = row[0]+"&"+row[otherCI]+time
                            lp.rows[row_index.getRowIndex()].bounds = 0,1
                            row_index.add()
                            for col in range(num_cols):
                                temp_matrix[(maxT*maxC*col)+(cI[row[0]]*maxT)+tI[time]] = 1
                                temp_matrix[(maxT*maxC*col)+(cI[row[otherCI]]*maxT)+tI[time]] = 1
                            matrix+=temp_matrix
                elif row[otherCI] in times:
                    for col in range(num_cols):
                        lp.rows.add(1)
                        temp_matrix = [0]*len(all_combos)
                        lp.rows[row_index.getRowIndex()].name = row[0]+"@"+row[otherCI]
                        lp.rows[row_index.getRowIndex()].bounds = 0
                        row_index.add()
                        for time in times:
                            if time==row[otherCI]:
                                temp_matrix[(maxT*maxC*col)+(cI[row[0]]*maxT)+tI[time]] = 1
                        matrix+=temp_matrix

    global_matrix.append(matrix)               


# The sections of a given course cannot be held at the same time as one another
def same_course_cons(all_combos,duplicates):
    matrix=[]
    for course1 in courses:
        for course2 in courses:
            if course1[0:3] == course2[0:3]:
                if duplicates[cI[course1]][cI[course2]] == 0 and duplicates[cI[course2]][cI[course1]] == 0:
                    duplicates[cI[course1]][cI[course2]]=1
                    duplicates[cI[course2]][cI[course1]]=1
                    for time in times:
                        lp.rows.add(1)
                        temp_matrix = [0]*len(all_combos)
                        lp.rows[row_index.getRowIndex()].name = course1+"&"+course2+time
                        lp.rows[row_index.getRowIndex()].bounds = 0,1
                        row_index.add()
                        for col in range(num_cols):
                            temp_matrix[(maxT*maxC*col)+(cI[course1]*maxT)+tI[time]] = 1
                            temp_matrix[(maxT*maxC*col)+(cI[course2]*maxT)+tI[time]] = 1
                        matrix+=temp_matrix
                        #loop columns, add from there
    global_matrix.append(matrix)

# Contains all of the faculty restrictions, including non-prime time hours,
# time restrictions and course overall restrictions
def faculty_restrictions(all_combos,contents,duplicates):
    matrix = []
    nonPrimeTimes = ["m800","m200","m330","t830","t230"]

    for row in contents:
        prof_name=row[0]
        courses_taught=[]
        invalid_times=[]

        # Stores all tiems that are invalid and which courses are to be
        # taught by a given professor
        row_trav = 2
        while row[row_trav] != "$":
            if row[row_trav] in courses:
                courses_taught.append(row[row_trav])
            if row[row_trav] in times:
                invalid_times.append(row[row_trav])
            row_trav+=1
        
        #TODO double check this
        if row[1] == "TRUE":
            lp.rows.add(1)
            temp_matrix = [0]*len(all_combos)
            lp.rows[row_index.getRowIndex()].name = prof_name+"Primetime"
            lp.rows[row_index.getRowIndex()].bounds = 0,1
            row_index.add()
            for col in range(num_cols):
                for course in courses_taught:
                    for time in nonPrimeTimes:
                        temp_matrix[(maxT*maxC*col)+(cI[course]*maxT)+tI[time]] = 1
            matrix+=temp_matrix
        
        if len(invalid_times)>0:
            for time in invalid_times:
                lp.rows.add(1)
                temp_matrix = [0]*len(all_combos)
                lp.rows[row_index.getRowIndex()].name = time+"InvalidFor"+prof_name
                lp.rows[row_index.getRowIndex()].bounds = 0
                row_index.add()
                for col in range(num_cols):
                    for course in courses_taught:
                        temp_matrix[(maxT*maxC*col)+(cI[course]*maxT)+tI[time]] =1
                matrix+=temp_matrix

        # 1 because if only one course, no overlap
        if len(courses_taught)>1:
            for course1 in courses_taught:
                for course2 in courses_taught:
                    if duplicates[cI[course1]][cI[course2]] == 0 and duplicates[cI[course2]][cI[course1]] == 0:
                        duplicates[cI[course1]][cI[course2]]=1
                        duplicates[cI[course2]][cI[course1]]=1
                        for time in times:
                            lp.rows.add(1)
                            temp_matrix = [0]*len(all_combos)
                            lp.rows[row_index.getRowIndex()].name = course1+"&"+course2+time
                            lp.rows[row_index.getRowIndex()].bounds = 0,1
                            row_index.add()
                            for col in range(num_cols):
                                temp_matrix[(maxT*maxC*col)+(cI[course1]*maxT)+tI[time]] = 1
                                temp_matrix[(maxT*maxC*col)+(cI[course2]*maxT)+tI[time]] = 1
                            matrix+=temp_matrix

    global_matrix.append(matrix)


#TODO FIX THIS
def force_courses_constraints(all_combos,forced_courses):
    matrix=[]

    # Should just need to refactor this so it's only looping thru columns
    # since the course and time indexes are given, also need to loop thru forced_columns
    
    for pairing in forced_courses:
        course= pairing[0]
        time= pairing[1]

        lp.rows.add(1)
        lp.rows[row_index.getRowIndex()].name = course+"forced@"+time
        lp.rows[row_index.getRowIndex()].bounds = 1
        row_index.add()

        # initialize an array to store values for a given row
        temp_matrix = [0]*len(all_combos)
        for col in range(num_cols):
                temp_matrix[(maxT*maxC*col)+(cI[course]*maxT)+tI[time]]=1
        matrix+=(temp_matrix)
        print(matrix)
    global_matrix.append(matrix)

    # for course in courses:
    #     lp.rows.add(1)
    #     lp.rows[row_index.getRowIndex()].name = course
    #     lp.rows[row_index.getRowIndex()].bounds = 1
    #     row_index.add()
        
    #     # initialize an array to store values for a given row
    #     temp_matrix = [0]*len(all_combos)
    #     for time in times:
    #         for col in range(num_cols):
    #             temp_matrix[(maxT*maxC*col)+(cI[course]*maxT)+tI[time]]=1
    #     matrix+=(temp_matrix)

    
    
    # print(matrix)

# Adds the global matrix to the lp matrix
def add_to_LP_matrix():
    lp.matrix+=global_matrix.get_Global_Matrix()

#------------Generate Method----------------------------

# Called from File_convertor to generate the schedule
def generate_and_run(contents_course_restrict,contents_faculty_restrict,forced_courses):
    # Stores the number of columns needed
    global num_cols
    num_cols = len(contents_course_restrict)
    if(num_cols<=10):
        num_cols=1
    elif(num_cols<19):
        num_cols=2
    elif(num_cols<27):
        num_cols=3
    else:
        num_cols=4

    # List of all courses offered
    global courses
    courses=[]
    for course in contents_course_restrict:
        courses.append(course[0])

    # Global creation of dictionaries needed in constraints
    global tI
    global cI
    global maxC
    global maxT
    # global global_matrix

    # Global_Matrix=
    # Makes dictionaries to call values by their respective names
    tI={}
    createDict(tI,times)
    cI={}
    createDict(cI,courses)

    # Used for indexing 
    maxC = len(courses)
    maxT = len(times)

    # Creates all_combos to store all variables
    global all_combos
    all_combos=[]
    for col in range(1,num_cols+1):
        for row in contents_course_restrict:
            for time in times:
                name = row[0]+"@"+time+"Col"+str(col)
                all_combos.append(name)

    # Created to make sure duplaicates aren;t added to LP if not needed
    duplicates=[[0 for i in range(len(courses))] for j in range(len(courses))]
    for i in range(len(courses)): # courses of same name are duplicates
            duplicates[i][i]=1

    # Calling all of the constraints
    add_cols(all_combos)
    courses_offered_cons(all_combos)
    add_objective_function(all_combos)
    time_overlap_cons(all_combos)
    generalColCons(all_combos)
    faculty_restrictions(all_combos,contents_faculty_restrict,duplicates)
    four_contact_hour_cons(all_combos,contents_course_restrict)
    two_course_conflict_cons(all_combos,contents_course_restrict,duplicates)
    same_course_cons(all_combos,duplicates)

    
    # print(lp.matrix)
    # print(len(lp.cols))
    # print(len(lp.rows))
    

    # TODO uncomment out when testing for forcing resumes
    print(forced_courses)
    if len(forced_courses)>0:
        force_courses_constraints(all_combos,forced_courses)
    
    add_to_LP_matrix()

    try:
        lp.simplex()
        lp.integer() # Force it to be intger
    except:
        print("bwoken!!!")
    #  Add a check here to see if a solution is feasible before checking integer

    

#------------Print Methods----------------------------

def print_all_rows_and_columns():
    print("objective value = " + str(lp.obj.value))
    print("Cols:")
    for c in lp.cols:
        print('%s = %g' % (c.name, c.primal))
    print("Rows:")
    for r in lp.rows:
        print('%s = %g' % (r.name, r.primal))

def print_all_filled_cols():
    print("objective value = " + str(lp.obj.value))
    for c in lp.cols:
        if c.primal ==1:
            print('%s = %g' % (c.name, c.primal))

def print_trouble_shoots():
    print("objective value = " + str(lp.obj.value))
    for c in lp.cols:
        if c.status !="bs":
            print('%s = %g' % (c.name, c.primal))

def print_readable_format(contents_course_restrict):
    count_courses_actual = len(contents_course_restrict)
    pairings=[]
    count_courses_simplex=0
    for c in lp.cols:
        if c.primal ==1:
            count_courses_simplex+=1
            pairings.append(c.name)
    if count_courses_simplex != count_courses_actual:
        print("Error with the simplex, only "+str(count_courses_simplex)+
              " courses were accounted for when "+str(count_courses_actual)+
              " courses should have been added")
    else:
        print("Success, all "+str(count_courses_actual)+" courses paired!")
    
    sortedPairings = []
    for num in range(num_cols):
        col_string = "Col"+str(num+1)
        for time in times:
            for pair in pairings:
                if col_string in pair and time in pair:
                    if pair not in sortedPairings: # Not sure why there a duplicates 
                        sortedPairings.append(pair)
    # print(pairings)
    # print(sortedPairings)
    for pair in sortedPairings:
        print(pair)

def export_csv(contents_course_restrict,contents_faculty_restrict,forced_courses,export_file_name):
    export_file = open(export_file_name,'w')
    file_contents=""
    if len(forced_courses)>0:
        file_contents+=("<forced_courses>\n")
        for pairing in forced_courses:
            file_contents+=(pairing[0]+","+pairing[1]+"\n")

    file_contents+="<course_restrict>\n"
    for line in contents_course_restrict:
        for val in line:
            if not val=="$":
                file_contents+=(val+",")
        file_contents+=("$\n")

    file_contents+="<faculty_restrictions>\n"
    for line in contents_faculty_restrict:
        for val in line:
            if not val=="$":
                file_contents+=(val+",")
        file_contents+=("$\n")

    export_file.write(file_contents)

def export_csv_website(contents_course_restrict,contents_faculty_restrict,forced_courses,export_file_name):
    export_file = open(export_file_name,'w')
    file_contents=""

    pairings=[]
    count_courses_simplex=0
    for c in lp.cols:
        if c.primal ==1:
            count_courses_simplex+=1
            pairings.append(c.name)

    sortedPairings = []
    output = []
    for num in range(num_cols):
        col_string = "Col"+str(num+1)
        for time in times:
            for pair in pairings:
                if col_string in pair and time in pair:
                    if pair not in sortedPairings: # Not sure why there a duplicates 
                        temp=str(num+1)+","+time+","+pair[:3]
                        for fac in contents_faculty_restrict:
                            if pair[:4] in fac:
                                temp+=","+fac[0]

                        sortedPairings.append(pair)
                        output.append(temp)
    # print(pairings)
    # print(sortedPairings)
    for pair in output:
        file_contents+=pair+"\n"
        
    export_file.write(file_contents)