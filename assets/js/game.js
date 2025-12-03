const grid = document.querySelector(".grid");
const sizeSelect = document.getElementById("size");
const generateBtn = document.querySelector(".parameters button");
const cards = [];
let wait = false;
let start = false;

class Card {
    constructor(element, flipImage) {
        this.element = element;
        this.flipImage = flipImage;
        this.isFlipped = false;
        this.isFind = false;
        this.imgElement = this.element.querySelector('.face-back img');
        this.imgElement.src = flipImage;
    }

    flip() {
        this.isFlipped = true;
        this.element.classList.add('flipped');
    }

    hide() {
        this.isFlipped = false;
        this.element.classList.remove('flipped');
    }
}

/**
 * Génère la grille de Memory.
 */
function generateGrid() {
    const selectedSize = sizeSelect.value;
    grid.innerHTML = "";
    grid.classList.remove("grid-4", "grid-6", "grid-10");

    let cardCount;
    let gridClass;

    switch (selectedSize) {
        case "4x4":
            cardCount = 16;
            gridClass = "grid-4";
            break;
        case "6x6":
            cardCount = 36;
            gridClass = "grid-6";
            break;
        case "10x10":
            cardCount = 100;
            gridClass = "grid-10";
            break;
        default:
            cardCount = 16;
            gridClass = "grid-4";
    }

    grid.classList.add(gridClass);

    let images = [
        // Web Core & Front-end (1-10)
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/html5/html5-original.svg",       // HTML5
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/css3/css3-original.svg",         // CSS3
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/javascript/javascript-original.svg", // JavaScript (JS)
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/typescript/typescript-original.svg", // TypeScript (TS)
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/react/react-original.svg",       // React
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/vuejs/vuejs-original.svg",       // Vue.js
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/angularjs/angularjs-original.svg", // AngularJS
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/redux/redux-original.svg",       // Redux
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/sass/sass-original.svg",         // Sass
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/tailwindcss/tailwindcss-original.svg", // Tailwind CSS

        // Back-end & Frameworks JS/PHP (11-20)
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/nodejs/nodejs-original.svg",     // Node.js
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/express/express-original.svg",   // Express
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/php/php-original.svg",           // PHP
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/laravel/laravel-original.svg",   // Laravel (PHP)
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/symfony/symfony-original.svg",   // Symfony (PHP)
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/nestjs/nestjs-original.svg",     // NestJS (Node.js)
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/gatsby/gatsby-original.svg",     // Gatsby (React Framework)
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/nextjs/nextjs-original.svg",     // Next.js (React Framework)
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/nuxt/nuxt-original.svg",         // Nuxt.js (Vue.js Framework)
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/cypressio/cypressio-original.svg", // Cypress

        // Langages Orientés Objet (21-30)
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/java/java-original.svg",         // Java
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/spring/spring-original.svg",     // Spring (Java)
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/cplusplus/cplusplus-original.svg", // C++
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/csharp/csharp-original.svg",     // C#
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/vitejs/vitejs-original.svg",     // Vite.js (REMPLACEMENT de .NET)
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/ruby/ruby-original.svg",         // Ruby
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/rails/rails-original-wordmark.svg", // Ruby on Rails
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/swift/swift-original.svg",       // Swift
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/kotlin/kotlin-original.svg",     // Kotlin
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/haskell/haskell-original.svg",   // Haskell

        // Langages Dynamiques & Data (31-40)
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/python/python-original.svg",     // Python
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/django/django-plain.svg",       // Django (Python)
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/flask/flask-original.svg",       // Flask (Python)
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/r/r-original.svg",               // R (Statistiques)
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/julia/julia-original.svg",       // Julia
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/matlab/matlab-original.svg",     // Matlab
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/pandas/pandas-original.svg",     // Pandas (Python Data)
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/numpy/numpy-original.svg",       // NumPy (Python Data)
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/jupyter/jupyter-original.svg",   // Jupyter Notebooks
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/scikitlearn/scikitlearn-original.svg", // Scikit-learn (ML Python)

        // Bases de données Relationnelles & NoSQL (41-50)
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/mysql/mysql-original.svg",       // MySQL
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/postgresql/postgresql-original.svg", // PostgreSQL
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/mongodb/mongodb-original.svg",   // MongoDB
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/sqlite/sqlite-original.svg",     // SQLite
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/oracle/oracle-original.svg",     // Oracle DB
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/redis/redis-original.svg",       // Redis
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/cassandra/cassandra-original.svg", // Cassandra
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/couchdb/couchdb-original.svg",   // CouchDB
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/mariadb/mariadb-original.svg",   // MariaDB
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/neo4j/neo4j-original.svg",       // Neo4j (Graph DB)

        // Cloud & APIs (51-60)
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/amazonwebservices/amazonwebservices-plain-wordmark.svg", // AWS
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/azure/azure-original.svg",       // Azure
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/googlecloud/googlecloud-original.svg", // Google Cloud (GCP)
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/firebase/firebase-plain.svg",    // Firebase
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/heroku/heroku-original.svg",     // Heroku
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/digitalocean/digitalocean-original.svg", // DigitalOcean
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/graphql/graphql-plain.svg",      // GraphQL
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/postman/postman-original.svg",   // Postman
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/terraform/terraform-original.svg", // Terraform (IaC)
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/ansible/ansible-original.svg",   // Ansible (Configuration)

        // DevOps & Outils (61-70)
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/git/git-original.svg",           // Git
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/github/github-original.svg",     // GitHub
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/gitlab/gitlab-original.svg",     // GitLab
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/docker/docker-original.svg",     // Docker
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/kubernetes/kubernetes-plain.svg", // Kubernetes
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/jenkins/jenkins-original.svg",   // Jenkins (CI/CD)
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/travis/travis-original.svg",     // Travis CI
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/jira/jira-original.svg",         // Jira
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/slack/slack-original.svg",       // Slack
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/trello/trello-plain.svg",        // Trello

        // Systèmes & Shells (71-80)
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/linux/linux-original.svg",       // Linux
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/ubuntu/ubuntu-plain.svg",        // Ubuntu
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/fedora/fedora-original.svg",     // Fedora
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/centos/centos-original.svg",     // CentOS
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/apple/apple-original.svg",       // Apple (macOS)
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/windows8/windows8-original.svg", // Windows
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/bash/bash-original.svg",         // Bash Shell
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/powershell/powershell-original.svg", // PowerShell
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/vim/vim-original.svg",           // Vim (Éditeur)
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/vscode/vscode-original.svg",     // VS Code

        // Mobile & Cross-Platform (81-90)
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/android/android-original.svg",   // Android
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/dart/dart-original.svg",         // Dart
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/flutter/flutter-original.svg",   // Flutter (Dart)
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/ionic/ionic-original.svg",       // Ionic
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/reactnative/reactnative-original.svg", // React Native
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/xamarin/xamarin-original.svg",   // Xamarin
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/apache/apache-original.svg",     // Apache
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/electron/electron-original.svg", // Electron (Desktop JS)
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/opencv/opencv-original.svg",     // OpenCV (Vision par ordinateur)
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/arduino/arduino-original.svg",   // Arduino

        // Build Tools & Autres (91-100)
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/npm/npm-original-wordmark.svg",  // npm
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/yarn/yarn-original.svg",         // Yarn
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/webpack/webpack-original.svg",   // Webpack
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/babel/babel-original.svg",       // Babel
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/gulp/gulp-plain.svg",            // Gulp
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/grunt/grunt-original.svg",       // Grunt
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/jest/jest-plain.svg",            // Jest (Tests JS)
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/mocha/mocha-original.svg",       // Mocha (Tests JS)
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/figma/figma-original.svg",       // Figma (Design)
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/blender/blender-original.svg",   // Blender (3D)
    ];

    const neededPairs = cardCount / 2;
    let selectedImages = images.slice(0, neededPairs);
    selectedImages = selectedImages.concat(selectedImages);

    cards.length = 0;

    for (let i = 0; i < cardCount; i++) {

        const index = Math.floor(Math.random() * selectedImages.length);
        const flipImage = selectedImages[index];
        selectedImages.splice(index, 1);

        const cardContainer = document.createElement("div");
        cardContainer.classList.add("card-container");

        const cardElement = document.createElement("div");
        cardElement.classList.add("memory-card");

        const faceFront = document.createElement("div");
        faceFront.classList.add("face", "face-front");

        const faceBack = document.createElement("div");
        faceBack.classList.add("face", "face-back");
        const flipImageElement = document.createElement("img");
        faceBack.appendChild(flipImageElement);

        cardElement.appendChild(faceFront);
        cardElement.appendChild(faceBack);
        cardContainer.appendChild(cardElement);
        grid.appendChild(cardContainer);

        const cardObj = new Card(cardElement, flipImage);
        cards.push(cardObj);

        cardContainer.addEventListener("click", () => {

            if (!start || wait) return;
            if (cardObj.isFlipped || cardObj.isFind) return;

            cardObj.flip();

            setTimeout(() => {
                const flippedCards = cards.filter(c => c.isFlipped && !c.isFind);

                if (flippedCards.length === 2) {
                    if (flippedCards[0].flipImage === flippedCards[1].flipImage) {

                        flippedCards.forEach(c => c.isFind = true);
                        if (cards.every(c => c.isFind)) {
                            alert("Félicitations ! Vous avez trouvé toutes les paires ! (" + timeFormat(time) + ")");
                            clearInterval(timerInterval);
                            start = false;
                        }
                    } else {
                        wait = true;
                        setTimeout(() => {
                            flippedCards.forEach(c => c.hide());
                            wait = false;
                        }, 800);
                    }
                }
            }, 50);
        });
    }
}

// Chrono
let startTime;
let chrono;
let timerInterval;

let time = 0;

function timeFormat(ms) {
    const totalSeconds = Math.floor(ms / 1000);
    const minutes = Math.floor(totalSeconds / 60);
    const seconds = totalSeconds % 60;
    const milliseconds = Math.floor((ms % 1000) / 10);
    return `${minutes}m ${seconds}s ${milliseconds}cs`;
}

generateBtn.addEventListener("click", () => {
    generateGrid();
    start = true;

    if (!chrono) {
        chrono = document.createElement("p");
        document.querySelector(".game").appendChild(chrono);
    }

    startTime = Date.now();
    if (timerInterval) clearInterval(timerInterval);
    timerInterval = setInterval(() => {
        const elapsed = Date.now() - startTime;
        time = elapsed;
        chrono.innerHTML = `<i class="ri-timer-line"></i> Chronomètre: ${timeFormat(elapsed)}`;
    }, 10);
});