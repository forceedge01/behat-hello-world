#!/bin/bash

branch=session-$(date +%s);
git checkout -b $branch
git add .
git commit -m "Local changes"
git checkout master
git pull
