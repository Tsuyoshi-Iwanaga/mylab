export default class localStorageIO {
  public static updateLocalStorage(key: string, value: object): void {
    localStorage.setItem(key, JSON.stringify(value));
  }

  public static getLocalStorage(key: string): unknown {
    let stringData: string | null = localStorage.getItem(key);
    if (stringData) {
      return JSON.parse(stringData);
    } else {
      return;
    }
  }
}
