#include <stdio.h>

int main(void)
{
  int *data;
  int average = 0;
  int array[10] = {15, 78, 98, 15, 98, 85, 17, 35, 42, 15};

  for(data = array; data != &array[10]; data++) {
    average += *(data);
  }
  
  printf("%d\n", average / 10);
  printf("%p\n", data);
  printf("%p\n", data + 1);
  return 0;
}