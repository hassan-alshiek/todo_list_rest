# Carmudi "Unit of Measurement" Test - Hassan Alshiek

## Installation
1. Run `docker-compose build`
2. Run `docker-compose up -d`
2. Change my_model.php line 10 to your mysql containers IP

## REST Documentation
- **Endpoint:** /vehicle
- **URL:** http://localhost:5000/index.php/vehicle

###### GET
Lists all saved vehicles. Query parameters:
 - [col]=[value] - Filter by column value (ex. vehicle_id=1&vehicle_name=Test)
 - order=[col] - Order by a column(ex. order=vehicle_name)
 - sort=[ASC,DESC] - Sort by ASC or DESC order
 
Response:
```
{
    "status": true,
    "results": [
        {
            "vehicle_id": "1",
            "vehicle_name": "Ford Ecosport",
            "engine_displacement": "1.50",
            "displacement_type_id": "1",
            "engine_power": "99",
            "converted_engine_displacement": "1.50 l",
            "displacement_type": "liters",
            "displacement_type_short": "l"
        },
        {
            "vehicle_id": "2",
            "vehicle_name": "BMW X6",
            "engine_displacement": "4395.00",
            "displacement_type_id": "2",
            "engine_power": "567",
            "converted_engine_displacement": "4.40 l",
            "displacement_type": "cubic centimetres",
            "displacement_type_short": "cc"
        }
    ]
}
```
 
###### POST
Add new vehicle. Params
 - vehicle_name - required, varchar, max[100]
 - engine_displacement - required, decimal
 - displacement_type_id - required, in_list[1 - litres, 2 - cubic centimetres, 3 - cubic inches]
 - engine_power - required, int[11]
 
 Success Response:
 ```
{
    "status": true,
    "results": {
        "vehicle_id": 3
    }
}
 ``` 
 Error Sample Response:
 ```
{
    "status": false,
    "results": "displacement_type_id must be 1, 2, 3. engine_power is required. "
}
 ```

## Implementation Explanation
No frameworks were used. I modified a lightweight REST API structure to use in this project.
To solve the "unit of measurement" issue, I created a table for displacement_types and a virtual column named converted_engine_displacement 
that converts all the displacements to litres. Doing so solves the problem of sorting and arranging by engine displacement.
- The GET call has a search by column function, a order by column as well as sort
- The POST call has minor rule checking implemented

## Optional (This will not impact in your result)

**You're NOT supposed to change the code on any of the following items. Just describe how you would implement it.**

 - Consider also electric vehicles. They do not have a combustion chamber, and also consequently no engine displacement. What would you do to support eletric vehicles?
    * The implemented displacement_types table can be modified to accomodate electric vehicles
 - As very last evaluation point we have performance. Keep in mind that this is not the main goal of this application, since the users are our own employees, even if it takes 10 minutes to load the page, the business can still be successful.
    * Performance is not a issue on the written code as it does not use a heavy framework and only uses simple SQL queries
 - Describe the flaws of technologies you are using. For example, if you decided to use Zend Framework 1, then you should say which parts of the framework are bad and reasons why you consider them bad.
    * Because I did not use any framework security is a issue in this REST API, mysql injections, unvalidated input are not checked.
 - This test is also a continuous improvement process. Suggest how you would improve it.
    * Input rule checking can be improved
    * Security to common injections can be implemented
    * Better GET filtering can be implemented
    * Duplicate entry checking can be implemented
