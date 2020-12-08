import { Component } from '@angular/core'

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss'],
})
export class AppComponent {
  time = '---'
  myName = 'スタート！'
  buttonFire(e: MouseEvent) {
    this.myName = 'クリックされた'
  }
  show(e: any) {
    this.time = e
  }
}
