simple x = x
-- :t simple
-- simple :: p -> p

aList = ["cat", "dog", "mouse"]
-- :t aList
-- aList :: [[Char]]

-- :t (+)
-- (+) :: Num a => a -> a -> a

-- 型クラスとは共通の振る舞いをもつ型のグループを表すために使用される
-- :info Num ※型クラスの定義を表示する

-- Num型クラスを実装していれば下記の関数は使用できる
addThenDouble :: Num a => a -> a -> a
addThenDouble x y = (x + y) * 2

-- よく使う型クラス
-- Ord
-- Eq
-- Bounded
-- Show

data Icecream = Chocolate | Vanilla deriving (Show, Eq, Ord)