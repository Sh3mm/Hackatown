#include <string>

using namespace std;
//
// Created by Sh3mm on 2018-01-20.
//

#ifndef PARKING_FIND_PARKING_SPACE_H
#define PARKING_FIND_PARKING_SPACE_H
#define str string

struct Position{
    string longitude;
    string latitude;
};

class Parking_Space {
private:
    Position position_;

    //status is true if it is occupied
    bool status_;
    int timeLeft_;

public:
    void Parking_Space();
    void Parking_Space(str longitude, str latitude);
    void Parking_Space(str longitude, str latitude , int timeLeft);

    str GetPosition();
    int GetTimeLeft();
    bool GetStatus();

    str SetPosition(str longitude, str latitude);
    int SetTimeLeft(int timeLeft);

};


#endif //PARKING_FIND_PARKING_SPACE_H
