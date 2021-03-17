#include <stdio.h>

// マクロ
// 関数と違い、処理がベタ書きされるので少し高速になる
#define PRINTM(X) printf("%d\n", X)

int main(void)
{
  int a1 = 100;
  int a2 = 50;

  PRINTM(a1);
  PRINTM(a2);

  return 0;
}