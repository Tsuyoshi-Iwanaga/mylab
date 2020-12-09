import { Component } from '@angular/core'
import { DomSanitizer } from '@angular/platform-browser'

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss'], 
})
export class AppComponent {
  myName = ['hoge', 'mote']

  buttonFire(e: MouseEvent):void {
    this.myName.push('aaaa')
  }

  handler(e: MouseEvent):void {
    alert(new Date().toLocaleString())
  }
}
