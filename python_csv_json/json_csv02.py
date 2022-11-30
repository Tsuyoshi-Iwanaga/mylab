import csv
import json

with open('data/input02.json', 'r') as f:
  json_dict = json.load(f)

with open('data/output02.csv', 'w') as f:
  writer = csv.DictWriter(f, fieldnames=json_dict[0].keys(), doublequote=False)
  writer.writeheader()
  writer.writerows(json_dict)