-- GCDを求める関数
myGCD a b = if remainder == 0
  then b
  else myGCD b remainder
  where remainder = a `mod` b

myGCD a 0 = a
myGCD a b = myGCD b (a `mod` b)

-- パターンマッチング
sayAmount n = case n of
  1 -> "one"
  2 -> "two"
  n -> "a bunch"

sayAmount2 1 = "one"
sayAmount2 2 = "two"
sayAmount2 n = "a bunch"

isEmpty [] = True
isEmpty _ = False

myHead (x:xs) = x
myHead [] = error "No head for empty list"

myTail(_:xs) = xs
myTail [] = []