-- クロージャ
getIfEven f = (\x -> ifEven f x)

ifEven f x = if even x
  then f x
  else x

inc x = x + 1

ifEvenInc x = getIfEven inc x

-- API Request
getRequestUrl host apikey resource id = host ++ "/" ++ resource ++ "/" ++ id ++ "?token=" ++ apikey

genHostRequestBuilder host = (\apikey resource id -> getRequestUrl host apikey resource id)

exampleUrlBuilder = genHostRequestBuilder "http://example.com"

genApiRequestBuilder hostBuilder apiKey = (\resource id -> hostBuilder apiKey resource id)

myExampleUrlBuilder = genApiRequestBuilder exampleUrlBuilder "xxxxxxxxxx"

-- 部分適用
add4 a b c d = a + b + c + d

-- addXto3 x = (\b c d -> add4 x b c d)
mystery = add4 3
anotherMystery = add4 4 5

-- 上のAPIリクエスト処理を部分適用を使って簡単に書いてみる
exampleUrlBuilder02 = getRequestUrl "http://example.com"
lBuilder02 = exampleUrlBuilder02 "xxxxxxx"

-- 部分適用を行うには引数の順番が大事、解決するものから順番に並べていく
-- またすでにある関数の引数を逆にする
flipBinaryArgs binaryFunction = (\x y -> binaryFunction y x)

-- Lesson5-2
binaryPartialApplication f x = (\y -> f x y)