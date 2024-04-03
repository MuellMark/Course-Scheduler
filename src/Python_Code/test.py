import os
def returnName():
    return "test"
def createFile(csv_file,app,filename):
    csv_file.save(os.path.join(
                app.config['UPLOAD_FOLDER'],
                filename
            ))