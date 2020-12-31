import { ComponentFixture, TestBed } from '@angular/core/testing';

import { Cmp2012312Component } from './cmp2012312.component';

describe('Cmp2012312Component', () => {
  let component: Cmp2012312Component;
  let fixture: ComponentFixture<Cmp2012312Component>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ Cmp2012312Component ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(Cmp2012312Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
