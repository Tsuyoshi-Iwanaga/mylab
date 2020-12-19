import { ComponentFixture, TestBed } from '@angular/core/testing';

import { Cmp201219Component } from './cmp201219.component';

describe('Cmp201219Component', () => {
  let component: Cmp201219Component;
  let fixture: ComponentFixture<Cmp201219Component>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ Cmp201219Component ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(Cmp201219Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
