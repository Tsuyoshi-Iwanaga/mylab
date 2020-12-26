import { TestBed } from '@angular/core/testing';

import { Cmp201226BookService } from './cmp201226.book.service';

describe('Cmp201226.BookService', () => {
  let service: Cmp201226BookService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(Cmp201226BookService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
