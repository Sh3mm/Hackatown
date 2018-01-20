import json

import csv
#----------------------------------------------------------------------
import csv
name = []
longitude = []
latitude = []
status = []
genre = []
rate = []
with open('Places.csv', newline='') as csvfile:
    spamreader = csv.reader(csvfile, delimiter=',', quotechar='|')
    for row in spamreader:
        name += [row[0]]
        longitude += [row[3]]
        latitude += [row[4]]
        status += [row[5]]
        genre += [row[6]]
        rate += [row[12]]


data = {'name' : name,
        'longitude': longitude,
        'latitude': latitude,
        'status': status,
        'genre': genre,
        'rate': rate}

with open('data.json', 'w') as f:
    json.dump(data, f)

