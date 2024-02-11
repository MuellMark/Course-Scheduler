from datetime import datetime
from pyscript import display
import asyncio
#Runs the server:
# python3 -m http.server

#link to local page
# http://0.0.0.0:8000/
def now():
    fmt = "%m/%d/%Y, %H:%M:%S"
    return f"{datetime.now():{fmt}}"

def test_method():
    return("Hello World!")

display(now(), target="output1", append=False)
display(test_method(), target="output2", append=False)

# async def foo():
#     while True:
#         await asyncio.sleep(1)
#         output = now()
#         display(output, target="output2", append=False)

#         if output[-1] in ["0", "4", "8"]:
#             display("It's espresso time!", target="output3", append=False)
#         else:
#             display("", target="output3", append=False)

# await foo()