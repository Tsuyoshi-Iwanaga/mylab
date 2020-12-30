import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { Cmp201230Component } from './cmp201230.component';
import { Sub01Component } from './sub01/sub01.component';
import { Sub02Component } from './sub02/sub02.component';
import { Sub03Component } from './sub03/sub03.component';

@NgModule({
  declarations: [
    Cmp201230Component,
    Sub01Component,
    Sub02Component,
    Sub03Component,
  ],
  imports: [
    CommonModule
  ]
})
export class Cmp201230Module { }
