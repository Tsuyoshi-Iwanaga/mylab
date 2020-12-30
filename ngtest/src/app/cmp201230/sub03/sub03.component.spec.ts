import { ComponentFixture, TestBed } from '@angular/core/testing';

import { Sub03Component } from './sub03.component';

describe('Sub03Component', () => {
  let component: Sub03Component;
  let fixture: ComponentFixture<Sub03Component>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ Sub03Component ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(Sub03Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
