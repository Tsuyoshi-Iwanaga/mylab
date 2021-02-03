-- リスト
head01 = head [1, 2, 3]
tail01 = tail [1, 2, 3]
list01 = 1:2:3:4:5:[]

-- ""はCharのリストという扱い
hello01 = 'h':"ello"
hello02 = "h" ++ "ello"

-- 遅延評価 無限のリスト
simple x = x
longList = [1 ..]
stillLongList = simple longList

-- インデックスアクセス
index01 = [1, 2, 3] !! 0
index02 = "puppies" !! 4
index03 = (!!) [1, 2, 3] 0

-- 部分適用と前置表記
paExample1 = (!!) "dog"
paExample2 = ("dog" !!)
-- paExample1 2
paExample3 = (!! 2)
-- paExample3 "dog" => g

-- 回文の判定メソッド
isPalindrome word = word == reverse word

-- リストに要素を含むか
contain x list = elem x list

-- 2項関数の中置
respond phrase = if '!' `elem` phrase
  then "wow!"
  else "uh... okey"

-- cycle
assignToGroups n aList = zip groups aList
  where groups = cycle [1..n]

-- lesson
repeat n = cycle[n]

subseq start end myList = take difference (drop start myList)
  where difference = end - start

inFirstHalf val myList = val `elem` firstHalf
  where firstHalf = take ((length myList) `div` 2) myList