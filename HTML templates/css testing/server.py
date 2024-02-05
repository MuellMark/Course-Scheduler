import webbrowser
from flask import Flask, render_template
app = Flask(__name__)

@app.route('/')
def index():
  return render_template('index.html')

@app.route('/my-link/')
def my_link():
  print ('I got clicked!')
  webbrowser.open('https://www.youtube.com/watch?v=dQw4w9WgXcQ')  # Go to example.com

if __name__ == '__main__':
  app.run(debug=True)