-- コンストラクタ
cup f10z = \message -> message f10z

-- インスタンス生成
coffeeCup = cup 12

-- アクセサ
getOz aCup = aCup (\f10z -> f10z)

-- 状態の変更(新しいインスタンスを返す)
drink aCup ozDrank = if ozDiff >= 0
  then cup ozDiff
  else cup 0
  where
    f10z = getOz aCup
    ozDiff = f10z - ozDrank