from flask_wtf import Form
from wtforms import StringField, PasswordField, SubmitField

class ListAllUsers(Form):
  submit = SubmitField('List Users') 
