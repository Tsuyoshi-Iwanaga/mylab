import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { HomeComponent } from './home/home.component';
import { Cmp201219Component } from './cmp201219/cmp201219.component';
import { Cmp201226Component } from './cmp201226/cmp201226.component';
import { Cmp201227Component } from './cmp201227/cmp201227.component';
import { Cmp201230Component } from './cmp201230/cmp201230.component';
import { Cmp201231Component } from './cmp201231/cmp201231.component';
import { Cmp2012312Component } from './cmp2012312/cmp2012312.component';
import { Cmp2012313Component } from './cmp2012313/cmp2012313.component';

const routes: Routes = [
  { path: '2012312', component: Cmp2012312Component },
  { path: '2012313', component: Cmp2012313Component },
  { path: '201231', component: Cmp201231Component },
  { path: '201230', component: Cmp201230Component },
  { path: '201227', component: Cmp201227Component },
  { path: '201226', component: Cmp201226Component },
  { path: '201219/:id', component: Cmp201219Component },
  { path: '', component: HomeComponent },
  { path: '**', redirectTo: '/' },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
