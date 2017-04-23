"""This script is run to test the app in development mode """

from app import app
app.run(host='0.0.0.0', port=8080, debug=True)
