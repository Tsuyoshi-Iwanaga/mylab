import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from '@angular/router';

@Component({
  selector: 'app-cmp201219',
  templateUrl: './cmp201219.component.html',
  styleUrls: ['./cmp201219.component.scss']
})
export class Cmp201219Component implements OnInit {
  id = ''

  constructor(private route: ActivatedRoute) { }

  ngOnInit(): void {
    this.route.params.subscribe(
      params => this.id = params['id']
    )
  }

}
