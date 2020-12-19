import { BrowserModule } from '@angular/platform-browser'
import { NgModule } from '@angular/core'
import { FormsModule } from '@angular/forms'
import { HttpClientModule } from '@angular/common/http'

import { AppRoutingModule } from './app-routing.module'
import { AppComponent } from './app.component';
import { HomeComponent } from './home/home.component'
import { Cmp201219Component } from './cmp201219/cmp201219.component';

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
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
