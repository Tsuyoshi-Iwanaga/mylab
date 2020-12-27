import { ComponentFixture, TestBed } from '@angular/core/testing';

import { Cmp201227Component } from './cmp201227.component';

describe('Cmp201227Component', () => {
  let component: Cmp201227Component;
  let fixture: ComponentFixture<Cmp201227Component>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ Cmp201227Component ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(Cmp201227Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
