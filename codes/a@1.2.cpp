#include <stdio.h>
#include <stdlib.h>
#include <time.h>
int main()

{
  srand(time(NULL));
  int a = rand() % 20 + 1;
  // printf("%d", a);
  printf("2");
  return 0;
}
