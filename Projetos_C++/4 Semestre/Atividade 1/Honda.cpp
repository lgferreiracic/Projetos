#include <iostream>
#include <ctime>

int loopTest01(int x);  

int main(int argc, char *argv[]) {
    double timeResult = 0.0;
    double startTime = 0.0;
    double endTime = 0.0;
    int funcResult = 0;
    const int nCycles = atoi(argv[1]);
    
    startTime = clock();
    funcResult = loopTest01(nCycles);  
    endTime = clock();
    timeResult = (endTime/CLOCKS_PER_SEC) - (startTime/CLOCKS_PER_SEC);

    std::cout << "LoopTest -> Valor_Calculado: " << funcResult << " Tempo: " << timeResult << std::endl;

    return 0;
}

int loopTest01(int x) {  
    int i = 0;
    int *vTemp;
    int result = 0;

    vTemp = new int[x];
    for (i = 0; i < x; i++)
        vTemp[i] = i;
    for (i = 0; i < x; i++)
        result += vTemp[i];
        
    delete[] vTemp;
    return result;
}
