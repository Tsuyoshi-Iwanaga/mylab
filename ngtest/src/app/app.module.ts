import { BrowserModule } from '@angular/platform-browser'
import { NgModule } from '@angular/core'
import { FormsModule } from '@angular/forms'
import { HttpClientModule } from '@angular/common/http'

import { AppRoutingModule } from './app-routing.module'
import { AppComponent } from './app.component';
import { HomeComponent } from './home/home.component'
import { Cmp201219Component } from './cmp201219/cmp201219.component';
import { Cmp201226Component } from './cmp201226/cmp201226.component';
import { DetailComponent } from './cmp201226/detail/detail.component';
import { EditComponent } from './cmp201226/edit/edit.component';
import { Cmp201227Component } from './cmp201227/cmp201227.component'

@NgModule({
  declarations: [
    AppComponent,
    HomeComponent,
    Cmp201219Component,
    Cmp201226Component,
    DetailComponent,
    EditComponent,
    Cmp201227Component,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    HttpClientModule,
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
