#include "stdafx.h"
#include <iostream>
#include <conio.h>
#include <list>
#include <ctime>
#include <Windows.h>

const int width = 40;
const int height = 20;

char level[height + 1][width + 1] = { 
{ "1111111111111111111111111111111111111111" },
{ "1                                      1" },
{ "1                                      1" },
{ "1                                      1" },
{ "1                                      1" },
{ "1                                      1" },
{ "1                                      1" },
{ "1                                      1" },
{ "1                                      1" },
{ "1                                      1" },
{ "1                                      1" },
{ "1                                      1" },
{ "1                                      1" },
{ "1                                      1" },
{ "1                                      1" },
{ "1                                      1" },
{ "1                                      1" },
{ "1                                      1" },
{ "1                                      1" },
{ "1111111111111111111111111111111111111111" } 
};

void showCursor(bool bShowFlag){
	HANDLE h = GetStdHandle(STD_OUTPUT_HANDLE);
	CONSOLE_CURSOR_INFO csbi;

	GetConsoleCursorInfo(h, &csbi);
	csbi.bVisible = bShowFlag;
	SetConsoleCursorInfo(h, &csbi);
}

class cEntity{
public:
	int x, y;
	bool value;
	std::string name;

	cEntity(){ value = 1; }

	virtual void Move(){}

	void Settings(std::string name, int X = width / 2, int Y = height / 2){
		x = X; y = Y;
		this->name = name;
	}

	virtual ~cEntity(){}
};

class cProjectile : public cEntity{
public:
	int dir;
	cProjectile(){}

	void Move(){
		switch (dir){
		case 0:
			x--;
			break;
		case 1:
			x++;
			break;
		case 2:
			y--;
			break;
		case 3:
			y++;
			break;
		}

		if (x > width || x < 0 || y < 0 || y > height) { value = 0; }
	}
};

class cChar : public cEntity{
public:
	int direction = 0;
	cChar(){}

	void Move(){
		if (_kbhit()){
			switch (_getch()){
			case 'a':
				x--;
				direction = 0;
				break;
			case 'd':
				x++;
				direction = 1;
				break;
			case 'w':
				y--;
				direction = 2;
				break;
			case 's':
				y++;
				direction = 3;
				break;
			default:
				break;
			}
		}
	}
	
	~cChar(){}
};

class cChar2 : public cEntity{
private:
	int dir;	
public:
	cChar2(){
		dir = (rand() % 4) + 1;
	}

	void Move(){

		if (x < 1) dir = 1;	
		else if (x > width - 2) dir = 2;
		else if (y < 1)	dir = 3;
		else if (y > height - 2) dir = 4;

		switch (dir){
		case 1: x++; break;
		case 2: x--; break;
		case 3: y++; break;
		case 4: y--; break;
		}
	}

	~cChar2(){}
};

int main(){

	showCursor(false);

	srand(time(NULL));

	bool pressed = false;

	std::list<cEntity*> entities;

	int x = width / 2, y = height / 2;

	cChar* charPlayer = new cChar();
	charPlayer->Settings("char_1", x, y);
	entities.push_back(charPlayer);

	for (int i = 0; i < 4; i++){
		cChar2* c = new cChar2();
		c->Settings("char_2", rand() % width, rand() % height);
		entities.push_back(c);
	}

	while (true){

		short int numEntity = (int)entities.size();

		int X = charPlayer->x;
		int Y = charPlayer->y;

		if (GetAsyncKeyState(VK_SPACE) != 0)
			pressed = true;

		if (pressed){
			cProjectile* p = new cProjectile();
			p->dir = charPlayer->direction;
			p->Settings("projectile", X, Y);
			entities.push_back(p);
			pressed = false;
		}

		for (int i = 0; i < height; i++){
			for (int j = 0; j < width; j++){
				SetConsoleCursorPosition(GetStdHandle(STD_OUTPUT_HANDLE), { j + 25, i + 10 });
				if (level[i][j] == '1')
					std::cout << "\xFE";
				
				else{
					bool print = false;
				
					for (auto &a : entities){
						if (i == a->y && j == a->x){
							if (a->name == "projectile")
								std::cout << "a";
							else if (a->name == "char_1")
								std::cout << "A";
							else if (a->name == "char_2")
								std::cout << "@";
						}
					}

					if (!print && level[i][j] == ' ')
						std::cout << ".";
				}
				

			}
			std::cout << std::endl;
		}

		for (auto &i = entities.begin(); i != entities.end();){
			cEntity* e = *i;
			e->Move();

			if (!e->value) { i = entities.erase(i); delete e; }
			else i++;
		}

		SetConsoleCursorPosition(GetStdHandle(STD_OUTPUT_HANDLE), { 32, height+11 });
		std::cout << "On Screen Entity count = " << numEntity << std::endl;
	}

	for (auto &a : entities)
		delete a;
	entities.clear();

	system("pause");
	return 0;
}