-- 型シノニム(同じ1つの型に対して別名をつける)
-- patientInfo :: String -> String -> Int -> Int -> String
type PatientName = (String, String)
type Age = Int
type Height = Int

patientInfo :: PatientName -> Age -> Height -> String
patientInfo name age height = patientName ++ " " ++ ageHeight
  where
    patientName = fst name ++ ", " ++ snd name 
    ageHeight = "(" ++ show age ++ "yrs. " ++ show height ++ "in.)"

firstName :: PatientName -> String
firstName patient = fst patient

lastName :: PatientName -> String
lastName patient = snd patient

-- 柔軟なNameの型
type FirstName = String
type LastName = String
type MiddleName = String
data Name = Name FirstName LastName | NameWithMiddle FirstName MiddleName LastName
showName :: Name -> String
showName (Name f l) = f ++ " " ++ l
showName (NameWithMiddle f m l) = f ++ " " ++ m ++ " " ++ l

name1 = Name "Jerome" "Salinger"
name2 = NameWithMiddle "Jerome" "David" "Salinger"

-- 新しい型を作る(型コンストラクタ / データコンストラクタ)
data Sex = Male | Female

data RhType = Pos | Neg
data ABOType = A | B | AB | O
data BloodType = BloodType ABOType RhType

patient1BT :: BloodType
patient1BT = BloodType A Pos

patient2BT :: BloodType
patient2BT = BloodType O Neg

patient3BT :: BloodType
patient3BT = BloodType AB Pos

showRh :: RhType -> String
showRh Pos = "+"
showRh Neg = "-"

showABO :: ABOType -> String
showABO A = "A"
showABO B = "B"
showABO AB = "AB"
showABO O = "O"

showBloodType :: BloodType -> String
showBloodType (BloodType abo rh) = showABO abo ++ showRh rh

-- ドナーになれるかの判定
canDonateTo :: BloodType -> BloodType -> Bool
canDonateTo (BloodType O _) _ = True
canDonateTo _ (BloodType AB _) = True
canDonateTo (BloodType A _) (BloodType A _) = True
canDonateTo (BloodType B _) (BloodType B _) = True
canDonateTo _ _ = False

-- data Patient = Patient Name Sex Int Int Int BloodType
-- johnDoe :: Patient
-- johnDoe = Patient (Name "John" "Doe") Male 30 74 200 (BloodType AB Pos)

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

donorFor :: Patient -> Patient -> Bool
donorFor p1 p2 = canDonateTo (bloodType p1) (bloodType p2)

showSex Male = "Male"
showSex Female = "Female"

patientSummary :: Patient -> String
patientSummary patient = "********\n" ++
  "Sex: " ++ showSex (sex patient) ++ "\n" ++
  "Age: " ++ show (age patient) ++ "\n" ++
  "Height" ++ show (height patient) ++ " in.\n" ++
  "Weight" ++ show (weight patient) ++ " lbs.\n" ++
  "Blood Type: " ++ showBloodType (bloodType patient) ++
  "\n********\n"