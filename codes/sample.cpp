#include <stdio.h>
int main()
{
  int player, position, mybids[51], t, i, moves[51], money_remained = 100;
  scanf("%d", &player);
  scanf("%d", &position);
  scanf("%d", &t);
  for (i = 0; i < t; i++)
  {
    scanf("%d", &mybids[i]);
    money_remained -= mybids[i];
  }
  for (i = 0; i < t; i++)
  {
    scanf("%d", &moves[i]);
  }

  // Write your code here
  // printf("2");
  return 0;
}
