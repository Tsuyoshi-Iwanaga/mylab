import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-cmp2012313',
  templateUrl: './cmp2012313.component.html',
  styleUrls: ['./cmp2012313.component.scss']
})
export class Cmp2012313Component implements OnInit {
  show = true

  constructor() { }

  ngOnInit(): void {
  }

  onchange() {
    this.show = !this.show
  }
}
