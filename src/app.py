from flask import Flask, request, render_template, send_file
import csv
import io
import test
import subprocess
import sys
import os
from collections import defaultdict
from io import StringIO


app = Flask(__name__)
#Initialize folders
app.config['UPLOAD_FOLDER'] = app.static_folder

#Routes for web apps
@app.route('/')
def index():
    return render_template('landing_page.php')
#Home Page
@app.route('/home')
def home():
    return render_template('landing_page.php')
#Dynamic Content
@app.route('/dynamic')
def dynamic():
    return render_template('dynamic_merge.php')
#FAQ Page
@app.route('/faq')
def faq():
    return render_template('faq.php')
#CSV Options
@app.route('/option')
def option():
    return render_template('csv_option.php')
#Guides Page
@app.route('/howto')
def howto():
    return render_template('about-howto.php')
#CSV Import Page
@app.route('/importpg')
def importpg():
    return render_template('import_csv.php')

#Retrieve  CSV data from file and store in a list.
def getCSVData():
    #Path to CSV file
    csv_file_path = "output.csv"

    # Initialize an empty list to store the data from the CSV file
    csv_data = []
    # Open the CSV file and read its contents
    with open(csv_file_path, newline='') as csvfile:
        #Create a CSV object
        csv_reader = csv.reader(csvfile)
        # Iterate over each row in the CSV file
        for row in csv_reader:
            # Append each row to the csv_data list
            csv_data.append(row)
    #Return list
    return csv_data

#Organize CSV data based on field
def organizeData():
    # Create a defaultdict to store entries based on the code
    entries = defaultdict(list)

    # Read the input CSV file
    with open('output.csv', 'r') as csvfile:
        reader = csv.reader(csvfile)
        #Iterate over each row
        for row in reader:
            number, code, label, *rest_var = row
            # number, code, label, professor, money = row
            #Check if there are more items
            if len(rest_var) >= 1:
                #Use the first extra item as the faculty
                faculty = rest_var[0]
            else:
                #Default faculty assignment
                faculty = "Faculty TBD"
            #Grouping the entries
            entries[code].append((number, label, faculty))

    # Write the merged data to the output CSV file
    with open("output.csv", 'w', newline='') as csvfile:
        #CSV writer
        writer = csv.writer(csvfile)
        #Iterate through data
        for code, data_list in entries.items():
            if len(data_list) > 1:  # Only merge if there are multiple entries with the same code
                merged_row = [data_list[0][0], code]
                data_list = sum(data_list,())
                expanded_list = []
                for item in data_list:
                    if isinstance(item, tuple):
                        expanded_list.extend(item)
                    else:
                        expanded_list.append(item)
                merged_row.extend([entry[0:] for entry in expanded_list])
                #Write the merged rows
                writer.writerow(merged_row)
            else:
                #Unmerged items are added
                writer.writerow([data_list[0][0], code, data_list[0][1], data_list[0][2]])

#Post Requests 

#Handles file uploads and operations
@app.route('/upload', methods=['POST'])
def upload():
    #Access the file
    csv_file = request.files['csv_file']
    if csv_file:
        # Read the uploaded CSV file
        csv_data = csv_file.read().decode('utf-8') 
        #Convert from a string to a StringIO object to read as CSV
        csv_reader = csv.reader(io.StringIO(csv_data))

        test.createFile(csv_file,app)
        #Write CSV data to file "input.csv"
        test.write_csv_to_file(csv_reader, "input.csv")
        command = "python File_Convertor.py input.csv csv both"
        #Execute the above command
        subprocess.call(command, shell=True)

        # Render HTML template with CSV data
        if(notInfeasible()):
            # organizeData()
            csv_function_data = getCSVData()
            return render_template('display.php', csv_data=csv_function_data)
        else:
            return render_template('infeasible_from_import.php') # Goes to separate page
    else:
        return render_template('no_file_page.php') # Goes to separate page

#Handles forced courses
@app.route("/force", methods=['GET', 'POST'])
def force():
    f = open('user_output.csv','r')
    newf = open('force.csv','w')
    lines = f.readlines() # read old content
    newf.write("<forced_courses>" + "\n" + request.form['course'] + "," + request.form['time'] + "\n") # write new content at the beginning
    for line in lines: # write old content after new
        newf.write(line)
    newf.close()
    f.close()
    command = "python File_Convertor.py force.csv csv both"
    subprocess.call(command, shell=True)
    if(notInfeasible()):
        # organizeData()
        csv_function_data = getCSVData()
        return render_template('display.php', csv_data=csv_function_data)
    else:
        csv_function_data = getCSVData()
        return render_template('displayInfeasible.php', csv_data=csv_function_data)

#Handles  Swapping courses
@app.route("/swap", methods=['GET', 'POST'])
def swap():
    #OPen the output file
    f = open('user_output.csv','r')
    #Open a new file for the forced changes
    newf = open('swap.csv','w')
    lines = f.readlines() # read old content
    #Start new content on a new line
    newf.write("<swapped_courses>" + "\n" + request.form['course1'] + "," + request.form['course2'] + "\n") # write new content at the beginning
    for line in lines: # write old content after new
        newf.write(line)
    newf.close()
    f.close()
    command = "python File_Convertor.py swap.csv swap both output.csv"
    subprocess.call(command, shell=True)
    #Check if the changes are feasible
    if(notInfeasible()):
        # organizeData()
        csv_function_data = getCSVData()
        return render_template('display.php', csv_data=csv_function_data)
    else:
        csv_function_data = getCSVData()
        return render_template('displayInfeasible.php', csv_data=csv_function_data)

#Check if the CSV meets specified criteria 
def notInfeasible():
    #open output CSV file
    with open('user_output.csv', 'r', newline='') as file:
        if 'infeasible' in file.read(): # if infeasible is in the file, not feasible
            return False
    return True

    
#Handles downloading CSV 
@app.route('/download_csv', methods=['POST'])
def download_csv():
    file_path = 'user_output.csv'  # Update this with the actual path to your CSV file
    #Check if file exists
    if os.path.exists(file_path):
        #Download on users end
        return send_file(file_path, as_attachment=True)
    else:
        return "File not found"


if __name__ == '__main__':
    #Run Flask
    app.run(host="0.0.0.0", port="8080")