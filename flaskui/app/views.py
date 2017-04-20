from app import app
from flask import Flask, render_template, request
from form import PostUserForm
import requests

#app = Flask(__name__)

app.secret_key = 'random-key=you-never-guess'
@app.route('/index')
def index():
  return render_template("index.html")

@app.route('/')
@app.route('/form', methods=['GET','POST'])
def form():
  URL="http://localhost/restdb.php"
  form = PostUserForm()
  if request.method == 'POST':
    #return form.name.data + form.username.data
    r = requests.post(URL+"/"+form.username.data+"/"+form.name.data)
    return r.text
  else:
    return render_template("form.html", form=form)
