#!/usr/bin/env python
"""This script runs together with gunicorn to server the web app"""

from app import app

if __name__ == "__main__":
    app.run()
