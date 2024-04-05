import os
import csv

def returnName():
    return "test"
def createFile(csv_file,app):
    csv_file.save(os.path.join(
                app.config['UPLOAD_FOLDER'],
                "input.csv"
            ))
    csv_file.save(os.path.join(
                app.config['UPLOAD_FOLDER'],
                "output.csv"
            ))
    
def write_csv_to_file(csv_data, file_path):
    # Open the file in 'w' mode to write data
    with open(file_path, 'w', newline='') as csvfile:
        # Create a CSV writer object
        csv_writer = csv.writer(csvfile)
        
        # Write each row of the CSV data to the file
        for row in csv_data:
            csv_writer.writerow(row)