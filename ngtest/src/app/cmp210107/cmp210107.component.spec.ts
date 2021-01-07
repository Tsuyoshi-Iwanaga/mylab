import { ComponentFixture, TestBed } from '@angular/core/testing';
import { FormsModule } from '@angular/forms';

import { Cmp210107Component } from './cmp210107.component';
import { TruncatePipe } from './truncate.pipe'

describe('Cmp210107Component', () => {
  let component: Cmp210107Component;
  let fixture: ComponentFixture<Cmp210107Component>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [ FormsModule ],
      declarations: [ Cmp210107Component, TruncatePipe]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(Cmp210107Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
