#include <stdio.h>

int main(void)
{
  int i,j;
  FILE *file;

  file = fopen("test2.txt", "r");
  fscanf(file, "%d,%d", &i, &j);
  fclose(file);

  printf("%d/%d\n", i, j);
  return 0;
}