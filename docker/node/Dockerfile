FROM node:22-alpine

WORKDIR /app

COPY package*.json ./

RUN npm install

COPY . .

RUN chown -R node:node /app

USER node

#EXPOSE 3000
EXPOSE 5173

ENV PATH /app/node_modules/.bin:$PATH

# Команда
CMD ["npm", "run", "serve"]