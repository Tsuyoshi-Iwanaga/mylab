import { ComponentFixture, TestBed } from '@angular/core/testing';

import { Cmp2012313Component } from './cmp2012313.component';

describe('Cmp2012313Component', () => {
  let component: Cmp2012313Component;
  let fixture: ComponentFixture<Cmp2012313Component>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ Cmp2012313Component ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(Cmp2012313Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
