const { ApolloServer, gql } = require('apollo-server')
const { PrismaClient } = require('@prisma/client')

const prisma = new PrismaClient()

const typeDefs = gql`
  type User {
    id: ID!
    name: String!
    email: String!
    myPosts: [Post]
  }

  type Post {
    id: ID!
    title: String!
    body: String!
    userId: ID!
  }

  type Query {
    hello(name: String!): String
    users: [User]
    user(id: ID!): User
    posts: [Post]
  }

  type Mutation {
    createUser(name: String!, email: String!): User
    updateUser(id: Int!, name: String!): User
    deleteUser(id: Int!): User
  }
`

const resolvers = {
  Query: {
    hello: (parent, args) => {
      console.log('parent', parent)
      console.log('args', args)
      return `Hello ${args.name}`
    },
    users: () => {
      return prisma.user.findMany()
    },
    user: async (_, args) => {
      return prisma.user.findUnique({
        where: {
          id: Number(args.id)
        }
      })
    },
    posts: async () => {
      return prisma.post.findMany()
    }
  },
  Mutation: {
    createUser: (_, args) => {
      return prisma.user.create({
        data: {
          name: args.name,
          email: args.email
        }
      })
    },
    updateUser: (_, args) => {
      return prisma.user.update({
        where: {
          id: args.id,
        },
        data: {
          name: args.name,
        }
      })
    },
    deleteUser: (_, args) => {
      return prisma.user.delete({
        where: {id: args.id},
      })
    }
  },
  User: {
    myPosts: async (parent) => {
      const myPosts = prisma.post.findMany({
        where: {authorId: parent.id}
      })
      return myPosts
    }
  }
}

const server = new ApolloServer({ typeDefs, resolvers })

server.listen().then(({ url }) => {
  console.log(`Server ready at ${url}`)
})