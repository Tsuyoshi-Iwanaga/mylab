import { Component, OnChanges, OnInit, DoCheck, AfterContentInit, AfterContentChecked, AfterViewInit, AfterViewChecked, OnDestroy } from '@angular/core';

@Component({
  selector: 'app-cmp2012313',
  templateUrl: './cmp2012313.component.html',
  styleUrls: ['./cmp2012313.component.scss']
})
export class Cmp2012313Component implements OnChanges, OnInit, DoCheck, AfterContentInit, AfterContentChecked, AfterViewInit, AfterViewChecked, OnDestroy {
  show = true
  current = new Date()

  onchange() {
    this.show = !this.show
    this.current = new Date()
  }

  constructor() {
    console.log('constructor')
  }

  ngOnChanges() {
    console.log('ngOnChanges')
  }

  ngOnInit() {
    console.log('ngOnInit')
  }

  ngDoCheck() {
    console.log('ngDoCheck')
  }

  ngAfterContentInit() {
    console.log('ngAfterContentInit')
  }

  ngAfterContentChecked() {
    console.log('ngAfterContentChecked')
  }

  ngAfterViewInit() {
    console.log('ngAfterViewInit')
  }

  ngAfterViewChecked() {
    console.log('ngAfterViewChecked')
  }

  ngOnDestroy() {
    console.log('ngOnDestroy')
  }
}
