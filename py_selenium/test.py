import time
from selenium import webdriver #pip install selenium
import chromedriver_binary #pip install chromedriver-binary==77.0.3865.40.0
import pandas as pd #pip install pandas
import sys

driver = webdriver.Chrome()

#CSV読み込み
asinList = pd.read_csv('./asinList.csv', encoding="UTF-8")

for asin in asinList['ASIN']:
    url = 'https://www.amazon.co.jp/dp/' + asin + '/'
    print(url)
    driver.get(url)
    for price in driver.find_elements_by_id('availability'):
      print(price.text)
    time.sleep(5)

driver.quit()
sys.exit()



