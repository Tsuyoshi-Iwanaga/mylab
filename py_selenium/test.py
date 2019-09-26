import time
from selenium import webdriver #pip install selenium
import chromedriver_binary #pip install chromedriver-binary==77.0.3865.40.0
import pandas as pd #pip install pandas
import sys
import re
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.support.ui import WebDriverWait

driver = webdriver.Chrome()

#エクセル読み込み
asinList = pd.read_csv('./asinList.csv', encoding="UTF-8")

# 待機関数のタイムアウト(10秒) 指定時間を超えると例外発生
wait = WebDriverWait(driver, 10)

# 要素の存在を確認するメソッド
def is_element_exist(selector, driver_or_element):
  if driver_or_element.find_elements_by_css_selector(selector):
    return True
  else:
    return False

# 要素を取得するメソッド
def find_elements(by, selector, driver_or_element):
  if by == 'id':
    element_getter = driver_or_element.find_elements_by_id
  elif by == 'name':
    element_getter = driver_or_element.find_elements_by_name
  elif by == 'xpath':
    element_getter = driver_or_element.find_elements_by_xpath
  elif by == 'css_selector':
    element_getter = driver_or_element.find_elements_by_css_selector
  return element_getter(selector)

# レビューを取得するメソッド
def getReviewInfo():
  for review in driver.find_elements_by_css_selector('#cm_cr-review_list .review'):

    obj = dict()

    for item in review.find_elements_by_css_selector('.review-rating'):
      obj['rating'] = item.get_attribute("textContent").strip()

    for item in review.find_elements_by_css_selector('.review-date'):
      obj['date'] = item.text.strip()

    for item in review.find_elements_by_css_selector('.review-text-content'):
      obj['content'] = item.text.strip()
    
    reviewArr.append(obj)

for asin in asinList['ASIN']:

    #ページを読み込む
    url = 'https://www.amazon.co.jp/dp/' + asin + '/'
    driver.get(url)

    #レビューを格納するobject
    reviewItem = dict()

    #セレクタで取得
    for price in driver.find_elements_by_css_selector('#reviewsMedley #histogramTable .a-histogram-row:nth-of-type(1)'):

      #レビューページへ
      price.click()
      wait.until(EC.presence_of_all_elements_located)
      time.sleep(1)

      reviewArr = list()

      getReviewInfo()

      while is_element_exist('#cm_cr-pagination_bar .a-last a', driver):
        for item in driver.find_elements_by_css_selector('#cm_cr-pagination_bar .a-last a'):
          item.click()
          wait.until(EC.presence_of_all_elements_located)
          time.sleep(5)
          getReviewInfo()
          time.sleep(5)

      print(reviewArr)
      print(len(reviewArr))

    #5秒待機
    time.sleep(5)

driver.quit()
sys.exit()



