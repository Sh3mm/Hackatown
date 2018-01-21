import json
from decimal import *
from sys import argv

def getopts(input):
    dic = {}
    while input:
        if input[0][0] == '-':
            dic[input[0]] = input[1]
        input = input[1:]
    return dic

with open("data.json") as json_file:
    json_data = json.load(json_file)

longitude = float(argv[1])
latitude = float(argv[2])
lon = []
lat = []

for x in range(len(json_data['latitude']))[1::]:
    if float(json_data['latitude'][x]) < latitude + (float(1)/111) and float(json_data['latitude'][x]) > latitude - (float(1) / 111):
        if float(json_data['longitude'][x]) < longitude + (float(1) / 111) and float(json_data['longitude'][x]) > longitude - (float(1) / 111):
            print(float(json_data['latitude'][x]), longitude + (float(1) / 111), (float(1) / 111))
            lon += [json_data['longitude'][x]]
            lat+= [json_data['latitude'][x]]

output = {'longitude': lon, 'latitude': lat}

with open('map.json', 'w') as f:
    json.dump(output, f)
print(len(lon))
