import { BrowserModule } from '@angular/platform-browser'
import { NgModule } from '@angular/core'
import { FormsModule } from '@angular/forms'
import { HttpClientModule } from '@angular/common/http'

import { AppRoutingModule } from './app-routing.module'
import { AppComponent } from './app.component';
import { HomeComponent } from './home/home.component'
import { Cmp201219Component } from './cmp201219/cmp201219.component';
import { Cmp201227Module } from './cmp201227/cmp201227.module'
import { Cmp201226Module } from './cmp201226/cmp201226.module'

@NgModule({
  declarations: [
    AppComponent,
    HomeComponent,
    Cmp201219Component,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    HttpClientModule,
    Cmp201226Module,
    Cmp201227Module,
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
