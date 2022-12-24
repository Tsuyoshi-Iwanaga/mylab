#!/usr/bin/env node
import * as cdk from 'aws-cdk-lib';
import { Cf221224Stack } from '../lib/cf221224-stack';

const app = new cdk.App();
new Cf221224Stack(app, 'Cf221224Stack');
