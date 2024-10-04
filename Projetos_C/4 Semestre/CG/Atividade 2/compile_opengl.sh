#!/bin/sh
gcc $1 -o $2 -lglut -lGL -lGLU -lm
./$2
