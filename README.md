# finalAPI

# Description
This is an API built to provide data to the client in our volunteer system project. Each route is self-descriptive and consists of queries to our database and returns JSON objects inside of an array.

#Installation
To install, download XAMPP on your machine and after installation and make sure that all services (Apache, ProFTPD, MySQL) are started. Set up the database using the sql file thats included in the zip folder that we provide. Once the DB is setup, open the XAMPP app and click on Volumes and then click on explore. This will open your local `lampp` folder and then enter the `htdocs` folder. Drop this project folder (API only, not the client) inside `htdocs` and you're done! Now as long as all the services are running, you'll be able to make fetch requests from the `Client`. 