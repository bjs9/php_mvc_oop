import os

print('Start...')

for file in os.listdir():
    if '.js' in file:
        f_input  = file
        f_output = '_' + file

        os.system(f"javascript-obfuscator {f_input} --output ../{f_output} --compact true --control-flow-flattening true --self-defending true --string-array true --string-array-encoding base64 --disable-console-output true --rename-globals true --transform-object-keys true --split-strings true")

print('End...')