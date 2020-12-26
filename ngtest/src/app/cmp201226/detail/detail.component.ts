import { Component, Input, OnInit } from '@angular/core';
import { Cmp201226Book } from '../cmp201226.book';

@Component({
  selector: 'detail-book',
  templateUrl: './detail.component.html',
  styleUrls: ['./detail.component.scss']
})
export class DetailComponent implements OnInit {
  @Input() item?: Cmp201226Book

  constructor() {}

  ngOnInit(): void {
  }

}
