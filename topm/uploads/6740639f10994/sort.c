#include<stdio.h>
#include<stdlib.h>
#include<string.h>
#define SIZE 8000
#define LIMIT 88888

// Function to perform selection sort
void selection_sort(int arr[], int size)
{
    int counter1, counter2, temp;
    for(counter1 = 0; counter1 < size - 1; counter1++)
    {
        for(counter2 = counter1 + 1; counter2 < size; counter2++)
        {
            if (arr[counter1] > arr[counter2])
            {
                temp = arr[counter2];
                arr[counter2] = arr[counter1];
                arr[counter1] = temp;
            }
        }
    }
}

// Function to perform bubble sort
void bubble_sort(int arr[], int size)
{
    int counter1, counter2, flag, temp;
    for(counter1 = size - 1; counter1 > 0; counter1--)
    {
        flag = 0;
        for(counter2 = 0; counter2 < counter1; counter2++)
        {
            if (arr[counter2] > arr[counter2 + 1])
            {
                temp = arr[counter2];
                arr[counter2] = arr[counter2 + 1];
                arr[counter2 + 1] = temp;
                flag = 1;
            }
        }
        if (flag == 0)
            break;
    }
}

// Function to perform insertion sort
void insertion_sort(int arr[], int size)
{
    int counter1, counter2, key;
    for(counter1 = 1; counter1 < size; counter1++)
    {
        key = arr[counter1];
        // Move elements of arr[0..i-1], that are greater than key, to one position ahead of their current position
        for(counter2 = counter1 - 1; counter2 >= 0 && arr[counter2] > key; counter2--)
        {
            arr[counter2 + 1] = arr[counter2];
        }
        arr[counter2 + 1] = key;
    }
}

// Function to merge two subarrays of arr[] -  arr[l..m] and arr[m+1..r]
void merge(int arr[], int l, int m, int r)
{
    int i, j, k;
    int n1 = m - l + 1;
    int n2 =  r - m;
 
    // create temp arrays
    int L[n1], R[n2];
 
    // Copy data to temp arrays L[] and R[]
    for (i = 0; i < n1; i++)
        L[i] = arr[l + i];
    for (j = 0; j < n2; j++)
        R[j] = arr[m + 1+ j];
 
    // Merge the temp arrays back into arr[l..r]
    i = 0; // Index of first subarray
    j = 0; // Index of second subarray
    k = l; // Index of merged subarray
    while (i < n1 && j < n2)
    {
        if (L[i] < R[j])
        {
            arr[k] = L[i];
            i++;
        }
        else
        {
            arr[k] = R[j];
            j++;
        }
        k++;
    }
 
    /* Copy the remaining elements of L[], if there
       are any */
    while (i < n1)
    {
        arr[k] = L[i];
        i++;
        k++;
    }
 
    /* Copy the remaining elements of R[], if there
       are any */
    while (j < n2)
    {
        arr[k] = R[j];
        j++;
        k++;
    }
}

// Function to perform Merge Sort
void merge_sort(int arr[], int left, int right)
{
    int mid;
    if (left < right)
    {
        // Same as (left+right)/2, but avoids overflow for large values
        mid = left+(right-left)/2;
 
        // Recursively sort first and second halves - partition
        merge_sort(arr, left, mid);
        merge_sort(arr, mid + 1, right);

        // Merge the Sorted Array 
        merge(arr, left, mid, right);
    }
}

// Function to swap two elements
void swap(int *a, int *b)
{
    int t;
    t = *a;
    *a = *b;
    *b = t;
}

// Function to perform partition of Quick Sort with last element as pivot
int partition (int arr[], int low, int high)
{
    int pivot = arr[high];    // pivot
    int i = (low - 1);  // Index of smaller element
    int j;
 
    for (j = low; j <= high- 1; j++)
    {
        // If current element is smaller than or equal to pivot
        if (arr[j] <= pivot)
        {
            i++;    // increment index of greater element
            swap(&arr[i], &arr[j]);
        }
    }
    swap(&arr[i + 1], &arr[high]);
    return (i + 1);
}
 
// Function to perform Quick Sort
void quick_sort(int arr[], int low, int high)
{
    if (low < high)
    {
        int pi;
        // pi is partitioning index, arr[pi] is now at right place
        pi = partition(arr, low, high);
 
        // Separately sort elements before partition and after partition
        quick_sort(arr, low, pi - 1);
        quick_sort(arr, pi + 1, high);
    }
}

// Function to do counting sort of arr[] according to
// the digit represented by exp.
void countSort(int arr[], int n, int exp)
{
    int output[n]; // output array
    int i, count[10] = {0};
 
    // Store count of occurrences in count[]
    for (i = 0; i < n; i++)
        count[ (arr[i]/exp)%10 ]++;
 
    // Change count[i] to contain cumulative count
    for (i = 1; i < 10; i++)
        count[i] += count[i - 1];
 
    // Build the output array
    for (i = n - 1; i >= 0; i--)
    {
        output[count[ (arr[i]/exp)%10 ] - 1] = arr[i];
        count[ (arr[i]/exp)%10 ]--;
    }
 
    // Copying the output array back to arr[]
    for (i = 0; i < n; i++)
        arr[i] = output[i];
}

// Function to perform radix sort
void radix_sort(int arr[], int size)
{
    /* The maximum number of digits for PID is 4
    and max is 10^i for ith digit number */
    int exp, counter, max;

    // Calculating max 
    max = arr[0]; 
    for (counter = 1; counter < size; counter++)
        max = arr[counter] > max ? arr[counter] : max;

    // Doing counting sort for every digit
    for (exp = 1; max/exp > 0; exp *= 10)
        countSort(arr, size, exp);
}

void display(int arr[], int size)
{
    int counter;
    printf(" The Sorted Array is :\n");
    for (counter = 0; counter < size; counter++)
        printf("\t%d", arr[counter]);
    printf("\n\n");
}

void display_original(int arr[], int size)
{
    int counter;
    printf(" The Original Array is :\n");
    for (counter = 0; counter < size; counter++)
        printf("\t%d", arr[counter]);
    printf("\n\n");
}

int main(int argc, char *argv[])
{
    int size, choice, counter, counter2, flag, arr[SIZE], copy[SIZE];
    char temp[LIMIT];
    
    do
    {
        flag = 0;
        printf("\n Enter the number of integers to be sorted : ");
        scanf("%s", temp);
        for(counter = 0; counter < strlen(temp); counter++)
        {
            if (temp[counter] < 48 || temp[counter] > 57)
            {
                printf("\n Invalid Data Type Entered .. Please input valid data type ... ");
                flag = 1;
                break;
            }
        }
        size = atoi(temp);
    }while(flag == 1);
    
    for (counter = 0; counter < size; counter++)
    {
        do
        {
            flag = 0;
            printf("\n Enter an integer : ");
            scanf("%s", temp);
            for(counter2 = 0; counter2 < strlen(temp); counter2++)
            {
                if (temp[counter2] < 48 || temp[counter2] > 57)
                {
                    printf("\n Invalid Data Type Entered .. Please input valid data type ... ");
                    flag = 1;
                    break;
                }
            }
            arr[counter] = atoi(temp);
            copy[counter] = arr[counter];
        }while(flag == 1);
    }

    do
    {
        printf("\n Enter the Sorting Algorithm to be used : ");
        printf("\n 1. Bubble Sort");
        printf("\n 2. Selection Sort");
        printf("\n 3. Insertion Sort");
        printf("\n 4. Merge Sort");
        printf("\n 5. Quick Sort");
        printf("\n 6. Radix Sort");
        printf("\n 0. Exit");

        do
        {
            flag = 0;
            printf("\n Enter your choice(0-7) : ");
            scanf("%s", temp);
            for(counter = 0; counter < strlen(temp); counter++)
            {
                if (temp[counter] < 48 || temp[counter] > 57)
                {
                    printf("\n Invalid Data Type Entered .. Please input valid data type ... ");
                    flag = 1;
                    break;
                }
            }
            choice = atoi(temp);
        }while(flag == 1);

        // Store back the original array before sorting for comparison
        for(counter = 0; counter < size; counter++)
            arr[counter] = copy[counter];

        switch(choice)
        {
            case 0:
                break;

            case 1:
                //Applying Bubble Sort to sort the data
				display_original(arr, size);
                printf("\n Executing Bubble Sort \n");
                bubble_sort(arr, size);
                display(arr, size);

                break;

            case 2:
                //Applying Selection Sort to sort the data
				display_original(arr, size);
                printf("\n Executing Selection Sort \n");
                selection_sort(arr, size);
                display(arr, size);
                break;

            case 3:
                //Applying Insertion Sort to sort the data
				display_original(arr, size);
                printf("\n Executing Insertion Sort \n");
                insertion_sort(arr, size);
                display(arr, size);
                break;

            case 4:
                //Applying Merge Sort to sort the data
				display_original(arr, size);
                printf("\n Executing Merge Sort \n");
                merge_sort(arr, 0, size - 1);
                display(arr, size);
                break;            
            
            case 5:
                //Applying Quick Sort to sort the data
				display_original(arr, size);
                printf("\n Executing Quick Sort \n");
                quick_sort(arr, 0, size - 1);
                display(arr, size);
                break;

            case 6:
                //Applying Radix Sort to sort the data
				display_original(arr, size);
                printf("\n Executing Radix Sort \n");
                radix_sort(arr, size);
                display(arr, size);
                break;

            default:
                printf("\n\n Invalid Input \n\n");
        }
    
    }while(choice !=0);
    return 0;
}

