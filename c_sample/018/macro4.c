#include <stdio.h>

int main(void)
{

  enum {
    STATE_NORMAL,
    STATE_POISON,
    STATE_NUMBLY,
    STATE_CURSE,
  };

  printf("%d\n", STATE_CURSE);
}