import { Component } from '@angular/core'

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss'], 
})
export class AppComponent {

  deposit = 'abc'

  user = {
    name: 'tarou',
    age: 15,
    mori: 150
  }

  buttonFire(e: MouseEvent):void {
    this.deposit += 'a'
  }

  show = false

  season = ''
}
