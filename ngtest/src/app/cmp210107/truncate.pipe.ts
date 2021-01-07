import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'truncate'
})
export class TruncatePipe implements PipeTransform {

  transform(value: string, length: number = 5, omission: string = '...'): string {
    if(typeof value !== 'string') {
      return value;
    }
    if(value.length <= length) {
      return value; 
    } else {
      return value.substring(0, length) + omission;
    }
  }

}
