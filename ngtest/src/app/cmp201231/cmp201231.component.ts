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

  //radio sample
  selected = 'hamster';
  data = [
    { label: '犬', value: 'dog' },
    { label: '猫', value: 'cat' },
    { label: 'ハムスター', value: 'hamster' },
    { label: '金魚', value: 'fish' },
    { label: '亀', value: 'turtle' },
  ]

  check(i: number) {
    console.log('label:' + this.data[i].label)
    console.log('value:' + this.selected)
  }

  //checkbox sample
  data2 = [
    { label: 'クッキー', value: 'cookie', selected: false},
    { label: 'ケーキ', value: 'cake', selected: true},
    { label: 'バナナ', value: 'banana', selected: false},
  ]

  check2() {
    console.log(this.data2)
  }
}
