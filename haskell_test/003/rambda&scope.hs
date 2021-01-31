-- (\x -> x * 2) 5 //10

-- whereを使う例
sumSquareOrSquareSum x y = if sumSquare > squareSum
  then sumSquare
  else squareSum
  where
    sumSquare = x^2 + y^2
    squareSum = (x + y)^2

-- 変数を使わず、関数を2つに分けてみる 
body sumSquare squareSum = if sumSquare > squareSum
  then sumSquare
  else squareSum

sumSquareOrSquareSum02 x y = body (x^2 + y^2) ((x + y)^2)

-- bodyは別にいらないのでラムダ関数にする
sumSquareOrSquareSum03 x y = (\sumSquare squareSum ->
  if sumSquare > squareSum
  then sumSquare
  else squareSum) (x^2 + y^2) ((x + y)^2)

-- let
sumSquareOrSquareSum04 x y =
  let
    sumSquare = (x^2 + y^2)
    squareSum = (x + y) ^2
  in
    if sumSquare > squareSum
    then sumSquare
    else squareSum

-- 変数を上書きする例 最後は4が返される
overwrite x = let x = 2
  in
    let x = 3
      in
        let x = 4
          in
            x

-- rambda関数で書き換え
overwrite2 x = (\x -> x + 1)((\x -> x + 1)((\x -> x) x))

-- レキシカルスコープ
x = 4
add1 y = y + x
add2 y = (\x -> y + x) 3
add3 y = (\y -> (\x -> x + y) 1 ) 2
-- add1 1 => 5
-- add2 1 => 4
-- add3 1 => 3

-- Lesson
simple = (\x -> x)

makeChange = (\owed given -> 
  if given - owed > 0
  then given - owed
  else 0)

inc = (\x -> x + 1)
double = (\x -> x * 2)
square = (\x -> x ^ 2)

--Lesson2
counter x = (\x -> x + 1)((\x -> x + 1) ((\x -> x) x))