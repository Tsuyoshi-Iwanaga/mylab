import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-cmp201231',
  templateUrl: './cmp201231.component.html',
  styleUrls: ['./cmp201231.component.scss']
})
export class Cmp201231Component implements OnInit {

  constructor() { }

  ngOnInit(): void {
  }

  user = {
    mail: 'hoge@example.com',
    password: '',
    name: '名無しの権兵衛',
    memo: 'メモ',
  }

  show() {
    console.log('mail: ' + this.user.mail)
    console.log('password: ' + this.user.password)
    console.log('name: ' + this.user.name)
    console.log('memo: ' + this.user.memo)
  }
}
