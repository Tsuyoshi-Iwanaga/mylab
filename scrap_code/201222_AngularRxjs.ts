import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';

export class SomeService {
  find(id: number): Observable<any> {
    const url = `/xxx/${id}`;
    return this.http
      .get<any>(url)
      .pipe(map(response => {
        response.data.product
      });
  }
}