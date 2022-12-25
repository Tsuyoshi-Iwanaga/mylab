import { Construct } from 'constructs'
import { RemovalPolicy } from 'aws-cdk-lib'
import { IFunction, Runtime } from 'aws-cdk-lib/aws-lambda'
import { AttributeType, Table } from 'aws-cdk-lib/aws-dynamodb'
import { NodejsFunction } from 'aws-cdk-lib/aws-lambda-nodejs'

export interface HitCounterProps {
  downstream: IFunction
}

export class HitCounter extends Construct {
  // allow accessing the counter function
  public readonly handler: NodejsFunction

  // allow accessing the counter table
  public readonly table: Table

  constructor(scope: Construct, id: string, props: HitCounterProps) {
    super(scope, id)

    //dynamo
    this.table = new Table(this, 'Hits', {
      partitionKey: { name: 'path', type: AttributeType.STRING },
      removalPolicy: RemovalPolicy.DESTROY
    })

    //lambda
    this.handler = new NodejsFunction(this, 'HitCountHandler', {
      entry: 'lambda/hitcounter.ts',
      handler: 'handler',
      runtime: Runtime.NODEJS_18_X,
      environment: {
        DOWNSTREAM_FUNCTION_NAME: props.downstream.functionName,
        HITS_TABLE_NAME: this.table.tableName
      }
    })

    // grant the lambda role read/write permissions to our table
    this.table.grantReadWriteData(this.handler)

    // grant the lambda role invoke permissions to the downstream function
    props.downstream.grantInvoke(this.handler);
  }
}
