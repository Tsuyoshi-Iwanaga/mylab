import { TestBed } from '@angular/core/testing';
import { HttpClientModule } from '@angular/common/http';

import { Cmp201219Service } from './cmp201219.service';

describe('Cmp201219Service', () => {
  let service: Cmp201219Service;

  beforeEach(() => {
    TestBed.configureTestingModule({
      imports: [HttpClientModule],
    });
    service = TestBed.inject(Cmp201219Service);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});