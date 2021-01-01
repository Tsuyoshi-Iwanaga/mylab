import { Component, AfterViewChecked, QueryList, ViewChildren, ContentChild, ContentChildren } from '@angular/core';
import { Child1Component } from './child1/child1.component'

@Component({
  selector: 'app-cmp210101',
  templateUrl: './cmp210101.component.html',
  styleUrls: ['./cmp210101.component.scss']
})
export class Cmp210101Component implements AfterViewChecked {

  //親コンポーネント(外部コンテンツ)などに記載された子コンポーネントを得る
  // @ContentChildren(Child1Component) childern?: QueryList<Child1Component>

  //自テンプレート(いわゆるビュー)に記載した子コンポーネントを得る
  @ViewChildren(Child1Component) children?: QueryList<Child1Component>
  poems = ['', '', '']

  ngAfterViewChecked() {
    console.log('ngAfterViewChecked')
    this.poems = this.children ? this.children.map((v) => v.poem) : ['', '', '']
  }
}