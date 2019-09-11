import { Component, Vue } from "vue-property-decorator";

export default class MyComponent extends Vue {
  //data
  count: number = 0;
  foo: string = 'hoge';

  //methods
  hoge() {
    return "fuga";
  }
  pon(foo) {
    return foo;
  }
  
  //computed
  get fullname(): string {
    return this.foo;
  }
  set fullname(foo: string) {
    this.foo = foo;
  }

  onClick() {
    console.log('クリックされました');
    this.count = this.count + 1;
  }
}