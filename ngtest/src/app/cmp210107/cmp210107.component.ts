import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-cmp210107',
  templateUrl: './cmp210107.component.html',
  styleUrls: ['./cmp210107.component.scss']
})
export class Cmp210107Component implements OnInit {
  testStr: string = 'いろはにほへと'
  testNumber: number = 5

  constructor() { }

  ngOnInit(): void {}
}
