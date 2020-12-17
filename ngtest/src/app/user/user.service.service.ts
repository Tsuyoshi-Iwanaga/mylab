import { Injectable } from '@angular/core'
import { HttpClient } from '@angular/common/http'
import { Observable, of } from 'rxjs'
import { catchError, map, tap } from 'rxjs/operators'
import { ThrowStmt } from '@angular/compiler'


@Injectable({
  providedIn: 'root'
})
export class UserService {
  private url = 'http://127.0.0.1:8888'

  constructor(private http: HttpClient) { }
}

