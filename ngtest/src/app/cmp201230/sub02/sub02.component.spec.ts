import { ComponentFixture, TestBed } from '@angular/core/testing';

import { Sub02Component } from './sub02.component';

describe('Sub02Component', () => {
  let component: Sub02Component;
  let fixture: ComponentFixture<Sub02Component>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ Sub02Component ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(Sub02Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
