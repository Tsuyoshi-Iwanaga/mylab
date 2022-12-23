import { gql, useQuery } from '@apollo/client'

const BOOKS = gql`
  query {
    test {
      title
      author
    }
  }
`

type dataType = {
  test: [{
    title: String,
    author: String
  }]
}

console.log(BOOKS)

function Books() {
  const { loading, error, data } = useQuery<dataType>(BOOKS)
  console.log(data)

  if (loading) return <p>Loading...</p>
  if (error) return <p>Error!</p>

  return (
    <>
      {data ? data.test.map(({title, author}, i) => (
        <p key={i}>{title}: {author}</p>
      )) : <p>いない</p>}
    </>
  )
}

function App() {
  return (
    <div className="App">
      <h1>GraphQL</h1>
      <Books />
    </div>
  )
}

export default App