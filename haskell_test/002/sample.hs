-- if & where
calcChange owed given = if change > 0
  then change
  else 0
  where
    change = given - owed

-- lesson
inc n = n + 1

double n = n * 2

square n = n ^ 2

test n = if n `mod` 2 == 0
  then n - 2
  else 3 * n + 1