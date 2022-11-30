import csv
import json

with open('data/input01.csv', 'r') as f:
  d_reader = csv.DictReader(f)
  d_list = [row for row in d_reader]

with open('data/output01.json', 'w') as f:
  json.dump(d_list, f, indent=2, ensure_ascii=False)