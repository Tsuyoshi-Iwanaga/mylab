import { Cmp210107Component } from './cmp210107.component'
import { ComponentFixture, TestBed } from '@angular/core/testing'
import { By } from '@angular/platform-browser'
import { DebugElement } from '@angular/core'

describe('AppComponent', () => {
  let debugElement: DebugElement
  let component: Cmp210107Component
  let fixture: ComponentFixture<Cmp210107Component>

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [Cmp210107Component]
    })

    fixture = TestBed.createComponent(Cmp210107Component)
    component = fixture.componentInstance;
    debugElement = fixture.debugElement.query(By.css('h1'))
  })

  it('<h1>要素の確認', () => {
    fixture.detectChanges();
    const h1 = debugElement.nativeElement;
    expect(h1.innerText).toMatch(/javascript/i)
  })
})