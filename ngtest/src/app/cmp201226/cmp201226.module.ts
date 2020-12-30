import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms'

import { Cmp201226Component } from './cmp201226.component';
import { DetailComponent } from './detail/detail.component';
import { EditComponent } from './edit/edit.component';

@NgModule({
  declarations: [
    Cmp201226Component,
    DetailComponent,
    EditComponent,
  ],
  imports: [
    CommonModule,
    FormsModule,
  ]
})
export class Cmp201226Module { }
