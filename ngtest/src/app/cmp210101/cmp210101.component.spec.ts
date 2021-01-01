import { ComponentFixture, TestBed } from '@angular/core/testing';

import { Cmp210101Component } from './cmp210101.component';

describe('Cmp210101Component', () => {
  let component: Cmp210101Component;
  let fixture: ComponentFixture<Cmp210101Component>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ Cmp210101Component ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(Cmp210101Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
