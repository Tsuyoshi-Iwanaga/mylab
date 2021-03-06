import { Component, OnInit } from '@angular/core';
import { Cmp201226Book } from './cmp201226.book';
import { Cmp201226BookService } from './cmp201226.book.service'

@Component({
  selector: 'app-cmp201226',
  templateUrl: './cmp201226.component.html',
  styleUrls: ['./cmp201226.component.scss']
})
export class Cmp201226Component implements OnInit {

  selected?: Cmp201226Book
  books: Cmp201226Book[] = []

  constructor(private bookHandler: Cmp201226BookService) {}

  ngOnInit(): void {
    this.books = this.bookHandler.getAllBooks()
    this.selected = this.books[0]
  }

  onclick(book: Cmp201226Book): void {
    this.selected = book;
  }

  onedit(book: Cmp201226Book) {
    alert(book.title)
    for(let item of this.books) {
      if(item.isbn === book.isbn) {
        item.title = book.title;
        item.price = book.price;
        item.publisher = book.publisher;
      }
    }
  }

  onShowTitle(title: string) {
    console.log(title)
  }
}