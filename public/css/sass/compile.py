import os

for file in os.listdir():
    if file.split('.')[1] == 'sass':
        os.system(f"sass {file} ../{file.split('.')[0]}.css --style=compressed")