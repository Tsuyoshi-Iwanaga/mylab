import { ComponentFixture, TestBed } from '@angular/core/testing';
import { ActivatedRoute } from '@angular/router';
import { of } from 'rxjs';
import { HttpClientModule } from '@angular/common/http';

import { Cmp201219Component } from './cmp201219.component';

describe('Cmp201219Component', () => {
  let component: Cmp201219Component;
  let fixture: ComponentFixture<Cmp201219Component>;

  beforeEach(async () => {
    let activeRouteStub = {
      get params() {
        return of({id: 108})
      }
    }

    await TestBed.configureTestingModule({
      declarations: [ Cmp201219Component ],
      imports: [HttpClientModule],
      providers: [
        { provide: ActivatedRoute, useValue: activeRouteStub },
      ],
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
