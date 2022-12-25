import { Stack, StackProps } from 'aws-cdk-lib'
import { Construct } from 'constructs'
import { LambdaRestApi } from 'aws-cdk-lib/aws-apigateway'
import { Runtime } from 'aws-cdk-lib/aws-lambda'
import { NodejsFunction } from 'aws-cdk-lib/aws-lambda-nodejs'
import { HitCounter } from './cf221224-stack02'

export class Cf221224Stack extends Stack {
  constructor(scope: Construct, id: string, props?: StackProps) {
    super(scope, id, props)

    //lambda
    const lambda = new NodejsFunction(this, 'HelloHandler', {
      entry: 'lambda/hello.ts',
      handler: 'handler',
      runtime: Runtime.NODEJS_18_X
    })

    //HitCounter Stack
    const helloWithCounter = new HitCounter(this, 'HelloHitCounter', {
      downstream: lambda
    })

    //API-Gateway
    const api = new LambdaRestApi(this, 'rest_api', {
      handler: helloWithCounter.handler,
    })
  }
}
