import { Component, Input, OnInit, Output } from '@angular/core';
import { Cmp201226Book } from '../cmp201226.book';
import { Cmp201226Module } from '../cmp201226.module';

@Component({
  selector: 'detail-book',
  templateUrl: './detail.component.html',
  styleUrls: ['./detail.component.scss']
})
export class DetailComponent implements OnInit {
  private _item?: Cmp201226Book;

  @Input()
  set item(_item: Cmp201226Book|undefined) {
    this._item = _item;
  }

  get item():Cmp201226Book|undefined {
    return this._item
  }

  constructor() {}

  ngOnInit(): void {}
}
