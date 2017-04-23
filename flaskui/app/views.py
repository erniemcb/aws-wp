from app import app
from flask import Flask, render_template, request
from form import PostUserForm
from list import ListAllUsers
import requests
import os

#app = Flask(__name__)

app.secret_key = 'random-key=you-never-guess'
@app.route('/index')
def index():
  return render_template("index.html")

@app.route('/')
@app.route('/form', methods=['GET','POST'])
def form():
  URL=os.environ.get('PHP_REST_ENDPOINT')
  form = PostUserForm()
  if request.method == 'POST':
    try:
    #return form.name.data + form.username.data
      r = requests.post(URL+"/"+form.username.data+"/"+form.name.data)
      return r.text
    except requests.exceptions.ConnectionError:
      #return "Ooops...cant seem to connect to "+URL
      return render_template("error.html", url=URL)
  else:
    return render_template("form.html", form=form)

@app.route('/list', methods=['GET', 'POST'])
def list():
  URL=os.environ.get('PHP_REST_ENDPOINT')
  #URL="http://php-rest/restdb.php"
  ListUsers = ListAllUsers()
  if request.method == 'POST':
    r = requests.get(URL+'/allusers')
    return r.text
  else:
    return render_template("list.html", listusers=ListUsers)
