#include <string>

//
// Created by Sh3mm on 2018-01-20.
//

#include "Parking_Space.h"
#define str string

Parking_Space::Parking_Space(){}

Parking_Space::Parking_Space(str longitude, str latitude)
{
    position_ = {longitude, latitude};
    timeLeft_ = 0;
    status_ = true;
}

Parking_Space::Parking_Space(str longitude, str latitude , int timeLeft)
{
    position_ = {longitude, latitude};
    timeLeft_ = timeLeft;
    if (timeLeft == 0)
        status_ = false;
    else
        status_ = true;
}


str Parking_Space::GetPosition(){
    return (position_.longitude + ',' + position_.latitude);
}

int Parking_Space::GetTimeLeft(){
    return timeLeft_;
}

bool Parking_Space::GetStatus(){
    return status_;
}

str Parking_Space::SetPosition(str longitude, str latitude){
    position_ = {longitude, latitude};
}

int Parking_Space::SetTimeLeft(int timeLeft){
    timeLeft_ = timeLeft;
}
