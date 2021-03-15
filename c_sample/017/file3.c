#include <stdio.h>

int main(int argc, char *argv[])
{
  int buf = 100;
  int out;
  FILE *file;

  file = fopen("test3.dat", "wb");//バイナリではbをつける
  fwrite(&buf, sizeof(buf), 1, file);
  fread(&out, sizeof(out), 1, file);

  fclose(file);

  printf("%d\n", out);
  return 0;
}