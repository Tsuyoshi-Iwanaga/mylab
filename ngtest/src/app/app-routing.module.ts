import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { HomeComponent } from './home/home.component';
import { Cmp201219Component } from './cmp201219/cmp201219.component';
import { Cmp201226Component } from './cmp201226/cmp201226.component';

const routes: Routes = [
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
