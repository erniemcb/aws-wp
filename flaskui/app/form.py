from flask_wtf import Form
from wtforms import StringField, PasswordField, SubmitField

class PostUserForm(Form):
  name = StringField('First Name')
  username = StringField('Username')
  submit = SubmitField('Add User') 
