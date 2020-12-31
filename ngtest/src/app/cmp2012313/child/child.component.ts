import { Component, Input, OnChanges, OnInit, DoCheck, AfterContentInit, AfterContentChecked, AfterViewInit, AfterViewChecked, OnDestroy, SimpleChanges } from '@angular/core';

@Component({
  selector: 'my-child',
  templateUrl: './child.component.html',
  styleUrls: ['./child.component.scss']
})
export class ChildComponent implements OnChanges, OnInit, DoCheck, AfterContentInit, AfterContentChecked, AfterViewInit, AfterViewChecked, OnDestroy {

  @Input() time?: Date;

  //インスタンス生成時に呼ばれる。主にDIなどの用途で使う
  constructor() {
    console.log('[child] constructor')
  }

  //@Input経由でpropsが設定or変更された時
  ngOnChanges(changes: SimpleChanges) {
    console.log('[child] ngOnChanges')
    //変更前のpropと変更後のpropを確認
    for(let prop in changes) {
      let change = changes[prop]
      console.log(`${prop}: ${change.previousValue} => ${change.currentValue}`)
      console.log(`初回実行かどうか: ${change.isFirstChange()}`)
    }
  }

  //一番最初に@Inputで値を受け取った後に1度だけ呼ばれる。基本的な初期化処理はここで
  ngOnInit() {
    console.log('[child] ngOnInit')
  }

  //状態の変更を検出した時
  ngDoCheck() {
    console.log('[child] ngDoCheck')
  }

  //外部コンテンツを初期化した時に1度だけ呼ばれる
  ngAfterContentInit() {
    console.log('[child] ngAfterContentInit')
  }

  //外部コンテンツの変更をチェックした時
  ngAfterContentChecked() {
    console.log('[child] ngAfterContentChecked')
  }

  //現在のコンポーネント及び子コンポーネントのビューを生成した時(最初の1回だけ呼ばれる)
  ngAfterViewInit() {
    console.log('[child] ngAfterViewInit')
  }

  //現在のコンポーネント及び子コンポーネントのビューが変更された時
  ngAfterViewChecked() {
    console.log('[child] ngAfterViewChecked')
  }

  //コンポーネントの終了処理、タイマーリセットやObservableの講読解除など
  ngOnDestroy() {
    console.log('[child] ngOnDestroy')
  }
}
