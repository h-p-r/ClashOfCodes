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
    while (1)
    {
        printf("2");
    }

    // if (money_remained > 8)
    //     printf("8");
    // else
    //     printf("%d", money_remained - 1);
    return 0;
}

// #include <stdio.h>
// int main()
// {
//     int x, i = 0, j = 0;
//     int mat[55][3];
//     FILE *fp;
//     fp = fopen("bids.txt", "r");
//     while (fscanf(fp, "%d", &mat[i][j]) != EOF) // take inputs from the files
//     {

//         j++;
//         if (j == 3)
//         {
//             i++;
//             j = 0;
//         }
//     }
//     fclose(fp);
//     if (i == 0)
//         printf("3");
//     else
//         printf("%d", mat[i - 1][2]);
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
