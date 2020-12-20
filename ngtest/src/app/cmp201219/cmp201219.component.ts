import { Component, OnInit, Inject } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Cmp201219Service } from './cmp201219.service';

type User = {
  id: number,
  name: string,
  email: string,
}

@Component({
  selector: 'app-cmp201219',
  templateUrl: './cmp201219.component.html',
  styleUrls: ['./cmp201219.component.scss'],
  // providers: [Cmp201219Service] 簡易的に指定する場合
  providers: [{
    provide: Cmp201219Service,
    useClass: Cmp201219Service,
    multi: false,
  }]
})
export class Cmp201219Component implements OnInit {
  id = ''
  users: User[] = []

  constructor(
    private route: ActivatedRoute,
    @Inject(Cmp201219Service) private service: Cmp201219Service
  ) {}

  ngOnInit(): void {
    this.route.params.subscribe(
      params => this.id = params['id']
    )
    this.service.getUsers().subscribe(res => {
      this.users = res
    })
  } 
}
