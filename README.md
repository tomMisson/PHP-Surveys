# 2CWK50-PHP

## Bio

Created by Tom Misson (18008043)

## Installation

No packages to install.  

To create the database, visit this URL first
```
http://localhost:82/2CWK50-PHP/create-data.php
```

If all has run been created successfully then you will be redirected to the home page.


## Features

- Admin can view (but not edit) all users and their data within the system by clicking on the users name in the table.  
- Admin can delete users  
- Admin can promote user to admin  
- Admin can delete surveys 
- Admin has modification privileges (can both view and edit) any survey in the system  
- Use of substring to determine if the user is in a builder or viewer mode to allow easy toggling between the two modes
- Used associative arrays where necessary and have limited the use of global variables
- Examples of own functions can be found in the [helper](helper.php)
- Can delete questions from surveys
- Favorites has populated data
- Can have unlimited questions on one survey (theoretically)


## Usage

If for some reason you aren't redirected after creating the data locally, enter the URL below: 
```
http://localhost:82/2CWK50-PHP/
```

## Guidance

The main survey in the site is the favorites survey that belongs to tom (username:tom password:tom123) that is accessible through both the admin tools and the normal UI, it is also view-able/answer-able by anyone as it is shared at:
```
http://localhost:82/2CWK50-PHP/view-survey.php?id=1
```  

As an example of a accessing an unshared survey (when logged in as anyone but the owner of the survey):
```
http://localhost:82/2CWK50-PHP/view-survey.php?id=2
```  

Competitor info can be found in the menu when you're signed out or at this link:
```
http://localhost:82/2CWK50-PHP/competitors.php
```  

Users of the system:
| Username      | Password      | Role  |
| ------------- |-------------  | ----- |
| admin         | secret        | admin |
| tom           | tom123        |  user |
| test          | tom123        |  user |


## License
[GNU General Public License v3.0](https://choosealicense.com/licenses/gpl-3.0/)
