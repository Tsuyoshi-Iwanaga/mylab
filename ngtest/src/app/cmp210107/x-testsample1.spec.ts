import { Cmp201226BookService } from "../cmp201226/cmp201226.book.service";
import { TruncatePipe } from "./truncate.pipe"

describe('truncate Pipe', () => {
  let pipe = new TruncatePipe();
  let msg = 'samplesamplesample';

  it('default', () => {
    expect(pipe.transform(msg)).toEqual('sample');
  })

  it('add parameter', () => {
    expect(pipe.transform(msg)).toEqual('samplesample〜');
  })
})

describe('BookService', () => {
  let service: Cmp201226BookService;

  beforeEach(() => {
    service = new Cmp201226BookService();
  })

  it('getBooksMethod', () => {
    let books = service.getBooks()
    expect(books.length).toEqual(5)
    expect(books[0].title).toEqual('sample books')
  })
})