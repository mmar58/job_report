import requests

url = "https://kama.magicmind.me/cga/signup"

payload = {
  "email": "nostra@dam.us",
  "password": "pass55",
  "host": "true"
}
headers = {"Content-Type": "application/json"}

response = requests.post(url, json=payload, headers=headers)

print(response)
print(response.json())

<Response [400]>
Traceback (most recent call last):
  File "C:\Python312\Lib\site-packages\requests\models.py", line 971, in json
    return complexjson.loads(self.text, **kwargs)
           ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
  File "C:\Python312\Lib\json\__init__.py", line 346, in loads
    return _default_decoder.decode(s)
           ^^^^^^^^^^^^^^^^^^^^^^^^^^
  File "C:\Python312\Lib\json\decoder.py", line 337, in decode
    obj, end = self.raw_decode(s, idx=_w(s, 0).end())
               ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
  File "C:\Python312\Lib\json\decoder.py", line 355, in raw_decode
    raise JSONDecodeError("Expecting value", s, err.value) from None
json.decoder.JSONDecodeError: Expecting value: line 1 column 1 (char 0)

During handling of the above exception, another exception occurred:

Traceback (most recent call last):
  File "F:\Server\job_report\assets\test.py", line 15, in <module>
    print(response.json())
          ^^^^^^^^^^^^^^^
  File "C:\Python312\Lib\site-packages\requests\models.py", line 975, in json
    raise RequestsJSONDecodeError(e.msg, e.doc, e.pos)
requests.exceptions.JSONDecodeError: Expecting value: line 1 column 1 (char 0)

Process finished with exit code 1
