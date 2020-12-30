import { Component, OnInit } from '@angular/core';
import { Sub01Component } from './sub01/sub01.component';
import { Sub02Component } from './sub02/sub02.component';
import { Sub03Component } from './sub03/sub03.component';

@Component({
  selector: 'app-cmp201230',
  templateUrl: './cmp201230.component.html',
  styleUrls: ['./cmp201230.component.scss']
})
export class Cmp201230Component implements OnInit {

  interval: any
  comp = [ Sub01Component, Sub02Component, Sub03Component]
  current = 0
  banner: any = Sub01Component

  constructor() {}

  ngOnInit(): void {
    this.interval = setInterval(() => {
      this.current = (this.current + 1) % this.comp.length;
      this.banner = this.comp[this.current];
    }, 3000)
  }

  ngOnDestroy() {
    clearInterval(this.interval)
  }
}
