# CLassroom Management System
CMS - CLassroom management system VTA is a center management system aimed at digitalizing all information management of all centers owned by the Vocaitonal Training Authority of Sri Lanka.

This is the official repository of the CMS - VTA project.

## Route caching

If you add new routes or change existing ones you must delete the routes/cached_routes.php file
As it keeps the cache of the previously declared routes.
So you must delete the file or disable the chaching ( Only in production Stages ) of routes inorder for
route changes to take effect.

## Route Definition

All your routes should be created in the routes/routes.php file

## Important
- DO NOT MODIFY ANY FILES IN THE http AND database DIRECTORIES
- MAKE SURE TO MODIFY THE .env FILE BEFORE DEPLOYING
