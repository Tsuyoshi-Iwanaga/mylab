#!/usr/bin/env node
import * as cdk from 'aws-cdk-lib';
import { CDKSampleStack } from '../lib/221206-stack';

const app = new cdk.App();
new CDKSampleStack(app, 'CDKSampleStack');
