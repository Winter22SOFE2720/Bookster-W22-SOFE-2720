#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <math.h>

int stepOne(long long myInt) {
    int stepOneTotal = 0;
    int stepCount = 0;
    int checkNum;
    char str[17];
    sprintf(str, "%lld", myInt);

    int length = strlen(str);
    if (length == 16){
        checkNum = 0;
    } else if (length == 15) {
        checkNum = 1;
    } else if (length == 13) {
        checkNum = 1;
    } else {
        printf("INVALID\n");
        exit(0);
    }

    for (int i = length - 1; i >= 0; i--) {
        if(i%2 == checkNum) {
            stepCount = 2*(str[i] - 48);
            if (stepCount != 0) {
                if (stepCount > 9) {
                    int stpCntPartialOne = ceil(stepCount/10);
                    int stpCntPartialTwo = stepCount % 10;
                    stepCount = stpCntPartialOne + stpCntPartialTwo;
                }
            }
            stepOneTotal += stepCount;
        }
    }
    return stepOneTotal;
}
int stepTwo(long long myInt) {
    int stepTwoCount = 0;
    int checkNum;
    char str[17];
    sprintf(str, "%lld", myInt);

    int length = strlen(str);
    if (length == 16){
        checkNum = 1;
    } else if (length == 13) {
        checkNum = 0;
    } else if (length == 15) {
        checkNum = 0;
    } else {
        printf("INVALID\n");
        exit(0);
    }

    for (int i = 0; i < strlen(str); i++) {
        if(i%2 == checkNum) {
            stepTwoCount += str[i] - 48;
        }
    }
    return stepTwoCount;
}
int finalCheck(long long stepOneValue, long long stepTwoValue) {
    int total = stepOneValue + stepTwoValue;
    if (total % 10 == 0) {
        return 1;
    } else {
        return 0;
    }
}
int checkCardType(long long myInt){
    int cardType = 0;
    char str[17];
    sprintf(str, "%lld", myInt);
    int length = strlen(str);
    char firstChar = str[0];
    char secondChar = str[1];

    int firstCharAsInt = (int) firstChar;
    firstCharAsInt = firstCharAsInt - 48;
    int secondCharAsInt = (int) secondChar;
    secondCharAsInt = secondCharAsInt - 48;

    if ((length == 15) && ((firstCharAsInt == 3 && secondCharAsInt == 7) || (firstCharAsInt == 3 && secondCharAsInt == 4))) {
        cardType = 1; // AMERICAN EXPRESS = 1
    }
    if ((length == 13 && firstCharAsInt == 4) || (length == 16 && firstCharAsInt == 4)) {
        cardType = 2; // VISAS = 2
    }
    if ((length == 16) && (firstCharAsInt == 5) && ((secondCharAsInt >= 1) && (secondCharAsInt <= 5))) {
        cardType = 3; // MASTERCARD = 3
    }

    return cardType;
}


long long getUserInput(){
    long long userInput;
    char str[3000];
    char *ptr;
    fgets(str, 100, stdin);

    for (int i = 0; i < strlen(str) -1; i++) {
        if(str[i] == 45){
            // remove dashes
        }
    }
//    printf("%s\n", str);

    long long strAsInt = strtoull(str,&ptr , 10);
    userInput = strAsInt;
    return userInput;
}


char* replace_char(char* str, char find, char replace){
    char *current_pos = strchr(str,find);
    while (current_pos) {
        *current_pos = replace;
        current_pos = strchr(current_pos,find);
    }
    return str;
}

int main() {
    printf("Number:");
    long long ccNumber = getUserInput();

    long long stepOneResult = stepOne(ccNumber);
    long long stepTwoResult = stepTwo(ccNumber);
    int validity = finalCheck(stepOneResult, stepTwoResult);
    printf("validity= %d", validity);
    if (validity == 1){
        int validityReturn = checkCardType(ccNumber);
        if (validityReturn != 0) {
            if (validityReturn == 1){
                printf("AMEX\n");
            } else if (validityReturn == 2){
                printf("VISA\n");
            } else if (validityReturn == 3){
                printf("MASTERCARD\n");
            }
        } else {
            printf("INVALID\n");
        }
    } else {
        printf("INVALID\n");
    }

//    char str[] = "Ge-eksf-orGe-eks";
//    int counter = 0;
//    int dashCounter = 0;
//
//    for (int i = 0; i < strlen(str); i++) {
//        if(str[i] == 45){
//            dashCounter++;
//        }
//    }
//
//    unsigned int sizeStrTwo = strlen(str)-dashCounter;
//    printf("sizeStrTwo: %d\n", sizeStrTwo);
//    char strTwo[12];
//
//    for (int i = 0; i < strlen(str) -1; i++) {
//        if(str[i] != '-'){
//            char activeChar = (char) str[i];
//            strTwo[counter] = activeChar;
//            counter++;
//        } else {
//            dashCounter++;
//        }
//    }
//
//    printf("%s", strTwo);
    return 0;
}