import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, FormBuilder, Validators } from '@angular/forms'

@Component({
  selector: 'app-cmp2012312',
  templateUrl: './cmp2012312.component.html',
  styleUrls: ['./cmp2012312.component.scss']
})
export class Cmp2012312Component implements OnInit {

  //各項目のバリデーション設定
  mail = new FormControl('hoge@gmail.com', [
    Validators.required,
    Validators.email
  ])
  password = new FormControl('', [
    Validators.required,
    Validators.minLength(6),
  ])
  name = new FormControl('名無しの権兵衛', [
    Validators.required,
    Validators.minLength(3),
    Validators.maxLength(10),
  ])
  memo = new FormControl('メモ', [
    Validators.maxLength(10)
  ])

  //FormGroupオブジェクトの生成
  myForm = this.builder.group({
    mail: this.mail,
    password: this.password,
    name: this.name,
    memo: this.memo,
  })

  //インスタンス生成時にFormBuilderを生成
  constructor(private builder: FormBuilder) { }

  ngOnInit(): void {
  }

  show() {
    console.log('メールアドレス: ' + this.mail.value)
    console.log('パスワード: ' + this.password.value)
    console.log('名前: ' + this.name.value)
    console.log('備考: ' + this.memo.value)
    console.log(this.myForm.value)
  }
}
