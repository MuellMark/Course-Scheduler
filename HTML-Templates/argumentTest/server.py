import webbrowser
from flask import Flask, render_template
app = Flask(__name__)

@app.route('/')
def index():
  return render_template('index.html')

@app.route('/my-link/')
def my_link():
  return ("You got it")

if __name__ == '__main__':
  app.run(debug=True)