-- コンストラクタ
robot (name, attack, hp) = \message -> message (name, attack, hp)

-- アクセサ
getName aRobot = aRobot (\(n,_,_)->n)
getAttack aRobot = aRobot (\(_,a,_)->a)
getHP aRobot = aRobot (\(_,_,h)->h)

-- セッター
setName aRobot newName = aRobot (\(n,a,h) -> robot(newName, a, h))
setAttack aRobot newAttack = aRobot(\(n,a,h) -> robot(n, newAttack, h))
setHP aRobot newHP = aRobot(\(n,a,h) -> robot(n, a, newHP))

-- 確認用のメソッド
printRobot aRobot = aRobot(\(n,a,h) -> n ++ " attack:" ++ (show a) ++ " hp:" ++ (show h))

-- ダメージ
damage aRobot attackDamage = aRobot (\(n,a,h) -> robot(n,a,h-attackDamage))

-- 戦闘
fight aRobot defender = damage defender attack
  where attack = if getHP aRobot > 10 then getAttack aRobot else 0