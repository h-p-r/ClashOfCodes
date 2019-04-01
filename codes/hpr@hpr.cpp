#include <stdio.h>
#include <stdlib.h>
#include <time.h>

int main()
{
    srand(time(NULL));
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

    int r2;
    r2 = rand();
    r2 = r2 % money_remained + 1;
    printf("%d", r2);
    return 0;
}

// #include <stdio.h>
// int main()
// {
//     int x;
//     FILE *fp;
//     fp = fopen("/temp.txt", "r");
//     fscanf(fp, "%d", &x);
//     printf("%d", x);
//     return 0;
// }

// #include <stdio.h>
// int main()
// {
//     int player, position, mybids[51], t, i, moves[51], money_remained = 100;
//     scanf("%d", &player);
//     scanf("%d", &position);
//     scanf("%d", &t);
//     for (i = 0; i < t; i++)
//     {
//         scanf("%d", &mybids[i]);
//         money_remained -= mybids[i];
//     }
//     for (i = 0; i < t; i++)
//     {
//         scanf("%d", &moves[i]);
//     }

//     if (t < 1)
//     {
//         printf("10");
//         return 0;
//     }
//     else
//     {
//         printf("%d", mybids[t - 1] - 1);
//         return 0;
//     }
// }
