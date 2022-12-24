import {
  Context,
  APIGatewayProxyEvent,
  APIGatewayProxyResult,
} from 'aws-lambda'

export const handler = async (event: APIGatewayProxyEvent, context: Context): Promise<APIGatewayProxyResult> => {
  console.log("request:", JSON.stringify(event, undefined, 2))
  return {
    statusCode: 200,
    headers: { 'Content-Type' : 'text/plain' },
    body: `Good Night, CDK! You've hit ${event.path}\n`
  }
}