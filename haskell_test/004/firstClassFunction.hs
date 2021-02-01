import Data.List

-- evenなら引数に渡した関数を適用する
ifEven myFunction x = if even x
  then myFunction x
  else x

inc n = n + 1
double n = n * 2
square n = n ^ 2

-- カスタムソート
author = ("Will", "Kurt")

names = [("Ian", "Curtis"),
  ("Bernard", "Sumner"),
  ("Peter", "Hook"),
  ("Stephen", "Morris"),
  ("Bob", "Morris")]

compareNames name1 name2 = if lastName1 > lastName2
  then GT
  else if lastName1 < lastName2
    then LT
    else if firstName1 > firstName2
      then GT
      else if firstName1 < firstName2
        then LT
        else EQ
  where
    firstName1 = fst name1
    firstName2 = fst name2
    lastName1 = snd name1
    lastName2 = snd name2

-- sortBy compareNames names
-- => [("Ian","Curtis"),("Peter","Hook"),("Bob","Morris"),("Stephen","Morris"),("Bernard","Sumner")]

-- 戻り値としての関数
addressLetter name location = locationFunction name
  where locationFunction = getLocationFunction location

getLocationFunction location = case location of
  "ny" -> nyOffice
  "sf" -> sfOffice
  "reno" -> renoOffice
  _ -> (\name -> (fst name) ++ " " ++ (snd name))

sfOffice name = if lastName < "L"
  then nameText ++ " - PO Box 1234 - San Fransisco, CA 94111"
  else nameText ++ " - PO Box 1234 - San Fransisco, CA 94111"
  where
    lastName = snd name
    nameText = (fst name) ++ " " ++ lastName

nyOffice name = nameText ++ ": PO Box 789 - New York, NY, 10013"
  where nameText = (fst name) ++ " " ++ (snd name)

renoOffice name = nameText ++ " - PO Box 456 - Reno NV 89523"
  where nameText = snd name