# CakePHP Application
This is a cakePHP application purely for totorial purposes.
You cant run the application without a mySQL database set up as per the needs of the application.
Also of course needs PHP to be installed with a range of extensions for cakePHP.

The transperth application has teh following features:
login,
Register new user ( with role user) - but knows about admin.
logout,
Authorisation is set up to allow selective access for
  not logged in
  user
  admin
The main menu changes according to the user role as above - this is done using a cell.

The transperth application will enable users to plan bus/train trips in Perth/Australia
(the official application already exists - and transperth is a registered trademark)

There is a screen for users to enter departure and destination addresses.
This screen accesses the google api and looks up the lat, long coordinates for the locations
The time of day is also entered if different from now.

Alternatively, the user can bring up a map and click on departure and destination locations.
The lat, long coordinates for the locations can then be read via the api.

Then we apply an algorithm to look up the transperth stops, routes, timetables ( in mySQL)
and find a suitable bus ( stage one does not cater for transfers).

This is a work in progress ... 

One of the aims is to use as many of the cakePHP features as possible ... like..

view templates
view layouts
view elements
view blocks
view cells
html helper
http helper
url helper
Controllers
Models and Entities
Views
Middleware
Authorisation component 

Brendan Curtin