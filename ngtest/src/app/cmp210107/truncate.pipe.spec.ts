import { TruncatePipe } from './truncate.pipe';

// describe('TruncatePipe', () => {
//   it('create an instance', () => {
//     const pipe = new TruncatePipe();
//     expect(pipe).toBeTruthy();
//   });
// });

describe('TruncatePipe', () => {
  const pipe = new TruncatePipe()
  const text = 'abcdefghijklmnopqrstuvwxyz'

  it('default: cat top to 5th charactor and add ...', () => {
    expect(pipe.transform(text)).toEqual('abcde...')
  })

  it('set start paramater 10 and 〜', () => {
    expect(pipe.transform(text, 10, '〜')).toEqual('abcdefghij〜')
  })
})
