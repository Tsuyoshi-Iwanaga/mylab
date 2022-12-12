#!/usr/bin/env node
import * as cdk from 'aws-cdk-lib';
import { Cf221212Stack } from '../lib/cf221212-stack';

const app = new cdk.App();
new Cf221212Stack(app, 'Cf221212Stack');
