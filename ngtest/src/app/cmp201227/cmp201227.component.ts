import { Component, OnChanges, OnInit, DoCheck, AfterContentInit, AfterContentChecked, AfterViewInit, AfterViewChecked, OnDestroy } from '@angular/core';

@Component({
  selector: 'app-cmp201227',
  templateUrl: './cmp201227.component.html',
  styleUrls: ['./cmp201227.component.scss']
})
export class Cmp201227Component implements OnChanges, OnInit, DoCheck, AfterContentInit, AfterContentChecked, AfterViewInit, AfterViewChecked, OnDestroy {
  show = false
  season = ''
  current = new Date()
  books = [
    { id: 1, title: '改訂版JavaScriptの教科書'},
    { id: 2, title: 'Androidアプリ開発'},
    { id: 3, title: 'Swiftポケットリファレンス'},
  ]
  style = {
    display: 'inline-block',
    'padding.em' : '0.5',
    backgroundColor: '#ff0',
  }
  class = {
    back: true,
    fore: true,
    space: true,
  }

  onclick() {
    this.books = [
      { id: 1, title: '改訂版JavaScriptの教科書'},
      { id: 2, title: 'Androidアプリ開発'},
      { id: 3, title: 'Swiftポケットリファレンス'},
      { id: 4, title: '独習PHP'},
    ]
  }

  trackFn(index: number, book: any): number {
    return book.id
  }

  constructor() {
    console.log('constructor')
  }

  // ==== LifeCycleMethod ====
  // =========================

  //入力値(@input)が処理された後、
  //コンポーネントの初期化処理(ngOnChangesメソッドのあとで1度だけ呼ばれる) 
  ngOnInit(): void {
    console.log('ngOnInit')
  }

  //@input経由で入力値が(再)設定された時
  ngOnChanges() {
    console.log('ngOnChanges')
  }

  //外部のコンテンツの変更をチェックした時
  ngDoCheck() {
    console.log('ngDoCheck')
  }

  //外部コンテンツを初期化した時
  //最初のngDoCheckメソッドのあとで一度だけ
  ngAfterContentInit() {
    console.log('ngAfterContentInit')
  }

  //外部コンテンツの変更をチェックした時
  ngAfterContentChecked() {
    console.log('ngAfterContentChecked')
  }

  //現在のコンポーネントと子コンポーネントのビューが生成された時
  //最初のngAfterContentCheckedメソッドのあとで一度だけ呼ばれる
  ngAfterViewInit() {
    console.log('ngAfterViewInit')
  }

  //現在のコンポーネントと子コンポーネントのビューが変更された時
  ngAfterViewChecked() {
    console.log('ngAfterViewChecked')
  }

  //コンポーネントが破棄される時
  ngOnDestroy() {
    console.log('ngOnDestroy')
  }
}
