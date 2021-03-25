#include <stdio.h>
#include <string.h>
#include <stdlib.h>

typedef struct {
  char name[256];
  int age;
  int sex;
} People;

void InputPeople(People *data);
void OutputPeople(People data);

int main(void)
{
  int i, count, datasize;
  People *data;

  datasize = 10;
  data = (People *)malloc(sizeof(People) * datasize);

  count = 0;
  while (1) {
    InputPeople (&data[count]);
    if (data[count].age == -1) break;
    count++;

    if (count >= datasize) {
      datasize += 10;
      data = (People *)realloc(data, sizeof(People) * datasize);
    }
  }

  printf("================\n");
  for (i=0; i<count; i++) {
    OutputPeople(data[i]);
  }

  free(data);
  return 0;
}

void InputPeople(People *data)
{
  printf("name:");
  scanf("%s", data->name);
  printf("age:");
  scanf("%d", &data->age);
  printf("gender(1-male, 2-female):");
  scanf("%d", &data->sex);
  printf("\n");
}

void OutputPeople(People data)
{
  char sex[16];
  
  printf("name: %s\n", data.name);
  printf("age: %d\n", data.age);

  if (data.sex == 1) {
    strcpy(sex, "男性");
  } else {
    strcpy(sex, "女性");
  }

  printf("sex: %s\n", sex);
  printf("\n");
}