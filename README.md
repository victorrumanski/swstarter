# SW Starter

### Steps for Mac users with M1 chip

For M1 chip the mysql server images were not able to run in the default docker runtime. We have to use colima runtime instead

https://formulae.brew.sh/formula/colima

#### Start Colima

```shell
  colima start --arch x86_64 --memory 8
```

#### Use Colima context

```shell
 docker context use colima
```

#### Install Laravel dependencies

```shell
cd backend
composer install
```


#### Start docker-compose

```shell
cd ..
docker-compose up
```


# Attention

```shell
docker-compose will take more than 5 minutes to build all images

After complete the php-fpm, nginx, node.js and mysql containers will be running

```

### After docker-compose is finished

Run these commands in a shell

```shell
# open a terminal and run these commands to setup the backend project and mysql db
$ docker-compose exec backend php artisan migrate

# leave this command prompt running
$ docker-compose exec backend php artisan schedule:work

# open another shell in order to not stop the scheduler
# leave this command prompt running
$ docker-compose exec backend php artisan queue:work

```

#### For some reason calling the docker containers from Mac is very slow, please have patience.

Open the React.js frontend in a browser at http://localhost:5173

You should be able to validate the UI mockup. Only mocks 1 to 5 were implemented.
I could not finish the "Back to Search" button with previous state, need more time with react-router-dom and url params. The mockup didn't show mobile designs, but I implemented 2 breakpoints (960px and 600px).

Please search some characters and movies.

After 5 minutes laravel will schedule the metrics calculation Job. Some messages will print in the queue terminal left open.

To check the the statistics (Top five queries with percentages in the PDF) please call this url: http://localhost/api/topqueries

### Questions from beginning of PDF:

1. What are you hoping to find in your next position that would make us the right next step in your career?

A respectfull and engaging environment open to new & sound engineering ideas that can improve the lives of users.

2. What have you learned so far about us that has excited you?

The personality of the company (Hungry, Smart, Humble) is what I'm looking for in a place where I can contribute meaningful software through solving complex data and UI problems.

3. Have you worked in an environment where developers own delivering features all the way to production? We have QA (Quality Assurance) and a Product Operations team, however, they exist to provide support to engineers. Are you comfortable going to a place where the quality buck stops with the engineers and you have the ability to deploy and observe your own code in production?

Yes, Currently I work fullstack creating complete end-user features that involves a test first mentality: Unit tests in classes, integration tests on APIs and React components, headless automation tests for data pipelines, e2e cypress UI tests, load performance tests with JMeter and production monitoring with Dynatrace.

4. What is the next technology or subject you are hoping to learn about?

Laravel, Columnar DBs/NoSQL, Progressive Enhancement Design.
