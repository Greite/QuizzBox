#/bin/bash

gnome-terminal -e "docker-compose -f api_quizz/docker-compose.yml up"
sleep 7
cd player/
gnome-terminal -e "npm run dev"
sleep 5
cd ../site_communautaire
gnome-terminal -e "npm run dev"
sleep 5
cd ../socketio
gnome-terminal -e "node index.js"
