import React from 'react'

// 1. CreateContextでContextを生成する(第一引数はデフォルト値)
const TitleContext = React.createContext('')

const Title = () => {
  return (
    <TitleContext.Consumer>
      {/* Consumer直下に関数を置き、Contextの値を参照する */}
      {(data) => {
        return <p>{data}</p>
      }}
    </TitleContext.Consumer>
  )
}

const Header = () => {
  return (
    <div>
      {/*HeaderからTitleへは何も渡さない*/}
      <Title />
    </div>
  )
}

const Page = () => {
  const title = 'ContextのProviderから渡されたデータ'
  
  //Providerを使ってContextに値をセットする
  //Provider以下のコンポーネントでは値を参照することができる
  return (
    <TitleContext.Provider value={title}>
      <Header />
    </TitleContext.Provider>
  )
}

export default Page