import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { Cmp2012313Component } from './cmp2012313.component';
import { ChildComponent } from './child/child.component';

@NgModule({
  declarations: [Cmp2012313Component, ChildComponent],
  imports: [
    CommonModule
  ]
})
export class Cmp2012313Module { }
