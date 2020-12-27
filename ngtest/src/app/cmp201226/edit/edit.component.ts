import { Component, OnInit, Input } from '@angular/core';
import { Cmp201226Book } from '../cmp201226.book';

@Component({
  selector: 'edit-book',
  templateUrl: './edit.component.html',
  styleUrls: ['./edit.component.scss']
})
export class EditComponent implements OnInit {

  constructor() { }

  ngOnInit(): void {
  }

  @Input() item?: Cmp201226Book;

  onclick() {
    alert(this.item?.title)
  }
}
