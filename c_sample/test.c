#include <stdio.h>

int main(void)
{
	int *p;
	int i;
	p = &i;
	*p = 10; /* 通常変数モードに切り替えたポインタ変数に代入 */
	printf("p = %d\n",*p);
	printf("i = %d\n",i);
	return 0;
}