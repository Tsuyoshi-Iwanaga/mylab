import { ComponentFixture, TestBed } from '@angular/core/testing';
import { ActivatedRoute } from '@angular/router';
import { Observable, of } from 'rxjs';
import { Cmp201219Service } from './cmp201219.service'

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

    let Cmp201219ServiceStub = {
      get users() {
        return of({
          id: 1,
          name: 'testUser',
          email: 'test@hoge@test.com',
        })
      }
    }

    await TestBed.configureTestingModule({
      declarations: [ Cmp201219Component ],
      providers: [
        { provide: ActivatedRoute, useValue: activeRouteStub },
        { provide: Cmp201219Service, useValue: Cmp201219ServiceStub}
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
