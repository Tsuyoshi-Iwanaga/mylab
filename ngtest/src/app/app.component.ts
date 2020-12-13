import { Component } from '@angular/core'
import { Book } from './coop/book'

@Component({
  selector: 'app-root',
  // templateUrl: './app.component.html',
  template: `
    <div>
      <span *ngFor="let b of books">
        [<a href="#" (click)="onclick(b)">{{b.title}}</a>]
      </span>
    </div>
    <hr>
    <detail-book [item]="selected"></detail-book>
    <edit-book [item]="selected" (edited)="onedited($event)"></edit-book>
  `,
  styleUrls: ['./app.component.scss'], 
})
export class AppComponent {
  selected?: Book;
  books = [
    {
      isbn: '978-4-7741-8411-1',
      title: '改訂版JavaScript本格入門',
      price: 2800,
      publisher: '技術評論社',
    },
    {
      isbn: '978-4-7980-4853-6',
      title: '初めてのAndroidアプリ',
      price: 1250,
      publisher: '秀和システム',
    }
  ]
  public onclick(book: Book) {
    this.selected = book;
  }
  public onedited(book: Book) {
    for(let item of this.books) {
      if (item.isbn === book.isbn) {
        if(book.title) item.title = book.title;
        if(book.price) item.price = book.price;
        if(book.publisher) item.publisher = book.publisher;
      }
    }
    this.selected = undefined;
  }
}