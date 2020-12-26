import { Injectable } from '@angular/core';
import { Cmp201226Book } from './cmp201226.book';

@Injectable({
  providedIn: 'root'
})
export class Cmp201226BookService {

  private books: Cmp201226Book[] = [
    {
      isbn: '978-4-7741-8411-1',
      title: '改訂新版JavaScript本格入門',
      price: 2980,
      publisher: '技術評論社',
    },
    {
      isbn: '978-4-7989-4853-6',
      title: '初めてのAndroidアプリ開発 第二版',
      price: 3200,
      publisher: '秀和システム',
    },
    {
      isbn: '999-5-8888-4394-7',
      title: 'Angular 本格入門',
      price: 4070,
      publisher: '技術評論社',
    },
  ]

  getAllBooks() {
    return this.books;
  }
}
