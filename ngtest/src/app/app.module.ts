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
import { Cmp201230Module } from './cmp201230/cmp201230.module';
import { Cmp201231Module } from './cmp201231/cmp201231.module';
import { Cmp210101Module } from './cmp210101/cmp210101.module';
import { Cmp210107Module } from './cmp210107/cmp210107.module';

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
    Cmp201230Module,
    Cmp201231Module,
    Cmp210101Module,
    Cmp210107Module,
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
