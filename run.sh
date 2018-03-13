#/bin/bash

gnome-terminal -e "docker-compose -f api_quizz/docker-compose.yml up"
sleep 5
cd player/
gnome-terminal -e "npm run dev"
sleep 3
cd ../site_communautaire
gnome-terminal -e "npm run dev"
cd ../socketio
gnome-terminal -e "node index.js"