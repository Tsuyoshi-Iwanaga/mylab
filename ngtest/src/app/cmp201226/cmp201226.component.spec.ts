import { ComponentFixture, TestBed } from '@angular/core/testing';

import { Cmp201226Component } from './cmp201226.component';

describe('Cmp201226Component', () => {
  let component: Cmp201226Component;
  let fixture: ComponentFixture<Cmp201226Component>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ Cmp201226Component ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(Cmp201226Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
