import { PrismaClient } from '@prisma/client'

const prisma = new PrismaClient()

async function main() {
  const alice = await prisma.user.upsert({
    where: {email: 'alice@prisma.io'},
    update: {},
    create: {
      id: 1,
      email: 'alice@prisma.io',
      name: 'Alice',
    }
  })
  const bob = await prisma.user.upsert({
    where: { email: 'bob@prima.io'},
    update: {},
    create: {
      id: 2,
      email: 'bob@prisma.io',
      name: 'Bob',
    }
  })
  const post01 = await prisma.post.upsert({
    where: { id: 1 },
    update: {},
    create: {
      id: 1,
      title: 'Hello-001',
      body: 'Hello, This is my post01',
      authorId: 1,
    }
  })

  const post02 = await prisma.post.upsert({
    where: { id: 2 },
    update: {},
    create: {
      id: 2,
      title: 'Hello-002',
      body: 'Hello, This is my post02',
      authorId: 2,
    }
  })

  const post03 = await prisma.post.upsert({
    where: { id: 3 },
    update: {},
    create: {
      id: 3,
      title: 'Hello-003',
      body: 'Hello, This is my post03',
      authorId: 2,
    }
  })
}

main()
.then(async () => {
  await prisma.$disconnect()
})
.catch(async (e) => {
  console.log(e)
  await prisma.$disconnect()
  process.exit(1)
})