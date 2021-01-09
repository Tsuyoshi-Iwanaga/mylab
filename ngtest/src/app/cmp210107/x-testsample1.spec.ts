import { DebugElement } from '@angular/core'
import { ComponentFixture, TestBed } from '@angular/core/testing'
import { By } from '@angular/platform-browser'

import { Cmp210107Component } from './cmp210107.component'

describe('Cmp210107', () => {
  let debugElement: DebugElement[]
  let component: Cmp210107Component
  let fixture: ComponentFixture<Cmp210107Component>

  beforeEach(async() => {
    TestBed.configureTestingModule({
      declarations: [Cmp210107Component]
    })
    .compileComponents();
  })

  beforeEach(() => {
    fixture = TestBed.createComponent(Cmp210107Component)
    component = fixture.componentInstance
  })

  it('check table row counts', () => {
    fixture.detectChanges();
    debugElement = fixture.debugElement.queryAll(By.css('tr'))
    expect(debugElement.length).toEqual(6);
  })
})