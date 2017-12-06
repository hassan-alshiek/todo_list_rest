# To-Do List REST

## Installation
1. Run `docker-compose build`
2. Run `docker-compose up -d`
3. Change my_model.php line 10 to your mysql containers IP
4. Access Front-end via http://localhost:5000/app/ NOTE:(Back-end is http://localhost:5000/api/index.php/todo_list)

## Implementation
Backend
- Working CRUD
- The GET call has a search by column function, a order by column as well as sort
- The POST and PUT call has minor rule checking implemented

Frontend
- Working CRUD
- Bootstrap and JQuery