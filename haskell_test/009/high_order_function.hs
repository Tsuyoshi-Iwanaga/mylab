import Data.Char

-- map
myMap f [] = []
myMap f (x:xs) = f x : myMap f xs

--filter
myFilter test [] = []
myFilter test (x:xs) = if test x
  then x:myFilter test xs
  else myFilter test xs

--lesson Remove
remove test [] = []
remove test (x:xs) = if test x
  then remove test xs
  else x:remove test xs

--lesson myProduct
myProduct xs = foldl (*) 1 xs

--全部の文字を連結する
concatAll xs = foldl (++) "" xs

--各要素を2乗し、足し合わせる
sumOfSquares xs = foldl (+) 0 (map (^2) xs)

--listを逆順にする
myReverse xs = foldl (\x y -> y:x) [] xs

--foldlを実装してみる(左畳み込み)
myFoldl f init [] = init
myFoldl f init (x:xs) = myFoldl f newInit xs
  where newInit = f init x

--foldrを実装してみる(右畳み込み)
myFoldr f init [] = init
myFoldr f init (x:xs) = f x rightResult
  where rightResult = myFoldr f init xs

--lessson01 elemを実装してみる 4 `elem` [1, 2, 3, 4] -> true
myElem val xs = (length filteredList) /= 0
  where filteredList = filter (== val) xs

--lesson02
isPalindrome text = processedText == reverse processedText
  where
  noSpace = filter (/= ' ') text
  processedText = map toLower noSpace

--lesson03
harmonic n = foldl (+) 0 list
  where
  list = map (\x -> 1 / x) [1..n]

harmonic2 n = sum (take n seriesValues)
  where
  seriesPairs = zip (cycle[1.0]) [1.0, 2.0 ..]
  seriesValues = map (\pair -> (fst pair)/(snd pair)) seriesPairs
