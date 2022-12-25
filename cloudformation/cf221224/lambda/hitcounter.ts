import { LambdaClient, InvokeCommand } from '@aws-sdk/client-lambda'
import { DynamoDBClient, UpdateItemCommand } from '@aws-sdk/client-dynamodb';
import { Context, APIGatewayEvent, APIGatewayProxyResult } from 'aws-lambda'

export const handler = async function(event: APIGatewayEvent, context: Context): Promise<APIGatewayProxyResult>{
  console.log('request:', JSON.stringify(event, undefined, 2))

  const dynamo_client = new DynamoDBClient({})
  const lambda_client = new LambdaClient({ region: 'ap-northeast-1' })

  await dynamo_client.send(new UpdateItemCommand({
    TableName: process.env.HITS_TABLE_NAME,
    Key: { path: { S: event.path } },
    UpdateExpression: 'ADD hits :incr',
    ExpressionAttributeValues: { ':incr': { N: '1' } }
  }))

  const resp = await lambda_client.send(new InvokeCommand({
    FunctionName: process.env.DOWNSTREAM_FUNCTION_NAME,
    Payload: new TextEncoder().encode(JSON.stringify(event))
  }))

  console.log('downstream response:', JSON.stringify(resp, undefined, 2))

  return JSON.parse(new TextDecoder().decode(resp.Payload))
}