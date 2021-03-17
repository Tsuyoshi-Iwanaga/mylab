#include <stdio.h>

//define疑似命令はただ指定のラベルを置き換えるだけなので、
//定数以外にも処理を入れ込むみたいなこともできる。
#define PRINT_TEMP printf("temp = %d\n", temp);

int main(void)
{
  int temp = 100;
  PRINT_TEMP;
  return 0;
}