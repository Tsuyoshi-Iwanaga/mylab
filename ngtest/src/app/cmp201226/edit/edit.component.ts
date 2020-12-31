import { Component, EventEmitter, Input, Output } from '@angular/core';
import { Cmp201226Book } from '../cmp201226.book';

@Component({
  selector: 'edit-book',
  templateUrl: './edit.component.html',
  styleUrls: ['./edit.component.scss']
})
export class EditComponent {
  @Input() item?: Cmp201226Book;
  @Output() edit = new EventEmitter<Cmp201226Book>();
  @Output('showTitle') showTitle = new EventEmitter<string>();

  constructor() {}

  onsubmit() {
    this.showTitle.emit(this.item?.title)
    this.edit.emit(this.item)
  }
}
