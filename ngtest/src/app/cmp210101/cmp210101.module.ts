import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Cmp210101Component } from './cmp210101.component';
import { Child1Component } from './child1/child1.component';

@NgModule({
  declarations: [Cmp210101Component, Child1Component],
  imports: [
    CommonModule,
    FormsModule,
  ]
})
export class Cmp210101Module { }
