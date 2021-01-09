import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable, of } from 'rxjs'
import { catchError } from 'rxjs/operators'

type User = {
  id: number,
  name: string,
  email: string,
}

@Injectable({
  providedIn: 'root'
})
export class Cmp201219Service {
  private url = 'http://localhost:8888'
  private headers = new HttpHeaders()

  constructor(private http: HttpClient) {
    this.headers.append('Content-Type', 'application/x-www-form-urlencoded')
  }

  getUsers(): Observable<User[]> {
    return this.http.get<User[]>(`${this.url}/users`, { headers: this.headers })
      .pipe(
        catchError(this.handleError(`getUsers`, []))
      )
  }

  getUser(id: number): Observable<User> {
    return this.http.get<User>(`${this.url}/users/${id}`)
      .pipe(
        catchError(this.handleError<User>(`getUser id=${id}`))
      )
  }

  setUser(user: User): Observable<User> {
    const id = user.id
    return this.http.post<User>(`${this.url}/users/${id}`, user)
      .pipe(
        catchError(this.handleError<User>(`setUser id=${id}`))
      )
  }

  private handleError<T> (operation = 'operation', result?: T) {
    return (error: any): Observable<T> => {
      console.log(error)
      console.log(`${operation} failed: ${error.message}`)
      return of(result as T)
    }
  }
}
