import time
from selenium import webdriver #pip install selenium
import chromedriver_binary #pip install chromedriver-binary==77.0.3865.40.0
import pandas as pd #pip install pandas
import sys
import re

driver = webdriver.Chrome()

#エクセル読み込み
asinList = pd.read_csv('./asinList.csv', encoding="UTF-8")

for asin in asinList['ASIN']:
    #ページを読み込む
    url = 'https://www.amazon.co.jp/dp/' + asin + '/'
    driver.get(url)

    #セレクタで取得、要素をテキストで表示
    for price in driver.find_elements_by_css_selector('#reviewsMedley .AverageCustomerReviews'):
      groups = re.search(r'(\d\.\d)', price.text)
      print(groups.group())

    time.sleep(5)

driver.quit()
sys.exit()



