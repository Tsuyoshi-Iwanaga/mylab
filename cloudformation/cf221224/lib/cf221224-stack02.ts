import { Construct } from 'constructs'
import { IFunction, Runtime } from 'aws-cdk-lib/aws-lambda'
import { AttributeType, Table } from 'aws-cdk-lib/aws-dynamodb'
import { NodejsFunction } from 'aws-cdk-lib/aws-lambda-nodejs'

export interface HitCounterProps {
  downstream: IFunction
}

export class HitCounter extends Construct {
  /** allows accessing the counter function */
  public readonly handler: NodejsFunction

  constructor(scope: Construct, id: string, props: HitCounterProps) {
    super(scope, id)

    //dynamo
    const table = new Table(this, 'Hits', {
      partitionKey: { name: 'path', type: AttributeType.STRING }
    })

    //lambda
    this.handler = new NodejsFunction(this, 'HitCountHandler', {
      entry: 'lambda/hitcounter.ts',
      handler: 'handler',
      runtime: Runtime.NODEJS_18_X,
      environment: {
        DOWNSTREAM_FUNCTION_NAME: props.downstream.functionName,
        HITS_TABLE_NAME: table.tableName
      }
    })

    // grant the lambda role read/write permissions to our table
    table.grantReadWriteData(this.handler)

    // grant the lambda role invoke permissions to the downstream function
    props.downstream.grantInvoke(this.handler);
  }
}
