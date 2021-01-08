import { ComponentFixture, TestBed } from '@angular/core/testing';
import { FormsModule } from '@angular/forms';

import { Cmp201231Component } from './cmp201231.component';

describe('Cmp201231Component', () => {
  let component: Cmp201231Component;
  let fixture: ComponentFixture<Cmp201231Component>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ Cmp201231Component ],
      imports: [ FormsModule ],
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(Cmp201231Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
