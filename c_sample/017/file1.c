#include <stdio.h>

int main(void)
{
  FILE *file;
  int i = 100;

  file = fopen("test1.txt", "w");
  fprintf(file, "%d: Hello, world\n", i);

  fclose(file);
  return 0;
}