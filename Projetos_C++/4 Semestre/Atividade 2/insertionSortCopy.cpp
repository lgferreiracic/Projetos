#include <iostream>
#include <ctime>
#include <vector>

std::vector<int> averageCase(int size, int lim, int seed);
std::vector<int> bestCase(int size, int lim);
std::vector<int> worstCase(int size, int lim);
std::vector<int> insertionSort(std::vector<int> A); 

int main(int argc, char *argv[]) {
    double timeResult = 0.0;
    double startTime = 0.0;
    double endTime = 0.0;
    const int size = atoi(argv[1]);
    const int lim = atoi(argv[2]);
    //const int seed = atoi(argv[3]);
    //std::vector<int> myData = averageCase(size, lim, seed);
    //std::vector<int> myData = bestCase(size, lim);
    std::vector<int> myData = worstCase(size, lim);

    startTime = clock();
    myData = insertionSort(myData);  
    endTime = clock();
    timeResult = (endTime/CLOCKS_PER_SEC) - (startTime/CLOCKS_PER_SEC);

    std::cout << " Time: " << timeResult << std::endl;

    return 0;
}

std::vector<int> insertionSort(std::vector<int> A) {
    int n = A.size();
    for (int j = 1; j < n; j++) { 
        int key = A[j];
        // Insert A[j] into sorted sequence A[1..j-1].
        int i = j - 1;
        while (i >= 0 && A[i] > key) {
            A[i + 1] = A[i];
            i = i - 1;
        }
        A[i + 1] = key;
    }
    return A;
}

std::vector<int> averageCase(int size, int lim, int seed) {
    std::vector<int> data;
    srand(seed); 

    for (int i = 0; i < size; i++) {
        data.push_back(rand() % lim + 1);  
    }

    return data;
}

std::vector<int> bestCase(int size, int lim) {
    std::vector<int> data(size);

    for (int i = 0; i < size; i++) {
        data[i]=i;  
    }

    return data;
}

std::vector<int> worstCase(int size, int lim) {
    std::vector<int> data(size);

    for (int i = 0; i < size; i++) {
        data[i]= size - i;  
    }

    return data;
}