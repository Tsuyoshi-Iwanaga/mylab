-- 型シノニム(型に別名をつける)
type FirstName = String
type MiddleName = String
type LastName = String
type Age = Int
type Height = Int

data Name = Name FirstName LastName | NameWithMiddle FirstName MiddleName LastName

showName :: Name -> String
showName (Name f l) = f ++ " " ++ l
showName (NameWithMiddle f m l) = f ++ " " ++ m ++ " " ++ l

name1 = Name "Jerome" "Salinger"
name2 = NameWithMiddle "Jerome" "David" "Salinger"

-- レコード構文で型を定義する
data Patient = Patient {
  name :: Name,
  sex :: Sex,
  age :: Int,
  height :: Int,
  weight :: Int,
  bloodType :: BloodType
}

jackieSmith :: Patient
jackieSmith = Patient {
  name = Name "Jackie" "Smith",
  age = 43,
  sex = Female,
  height = 62,
  weight = 115,
  bloodType = BloodType O Neg
}

jackieSmithUpdated = jackieSmith { age = 44 }

-- 型コンストラクタ データコンストラクタ
data Sex = Male | Female

data RhType = Pos | Neg
data ABOType = A | B | AB | O
data BloodType = BloodType ABOType RhType

-- patient
patient1BT :: BloodType
patient1BT = BloodType A Pos

patient2BT :: BloodType
patient2BT = BloodType O Neg

patient3BT :: BloodType
patient3BT = BloodType AB Pos

-- Rh
showRh :: RhType -> String
showRh Pos = "+"
showRh Neg = "-"

-- ABO
showABO :: ABOType -> String
showABO A = "A"
showABO B = "B"
showABO AB = "AB"
showABO O = "O"

-- BloodType
showBloodType :: BloodType -> String
showBloodType (BloodType abo rh) = showABO abo ++ showRh rh

-- canDonateTo
canDonateTo :: BloodType -> BloodType -> Bool
canDonateTo (BloodType O _) _ = True
canDonateTo _ (BloodType AB _) = True
canDonateTo (BloodType A _) (BloodType A _) = True
canDonateTo (BloodType B _) (BloodType B _) = True
canDonateTo _ _ = False

