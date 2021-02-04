-- length
myLength [] = 0
myLength xs = 1 + myLength (tail xs)

myLength2 [] = 0
myLength2 (_:xs) = 1 + myLength xs

--take
myTake _ [] = []
myTake 0 _ = []
myTake n (x: xs) = x:rest
  where rest = myTake (n - 1) xs

--cycle
myCycle (first:rest) = first:myCycle (rest ++ [first])

-- reverse
myReverse [] = []
myReverse (x:[]) = [x]
myReverse (x:xs) = myReverse xs ++ [x]

-- アッカーマン関数(パフォーマンス問題)
ackermann 0 n = n + 1
ackermann m 0 = ackermann (m-1) 1
ackermann m n = ackermann (m-1) (ackermann m (n-1))

-- コラッツ予想
collatz 1 = 1
collatz n = if even n
  then 1 + collatz (n `div` 2)
  else 1 + collatz (n*3 + 1)