###################
Tasklist
###################
Project Name
*******************
dekasons car rental
*******************
*******************
V 1.0
*******************
Project requirements
1. setup dev in php CI (i will purcashe the hosting & domain)
2. standard login page for now
3. Dashboard: please show bookings, Vehicles, Income, Expense, Customers & Users (no charts for now it's fine)
4. Users (Customers, Admin): Add, delete, edit, disable/enable, change password (Admin only)
admin details: username, firstname, lastname, password, access level
customers: username, firstname, lastname, address, phone, email, upload photo, notes 
5. Vehicles: add, delete, edit, disable/enable, export (pdf & excel)

Manage = Images, Maker, Model, Type, Color, Year, License Plate, Status  (i might add more fields later)
Inspections = please follow like this guy: https://f6.hyvikk.space/admin/vehicle-reviews-create

6. Bookings: add, delete, edit, disable/enable, export (pdf & excel)

Create New: Select customer, Pickup date & time, dropoff date & time, Delivery needed?, Select Vehicle, Pickup Address, Drop-off address, Select amount of Pricing or custom pricing, payment type, discount (fixed amount or %) Notes
Pricing: name, description, price, status
payment type: we only have 2 for now, cash & manual bank transfer
Manage: customer, vehicle, pickup address, pickup time and date, dropoff time& date, dropoff address, payment status, payment amount, booking status
calendar: https://f6.hyvikk.space/admin/bookings_calendar (if you can add this too that would be great..but this is for later)

7. Services, Expense & Salary: Bookings: add, delete, edit, disable/enable, export (pdf & excel)

Service: name, description, date, status, amount, user, autoshop name & address, notes
Expense: name, description, date, status, amount, user,  notes
Salary: name, description, date, status, amount, user,  notes

8 Transaction: Bookings: add, delete, edit, disable/enable, export (pdf & excel)

income and expense (basically they will show here automatically since income will come from bookings, and expense will come from no 7.)

What we can do here sort, view & listing tools and maybe add "create new" manually button for income and expense

9. Reports: generate reports,  export (pdf & excel)

10. Other tools:

a. service reminder
b. booking inquires > html form in the frontend too
c. user access management
d. logout
