import { Component, OnInit } from '@angular/core';
import { Observable } from 'rxjs';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  stylesUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  //Observable
  public loginObservable: Observable<string> = new Observable((observer => {
    observer.next('test');
    setTimeout(() => {
      observer.next('test2');
    }, 1000)
  }))

  constructor() {}

  //Subscribe Observable
  ngOnInit() {
    this.loginObservable.subscribe((data: string) => {
      console.log(data);
    })
  }
}

// === result ===
// test
// test2 (delay little time)