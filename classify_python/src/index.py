from flask import Flask
from flask import request
from flask import Response
import classify_function
import json
import logging

app_first = Flask(__name__)
@app_first.route("/")
def hello():
 input_text = request.args.get('input_text')
 logging.warning(input_text)
 answer = classify_function.get_classification(input_text)
 x = {
    "input_text":input_text,
    "answer":answer
 }
 reply = json.dumps(x)
 r = Response (response=reply, status=200, mimetype="application/json")
 r.headers["Content-Type"]="application/json"
 r.headers["Access-Control-Allow-Origin"]="*"
 return r

 print("Aidan")
 
if __name__ == '__main__':
 app_first.run(host="0.0.0.0", port=100)