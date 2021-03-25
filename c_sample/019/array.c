#include <stdio.h>
#include <stdlib.h>

int main()
{
  int i;
  int *heap;

  //ヒープにメモリを確保する
  heap = (int *)malloc(sizeof(int) * 10);

  for(i=0; i < 10; i++) {
    heap[i] = i;
  }

  //既存のデータは維持したままで要素数を拡大する
  heap = (int *)realloc(heap, sizeof(int) * 100);
  if (heap == NULL) exit(0);

  printf("%d\n", heap[5]);

  free(heap);
  return 0;
}