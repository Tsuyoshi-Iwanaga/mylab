import { useQuery, gql } from '@apollo/client'

const GET_USERS = gql`
  query GetUsers {
    users {
      id
      name
      email
    }
  }
`

type User = {
  id: String,
  name: String,
  email: String,
}

type UserResponse = {
  users: User[]
}

function App() {
  const { loading, error, data } = useQuery<UserResponse>(GET_USERS)

  if (loading) return <p>ローディング中</p>
  if (error) return <p>エラーが発生!</p>

  return (
    <>
      <h1>GraphQL Test</h1>
      {data ? data.users.map(user => {
        return (
          <dl key={Number(user.id)} style={{display: "flex"}}>
            <dt>{user.name}</dt>
            <dd>{user.email}</dd>
            <dd>{user.id}</dd>
          </dl>
        )
      }): <p>ユーザなし</p>}
    </>
  )
}

export default App
