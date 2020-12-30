import { ComponentFixture, TestBed } from '@angular/core/testing';

import { Cmp201230Component } from './cmp201230.component';

describe('Cmp201230Component', () => {
  let component: Cmp201230Component;
  let fixture: ComponentFixture<Cmp201230Component>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ Cmp201230Component ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(Cmp201230Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
