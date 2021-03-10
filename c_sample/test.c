#include <stdio.h>

void maxmin(int array[], int *max, int *min);

int main(void)
{
  int i = 0;
  int array[10];
  int max;
  int min;

  do {
    printf("%d番目の入力: ", i + 1);
    scanf("%d", &array[i]);
    i++;
  } while (array[i - 1] != -1);

  maxmin(array, &max, &min);
  printf("max: %d/min: %d\n", max, min);
  return 0;
}

void maxmin(int array[], int *max, int *min)
{
  int i = 0;

  *max = 0;
  *min = 100;
  
  while (array[i] != -1) {
    if(array[i] > *max) *max = array[i];
    if(array[i] < *min) *min = array[i];
    i++;
  }
}