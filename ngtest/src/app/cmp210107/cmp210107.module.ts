import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms'

import { Cmp210107Component } from './cmp210107.component';
import { TruncatePipe } from './truncate.pipe'

@NgModule({
  declarations: [
    Cmp210107Component,
    TruncatePipe,
  ],
  imports: [
    CommonModule,
    FormsModule,
  ]
})
export class Cmp210107Module { }
