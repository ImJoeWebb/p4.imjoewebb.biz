p4.imjoewebb.biz
================

Project 4 - Dynamic Web Applications

My project 4 is a diary logger, very similar to OhLife. The user can create an account and view and edit their diary posts from the website. The user also sets up a time to recieve a daily email. The email will remind the user to write a new entry and will have a link to do so. There is also no social function to the website and the diary entries are kept private from other users.

Features:
* Sign up new user
* Login user
* Logout user
* Send a daily email with a link to make a new post for their diary
* Edit the time the user will recieve the email
* Add posts at any time
* Edit any post
* Delete any post

Maybes:
* Save entire diary to a text file
* Delete an account / all the user's data

Aspects of the application managed by Javascript:
* Client-side form validation

Things to work on:
- Be aware when app is resized to be thinner, it cuts off the navigation.
- Code relies on br tags. They are pretty inflexible (what if you need to add more space beneath something in the future?) so try wrapping things into div and p tags.	

Cron job: wget -q -O /dev/null http://www.p4.imjoewebb.biz/email/email