import { ComponentFixture, TestBed } from '@angular/core/testing';

import { Sub01Component } from './sub01.component';

describe('Sub01Component', () => {
  let component: Sub01Component;
  let fixture: ComponentFixture<Sub01Component>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ Sub01Component ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(Sub01Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
