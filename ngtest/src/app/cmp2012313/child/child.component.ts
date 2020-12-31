import { Component, Input, OnInit } from '@angular/core';

@Component({
  selector: 'my-child',
  templateUrl: './child.component.html',
  styleUrls: ['./child.component.scss']
})
export class ChildComponent implements OnInit {

  @Input() time?: Date;

  constructor() { }

  ngOnInit(): void {
  }

}
